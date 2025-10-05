<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            Session::put('login', true);
            Session::put('username', $user->username);
            Session::put('user_id', $user->id_user);

            return redirect()->route('dashboard')->with('success', 'Selamat datang, ' . $user->username . '!');
        }

        return back()->with('error', 'Username atau Password salah.');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $request->validate([
            'username'   => 'required|unique:users',
            'password'   => 'required|min:6',
            'rt_rw'      => 'nullable|string|max:20',
            'kelurahan'  => 'nullable|string|max:100',
            'kecamatan'  => 'nullable|string|max:100',
            'kota'       => 'nullable|string|max:100',
            'foto'       => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $fotoPath = null;

        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('uploads/foto_admin', 'public');
        }

        User::create([
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
            'rt_rw'      => $request->rt_rw,
            'kelurahan'  => $request->kelurahan,
            'kecamatan'  => $request->kecamatan,
            'kota'       => $request->kota,
            'foto'       => $fotoPath,
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Anda telah logout.');
    }

    public function showForgotPassword()
    {
        return view('auth.forgot_password');
    }

    public function processForgotPassword(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::where('username', $request->username)->first();

        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('login')->with('success', 'Password berhasil diubah! Silakan login.');
    }
}
