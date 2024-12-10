<?php

namespace App\Http\Controllers;

use App\Models\Laundry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class LaundryController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $laundries = Laundry::with('user')
            ->where('user_id', '!=', Auth::id()) // Exclude laundry where user_id is the authenticated user's ID
            ->latest()
            ->paginate(10); // Paginate the result
        return view('laundry.index', compact('laundries'));
    }

    public function create()
    {
        return view('laundry.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'pickup_address' => 'required|string',
            'phone_number' => 'required|digits:10',
            'delivery_address' => 'required|string',
            'delivery_address_same_as_pickup' => 'boolean', // if you're using this checkbox
        ]);

        $validated['user_id'] = Auth::id();
        $validated['picked_up_by_user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Laundry::create([
            'user_id' => Auth::id(),
            'pickup_address' => $request->pickup_address,
            'phone_number' => $request->phone_number,
            'delivery_address' => $request->delivery_address,
            'delivery_address_same_as_pickup' => $request->delivery_address_same_as_pickup ? true : false,
            'status' => 'Pending',
        ]);

        return redirect()->route('laundry.myLaundry')->with('success', 'Pickup request created successfully.');
    }

    public function track($id)
    {
        $laundry = Laundry::findOrFail($id);
        return view('laundry.track', compact('laundry'));
    }

    public function pickup(Laundry $laundry)
    {
        if ($laundry->status !== 'pending') {
            return back()->with('error', 'This laundry is no longer available for pickup.');
        }


        $laundry->update([
            'deliverer_id' => Auth::id(),
            'status' => 'picked_up',
            'picked_up_at' => now(),
        ]);

        return back()->with('success', 'You have successfully picked up this laundry.');
    }

    public function updateStatus(Laundry $laundry, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:out_for_delivery,delivered',
        ]);

        $timestamp_field = $validated['status'] . '_at';

        $laundry->update([
            'status' => $validated['status'],
            $timestamp_field => now(),
        ]);

        return back()->with('success', 'Laundry status updated successfully.');
    }

    public function delete(Laundry $laundry)
    {
        if ($laundry->status === 'out_for_delivery') {
            $laundry->delete();
            return redirect()->route('laundry.index')->with('success', 'Laundry successfully delivered and removed.');
        }

        return back()->with('error', 'Laundry cannot be deleted until it is out for delivery.');
    }

    public function destroy($id)
    {
        Laundry::findOrFail($id)->delete();
        return redirect()->route('laundry.index')->with('success', 'Laundry tracking has been deleted.');
    }

    public function acceptOrder(Laundry $laundry)
    {
        if ($laundry->status !== 'pending') {
            return back()->with('error', 'This laundry is no longer available for acceptance.');
        }

        $laundry->update([
            'deliverer_id' => Auth::id(),
            'status' => 'pending', // Status stays 'pending' until picked up
        ]);

        return redirect()->route('laundry.track', $laundry)->with('success', 'You have accepted the order.');
    }

    public function cancelOrder($laundryId)
    {
        $laundry = Laundry::find($laundryId);

        if ($laundry && $laundry->deliverer_id === auth()->id() && $laundry->status === 'picked_up') {
            $laundry->status = 'pending';
            $laundry->save();

            return redirect()->route('laundry.index')
                ->with('success', 'Laundry order has been canceled and is available for others.');
        }

        return back()->with('error', 'You cannot cancel this order.');
    }

    /**
     * Service method to display the quick stats page.
     */
    public function service()
    {
        // Calculate counts for quick stats
        $pendingCount = Laundry::where('status', 'pending')->count();
        $inTransitCount = Laundry::whereIn('status', ['picked_up', 'out_for_delivery'])->count();
        $deliveredToday = Laundry::where('status', 'delivered')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        // Pass data to the service view
        return view('laundry.service', compact('pendingCount', 'inTransitCount', 'deliveredToday'));    }

    public function myLaundry()
    {
        $userlaundry = Laundry::where('user_id', Auth::id())->get();
        return view('laundry.myLaundry', compact('userlaundry'));
    }
}
