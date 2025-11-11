<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Project;
use App\Models\Proposal;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Count users by role
            $clientCount = User::where('role', 'client')->count();
            $freelancerCount = User::where('role', 'freelancer')->count();
            
            // Count total projects
            $projectCount = Project::count();
            
            // Count total proposals
            $proposalCount = Proposal::count();
            
            // Get monthly project data for the chart
            $monthlyProjectData = $this->getMonthlyProjectData();
            $monthlyLabels = $this->getMonthlyLabels();
            
            // Get recent projects for the table
            $recentProjects = Project::with('client')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get();
            
            return view('admin.dashboard', compact(
                'clientCount',
                'freelancerCount', 
                'projectCount',
                'proposalCount',
                'monthlyProjectData',
                'monthlyLabels',
                'recentProjects'
            ));
            
        } catch (\Exception $e) {
            // Handle any database errors gracefully
            return view('admin.dashboard', [
                'clientCount' => 0,
                'freelancerCount' => 0,
                'projectCount' => 0,
                'proposalCount' => 0,
                'monthlyProjectData' => [0, 0, 0, 0, 0, 0],
                'monthlyLabels' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                'recentProjects' => collect([])
            ]);
        }
    }
    
    private function getMonthlyProjectData()
    {
        try {
            // Get project counts for the last 6 months
            $data = [];
            for ($i = 5; $i >= 0; $i--) {
                $month = Carbon::now()->subMonths($i);
                $count = Project::whereYear('created_at', $month->year)
                              ->whereMonth('created_at', $month->month)
                              ->count();
                $data[] = $count;
            }
            return $data;
        } catch (\Exception $e) {
            return [0, 0, 0, 0, 0, 0];
        }
    }
    
    private function getMonthlyLabels()
    {
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $month = Carbon::now()->subMonths($i);
            $labels[] = $month->format('M');
        }
        return $labels;
    }
    
    // Alternative method to get weekly data if needed
    private function getWeeklyProjectData()
    {
        try {
            $data = [];
            for ($i = 6; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $count = Project::whereDate('created_at', $date)->count();
                $data[] = $count;
            }
            return $data;
        } catch (\Exception $e) {
            return [0, 0, 0, 0, 0, 0, 0];
        }
    }
    
    // Method to get additional statistics if needed
    public function getStatistics()
    {
        try {
            return [
                'total_users' => User::count(),
                'active_projects' => Project::where('status', 'active')->count(),
                'pending_proposals' => Proposal::where('status', 'pending')->count(),
                'completed_projects' => Project::where('status', 'completed')->count(),
            ];
        } catch (\Exception $e) {
            return [
                'total_users' => 0,
                'active_projects' => 0,
                'pending_proposals' => 0,
                'completed_projects' => 0,
            ];
        }
    }
}