<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        try {
            if (Auth::attempt($credentials)) {
                // Ambil kode perangkat
                $kodePerangkat = DB::table('alat')
                    ->where('id_user', Auth::id())
                    ->orderBy('id_alat', 'ASC')
                    ->value('kode_perangkat');

                // Simpan ke session untuk diakses JavaScript
                session(['device_code' => $kodePerangkat ?? 'Belum Ada Alat']);

                return redirect()->intended('main')->with('login_success', true);
            }
        } catch (\Exception $e) {
            // Handle any exceptions that occur during the login process
            Log::error('Login failed: ' . $e->getMessage());
        }

        return back()
            ->withInput($request->only('email'))
            ->with('type', 'danger')
            ->with('message', 'Login Gagal!')
            ->with('details', [
                'Email atau password salah',
                'Silakan periksa kembali email dan password Anda'
            ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')
            ->with('success', 'Berhasil keluar')
            ->with('success_detail', ['Anda telah berhasil keluar dari sistem']);
    }
} 