<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerSettingController extends Controller
{
    public function index()
    {
        $userId = Auth::id();
        $setting = Setting::where('user_id', $userId)->firstOrNew();

        return view('customer.setting.all_setting', compact('setting'));
    }
    public function update(Request $request)
    {
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

        // 3. Settings table ko update karein (phone, address, etc.)
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
            'message' => 'Account Settings Updated Successfully!',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
