<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function dashboard()
    {
        $showBadge = Mood::where('user_id', Auth::user()->id)->whereDate('created_at', Carbon::now())->count();
        return view('Dashboard.Home.home', compact('showBadge'));
    }
}
