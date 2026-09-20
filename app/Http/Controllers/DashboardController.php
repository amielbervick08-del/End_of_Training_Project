<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(Request $request)
{
    $user = $request->user();

    $requestCount = $user->learningRequests()->count();

   $bookingCount = \App\Models\Booking::where('student_id', $user->id)
    ->orWhere('tutor_id', $user->id)
    ->count();

    $skillCount = $user->userSkills()->count();

    return view('dashboard', compact(
        'requestCount',
        'bookingCount',
        'skillCount' 
    ));
}
}