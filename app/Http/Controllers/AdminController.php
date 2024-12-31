<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Laundry;
use App\Models\Parcel;
use App\Models\Marketplace;
use App\Models\StudentGrab;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Display admin dashboard
    public function dashboard()
    {
        $users = User::where('role',  '!=', 'admin')->paginate(10); // Fetch paginated list of users
        return view('admin.admindashboard', compact('users'));
    }

    // Display user edit form
    public function editUser($id)
    {
        $user = User::findOrFail($id); // Find user by ID
        return view('admin.edit', compact('user'));
    }

    // Update user information
    public function updateUser(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone_number' => 'required|string|digits:10',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'role' => $request->input('role'),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'User updated successfully');
    }

    // Delete a user
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')
          ->with('success', 'User deleted successfully');
    }

    // Display history of services
    public function history()
    {
        $laundries = Laundry::with('user')->latest()->get();
        $parcels = Parcel::with('user')->latest()->get();
        // $marketplaceOrders = Marketplace::with('user')->latest()->get();
        // $studentGrabs = StudentGrab::with('user')->latest()->get();

        return view('admin.history', compact('laundries', 'parcels' ));
    }

    // Edit a service record
    public function editService($type, $id)
    {
        $model = $this->getModel($type);
        $service = $model::findOrFail($id);

        return view('admin.edit-service', compact('service', 'type'));
    }

    // Update a service record
    public function updateService(Request $request, $type, $id)
    {
        $model = $this->getModel($type);
        $service = $model::findOrFail($id);

        $request->validate([
            'pickup_address' => 'nullable|string|max:255',
            'phone_number' => 'required|string|digits:10',
            'delivery_address' => 'nullable|string|max:255',
            'status' => 'required|string',
        ]);

        $service->update($request->all());

        return redirect()->route('admin.history')->with('success', ucfirst($type) . ' record updated successfully');
    }

    // Delete a service record
    public function deleteService($type, $id)
    {
        $model = $this->getModel($type);
        $service = $model::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.history')->with('success', ucfirst($type) . ' record deleted successfully');
    }

    // Get model based on type
    private function getModel($type)
    {
        return match ($type) {
            'laundry' => Laundry::class,
            'parcel' => Parcel::class,
            // 'marketplace' => Marketplace::class,
            // 'student-grab' => StudentGrab::class,
            default => throw new \InvalidArgumentException('Invalid service type')
        };
    }

    // Display history records filtered by type (Laundry, Parcel, etc.)
    public function historyByType($type)
    {
        $model = $this->getModel($type);
        $data = $model::with('user')->latest()->paginate(10);

        return view('admin.history-by-type', compact('data', 'type'));
    }
}
