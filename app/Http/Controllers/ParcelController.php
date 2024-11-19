<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ParcelController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $parcels = Parcel::with('user')
            ->where('user_id', '!=', Auth::id()) // Exclude parcels where user_id is the authenticated user's ID
            ->latest()
            ->paginate(10); // Paginate the result
        return view('parcels.index', compact('parcels'));
    }

    public function create()
    {
        return view('parcels.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tracking_number' => 'required|string|unique:parcels',
            'pickup_point' => 'required|in:Cengal Parcel Point,One Parcel Centre,Angkasa Ninja Van',
            'phone_number' => 'required|string|max:20',
            'delivery_address' => 'required|string',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['picked_up_by_user_id'] = Auth::id();
        $validated['status'] = 'pending';

        Parcel::create($validated);

        return redirect()->route('parcels.index')
            ->with('success', 'Parcel pickup request created successfully.');
    }

    public function track($id)
    {
        $parcel = Parcel::findOrFail($id);
        return view('parcels.track', compact('parcel'));
    }

    public function pickup(Parcel $parcel)
    {
        if ($parcel->status !== 'pending') {
            return back()->with('error', 'This parcel is no longer available for pickup.');
        }

        $parcel->update([
            'deliverer_id' => Auth::id(),
            'status' => 'picked_up',
            'picked_up_at' => now(),
        ]);

        return back()->with('success', 'You have successfully picked up this parcel.');
    }

    public function updateStatus(Parcel $parcel, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:out_for_delivery,delivered',
        ]);

        $timestamp_field = $validated['status'] . '_at';

        $parcel->update([
            'status' => $validated['status'],
            $timestamp_field => now(),
        ]);

        return back()->with('success', 'Parcel status updated successfully.');
    }

    public function delete(Parcel $parcel)
    {
        if ($parcel->status === 'out_for_delivery') {
            $parcel->delete();
            return redirect()->route('parcel.index')->with('success', 'Parcel successfully delivered and removed.');
        }

        return back()->with('error', 'Parcel cannot be deleted until it is out for delivery.');
    }

    public function destroy($id)
    {
        Parcel::findOrFail($id)->delete();
        return redirect()->route('parcels.index')->with('success', 'Parcel tracking has been deleted.');
    }

    public function acceptOrder(Parcel $parcel)
    {
        if ($parcel->status !== 'pending') {
            return back()->with('error', 'This parcel is no longer available for acceptance.');
        }

        $parcel->update([
            'deliverer_id' => Auth::id(),
            'status' => 'pending', // Status stays 'pending' until picked up
        ]);

        return redirect()->route('parcel.track', $parcel)->with('success', 'You have accepted the order.');
    }

    public function cancelOrder($parcelId)
    {
        $parcel = Parcel::find($parcelId);

        if ($parcel && $parcel->deliverer_id === auth()->id() && $parcel->status === 'picked_up') {
            $parcel->status = 'pending';
            $parcel->save();

            return redirect()->route('parcels.index')
                ->with('success', 'Parcel order has been canceled and is available for others.');
        }

        return back()->with('error', 'You cannot cancel this order.');
    }

    /**
     * Service method to display the quick stats page.
     */
    public function service()
    {
        // Calculate counts for quick stats
        $pendingCount = Parcel::where('status', 'pending')->count();
        $inTransitCount = Parcel::whereIn('status', ['picked_up', 'out_for_delivery'])->count();
        $deliveredToday = Parcel::where('status', 'delivered')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        // Pass data to the service view
        return view('parcels.service', compact('pendingCount', 'inTransitCount', 'deliveredToday'));
    }
}
