<?php
// app/Http/Controllers/SubmitProjectController.php

namespace App\Http\Controllers;

use App\Models\SubmitProject;
use App\Models\Project;
use App\Models\Progress;
use App\Models\Payment;
use App\Models\Wallet;
use App\Services\NotificationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SubmitProjectController extends Controller
{
    public function store(Request $request)
    {
        \Log::info('User ID: ' . auth()->id());
        \Log::info('Request data:', $request->all());
        
        try {
            Log::info('SubmitProject Request Data:', $request->all());

            $request->validate([
                'project_id'   => 'required|exists:projects,id',
                'links'        => 'required|string',
                'description'  => 'required|string|min:10',
                'notes'        => 'nullable|string',
            ]);

            $links = [];
            if ($request->filled('links')) {
                $links = array_filter(preg_split("/\r\n|\n|\r/", $request->links));
            }

            $existing = SubmitProject::where('project_id', $request->project_id)
                ->where('user_id', auth()->id())
                ->first();

            if ($existing) {
                $submission = $existing;
                $existing->update([
                    'links'       => $links,
                    'description' => $request->description,
                    'notes'       => $request->notes,
                    'status'      => 'pending',
                ]);
            } else {
                $submission = SubmitProject::create([
                    'user_id'     => auth()->id(),
                    'project_id'  => $request->project_id,
                    'files'       => [],
                    'links'       => $links,
                    'description' => $request->description,
                    'notes'       => $request->notes,
                    'status'      => 'pending',
                ]);
            }

            NotificationService::projectSubmitted($submission);

            Log::info('Submission completed successfully:', ['project_id' => $request->project_id]);

            return response()->json([
                'success' => true,
                'message' => $existing ? 'Resubmission berhasil disimpan! Client akan menerima notifikasi.' : 'Submission berhasil disimpan! Client akan menerima notifikasi.',
                'data' => $submission
            ], 200);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
        } catch (\Exception $e) {
            Log::error('SubmitProject Error:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        Log::info("MASUK method show START", ['id' => $id]);

        $submitProject = SubmitProject::with('project')->findOrFail($id);

        $user = auth()->user();

        $isProjectOwner = $submitProject->project
            ? $submitProject->project->user_id === $user->id
            : false;

        $isSubmitter = $submitProject->user_id === $user->id;

        Log::info('Authorization flags', [
            'isProjectOwner' => $isProjectOwner,
            'isSubmitter'    => $isSubmitter,
        ]);

        if (!$isProjectOwner && !$isSubmitter) {
            return response()->json(['success' => false, 'message' => 'Unauthorized access'], 403);
        }

        return response()->json($submitProject);
    }

    public function updateStatus(Request $request, $id)
    {
        try {
            $submitProject = SubmitProject::with(['project', 'user'])->findOrFail($id);
            
            Log::info('🔵 updateStatus START', [
                'submission_id' => $submitProject->id,
                'project_id' => $submitProject->project_id,
                'current_status' => $submitProject->status,
                'requested_status' => $request->status,
                'client_id' => auth()->id(),
                'freelancer_id' => $submitProject->user_id
            ]);

            $request->validate([
                'status' => 'required|in:pending,revisi,selesai',
                'notes' => $request->status === 'revisi' ? 'required|string|min:10|max:2000' : 'nullable|string|max:2000',
            ]);

            if ($submitProject->project->user_id !== auth()->id()) {
                Log::warning('❌ Unauthorized access attempt', [
                    'submission_id' => $submitProject->id,
                    'project_owner' => $submitProject->project->user_id,
                    'requesting_user' => auth()->id()
                ]);
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized access'
                ], 403);
            }

            DB::beginTransaction();

            $oldStatus = $submitProject->status;
            $updateData = ['status' => $request->input('status')];

            if ($request->filled('notes')) {
                $updateData['notes'] = $request->input('notes');
            }

            $submitProject->update($updateData);

            Log::info('✅ Status updated in DB', [
                'submission_id' => $submitProject->id,
                'old_status' => $oldStatus,
                'new_status' => $submitProject->status
            ]);

            if ($request->input('status') === 'selesai' && $oldStatus !== 'selesai') {
                Log::info('🟢 Processing project completion...');
                
                // ✅ PERBAIKAN: Release payment ke freelancer dengan BALANCE (bukan pending_balance)
                $paymentReleased = $this->releasePaymentToFreelancer($submitProject);
                
                // Update project status
                $submitProject->project->update(['status' => 'completed']);
                
                Log::info('✅ Project status updated to completed', [
                    'project_id' => $submitProject->project_id
                ]);
                
                // Trigger notification
                NotificationService::projectApproved($submitProject);
                
                Log::info('🎉 PROJECT COMPLETION SUMMARY', [
                    'submission_id' => $submitProject->id,
                    'project_id' => $submitProject->project_id,
                    'freelancer_id' => $submitProject->user_id,
                    'payment_released' => $paymentReleased ? 'YES' : 'NO',
                    'amount_released' => $paymentReleased['amount'] ?? 0,
                    'notification_sent' => true,
                    'project_status' => 'completed'
                ]);
                
            } elseif ($request->input('status') === 'revisi') {
                Log::info('🟡 Processing revision request...');
                NotificationService::projectRevision($submitProject, $request->input('notes'));
                
                Log::info('✅ Revision notification sent', [
                    'submission_id' => $submitProject->id,
                    'notes_length' => strlen($request->input('notes'))
                ]);
            }

            DB::commit();

            $message = match($request->input('status')) {
                'selesai' => 'Project berhasil diselesaikan! Pembayaran Rp ' . 
                            number_format($paymentReleased['amount'] ?? 0, 0, ',', '.') . 
                            ' telah ditambahkan ke saldo freelancer.',
                'revisi' => 'Permintaan revisi berhasil dikirim ke freelancer.',
                default => 'Status berhasil diperbarui!'
            };

            return response()->json([
                'success' => true,
                'message' => $message,
                'data' => [
                    'submission' => $submitProject->fresh(),
                    'payment_info' => $paymentReleased ?? null
                ]
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            DB::rollBack();
            Log::error('❌ Validation error:', [
                'errors' => $e->errors(),
                'submission_id' => $id
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('💥 UpdateStatus Error:', [
                'submission_id' => $id,
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * ✅ FIXED: Release payment ke BALANCE (bukan pending_balance)
     */
    private function releasePaymentToFreelancer(SubmitProject $submitProject)
    {
        try {
            Log::info('💰 Starting payment release process...', [
                'project_id' => $submitProject->project_id,
                'freelancer_id' => $submitProject->user_id
            ]);

            // Cari payment yang sudah success tapi belum dirilis
            $payment = Payment::where('project_id', $submitProject->project_id)
                ->where('freelancer_id', $submitProject->user_id)
                ->where('status', 'success')
                ->where('is_released_to_freelancer', false)
                ->first();

            if (!$payment) {
                Log::warning('⚠️ No payment found to release', [
                    'project_id' => $submitProject->project_id,
                    'freelancer_id' => $submitProject->user_id
                ]);
                
                $alreadyReleased = Payment::where('project_id', $submitProject->project_id)
                    ->where('freelancer_id', $submitProject->user_id)
                    ->where('is_released_to_freelancer', true)
                    ->exists();
                
                if ($alreadyReleased) {
                    Log::info('ℹ️ Payment already released previously');
                    return [
                        'status' => 'already_released',
                        'message' => 'Payment sudah dirilis sebelumnya'
                    ];
                }
                
                return null;
            }

            Log::info('📦 Payment found', [
                'payment_id' => $payment->payment_id,
                'order_id' => $payment->order_id,
                'amount' => $payment->amount,
                'service_amount' => $payment->service_amount,
                'admin_fee' => $payment->admin_fee
            ]);

            // ✅ PERBAIKAN: Gunakan service_amount (bukan admin_fee)
            $amountToRelease = $payment->service_amount;
            
            if (!$amountToRelease || $amountToRelease <= 0) {
                Log::error('❌ Invalid service_amount', [
                    'payment_id' => $payment->payment_id,
                    'service_amount' => $payment->service_amount
                ]);
                throw new \Exception('Invalid service amount');
            }

            Log::info('💵 Amount calculation', [
                'total_amount' => $payment->amount,
                'admin_fee' => $payment->admin_fee,
                'service_amount' => $amountToRelease
            ]);

            // Get atau create wallet
            $wallet = Wallet::firstOrCreate(
                ['user_id' => $payment->freelancer_id],
                [
                    'balance' => 0,
                    'pending_balance' => 0
                ]
            );

            Log::info('👛 Wallet before release', [
                'wallet_id' => $wallet->id,
                'user_id' => $wallet->user_id,
                'balance' => $wallet->balance,
                'pending_balance' => $wallet->pending_balance
            ]);

            // ✅ PERBAIKAN: Tambahkan ke BALANCE (bukan pending_balance)
            $balanceBefore = $wallet->balance;
            $wallet->balance += $amountToRelease; // ⬅️ INI YANG BENAR!
            $wallet->save();

            Log::info('✅ Wallet updated', [
                'wallet_id' => $wallet->id,
                'balance_before' => $balanceBefore,
                'balance_after' => $wallet->balance,
                'amount_added' => $amountToRelease,
                'pending_balance' => $wallet->pending_balance
            ]);

            // Create transaction record
            $transaction = $wallet->transactions()->create([
                'payment_id' => $payment->id,
                'type' => 'credit',
                'status' => 'completed',
                'amount' => $amountToRelease,
                'description' => sprintf(
                    "Pembayaran dari project #%d - %s",
                    $submitProject->project_id,
                    $submitProject->project->title
                ),
                'balance_before' => $balanceBefore,
                'balance_after' => $wallet->balance
            ]);

            Log::info('📝 Transaction created', [
                'transaction_id' => $transaction->id,
                'type' => 'credit',
                'amount' => $amountToRelease
            ]);

            // Update payment record
            $payment->update([
                'is_released_to_freelancer' => true,
                'released_at' => now(),
                'release_notes' => sprintf(
                    'Funds released to freelancer balance. Amount: Rp %s',
                    number_format($amountToRelease, 0, ',', '.')
                )
            ]);

            Log::info('✅ Payment record updated', [
                'payment_id' => $payment->payment_id,
                'is_released' => true,
                'released_at' => $payment->released_at
            ]);

            // Trigger notification
            NotificationService::paymentReceived($payment);

            $releaseInfo = [
                'status' => 'success',
                'payment_id' => $payment->payment_id,
                'amount' => $amountToRelease,
                'formatted_amount' => 'Rp ' . number_format($amountToRelease, 0, ',', '.'),
                'freelancer_id' => $payment->freelancer_id,
                'wallet_balance' => $wallet->balance,
                'wallet_pending' => $wallet->pending_balance,
                'transaction_id' => $transaction->id,
                'released_at' => now()->toDateTimeString()
            ];

            Log::info('🎉 PAYMENT RELEASE SUCCESS', $releaseInfo);

            return $releaseInfo;

        } catch (\Exception $e) {
            Log::error('💥 Failed to release payment:', [
                'error' => $e->getMessage(),
                'submission_id' => $submitProject->id,
                'project_id' => $submitProject->project_id,
                'freelancer_id' => $submitProject->user_id,
                'line' => $e->getLine(),
                'file' => $e->getFile(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return [
                'status' => 'error',
                'message' => $e->getMessage()
            ];
        }
    }

    public function getProjectStatus($projectId)
    {
        $project = Project::find($projectId);

        if (!$project) {
            return response()->json([
                'success' => false,
                'message' => 'Project tidak ditemukan'
            ], 404);
        }

        $submission = SubmitProject::where('project_id', $projectId)
            ->where('user_id', auth()->id())
            ->first();

        $displayStatus = $submission ? match ($submission->status) {
            'pending' => 'Menunggu Persetujuan',
            'revisi'  => 'Revisi',
            'selesai' => 'Selesai',
            default   => 'Dalam Proses'
        } : 'Dalam Proses';

        $freelancerName = optional(
            $project->proposalls()
                ->where('status', 'accepted')
                ->with('user')
                ->first()
        )->user->name ?? '-';

        $progress = Progress::where('project_id', $projectId)->get();

        $totalFiles = \App\Models\Timeline::where('project_id', $projectId)
                        ->where('status', 'selesai')
                        ->count();

        return response()->json([
            'project' => [
                'id'    => $project->id,
                'title' => $project->title,
            ],
            'status'  => $submission->status ?? 'dalam_proses',
            'display' => $displayStatus,
            'notes'   => $submission->notes ?? null,
            'freelancer_name' => $freelancerName,
            'total_links'     => $totalFiles,
            'links'           => $progress->map(fn($p) => [
                'url' => $p->link_url,
            ]),
            'chat_url' => route('chat')
        ]);
    }

    public function getRevisionNotes($projectId)
    {
        try {
            $submitProject = SubmitProject::where('project_id', $projectId)
                ->where('user_id', auth()->id())
                ->where('status', 'revisi')
                ->first();

            if (!$submitProject) {
                return response()->json([
                    'success' => false,
                    'notes' => 'Data revisi tidak ditemukan.'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'notes' => $submitProject->notes ?? 'Tidak ada catatan khusus dari client.'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'notes' => 'Gagal memuat catatan revisi.'
            ], 500);
        }
    }
}