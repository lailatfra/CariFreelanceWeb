<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function index(Request $request)
    {
        // Mock data untuk demo
        $stats = [
            'total_pending' => 15,
            'total_approved_today' => 8,
            'total_rejected' => 3,
            'total_amount_pending' => 25000000,
        ];
        
        // Mock chart data
        $chartData = [
            ['date' => 'Sep 15', 'approved' => 5, 'rejected' => 1],
            ['date' => 'Sep 16', 'approved' => 3, 'rejected' => 2],
            ['date' => 'Sep 17', 'approved' => 7, 'rejected' => 0],
            ['date' => 'Sep 18', 'approved' => 4, 'rejected' => 1],
            ['date' => 'Sep 19', 'approved' => 6, 'rejected' => 0],
            ['date' => 'Sep 20', 'approved' => 8, 'rejected' => 2],
            ['date' => 'Sep 21', 'approved' => 5, 'rejected' => 1],
        ];
        
        // Mock withdrawals data
        $withdrawals = collect([
            [
                'id' => 1,
                'freelancer_name' => 'Ahmad Rizki',
                'freelancer_email' => 'ahmad.rizki@email.com',
                'amount' => 1500000,
                'bank_name' => 'Bank BCA',
                'account_number' => '1234567890',
                'account_name' => 'Ahmad Rizki',
                'status' => 'pending',
                'created_at' => '2024-09-20 14:30:00',
                'rating' => 4.8
            ],
            [
                'id' => 2,
                'freelancer_name' => 'Siti Nurhaliza',
                'freelancer_email' => 'siti.nur@email.com',
                'amount' => 2000000,
                'bank_name' => 'Bank Mandiri',
                'account_number' => '9876543210',
                'account_name' => 'Siti Nurhaliza',
                'status' => 'approved',
                'created_at' => '2024-09-19 10:15:00',
                'rating' => 4.9
            ],
            [
                'id' => 3,
                'freelancer_name' => 'Budi Santoso',
                'freelancer_email' => 'budi.santoso@email.com',
                'amount' => 750000,
                'bank_name' => 'Bank BRI',
                'account_number' => '5678901234',
                'account_name' => 'Budi Santoso',
                'status' => 'rejected',
                'created_at' => '2024-09-18 16:45:00',
                'rating' => 4.2
            ],
            [
                'id' => 4,
                'freelancer_name' => 'Maya Sari',
                'freelancer_email' => 'maya.sari@email.com',
                'amount' => 1200000,
                'bank_name' => 'Bank BNI',
                'account_number' => '3456789012',
                'account_name' => 'Maya Sari',
                'status' => 'pending',
                'created_at' => '2024-09-21 09:20:00',
                'rating' => 4.7
            ],
            [
                'id' => 5,
                'freelancer_name' => 'Eko Prasetyo',
                'freelancer_email' => 'eko.prasetyo@email.com',
                'amount' => 900000,
                'bank_name' => 'Bank CIMB Niaga',
                'account_number' => '7890123456',
                'account_name' => 'Eko Prasetyo',
                'status' => 'pending',
                'created_at' => '2024-09-20 11:30:00',
                'rating' => 4.5
            ]
        ]);
        
        // Apply filters
        if ($request->filled('status')) {
            $withdrawals = $withdrawals->where('status', $request->status);
        }
        
        if ($request->filled('search')) {
            $search = strtolower($request->search);
            $withdrawals = $withdrawals->filter(function ($item) use ($search) {
                return str_contains(strtolower($item['freelancer_name']), $search) ||
                       str_contains(strtolower($item['freelancer_email']), $search) ||
                       str_contains((string)$item['id'], $search);
            });
        }
        
        // Pagination simulation
        $perPage = 10;
        $currentPage = $request->get('page', 1);
        $offset = ($currentPage - 1) * $perPage;
        $paginatedWithdrawals = $withdrawals->slice($offset, $perPage)->values();
        
        return view('admin.withdrawals.index', compact('stats', 'chartData', 'paginatedWithdrawals'));
    }
    
    public function show($id)
    {
        // Mock detail data
        $withdrawal = [
            'id' => $id,
            'freelancer_name' => 'Ahmad Rizki',
            'freelancer_email' => 'ahmad.rizki@email.com',
            'amount' => 1500000,
            'bank_name' => 'Bank BCA',
            'account_number' => '1234567890',
            'account_name' => 'Ahmad Rizki',
            'status' => 'pending',
            'created_at' => '2024-09-20 14:30:00',
            'rating' => 4.8,
            'admin_notes' => null,
            'status_logs' => [
                [
                    'status' => 'pending',
                    'notes' => 'Withdrawal request submitted',
                    'created_at' => '2024-09-20 14:30:00'
                ]
            ]
        ];
        
        return response()->json([
            'success' => true,
            'data' => $withdrawal
        ]);
    }
    
    public function approve(Request $request, $id)
    {
        // Simulate approval process
        sleep(1); // Simulate processing time
        
        return response()->json([
            'success' => true,
            'message' => 'Withdrawal berhasil disetujui'
        ]);
    }
    
    public function reject(Request $request, $id)
    {
        // Simulate rejection process
        sleep(1); // Simulate processing time
        
        return response()->json([
            'success' => true,
            'message' => 'Withdrawal berhasil ditolak'
        ]);
    }
    
    public function bulkAction(Request $request)
    {
        $action = $request->action;
        $ids = $request->withdrawal_ids;
        $count = count($ids);
        
        // Simulate bulk processing
        sleep(2);
        
        $message = $action === 'approve' 
            ? "{$count} withdrawal berhasil disetujui" 
            : "{$count} withdrawal berhasil ditolak";
            
        return response()->json([
            'success' => true,
            'message' => $message
        ]);
    }
}