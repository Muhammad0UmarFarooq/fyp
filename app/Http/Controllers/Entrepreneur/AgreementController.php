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
        $request->validate([
            'signature' => 'required|string',
        ]);

        $signatureData = $request->input('signature');

        if (preg_match('/^data:image\/(\w+);base64,/', $signatureData, $type)) {
            $data = substr($signatureData, strpos($signatureData, ',') + 1);
            $type = strtolower($type[1]); // png, jpg, etc

            if (! in_array($type, ['png', 'jpg', 'jpeg'])) {
                return back()->with('error', 'Invalid signature image type.');
            }

            $data = base64_decode($data);

            if ($data === false) {
                return back()->with('error', 'Signature decoding failed.');
            }

            if ($agreement->entrepreneur_file) {
                Storage::disk('public')->delete($agreement->entrepreneur_file);
            }

            $filename = 'signature_'.time().'.'.$type;
            $path = 'agreements/signed/'.$filename;

            Storage::disk('public')->put($path, $data);

            $agreement->update([
                'entrepreneur_file' => $path,
                'entrepreneur_filename' => $filename,
                'entrepreneur_filesize' => round(strlen($data) / 1048576, 2).' MB',
                'status' => 'active',
                'agreement_date' => now()->toDateString(),
            ]);

            return back()->with('success', 'Agreement signed and finalized successfully!');
        }

        return back()->with('error', 'Please provide a valid signature.');
    }

    public function reject(Request $request, Agreement $agreement)
    {
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
