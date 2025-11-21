<?php
// app/Services/NotificationService.php
// ✅ FILE BARU - BUAT FILE INI

namespace App\Services;

use App\Models\Notification;
use App\Models\User;
use App\Models\Proposal;
use App\Models\SubmitProject;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class NotificationService
{
    /**
     * Notifikasi saat freelancer mengirim proposal ke client
     */
    public static function proposalReceived(Proposal $proposal)
    {
        try {
            $freelancer = $proposal->user;
            $project = $proposal->project;
            $client = $project->user;

            Notification::createNotification(
                $client->id,
                Notification::TYPE_PROPOSAL_RECEIVED,
                'Proposal Baru untuk Proyek Anda',
                "{$freelancer->name} mengajukan proposal untuk proyek \"{$project->title}\" dengan penawaran Rp " . number_format($proposal->proposal_price, 0, ',', '.'),
                [
                    'proposal_id' => $proposal->id,
                    'project_id' => $project->id,
                    'freelancer_id' => $freelancer->id,
                    'freelancer_name' => $freelancer->name,
                    'project_title' => $project->title,
                    'price' => $proposal->proposal_price,
                ]
            );

            Log::info('Notification created: Proposal received', [
                'client_id' => $client->id,
                'proposal_id' => $proposal->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create proposal received notification: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat proposal diterima oleh client
     */
    public static function proposalAccepted(Proposal $proposal)
    {
        try {
            $freelancer = $proposal->user;
            $project = $proposal->project;

            Notification::createNotification(
                $freelancer->id,
                Notification::TYPE_PROPOSAL_ACCEPTED,
                'Proposal Diterima!',
                "Selamat! Proposal Anda untuk proyek \"{$project->title}\" telah diterima oleh {$project->user->name}. Proyek dimulai hari ini.",
                [
                    'proposal_id' => $proposal->id,
                    'project_id' => $project->id,
                    'client_id' => $project->user_id,
                    'client_name' => $project->user->name,
                    'project_title' => $project->title,
                ]
            );

            Log::info('Notification created: Proposal accepted', [
                'freelancer_id' => $freelancer->id,
                'proposal_id' => $proposal->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create proposal accepted notification: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat proposal ditolak oleh client
     */
    public static function proposalRejected(Proposal $proposal)
    {
        try {
            $freelancer = $proposal->user;
            $project = $proposal->project;

            Notification::createNotification(
                $freelancer->id,
                Notification::TYPE_PROPOSAL_REJECTED,
                'Proposal Tidak Diterima',
                "Proposal Anda untuk proyek \"{$project->title}\" tidak diterima oleh client. Jangan menyerah, masih banyak proyek lainnya!",
                [
                    'proposal_id' => $proposal->id,
                    'project_id' => $project->id,
                    'project_title' => $project->title,
                ]
            );

            Log::info('Notification created: Proposal rejected', [
                'freelancer_id' => $freelancer->id,
                'proposal_id' => $proposal->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create proposal rejected notification: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat freelancer submit project ke client
     */
    public static function projectSubmitted(SubmitProject $submission)
    {
        try {
            $freelancer = $submission->user;
            $project = $submission->project;
            $client = $project->user;

            $linksCount = is_array($submission->links) ? count($submission->links) : 0;

            Notification::createNotification(
                $client->id,
                Notification::TYPE_PROJECT_SUBMITTED,
                'Pekerjaan Telah Diserahkan',
                "{$freelancer->name} telah mengirimkan hasil pekerjaan \"{$project->title}\" untuk review Anda. Total {$linksCount} file/link diserahkan. Silakan periksa dan berikan feedback.",
                [
                    'submission_id' => $submission->id,
                    'project_id' => $project->id,
                    'freelancer_id' => $freelancer->id,
                    'freelancer_name' => $freelancer->name,
                    'project_title' => $project->title,
                    'total_links' => $linksCount,
                ]
            );

            Log::info('Notification created: Project submitted', [
                'client_id' => $client->id,
                'submission_id' => $submission->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create project submitted notification: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat client approve project (status selesai)
     */
    public static function projectApproved(SubmitProject $submission)
    {
        try {
            $freelancer = $submission->user;
            $project = $submission->project;

            $payment = Payment::where('project_id', $project->id)
                ->where('freelancer_id', $freelancer->id)
                ->where('status', 'success')
                ->first();

            $amount = $payment ? $payment->service_amount : 0;

            Notification::createNotification(
                $freelancer->id,
                Notification::TYPE_PROJECT_APPROVED,
                'Project Disetujui!',
                "Selamat! Project \"{$project->title}\" telah disetujui oleh client. Pembayaran sebesar Rp " . number_format($amount, 0, ',', '.') . " akan segera diproses ke saldo Anda.",
                [
                    'submission_id' => $submission->id,
                    'project_id' => $project->id,
                    'project_title' => $project->title,
                    'amount' => $amount,
                ]
            );

            Log::info('Notification created: Project approved', [
                'freelancer_id' => $freelancer->id,
                'submission_id' => $submission->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create project approved notification: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat client minta revisi
     */
    public static function projectRevision(SubmitProject $submission, $revisionNotes)
    {
        try {
            $freelancer = $submission->user;
            $project = $submission->project;

            Notification::createNotification(
                $freelancer->id,
                Notification::TYPE_PROJECT_REVISION,
                'Permintaan Revisi',
                "Client meminta revisi untuk project \"{$project->title}\". Catatan: " . substr($revisionNotes, 0, 100) . (strlen($revisionNotes) > 100 ? '...' : ''),
                [
                    'submission_id' => $submission->id,
                    'project_id' => $project->id,
                    'project_title' => $project->title,
                    'revision_notes' => $revisionNotes,
                ]
            );

            Log::info('Notification created: Project revision requested', [
                'freelancer_id' => $freelancer->id,
                'submission_id' => $submission->id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create project revision notification: ' . $e->getMessage());
        }
    }

    /**
     * Notifikasi saat saldo masuk ke wallet freelancer
     */
    public static function paymentReceived(Payment $payment)
    {
        try {
            $freelancer = $payment->freelancer;
            $project = $payment->project;

            Notification::createNotification(
                $freelancer->id,
                Notification::TYPE_PAYMENT_RECEIVED,
                'Pembayaran Diterima',
                "Pembayaran sebesar Rp " . number_format($payment->service_amount, 0, ',', '.') . " untuk proyek \"{$project->title}\" telah masuk ke pending balance Anda.",
                [
                    'payment_id' => $payment->payment_id,
                    'project_id' => $project->id,
                    'project_title' => $project->title,
                    'amount' => $payment->service_amount,
                ]
            );

            Log::info('Notification created: Payment received', [
                'freelancer_id' => $freelancer->id,
                'payment_id' => $payment->payment_id
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to create payment received notification: ' . $e->getMessage());
        }
    }
}