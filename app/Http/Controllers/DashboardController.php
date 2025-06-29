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
        $moods = Mood::where('user_id', Auth::user()->id)->count();
        $showBadge = false;
        if ($moods > 2) {
            $showBadge = true;
        }

        $userId = Auth::user()->id;
        $weekStart = Carbon::now()->startOfWeek(); 
        $weekEnd = Carbon::now()->endOfWeek();   

        // Get all moods for the current week
        $weeklyMoods = Mood::where('user_id', $userId)
            ->whereBetween('created_at', [$weekStart, $weekEnd])
            ->get();

        // Define mood types
        $moodTypes = ['Happy', 'Sad', 'Angry', 'Excited'];

        // Count each mood
        $moodCounts = [];
        foreach ($moodTypes as $type) {
            $moodCounts[$type] = $weeklyMoods->where('mood', $type)->count();
        }

        return view('Dashboard.Home.home', compact('showBadge', 'moodCounts'));
    }
}
