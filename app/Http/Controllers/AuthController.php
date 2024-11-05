<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role; // Pastikan untuk mengimpor model Role
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Menampilkan halaman pendaftaran
    public function daftar()
    {
        $roles = Role::all(); // Mengambil semua role dari database
        return view('daftar', compact('roles')); // Mengirim data role ke view
    }
    // Menyimpan data pendaftaran
    public function submit(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email', // Validasi email
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);
        
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email, // Pastikan email ada
            'username' => $request->username,
            'password' => Hash::make($request->password), 
            'role_id' => $request->role_id,
            
        ]);
    
        return redirect()->route('login.tampil')->with('success', 'Registrasi berhasil! Silakan login.');
    }
    

    // Menampilkan halaman login
    public function login()
    {
        return view('login');
    }

    // Proses autentikasi pengguna
    public function submitLogin(Request $request)
    {
        // Validasi input login
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        // Mengambil data untuk autentikasi
        $data = $request->only('email', 'password');

        if (Auth::attempt($data)) {
            $request->session()->regenerate(); // Regenerasi session untuk keamanan
            return redirect()->route('user.tampil'); // Redirect ke halaman pengguna setelah login berhasil
        } else {
            return redirect()->back()->with('error', 'Email atau Password Anda Salah'); // Menampilkan pesan error
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/'); // Redirect ke halaman utama setelah logout
    }
}
