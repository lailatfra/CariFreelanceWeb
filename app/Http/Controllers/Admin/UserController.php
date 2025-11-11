<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserController extends Controller
{
    public function index() {
        $users = User::paginate(15);
        $totalUsers = User::count();
        $clientCount = User::where('role', 'client')->count();
        $freelancerCount = User::where('role', 'freelancer')->count();
        $monthlyLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'];
        $monthlyUserData = [3, 7, 5, 12, 8, 15]; // Replace with actual data

        
        return view('admin.users.index', compact(
            'users', 
            'totalUsers', 
            'clientCount', 
            'freelancerCount',
            'monthlyLabels',
            'monthlyUserData',
        ));
    
    }
}
