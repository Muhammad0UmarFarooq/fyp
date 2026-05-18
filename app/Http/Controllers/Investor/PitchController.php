<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Pitch;

class PitchController extends Controller
{
    public function index()
    {
        $pitches = Pitch::with(['user', 'pitchFields'])
            ->where('status', 'active')
            ->latest()
            ->get();

        return view('investor.home', compact('pitches'));
    }

    public function show(?Pitch $pitch = null)
    {
        if (! $pitch) {
            $pitch = Pitch::with(['user', 'pitchFields'])
                ->where('status', 'active')
                ->latest()
                ->first();
        } else {
            $pitch->load(['user', 'pitchFields']);
        }

        if (! $pitch) {
            return redirect()->route('investor.home')->with('error', 'No active pitches available to view.');
        }

        return view('investor.viewPitch', compact('pitch'));
    }
}
