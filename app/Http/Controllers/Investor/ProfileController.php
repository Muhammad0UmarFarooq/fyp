<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\InvestorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $investorProfile = $user->investorProfile ?? new InvestorProfile();

        $activeAgreements = Agreement::with(['pitch'])
            ->where('investor_id', $user->id)
            ->whereIn('status', ['active', 'completed'])
            ->latest()
            ->get();

        return view('investor.profile', compact('user', 'investorProfile', 'activeAgreements'));
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        $user = auth()->user();

        if ($request->hasFile('profile_image')) {
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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'interested_businesses' => 'nullable|string', // Comma separated or JSON string
            'investment_amount' => 'nullable|numeric|min:0',
            'investment_focus' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'bio' => $validated['bio'],
        ]);

        $interested = array_filter(array_map('trim', explode(',', $validated['interested_businesses'] ?? '')));

        InvestorProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'interested_businesses' => empty($interested) ? null : $interested,
                'investment_amount' => $validated['investment_amount'] ?? null,
                'investment_focus' => $validated['investment_focus'] ?? null,
            ]
        );

        return back()->with('success', 'Profile details updated successfully.');
    }
}
