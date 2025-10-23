<?php

namespace App\Http\Controllers\Admin\Setting;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingController extends Controller
{
    public function index()
    {
        // Logged-in user ki ID haasil karein
        $userId = Auth::id();

        // Us user ki settings find karein, agar nahi hain tou new instance banayein
        $setting = Setting::where('user_id', $userId)->firstOrNew();

        // View ko data ke saath return karein
        return view('admin.setting.all_setting', compact('setting'));
    }

    public function update(Request $request)
    {
        // 1. Logged-in user ka data hasil karein
        $user = Auth::user();
        if (!$user) {
            return redirect()->back()->withErrors(['msg' => 'User not found.']);
        }

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->save();
        Setting::updateOrCreate(
            ['user_id' => $user->id],
            [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
            ]
        );

        $notification = array(
            'message' => 'Settings and Profile Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
