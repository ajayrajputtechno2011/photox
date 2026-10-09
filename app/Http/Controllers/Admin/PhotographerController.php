<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class PhotographerController extends Controller
{
    /**
     * Display a listing of all photographers with filtering and search.
     */
    public function index(Request $request): View
    {
        $query = User::where('role', 'photographer')->with('membership');

        // Search
        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        // Filter by status
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        // Filter by membership tier
        if ($request->filled('membership') && $request->input('membership') !== 'all') {
            $membershipVal = $request->input('membership');
            if (is_numeric($membershipVal)) {
                $query->where('membership_id', (int) $membershipVal);
            } else {
                $query->where(function ($q) use ($membershipVal) {
                    $q->where('tier', $membershipVal)
                        ->orWhereHas('membership', function ($mq) use ($membershipVal) {
                            $mq->where('slug', $membershipVal);
                        });
                });
            }
        }

        $photographers = $query->latest('id')->paginate(15)->withQueryString();

        // Statistics
        $totalCount = User::where('role', 'photographer')->count();
        $verifiedCount = User::where('role', 'photographer')
            ->where(function ($q) {
                $q->where('is_verified', true)->orWhere('status', 'active');
            })
            ->count();
        $pendingCount = User::where('role', 'photographer')->where('status', 'pending_approval')->count();

        // Available membership plans for filters and modals
        $memberships = Membership::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.photographers', compact(
            'photographers',
            'totalCount',
            'verifiedCount',
            'pendingCount',
            'memberships'
        ));
    }

    /**
     * Show the form for creating a new photographer.
     */
    public function create(): View
    {
        $memberships = Membership::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.add-photographer', compact('memberships'));
    }

    /**
     * Store a newly created photographer in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|unique:users,email|max:190',
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:150',
            'specialty' => 'nullable|string|max:150',
            'bio' => 'nullable|string|max:2000',
            'avatar' => 'nullable|string|max:500',
            'membership_id' => 'nullable|exists:memberships,id',
            'status' => 'required|in:active,pending_approval,suspended',
            'is_verified' => 'nullable|boolean',
            'custom_storage_limit' => 'nullable|string|max:50',
            'custom_commission_rate' => 'nullable|string|max:50',
            'custom_features' => 'nullable|array',
            'verification_badge' => 'nullable|string|max:100',
            'membership_expires_at' => 'nullable|date',
            'payout_email' => 'nullable|email|max:190',
            'payout_method' => 'nullable|string|max:150',
            'admin_notes' => 'nullable|string|max:2000',
            'password' => 'nullable|string|min:6',
        ]);

        $membership = ! empty($validated['membership_id'])
            ? Membership::find($validated['membership_id'])
            : null;

        $tier = $membership ? $membership->slug : 'starter';

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password'] ?? 'photox2026'),
            'role' => 'photographer',
            'status' => $validated['status'],
            'is_verified' => $request->has('is_verified') || $validated['status'] === 'active',
            'tier' => $tier,
            'membership_id' => $membership?->id,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
            'specialty' => $validated['specialty'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'avatar' => $validated['avatar'] ?? 'https://images.unsplash.com/photo-1535713875002-d1d0cf377fde?auto=format&fit=crop&w=300&q=80',
            'custom_storage_limit' => $validated['custom_storage_limit'] ?? null,
            'custom_commission_rate' => $validated['custom_commission_rate'] ?? null,
            'custom_features' => $validated['custom_features'] ?? null,
            'verification_badge' => $validated['verification_badge'] ?? ($membership ? ($membership->badge ?: $membership->name.' Member') : 'Standard Member'),
            'membership_expires_at' => $validated['membership_expires_at'] ?? null,
            'payout_email' => $validated['payout_email'] ?? $validated['email'],
            'payout_method' => $validated['payout_method'] ?? 'Bank Transfer',
            'admin_notes' => $validated['admin_notes'] ?? null,
        ]);

        return redirect()->route('admin.photographers.index')
            ->with('success', "Photographer {$user->name} created successfully.");
    }

    /**
     * Display the specified photographer details.
     */
    public function show(User $photographer): View
    {
        if ($photographer->role !== 'photographer') {
            abort(404, 'User is not a photographer.');
        }

        $photographer->load('membership');
        $memberships = Membership::orderBy('sort_order')->orderBy('id')->get();

        // Count published events and images
        $eventsCount = Event::where('status', 'published')->count();
        $photosCount = EventPhoto::where('is_demo', true)->count();

        return view('admin.photographer-detail', compact(
            'photographer',
            'memberships',
            'eventsCount',
            'photosCount'
        ));
    }

    /**
     * Show the form for editing the photographer.
     */
    public function edit(User $photographer): View
    {
        if ($photographer->role !== 'photographer') {
            abort(404, 'User is not a photographer.');
        }

        $photographer->load('membership');
        $memberships = Membership::orderBy('sort_order')->orderBy('id')->get();

        return view('admin.add-photographer', compact('photographer', 'memberships'));
    }

    /**
     * Update the specified photographer in storage.
     */
    public function update(Request $request, User $photographer): RedirectResponse
    {
        if ($photographer->role !== 'photographer') {
            abort(404, 'User is not a photographer.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'email' => 'required|email|max:190|unique:users,email,'.$photographer->id,
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:150',
            'specialty' => 'nullable|string|max:150',
            'bio' => 'nullable|string|max:2000',
            'avatar' => 'nullable|string|max:500',
            'membership_id' => 'nullable|exists:memberships,id',
            'status' => 'required|in:active,pending_approval,suspended',
            'is_verified' => 'nullable|boolean',
            'custom_storage_limit' => 'nullable|string|max:50',
            'custom_commission_rate' => 'nullable|string|max:50',
            'custom_features' => 'nullable|array',
            'verification_badge' => 'nullable|string|max:100',
            'membership_expires_at' => 'nullable|date',
            'payout_email' => 'nullable|email|max:190',
            'payout_method' => 'nullable|string|max:150',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        $membership = ! empty($validated['membership_id'])
            ? Membership::find($validated['membership_id'])
            : null;

        $tier = $membership ? $membership->slug : ($photographer->tier ?: 'starter');

        $photographer->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'status' => $validated['status'],
            'is_verified' => $request->has('is_verified'),
            'tier' => $tier,
            'membership_id' => $membership?->id,
            'phone' => $validated['phone'] ?? null,
            'location' => $validated['location'] ?? null,
            'specialty' => $validated['specialty'] ?? null,
            'bio' => $validated['bio'] ?? null,
            'avatar' => $validated['avatar'] ?? $photographer->avatar,
            'custom_storage_limit' => $validated['custom_storage_limit'] ?: null,
            'custom_commission_rate' => $validated['custom_commission_rate'] ?: null,
            'custom_features' => $request->input('custom_features', []),
            'verification_badge' => $validated['verification_badge'] ?: null,
            'membership_expires_at' => $validated['membership_expires_at'] ?: null,
            'payout_email' => $validated['payout_email'] ?? null,
            'payout_method' => $validated['payout_method'] ?? null,
            'admin_notes' => $validated['admin_notes'] ?? null,
        ]);

        $photographer->save();

        return redirect()->route('admin.photographers.show', $photographer->id)
            ->with('success', "Photographer {$photographer->name} updated successfully with membership privileges.");
    }

    /**
     * Quick toggle for photographer account status.
     */
    public function toggleStatus(Request $request, User $photographer): RedirectResponse
    {
        if ($photographer->role !== 'photographer') {
            abort(404);
        }

        $newStatus = $request->input('status', 'active');
        if (in_array($newStatus, ['active', 'pending_approval', 'suspended'])) {
            $photographer->status = $newStatus;
            $photographer->is_verified = ($newStatus === 'active');
            if ($request->filled('admin_notes')) {
                $photographer->admin_notes = $request->input('admin_notes');
            }
            $photographer->save();
        }

        return back()->with('success', "Account status updated to {$newStatus}.");
    }

    /**
     * Remove the photographer account.
     */
    public function destroy(User $photographer): RedirectResponse
    {
        if ($photographer->role !== 'photographer') {
            abort(404);
        }

        $name = $photographer->name;
        $photographer->delete();

        return redirect()->route('admin.photographers.index')
            ->with('success', "Photographer {$name} removed.");
    }
}
