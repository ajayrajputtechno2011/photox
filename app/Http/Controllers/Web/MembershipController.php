<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Membership;

class MembershipController extends Controller
{
    public function index()
    {
        $plans = Membership::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('web.membership', compact('plans'));
    }
}
