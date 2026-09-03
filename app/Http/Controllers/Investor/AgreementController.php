<?php

namespace App\Http\Controllers\Investor;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AgreementController extends Controller
{
    public function index()
    {
        $agreements = Agreement::with(['pitch', 'entrepreneur'])
            ->where('investor_id', auth()->id())
            ->latest()
            ->get();

        $pendingSign = $agreements->where('status', 'pending_signature');
        $staged = $agreements->where('status', 'investor_uploaded');
        $rejected = $agreements->where('status', 'rejected');
        $vault = $agreements->whereIn('status', ['active', 'completed']);

        return view('investor.agreements', compact('pendingSign', 'staged', 'rejected', 'vault'));
    }

    public function upload(Request $request, Agreement $agreement)
    {
        $request->validate([
            'agreement_file' => 'required|file|mimes:pdf,docx,doc|max:25600',
        ]);

        if ($request->hasFile('agreement_file')) {
            if ($agreement->agreement_file) {
                Storage::disk('public')->delete($agreement->agreement_file);
            }

            $file = $request->file('agreement_file');
            $path = $file->store('agreements', 'public');

            $agreement->update([
                'agreement_file' => $path,
                'agreement_filename' => $file->getClientOriginalName(),
                'agreement_filesize' => round($file->getSize() / 1048576, 2).' MB',
                'status' => 'investor_uploaded',
                'rejection_reason' => null,
            ]);

            return back()->with('success', 'Agreement uploaded and staged for execution.');
        }

        return back()->with('error', 'Failed to upload agreement file.');
    }

    public function removeFile(Agreement $agreement)
    {
        if ($agreement->agreement_file) {
            Storage::disk('public')->delete($agreement->agreement_file);
        }

        $agreement->update([
            'agreement_file' => null,
            'agreement_filename' => null,
            'agreement_filesize' => null,
            'status' => 'pending_signature',
        ]);

        return back()->with('success', 'Staged agreement document removed.');
    }

    public function send(Agreement $agreement)
    {
        if (! $agreement->agreement_file) {
            return back()->with('error', 'Please upload a signed agreement document first.');
        }

        $agreement->update([
            'status' => 'sent_to_entrepreneur',
        ]);

        return back()->with('success', 'Agreement sent to entrepreneur successfully!');
    }

    public function download(Agreement $agreement)
    {
        if (! $agreement->agreement_file || ! Storage::disk('public')->exists($agreement->agreement_file)) {
            return back()->with('error', 'Agreement file not found.');
        }

        return Storage::disk('public')->download($agreement->agreement_file, $agreement->agreement_filename ?? 'agreement.pdf');
    }

    public function downloadEntrepreneurFile(Agreement $agreement)
    {
        if (! $agreement->entrepreneur_file || ! Storage::disk('public')->exists($agreement->entrepreneur_file)) {
            return back()->with('error', 'Entrepreneur document not found.');
        }

        return Storage::disk('public')->download($agreement->entrepreneur_file, $agreement->entrepreneur_filename ?? 'signed_agreement.pdf');
    }
}
