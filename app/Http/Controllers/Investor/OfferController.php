<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use App\Models\Pitch;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::with(['pitch.user'])
            ->where('investor_id', auth()->id())
            ->latest()
            ->get();

        return view('investor.myOffers', compact('offers'));
    }

    public function store(Request $request, Pitch $pitch)
    {
        $validated = $request->validate([
            'offer_amount' => 'required|numeric|min:1',
            'time_period' => 'required|string|max:255',
            'valuation' => 'required|numeric|min:1',
        ]);

        Offer::create([
            'pitch_id' => $pitch->id,
            'investor_id' => auth()->id(),
            'offer_amount' => $validated['offer_amount'],
            'time_period' => $validated['time_period'],
            'valuation' => $validated['valuation'],
            'status' => 'pending',
        ]);

        return redirect()->route('investor.myOffers')->with('success', 'Offer submitted successfully to the entrepreneur!');
    }

    public function update(Request $request, Offer $offer)
    {
        if ($offer->investor_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'offer_amount' => 'required|numeric|min:1',
            'time_period' => 'required|string|max:255',
            'valuation' => 'required|numeric|min:1',
        ]);

        $offer->update([
            'offer_amount' => $validated['offer_amount'],
            'time_period' => $validated['time_period'],
            'valuation' => $validated['valuation'],
            'status' => 'pending',
        ]);

        return redirect()->route('investor.myOffers')->with('success', 'Offer updated and re-sent to the entrepreneur successfully!');
    }

    public function destroy(Offer $offer)
    {
        if ($offer->investor_id !== auth()->id()) {
            abort(403);
        }

        $offer->delete();

        return redirect()->route('investor.myOffers')->with('success', 'Offer cancelled successfully.');
    }
}
