<?php

namespace App\Http\Controllers\Freelancer;

use App\Http\Controllers\Controller;

class FreelancerDashboardController extends Controller
{
    public function index()
    {

        return view('freelancer.home');
    }
}

