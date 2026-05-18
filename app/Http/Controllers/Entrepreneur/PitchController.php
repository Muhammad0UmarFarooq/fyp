<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use App\Models\Pitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PitchController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'video' => 'required|file|mimes:mp4,mov|max:2500000', // 250MB
            'startup_name' => 'required|string|max:255',
            'invested_amount' => 'nullable|string',
            'monthly_net_value' => 'nullable|string',
            'monthly_growth' => 'nullable|string',
            'vision_statement' => 'nullable|string',
            'additional_detail' => 'nullable|string',
            'funding_required' => 'nullable|string',
            'return_time' => 'nullable|string',
            'total_valuation' => 'nullable|string',
            'custom_fields.*.label' => 'nullable|string',
            'custom_fields.*.value' => 'nullable|string',
        ]);

        if (Pitch::where('user_id', auth()->id())->exists()) {
            return redirect()->route('entrepreneur.dashboard')->with('error', 'You can only have one active pitch at a time. Please delete your current pitch to create a new one.');
        }

        try {
            DB::beginTransaction();

            $videoPath = null;
            if ($request->hasFile('video')) {
                $videoPath = $request->file('video')->store('pitches', 'public');
            }

            $cleanInt = function ($val) {
                return $val ? (int) preg_replace('/[^0-9]/', '', $val) : null;
            };

            $pitch = Pitch::create([
                'user_id' => auth()->id(),
                'startup_name' => $validated['startup_name'],
                'invested_amount' => $cleanInt($validated['invested_amount'] ?? null),
                'monthly_net_value' => $cleanInt($validated['monthly_net_value'] ?? null),
                'monthly_growth' => $cleanInt($validated['monthly_growth'] ?? null),
                'vision_statement' => $validated['vision_statement'] ?? null,
                'additional_detail' => $validated['additional_detail'] ?? null,
                'funding_required' => $cleanInt($validated['funding_required'] ?? null),
                'return_time' => $validated['return_time'] ?? null,
                'total_valuation' => $cleanInt($validated['total_valuation'] ?? null),
                'video_path' => $videoPath,
            ]);

            if ($request->has('custom_fields')) {
                foreach ($request->input('custom_fields') as $field) {
                    if (! empty($field['label']) && ! empty($field['value'])) {
                        $pitch->pitchFields()->create([
                            'label' => $field['label'],
                            'value' => $field['value'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('entrepreneur.dashboard')->with('success', 'Pitch created successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error creating pitch: '.$e->getMessage())->withInput();
        }
    }

    public function update(Request $request, Pitch $pitch)
    {
        if ($pitch->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'video' => 'nullable|file|mimes:mp4,mov|max:2500000', // 250MB
            'startup_name' => 'required|string|max:255',
            'invested_amount' => 'nullable|string',
            'monthly_net_value' => 'nullable|string',
            'monthly_growth' => 'nullable|string',
            'vision_statement' => 'nullable|string',
            'additional_detail' => 'nullable|string',
            'funding_required' => 'nullable|string',
            'return_time' => 'nullable|string',
            'total_valuation' => 'nullable|string',
            'custom_fields.*.label' => 'nullable|string',
            'custom_fields.*.value' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $videoPath = $pitch->video_path;
            if ($request->hasFile('video')) {
                if ($videoPath) {
                    Storage::disk('public')->delete($videoPath);
                }
                $videoPath = $request->file('video')->store('pitches', 'public');
            }

            $cleanInt = function ($val) {
                return $val ? (int) preg_replace('/[^0-9]/', '', $val) : null;
            };

            $pitch->update([
                'startup_name' => $validated['startup_name'],
                'invested_amount' => $cleanInt($validated['invested_amount'] ?? null),
                'monthly_net_value' => $cleanInt($validated['monthly_net_value'] ?? null),
                'monthly_growth' => $cleanInt($validated['monthly_growth'] ?? null),
                'vision_statement' => $validated['vision_statement'] ?? null,
                'additional_detail' => $validated['additional_detail'] ?? null,
                'funding_required' => $cleanInt($validated['funding_required'] ?? null),
                'return_time' => $validated['return_time'] ?? null,
                'total_valuation' => $cleanInt($validated['total_valuation'] ?? null),
                'video_path' => $videoPath,
            ]);

            $pitch->pitchFields()->delete();

            if ($request->has('custom_fields')) {
                foreach ($request->input('custom_fields') as $field) {
                    if (! empty($field['label']) && ! empty($field['value'])) {
                        $pitch->pitchFields()->create([
                            'label' => $field['label'],
                            'value' => $field['value'],
                        ]);
                    }
                }
            }

            DB::commit();

            return redirect()->route('entrepreneur.dashboard')->with('success', 'Pitch updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error updating pitch: '.$e->getMessage())->withInput();
        }
    }

    public function destroy(Pitch $pitch)
    {
        if ($pitch->user_id !== auth()->id()) {
            abort(403);
        }

        if ($pitch->video_path) {
            Storage::disk('public')->delete($pitch->video_path);
        }

        $pitch->delete();

        return redirect()->route('entrepreneur.dashboard')->with('success', 'Pitch deleted successfully.');
    }
}
