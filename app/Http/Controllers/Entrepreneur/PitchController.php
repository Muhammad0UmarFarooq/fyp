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
        $cleanInt = function ($val) {
            return ($val !== null && $val !== '') ? (int) preg_replace('/[^0-9]/', '', (string) $val) : null;
        };

        $request->merge([
            'invested_amount' => $cleanInt($request->input('invested_amount')),
            'monthly_net_value' => $cleanInt($request->input('monthly_net_value')),
            'monthly_growth' => $cleanInt($request->input('monthly_growth')),
            'funding_required' => $cleanInt($request->input('funding_required')),
            'return_time' => $cleanInt($request->input('return_time')),
            'total_valuation' => $cleanInt($request->input('total_valuation')),
        ]);

        $validated = $request->validate([
            'video' => 'required|file|mimes:mp4,mov|max:2500000', // 2500MB
            'startup_name' => 'required|regex:/^[A-Za-z ]+$/|max:20',
            'invested_amount' => 'required|integer|min:50000|max:1000000000',
            'monthly_net_value' => 'required|integer|min:20000|max:1000000000',
            'monthly_growth' => 'required|integer|min:1|max:100',
            'vision_statement' => 'nullable|string',
            'additional_detail' => 'nullable|string',
            'funding_required' => 'required|integer|min:50000|max:10000000000',
            'return_time' => 'required|integer|min:1|max:10',
            'total_valuation' => 'required|integer|min:50000|max:10000000000',
            'custom_fields' => 'nullable|array',
            'custom_fields.*.label' => 'required_with:custom_fields|string',
            'custom_fields.*.value' => 'required_with:custom_fields|string',
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

            $pitch = Pitch::create([
                'user_id' => auth()->id(),
                'startup_name' => $validated['startup_name'],
                'invested_amount' => $validated['invested_amount'],
                'monthly_net_value' => $validated['monthly_net_value'],
                'monthly_growth' => $validated['monthly_growth'],
                'vision_statement' => $validated['vision_statement'] ?? null,
                'additional_detail' => $validated['additional_detail'] ?? null,
                'funding_required' => $validated['funding_required'],
                'return_time' => $validated['return_time'],
                'total_valuation' => $validated['total_valuation'],
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

        $cleanInt = function ($val) {
            return ($val !== null && $val !== '') ? (int) preg_replace('/[^0-9]/', '', (string) $val) : null;
        };

        $request->merge([
            'invested_amount' => $cleanInt($request->input('invested_amount')),
            'monthly_net_value' => $cleanInt($request->input('monthly_net_value')),
            'monthly_growth' => $cleanInt($request->input('monthly_growth')),
            'funding_required' => $cleanInt($request->input('funding_required')),
            'return_time' => $cleanInt($request->input('return_time')),
            'total_valuation' => $cleanInt($request->input('total_valuation')),
        ]);

        $validated = $request->validate([
            'video' => 'nullable|file|mimes:mp4,mov|max:2500000', // 2500MB
            'startup_name' => 'required|regex:/^[A-Za-z ]+$/|max:20',
            'invested_amount' => 'required|integer|min:50000|max:1000000000',
            'monthly_net_value' => 'required|integer|min:20000|max:1000000000',
            'monthly_growth' => 'required|integer|min:1|max:100',
            'vision_statement' => 'nullable|string',
            'additional_detail' => 'nullable|string',
            'funding_required' => 'required|integer|min:50000|max:10000000000',
            'return_time' => 'required|integer|min:1|max:10',
            'total_valuation' => 'required|integer|min:50000|max:10000000000',
            'custom_fields' => 'nullable|array',
            'custom_fields.*.label' => 'required_with:custom_fields|string',
            'custom_fields.*.value' => 'required_with:custom_fields|string',
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

            $pitch->update([
                'startup_name' => $validated['startup_name'],
                'invested_amount' => $validated['invested_amount'],
                'monthly_net_value' => $validated['monthly_net_value'],
                'monthly_growth' => $validated['monthly_growth'],
                'vision_statement' => $validated['vision_statement'] ?? null,
                'additional_detail' => $validated['additional_detail'] ?? null,
                'funding_required' => $validated['funding_required'],
                'return_time' => $validated['return_time'],
                'total_valuation' => $validated['total_valuation'],
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

        $pitch->agreements()->update(['pitch_id' => null]);

        $pitch->delete();

        return redirect()->route('entrepreneur.dashboard')->with('success', 'Pitch deleted successfully.');
    }
}
