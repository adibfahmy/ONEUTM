<?php

namespace App\Http\Controllers;

use App\Models\StudentGrab;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class StudentGrabController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $studentGrabs = StudentGrab::with('user')
            ->where('user_id', '!=', Auth::id()) // Exclude orders where user_id is the authenticated user's ID
            ->latest()
            ->paginate(10); // Paginate the result
        return view('studentgrab.index', compact('studentGrabs'));
    }

    public function create()
    {
        return view('studentgrab.create');
    }

    public function store(Request $request)
    {
        // Validation to ensure 'date' and 'time' are included
        $validated = $request->validate([
            'pickup_address' => 'required|string',
            'phone_number' => 'required|digits:10',
            'delivery_address' => 'required|string',
            'date' => 'required|date',
            'time' => 'required|date_format:H:i',
        ]);

        // Create a new StudentGrab record with the provided data
        StudentGrab::create([
            'user_id' => Auth::id(),
            'pickup_address' => $request->pickup_address,
            'phone_number' => $request->phone_number,
            'delivery_address' => $request->delivery_address,
            'date' => $request->date,  // Store the date
            'time' => $request->time,  // Store the time
            'status' => 'pending',  // Default status is 'pending'
        ]);

        return redirect()->route('studentgrab.myStudentGrab')->with('success', 'Pickup request created successfully.');
    }

    public function track($id)
    {
        $studentGrab = StudentGrab::findOrFail($id);
        return view('studentgrab.track', compact('studentGrab'));
    }

    public function pickup(StudentGrab $studentGrab)
    {
        if ($studentGrab->status !== 'pending') {
            return back()->with('error', 'This order is no longer available for pickup.');
        }

        $studentGrab->update([
            'deliverer_id' => Auth::id(),
            'status' => 'picked_up',
            'picked_up_at' => now(),
        ]);

        return back()->with('success', 'You have successfully picked up this order.');
    }

    public function updateStatus(StudentGrab $studentGrab, Request $request)
    {
        $validated = $request->validate([
            'status' => 'required|in:out_for_delivery,delivered',
        ]);

        $timestamp_field = $validated['status'] . '_at';

        $studentGrab->update([
            'status' => $validated['status'],
            $timestamp_field => now(),
        ]);

        return back()->with('success', 'Order status updated successfully.');
    }

    public function delete(StudentGrab $studentGrab)
    {
        if ($studentGrab->status === 'out_for_delivery') {
            $studentGrab->delete();
            return redirect()->route('studentgrab.index')->with('success', 'Order successfully delivered and removed.');
        }

        return back()->with('error', 'Order cannot be deleted until it is out for delivery.');
    }

    public function destroy($id)
    {
        StudentGrab::findOrFail($id)->delete();
        return redirect()->route('studentgrab.index')->with('success', 'Order tracking has been deleted.');
    }

    public function acceptOrder(StudentGrab $studentGrab)
    {
        if ($studentGrab->status !== 'pending') {
            return back()->with('error', 'This order is no longer available for acceptance.');
        }

        $studentGrab->update([
            'deliverer_id' => Auth::id(),
            'status' => 'pending', // Status stays 'pending' until picked up
        ]);

        return redirect()->route('studentgrab.track', $studentGrab)->with('success', 'You have accepted the order.');
    }

    public function cancelOrder($studentGrabId)
    {
        $studentGrab = StudentGrab::find($studentGrabId);

        if ($studentGrab && $studentGrab->deliverer_id === auth()->id() && $studentGrab->status === 'picked_up') {
            $studentGrab->status = 'pending';
            $studentGrab->save();

            return redirect()->route('studentgrab.index')
                ->with('success', 'Order has been canceled and is available for others.');
        }

        return back()->with('error', 'You cannot cancel this order.');
    }

    public function service()
    {
        // Calculate counts for quick stats
        $pendingCount = StudentGrab::where('status', 'pending')->count();
        $inTransitCount = StudentGrab::whereIn('status', ['picked_up', 'out_for_delivery'])->count();
        $deliveredToday = StudentGrab::where('status', 'delivered')
            ->whereDate('updated_at', Carbon::today())
            ->count();

        // Pass data to the service view
        return view('studentgrab.service', compact('pendingCount', 'inTransitCount', 'deliveredToday'));
    }

    public function myStudentGrab()
    {
        $userOrders = StudentGrab::with('deliverer')->where('user_id', Auth::id())->get();
        return view('studentgrab.myStudentGrab', compact('userOrders'));
    }
}
