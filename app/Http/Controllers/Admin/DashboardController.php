<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Proposal;
use App\Models\AdminWallet;
use App\Models\AdminWalletTransaction;
use App\Models\Payment;
use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        try {
            Log::info('=== ADMIN DASHBOARD CONTROLLER CALLED ===');

            // Count users by role
            $clientCount = User::where('role', 'client')->count();
            $freelancerCount = User::where('role', 'freelancer')->count();
            
            // Count total projects
            $projectCount = Project::count();
            
            // Count total proposals
            $proposalCount = Proposal::count();
            
            // Get admin wallet data
            $wallet = AdminWallet::first();
            
            if (!$wallet) {
                Log::warning('Admin wallet not found, creating default...');
                $wallet = AdminWallet::create([
                    'service_balance' => 0,
                    'admin_fee_balance' => 0, 
                    'total_balance' => 0
                ]);
            }
            
            // Format balances
            $totalBalance = 'Rp ' . number_format($wallet->total_balance, 0, ',', '.');
            $serviceBalance = 'Rp ' . number_format($wallet->service_balance, 0, ',', '.');
            $adminFeeBalance = 'Rp ' . number_format($wallet->admin_fee_balance, 0, ',', '.');
            
            // Get recent transactions (last 5)
            $recentTransactions = AdminWalletTransaction::with(['payment', 'withdrawal'])
                ->where('admin_wallet_id', $wallet->id)
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            // Count transactions this month
            $recentTransactionsCount = AdminWalletTransaction::where('admin_wallet_id', $wallet->id)
                ->whereMonth('created_at', now()->month)
                ->whereYear('created_at', now()->year)
                ->count();
            
            // Get recent projects for the table
            $recentProjects = Project::with(['client', 'proposalls'])
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();

            // Get payment statistics
            $totalRevenue = Payment::where('status', 'success')->sum('amount');
            $pendingWithdrawals = Withdrawal::where('status', 'pending')->count();
            $completedWithdrawals = Withdrawal::where('status', 'completed')->count();

            // Get withdrawal statistics for cards
            $withdrawalStats = $this->getWithdrawalStats($request);

            $data = [
                'clientCount' => $clientCount,
                'freelancerCount' => $freelancerCount,
                'projectCount' => $projectCount,
                'proposalCount' => $proposalCount,
                'totalBalance' => $totalBalance,
                'serviceBalance' => $serviceBalance,
                'adminFeeBalance' => $adminFeeBalance,
                'recentTransactions' => $recentTransactions,
                'recentTransactionsCount' => $recentTransactionsCount,
                'recentProjects' => $recentProjects,
                'totalRevenue' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
                'pendingWithdrawals' => $pendingWithdrawals,
                'completedWithdrawals' => $completedWithdrawals,
                'wallet' => $wallet,
                'withdrawalStats' => $withdrawalStats,
                'selectedMonth' => $request->get('withdrawal_month', now()->month),
                'selectedYear' => $request->get('withdrawal_year', now()->year)
            ];

            Log::info('=== DASHBOARD DATA READY ===');
            
            return view('admin.dashboard', $data);
            
        } catch (\Exception $e) {
            Log::error('DashboardController Error: ' . $e->getMessage());
            
            // Fallback data
            return view('admin.dashboard', [
                'clientCount' => 0,
                'freelancerCount' => 0,
                'projectCount' => 0,
                'proposalCount' => 0,
                'totalBalance' => 'Rp 0',
                'serviceBalance' => 'Rp 0',
                'adminFeeBalance' => 'Rp 0',
                'recentTransactions' => collect([]),
                'recentTransactionsCount' => 0,
                'recentProjects' => collect([]),
                'totalRevenue' => 'Rp 0',
                'pendingWithdrawals' => 0,
                'completedWithdrawals' => 0,
                'withdrawalStats' => [
                    'total_pending' => 0,
                    'total_completed' => 0,
                    'total_rejected' => 0,
                    'month_name' => now()->monthName,
                    'year' => now()->year
                ],
                'selectedMonth' => now()->month,
                'selectedYear' => now()->year
            ]);
        }
    }

    /**
     * Get withdrawal statistics for cards
     */
    private function getWithdrawalStats(Request $request)
    {
        try {
            $month = $request->get('withdrawal_month', now()->month);
            $year = $request->get('withdrawal_year', now()->year);
            
            // Validate month and year
            $month = max(1, min(12, (int)$month));
            $year = max(2020, min(2030, (int)$year));
            
            $totalPending = Withdrawal::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', 'pending')
                ->count();
                
            $totalCompleted = Withdrawal::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', 'completed')
                ->count();
                
            $totalRejected = Withdrawal::whereMonth('created_at', $month)
                ->whereYear('created_at', $year)
                ->where('status', 'rejected')
                ->count();
            
            return [
                'total_pending' => $totalPending,
                'total_completed' => $totalCompleted,
                'total_rejected' => $totalRejected,
                'month_name' => Carbon::create()->month($month)->monthName,
                'year' => $year
            ];
            
        } catch (\Exception $e) {
            Log::error('Error getting withdrawal stats: ' . $e->getMessage());
            
            return [
                'total_pending' => 0,
                'total_completed' => 0,
                'total_rejected' => 0,
                'month_name' => now()->monthName,
                'year' => now()->year
            ];
        }
    }
}