<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Models\User;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('auth.forgot-password');
    }

    public function sendResetLinkEmail(Request $request)
    {
        // 1. Email validate karein
        $request->validate(['email' => 'required|email|exists:users,email']);

        // 2. Unique Token generate karein
        $token = Str::random(64);

        // 3. Database mein entry karein
        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        // 4. Reset Link ki bajaye direct route par redirect karein
        // Hum yahan password.reset walay page par data bhej kar redirect kar rahe hain
        return redirect()->route('password.reset', [
            'token' => $token,
            'email' => $request->email
        ])->with('success', 'Testing Mode: System ne aapko direct reset page par bhej diya hai.');
    }

    public function showResetForm($token, Request $request)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|min:8|confirmed',
            'token' => 'required'
        ]);

        // Token check karein
        $check = DB::table('password_reset_tokens')
            ->where(['email' => $request->email, 'token' => $request->token])
            ->first();

        if (!$check || !isset($check->token)) {
            return back()->withErrors(['email' => 'Invalid or expired token link!']);
        }
        // Password update karein
        User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
        ]);

        // Token delete kar dein
        DB::table('password_reset_tokens')->where(['email' => $request->email])->delete();

        return redirect()->route('login')->with('success', 'Aapka password update ho gaya hai!');
    }
}
