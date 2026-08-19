<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agreement;
use App\Models\Offer;
use App\Models\Pitch;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'total_users' => User::where('role', '!=', 'admin')->count(),
            'entrepreneurs' => User::where('role', 'entrepreneur')->count(),
            'investors' => User::where('role', 'investor')->count(),
            'active_pitches' => Pitch::where('status', 'active')->count(),
            'total_pitches' => Pitch::count(),
            'pending_offers' => Offer::where('status', 'pending')->count(),
            'total_offers' => Offer::count(),
            'active_agreements' => Agreement::where('status', 'active')->count(),
            'total_agreements' => Agreement::count(),
        ];

        $recentUsers = User::where('role', '!=', 'admin')
            ->latest()
            ->take(5)
            ->get();

        $recentAgreements = Agreement::with(['entrepreneur', 'investor', 'pitch'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact('stats', 'recentUsers', 'recentAgreements'));
    }

    public function users(Request $request)
    {
        $query = User::where('role', '!=', 'admin');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('cnic', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%")
                  ->orWhere('city', 'like', "%{$search}%");
            });
        }

        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->latest()->paginate(15);

        return view('admin.users', compact('users'));
    }

    public function userDetail(User $user)
    {
        $user->load([
            'entrepreneurProfile',
            'investorProfile',
            'pitch.offers.investor',
            'pitch.agreements',
            'sentOffers.pitch',
            'sentOffers.agreement',
        ]);

        $agreements = Agreement::with(['entrepreneur', 'investor', 'pitch', 'offer'])
            ->where('entrepreneur_id', $user->id)
            ->orWhere('investor_id', $user->id)
            ->latest()
            ->get();

        return view('admin.user-detail', compact('user', 'agreements'));
    }

    public function pitches(Request $request)
    {
        $query = Pitch::with('user');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('startup_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $pitches = $query->latest()->paginate(15);

        return view('admin.pitches', compact('pitches'));
    }

    public function offers(Request $request)
    {
        $query = Offer::with(['investor', 'pitch']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('investor', function ($iq) use ($search) {
                    $iq->where('name', 'like', "%{$search}%");
                })->orWhereHas('pitch', function ($pq) use ($search) {
                    $pq->where('startup_name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $offers = $query->latest()->paginate(15);

        return view('admin.offers', compact('offers'));
    }

    public function agreements(Request $request)
    {
        $query = Agreement::with(['entrepreneur', 'investor', 'pitch', 'offer']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->whereHas('entrepreneur', function ($eq) use ($search) {
                    $eq->where('name', 'like', "%{$search}%");
                })->orWhereHas('investor', function ($iq) use ($search) {
                    $iq->where('name', 'like', "%{$search}%");
                });
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $agreements = $query->latest()->paginate(15);

        return view('admin.agreements', compact('agreements'));
    }
}
