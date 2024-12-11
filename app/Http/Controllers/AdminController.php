<?php

namespace App\Http\Controllers;

use App\Models\User;
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

        return redirect()->route('admin.dashboard') ->with('success', 'User updated successfully');
    }

    // Delete a user
    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.dashboard')
          ->with('success', 'User deleted successfully');
    }
}
