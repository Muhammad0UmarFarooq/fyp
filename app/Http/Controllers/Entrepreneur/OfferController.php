<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Offer;
use App\Models\Pitch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    public function index()
    {
        $pitch = Pitch::where('user_id', auth()->id())->first();
        $offers = $pitch ? Offer::with('investor')
            ->where('pitch_id', $pitch->id)
            ->whereDoesntHave('agreement', function ($query) {
                $query->whereIn('status', ['active', 'completed']);
            })
            ->latest()
            ->get() : collect();

        return view('entrepreneur.investorsOffer', compact('offers', 'pitch'));
    }

    public function updateStatus(Request $request, Offer $offer)
    {
        if ($offer->pitch->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'status' => 'required|in:accepted,rejected',
        ]);

        try {
            DB::beginTransaction();

            $offer->update([
                'status' => $validated['status'],
            ]);

            if ($validated['status'] === 'accepted') {
                Agreement::firstOrCreate([
                    'offer_id' => $offer->id,
                ], [
                    'pitch_id' => $offer->pitch_id,
                    'entrepreneur_id' => $offer->pitch->user_id,
                    'investor_id' => $offer->investor_id,
                    'ownership_stake' => $offer->valuation > 0 ? round(($offer->offer_amount / $offer->valuation) * 100) : 10,
                    'estimated_roi' => 50,
                    'agreement_date' => now()->toDateString(),
                    'status' => 'pending_signature',
                ]);
            }

            DB::commit();

            return back()->with('success', 'Offer status updated to '.$validated['status'].'.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Error updating offer status: '.$e->getMessage());
        }
    }
}
