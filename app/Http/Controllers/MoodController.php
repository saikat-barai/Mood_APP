<?php

namespace App\Http\Controllers;

use App\Models\Mood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MoodController extends Controller
{
    public function mood_list()
    {
        $moods = Mood::where('user_id', Auth::user()->id)->orderBy('created_at', 'desc')->get();;
        return view('Dashboard.Mood.mood_list', compact('moods'));
    }

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
        Mood::create([
            'mood'      => $request->mood,
            'note'      => $request->note,
            'user_id'   => Auth::user()->id,
            'created_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Mood saved successfully!');
    }

    public function mood_view($id)
    {
        $mood = Mood::find($id);
        return response()->json($mood);
        // return view('Dashboard.Mood.mood_view', compact('mood'));
    }

    public function mood_destroy(Request $request)
    {
        $mood = Mood::where('user_id', Auth::user()->id)->where('id', $request->id)->first();
        $mood->delete();
        return redirect()->back()->with('success', 'Mood deleted successfully!');
    }

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
            'created_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Mood updated successfully!');
    }
}
