<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\FreelancerApproved;

class FreelancerController extends Controller
{
    /**
     * Tampilkan semua freelancer
     */
    public function index()
    {
        $freelancers = User::where('role', 'freelancer')->get();
        return view('admin.freelancers.index', compact('freelancers'));
    }

    /**
     * Update status freelancer
     */
    public function updateStatus(Request $request, User $freelancer)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $freelancer->status = $request->status;
        $freelancer->save();

        // Debug log biar keliatan di storage/logs/laravel.log
        \Log::info("Status freelancer {$freelancer->id} diubah jadi {$request->status}");

        // Kirim email kalau disetujui
        if ($request->status === 'approved') {
            \Log::info("Mengirim email ke {$freelancer->email}");
            Mail::to($freelancer->email)->send(new FreelancerApproved($freelancer));
        }

        return redirect()->back()->with('success', 'Status freelancer berhasil diubah.');
    }
}
