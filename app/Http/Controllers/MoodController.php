<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MoodController extends Controller
{

    // mood list show 
    public function mood_list()
    {
        $moods = Mood::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        return view('Dashboard.Mood.mood_list', compact('moods'));
    }

    // create new mood 
    public function mood_store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mood' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the errors and try again.');
        }
        $alreadyExists = Mood::where('user_id', Auth::id())
            ->whereDate('created_at', Carbon::today())
            ->exists();

        if ($alreadyExists) {
            return redirect()->back()->with('error', 'You have already submitted your mood for today.');
        }

        Mood::create([
            'mood'      => $request->mood,
            'note'      => $request->note,
            'user_id'   => Auth::id(),
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('success', 'Mood saved successfully!');
    }

    // mood soft delete 
    public function mood_destroy(Request $request)
    {
        $mood = Mood::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
        $mood->delete();
        return redirect()->back()->with('success', 'Mood trushed successfully!');
    }

    // mood update 
    public function mood_update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mood' => 'required|string|max:255',
            'note' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput()
                ->with('error', 'Please correct the errors and try again.');
        }
        Mood::where('user_id', Auth::user()->id)->where('id', $request->id)->update([
            'mood'      => $request->mood,
            'note'      => $request->note,
            'user_id'   => Auth::user()->id,
            'updated_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Mood updated successfully!');
    }

    // trushed mood list show 
    public function mood_trashed()
    {
        $moods = Mood::onlyTrashed()->where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();
        // return $moods;
        return view('Dashboard.Mood.trashed_mood', compact('moods'));
    }

    // restore single mood 
    public function mood_restore($id)
    {
        $mood = Mood::onlyTrashed()->where('user_id', Auth::user()->id)->where('id', $id)->first();
        $mood->restore();
        return redirect()->back()->with('success', 'Mood restored successfully!');
    }

    // mood hard delete 
    public function mood_hardDelete(Request $request)
    {
        $mood = Mood::onlyTrashed()->where('user_id', Auth::user()->id)->where('id', $request->id)->first();
        $mood->forceDelete();
        return redirect()->back()->with('success', 'Mood deleted successfully!');
    }

    // show monthly modd 
    public function mood_monthly()
    {

        $userId = Auth::user()->id;
        $startDate = Carbon::now()->subDays(30);

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        // Group and count moods from the last 30 days
        $topMood = Mood::where('user_id', $userId)
            ->where('created_at', '>=', $startDate)
            ->selectRaw('mood, COUNT(*) as mood_count')
            ->groupBy('mood')
            ->orderByDesc('mood_count')
            ->first();

        $moodCounts = Mood::where('user_id', $userId)
            ->whereBetween('created_at', [$startOfMonth, $endOfMonth])
            ->selectRaw('mood, COUNT(*) as total')
            ->groupBy('mood')
            ->pluck('total', 'mood');

        $moodOfMonth = $topMood ? $topMood->mood : 'No mood found';

        return view('Dashboard.Mood.monthly_mood', compact('moodOfMonth', 'moodCounts'));
    }
}
