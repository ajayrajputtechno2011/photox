<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventPhoto;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the dynamic admin dashboard with live marketplace statistics.
     */
    public function index(Request $request): View
    {
        $admin = auth()->user();

        $photographersCount = User::where('role', 'photographer')->count();
        $pendingPhotographersCount = User::where('role', 'photographer')->where('status', 'pending_approval')->count();

        $customersCount = User::where('role', 'customer')->count();
        $newCustomersThisMonth = User::where('role', 'customer')
            ->where('created_at', '>=', now()->startOfMonth())
            ->count();

        $eventsCount = Event::count();
        $upcomingEventsCount = Event::where('status', 'published')->count();
        $galleriesCount = $eventsCount;
        $photosCount = EventPhoto::count();

        $topPhotographers = User::where('role', 'photographer')
            ->withCount(['events', 'photos'])
            ->take(4)
            ->get();

        $topEvents = Event::where('status', 'published')
            ->with('photographer')
            ->withCount('photos')
            ->latest('event_date')
            ->take(3)
            ->get();

        $eftReadyCount = User::where('role', 'photographer')
            ->whereNotNull('bank_name')
            ->whereNotNull('account_number')
            ->count();
        $missingBankingCount = max(0, $photographersCount - $eftReadyCount);

        return view('admin.dashboard', compact(
            'admin',
            'photographersCount',
            'pendingPhotographersCount',
            'customersCount',
            'newCustomersThisMonth',
            'eventsCount',
            'upcomingEventsCount',
            'galleriesCount',
            'photosCount',
            'topPhotographers',
            'topEvents',
            'eftReadyCount',
            'missingBankingCount'
        ));
    }
}
