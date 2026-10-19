<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    /**
     * Display a listing of all customers.
     */
    public function index(Request $request): View
    {
        $query = User::where('role', 'customer');

        if ($request->filled('search')) {
            $search = trim($request->input('search'));
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%")
                    ->orWhere('id', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        $totalCustomers = User::where('role', 'customer')->count();
        $activeCustomers = User::where('role', 'customer')->where('status', 'active')->count();
        $inactiveCustomers = User::where('role', 'customer')->where('status', '!=', 'active')->count();
        $newThisMonth = User::where('role', 'customer')->where('created_at', '>=', now()->startOfMonth())->count();

        $customers = $query->latest()->paginate(15)->withQueryString();

        return view('admin.customers', compact(
            'customers',
            'totalCustomers',
            'activeCustomers',
            'inactiveCustomers',
            'newThisMonth'
        ));
    }

    /**
     * Display the specified customer details.
     */
    public function show(int $id): View
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        return view('admin.customer-detail', compact('customer'));
    }

    /**
     * Update the customer profile and administrative notes.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,'.$customer->id,
            'phone' => 'nullable|string|max:50',
            'location' => 'nullable|string|max:255',
            'status' => 'required|string|in:active,inactive,blocked',
            'role' => 'nullable|string|in:customer,photographer',
            'admin_notes' => 'nullable|string|max:2000',
        ]);

        if (! empty($validated['role']) && $validated['role'] === 'photographer' && $customer->role !== 'photographer') {
            $customer->tier = $customer->tier ?: 'starter';
        }

        $customer->update($validated);

        if ($customer->role === 'photographer') {
            return redirect()->route('admin.photographers.show', $customer->id)
                ->with('success', "Account for {$customer->name} has been promoted to Photographer with Creator Workspace.");
        }

        return redirect()->route('admin.customers.show', $customer->id)
            ->with('success', "Customer account for {$customer->name} was updated successfully.");
    }

    /**
     * Toggle customer active/blocked status.
     */
    public function toggleStatus(int $id): RedirectResponse
    {
        $customer = User::where('role', 'customer')->findOrFail($id);

        $customer->status = ($customer->status === 'active') ? 'blocked' : 'active';
        $customer->save();

        $label = ucfirst($customer->status);

        return back()->with('success', "Customer status changed to {$label}.");
    }

    /**
     * Delete a customer.
     */
    public function destroy(int $id): RedirectResponse
    {
        $customer = User::where('role', 'customer')->findOrFail($id);
        $name = $customer->name;
        $customer->delete();

        return redirect()->route('admin.customers.index')
            ->with('success', "Customer {$name} was deleted successfully.");
    }
}
