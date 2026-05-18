<?php

namespace App\Http\Controllers\Entrepreneur;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::with(['pitch', 'investor'])
            ->where('entrepreneur_id', auth()->id())
            ->latest()
            ->get();

        $readyToSign = $agreements->where('status', 'sent_to_entrepreneur');
        $active = $agreements->whereIn('status', ['active', 'completed']);
        $rejected = $agreements->where('status', 'rejected');

        return view('entrepreneur.agreements', compact('readyToSign', 'active', 'rejected'));
    }

    public function sign(Request $request, Agreement $agreement)
    {
        if ($agreement->entrepreneur_id !== auth()->id()) {
            abort(403);
        }

        if ($agreement->status !== 'sent_to_entrepreneur') {
            return back()->with('error', 'Agreement is not ready for signing.');
        }

        $request->validate([
            'signed_file' => 'required|file|mimes:pdf,docx,doc|max:25600',
        ]);

        if ($request->hasFile('signed_file')) {
            if ($agreement->entrepreneur_file) {
                Storage::disk('public')->delete($agreement->entrepreneur_file);
            }

            $file = $request->file('signed_file');
            $path = $file->store('agreements/signed', 'public');

            $agreement->update([
                'entrepreneur_file' => $path,
                'entrepreneur_filename' => $file->getClientOriginalName(),
                'entrepreneur_filesize' => round($file->getSize() / 1048576, 2) . ' MB',
                'status' => 'active',
                'agreement_date' => now()->toDateString(),
            ]);

            return back()->with('success', 'Signed agreement document uploaded and finalized successfully!');
        }

        return back()->with('error', 'Please upload a valid document.');
    }

    public function reject(Request $request, Agreement $agreement)
    {
        if ($agreement->entrepreneur_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:1000',
        ]);

        $agreement->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return back()->with('success', 'Agreement rejected with reason recorded.');
    }
}
