<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\EntrepreneurProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $activeAgreements = Agreement::with(['investor', 'pitch'])
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

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:255',
            'bio' => 'nullable|string|max:1000',
            'company_name' => 'nullable|string|max:255',
            'industry' => 'nullable|string|max:255',
            'experience_years' => 'nullable|integer|min:0',
            'total_valuation' => 'nullable|numeric|min:0',
            'future_valuation' => 'nullable|numeric|min:0',
            'website' => 'nullable|string|max:255',
        ]);

        $user = auth()->user();

        $user->update([
            'name' => $validated['name'],
            'city' => $validated['city'],
            'phone' => $validated['phone'],
            'bio' => $validated['bio'],
        ]);

        EntrepreneurProfile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'company_name' => $validated['company_name'] ?? null,
                'industry' => $validated['industry'] ?? null,
                'experience_years' => $validated['experience_years'] ?? null,
                'total_valuation' => $validated['total_valuation'] ?? null,
                'future_valuation' => $validated['future_valuation'] ?? null,
                'website' => $validated['website'] ?? null,
            ]
        );

        return back()->with('success', 'Profile details updated successfully.');
    }
}
