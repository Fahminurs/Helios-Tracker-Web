<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class RegistrationController extends Controller
{
    public function showRegistrationForm()
    {
        return view('registrasi');
    }

    public function register(Request $request)
    {
        Log::info('Memulai proses registrasi', [
            'nama' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no_hp
        ]);

        try {
            $validated = $request->validate([
                'nama' => 'required|max:50',
                'email' => 'required|email|max:50|unique:user',
                'no_hp' => 'required|max:50|unique:user',
                'password' => 'required|min:8|confirmed'
            ], [
                'nama.required' => 'Nama harus diisi',
                'nama.max' => 'Nama maksimal 50 karakter',
                'email.required' => 'Email harus diisi',
                'email.email' => 'Format email tidak valid',
                'email.max' => 'Email maksimal 50 karakter',
                'email.unique' => 'Email sudah terdaftar',
                'no_hp.required' => 'Nomor HP harus diisi',
                'no_hp.max' => 'Nomor HP maksimal 50 karakter',
                'no_hp.unique' => 'Nomor HP sudah terdaftar',
                'password.required' => 'Password harus diisi',
                'password.min' => 'Password minimal 8 karakter',
                'password.confirmed' => 'Konfirmasi password tidak cocok'
            ]);

            Log::info('Validasi berhasil', $validated);

            $user = new User();
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->password = Hash::make($request->password);
            $user->create_at = now();
            $user->save();

            Log::info('Registrasi berhasil', [
                'user_id' => $user->id_user,
                'email' => $user->email
            ]);

            return redirect()->route('registrasi')->with([
                'type' => 'success',
                'message' => 'Registrasi berhasil',
                'redirect_to' => route('login')
            ]);

        } catch (ValidationException $e) {
            Log::error('Validasi gagal', [
                'errors' => $e->errors(),
                'request_data' => $request->all()
            ]);

            return redirect()->route('registrasi')
                ->withInput([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation
                ])
                ->with([
                    'type' => 'danger',
                    'message' => 'Validasi gagal',
                    'details' => $e->errors()
                ]);

        } catch (\Exception $e) {
            Log::error('Registrasi gagal', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return redirect()->route('registrasi')
                ->withInput([
                    'nama' => $request->nama,
                    'email' => $request->email,
                    'no_hp' => $request->no_hp,
                    'password' => $request->password,
                    'password_confirmation' => $request->password_confirmation
                ])
                ->with([
                    'type' => 'danger',
                    'message' => 'Terjadi kesalahan',
                    'details' => [$e->getMessage()]
                ]);
        }
    }
} 