<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class ParcelController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $parcels = Parcel::with(relations: 'user')
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
        // $this->authorize('view', $parcel);
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
        // $this->authorize('update', $parcel);

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

    // public function available()
    // {
    //     $parcels = Parcel::where('status', 'pending')
    //         ->latest()
    //         ->paginate(10);

    //     return view('parcels.available', compact('parcels'));
    // }
//     public function acceptOrder(Parcel $parcel)
// {
//     if ($parcel->status !== 'pending') {
//         return back()->with('error', 'Order is not available for acceptance.');
//     }

//     $parcel->update(['status' => 'picked_up']);
//     return back()->with('success', 'You have accepted the order for delivery.');
// }

public function delete(Parcel $parcel)
{
    if ($parcel->status === 'out_for_delivery') {
        $parcel->delete();
        return redirect()->route('parcel.index')->with('success', 'Parcel successfully delivered and removed.');
    }

    return back()->with('error', 'Parcel cannot be deleted until it is out for delivery.');
}

// public function markAsPickedUp(Parcel $parcel)
// {
//     // Ensure only pending parcels can be picked up
//     if ($parcel->status == 'pending') {
//         $parcel->update(['status' => 'picked_up']);
//     }

//     return redirect()->route('parcels.index')->with('success', 'Parcel status updated to picked up.');
// }


public function service()
{
    return view('parcels.service');
}


// public function pickedup(Parcel $parcel)
// {
//     if ($parcel->status !== 'pending') {
//         return back()->with('error', 'This parcel is no longer available for pickup.');
//     }

//     $parcel->update([
//         'deliverer_id' => Auth::id(),
//         'status' => 'picked_up',
//         'picked_up_at' => now(),
//     ]);

//     return back()->with('success', 'You have successfully picked up this parcel.');
// }


// public function updatedStatus(Request $request, $parcelId)
// {
//     // Find the parcel by ID
//     $parcel = Parcel::findOrFail($parcelId);

//     // Update the parcel's status based on the form submission
//     $parcel->status = $request->input('status');

//     // Save the changes
//     $parcel->save();

//     // Redirect back with a success message
//     return redirect()->route('parcel.track', $parcelId)->with('success', 'Status updated!');
// }

public function destroy($id)
{
    Parcel::findOrFail($id)->delete();
    return redirect()->route('parcels.index')->with('success', 'Parcel tracking has been deleted.');
}

// app/Http/Controllers/ParcelController.php

public function acceptOrder(Parcel $parcel)
{
    // Ensure the parcel is still pending before accepting
    if ($parcel->status !== 'pending') {
        return back()->with('error', 'This parcel is no longer available for acceptance.');
    }

    // Assign the deliverer and keep the status as 'pending'
    $parcel->update([
        'deliverer_id' => Auth::id(),
        'status' => 'pending', // Status stays 'pending' until picked up
    ]);

    return redirect()->route('parcel.track', $parcel)->with('success', 'You have accepted the order.');
}

// app/Http/Controllers/ParcelController.php

// app/Http/Controllers/ParcelController.php

public function cancelOrder($parcelId)
{
    $parcel = Parcel::find($parcelId);

    if ($parcel && $parcel->deliverer_id === auth()->id() && $parcel->status === 'picked_up') {
        // Change status back to 'pending'
        $parcel->status = 'pending';
        $parcel->save();

        // Optionally, you can redirect to the available parcels page
        return redirect()->route('parcels.index')
                         ->with('success', 'Parcel order has been canceled and is available for others.');
    }

    return back()->with('error', 'You cannot cancel this order.');
}


}
