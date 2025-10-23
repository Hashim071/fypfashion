<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Show all users
     */
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.user.all_user', compact('users'));
    }

    /**
     * Show single user
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.user.user_details', compact('user'));
    }

    /**
     * Delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}
