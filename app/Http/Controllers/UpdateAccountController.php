<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UpdateAccountController extends Controller
{
    public function update(Request $request)
    {
        Log::info('Memulai proses update akun', [
            'user_id' => Auth::id(),
            'request_data' => $request->only(['nama', 'email', 'no_hp'])
        ]);

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:user,email,' . Auth::id() . ',id_user',
            'no_hp' => 'required|string|max:15',
            'foto_profil' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($validator->fails()) {
            Log::warning('Validasi update akun gagal', [
                'user_id' => Auth::id(),
                'errors' => $validator->errors()->all()
            ]);

            return back()
                ->withInput()
                ->with('type', 'danger')
                ->with('message', 'Gagal memperbarui akun')
                ->with('details', $validator->errors()->all());
        }

        try {
            $user = User::find(Auth::id());
            if (!$user) {
                Log::error('User tidak ditemukan saat update akun', [
                    'user_id' => Auth::id()
                ]);

                throw new \Exception('User tidak ditemukan');
            }

            $oldData = [
                'nama' => $user->nama,
                'email' => $user->email,
                'no_hp' => $user->no_hp,
                'foto_profil' => $user->foto_profil
            ];

            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;

            // Handle foto profil
            if ($request->hasFile('foto_profil')) {
                $file = $request->file('foto_profil');
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = 'resources/assets/image/foto_profile/';

                // Hapus foto lama jika bukan default
                $oldProfilePath = base_path($path . basename($user->foto_profil));
                $defaultProfilePath = base_path($path . 'default_profile.png');
                
                if (File::exists($oldProfilePath) && $oldProfilePath !== $defaultProfilePath) {
                    try {
                        File::delete($oldProfilePath);
                        Log::info('Foto profil lama dihapus', [
                            'path' => $oldProfilePath,
                            'user_id' => $user->id_user
                        ]);
                    } catch (\Exception $e) {
                        Log::warning('Gagal menghapus foto profil lama', [
                            'path' => $oldProfilePath,
                            'error' => $e->getMessage()
                        ]);
                    }
                }

                // Simpan foto baru
                try {
                    $file->move(base_path($path), $filename);
                    $user->foto_profil = '/image/foto_profile/' . $filename;
                    
                    Log::info('Foto profil baru disimpan', [
                        'filename' => $filename,
                        'path' => $path,
                        'user_id' => $user->id_user
                    ]);
                } catch (\Exception $e) {
                    Log::error('Gagal menyimpan foto profil baru', [
                        'filename' => $filename,
                        'error' => $e->getMessage()
                    ]);
                    throw new \Exception('Gagal mengunggah foto profil');
                }
            }

            $user->save();

            Log::info('Akun berhasil diperbarui', [
                'user_id' => $user->id_user,
                'old_data' => $oldData,
                'new_data' => [
                    'nama' => $user->nama,
                    'email' => $user->email,
                    'no_hp' => $user->no_hp,
                    'foto_profil' => $user->foto_profil
                ]
            ]);

            return back()
                ->with('type', 'success')
                ->with('message', 'Akun berhasil diperbarui')
                ->with('details', ['Data akun Anda telah diperbarui']);

        } catch (\Exception $e) {
            Log::error('Error saat update akun', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('type', 'danger')
                ->with('message', 'Gagal memperbarui akun')
                ->with('details', ['Terjadi kesalahan saat memperbarui akun']);
        }
    }

    public function update_password(Request $request)
    {
        Log::info('Memulai proses update password', [
            'user_id' => Auth::id()
        ]);

        try {
            $validated = $request->validate([
                'current_password' => 'required',
                'new_password' => [
                    'required',
                    'string',
                    'min:8',
                ],
                'confirm_password' => 'required|same:new_password'
            ], [
                'current_password.required' => 'Password saat ini harus diisi',
                'new_password.required' => 'Password baru harus diisi',
                'new_password.min' => 'Password baru minimal 8 karakter',
                'confirm_password.required' => 'Konfirmasi password harus diisi',
                'confirm_password.same' => 'Konfirmasi password tidak cocok',
            ]);

            $user = User::find(Auth::id());
            
            // Verifikasi password saat ini
            if (!Hash::check($request->current_password, $user->password)) {
                Log::warning('Password saat ini tidak sesuai', [
                    'user_id' => Auth::id()
                ]);

                return back()
                    ->withInput()
                    ->with('type', 'danger')
                    ->with('message', 'Password saat ini tidak sesuai')
                    ->with('details', ['Password yang Anda masukkan salah']);
            }

            // Update password
            $user->password = Hash::make($validated['new_password']);
            $user->save();

            Log::info('Password berhasil diperbarui', [
                'user_id' => $user->id_user
            ]);

            return back()
                ->with('type', 'success')
                ->with('message', 'Password berhasil diubah')
                ->with('details', ['Password Anda telah diperbarui']);

        } catch (ValidationException $e) {
            Log::warning('Validasi update password gagal', [
                'user_id' => Auth::id(),
                'errors' => $e->errors()
            ]);

            return back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('type', 'danger')
                ->with('message', 'Gagal mengubah password')
                ->with('details', collect($e->errors())->flatten()->all());

        } catch (\Exception $e) {
            Log::error('Error saat update password', [
                'user_id' => Auth::id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()
                ->withInput()
                ->with('type', 'danger')
                ->with('message', 'Gagal mengubah password')
                ->with('details', ['Terjadi kesalahan saat memperbarui password']);
        }
    }
} 