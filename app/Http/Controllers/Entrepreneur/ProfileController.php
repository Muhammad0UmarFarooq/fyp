<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $activeAgreements = \App\Models\Agreement::with(['investor', 'pitch'])
            ->where('entrepreneur_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->latest()
            ->get();

        return view('entrepreneur.profile', compact('user', 'activeAgreements'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_image')) {
            // Delete old image if exists
            if ($user->profile_image) {
                Storage::disk('public')->delete($user->profile_image);
            }

            $path = $request->file('profile_image')->store('profile_images', 'public');
            
            $user->update([
                'profile_image' => $path,
            ]);

            return back()->with('success', 'Profile image updated successfully.');
        }

        return back()->with('error', 'Failed to upload image.');
    }
}
