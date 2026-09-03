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
        $investorProfile = $user->investorProfile ?? new InvestorProfile;

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
            'interested_businesses' => 'nullable|string',
            'investment_amount' => 'nullable|numeric|min:0',
            'investment_focus' => 'nullable|string|max:255',
            'portfolio_size' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'bio' => $validated['bio'],
        ]);

        $interested = array_filter(array_map('trim', explode(',', $validated['interested_businesses'] ?? '')));

        $profile = InvestorProfile::firstOrNew(['user_id' => $user->id]);
        $profile->interested_businesses = empty($interested) ? null : array_values($interested);

        if ($request->has('investment_amount') && $request->filled('investment_amount')) {
            $profile->investment_amount = $validated['investment_amount'];
        }
        if ($request->has('investment_focus') && $request->filled('investment_focus')) {
            $profile->investment_focus = $validated['investment_focus'];
        }
        if ($request->has('portfolio_size') && $request->filled('portfolio_size')) {
            $profile->portfolio_size = $validated['portfolio_size'];
        }

        $profile->save();

        return back()->with('success', 'Profile details updated successfully.');
    }
}
