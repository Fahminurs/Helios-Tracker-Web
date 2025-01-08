<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('admin.profile', compact('user'));
    }

 public function update(Request $request)  
{  
    $request->validate([  
        'name' => 'required|string|max:255',  
        'phone' => 'nullable|string|max:20',  
        'password' => 'nullable|string|min:8|confirmed'  
    ]);  

    $user = auth()->user();  

    // Pastikan pengguna terautentikasi  
    if (!$user) {  
        return redirect()->route('login')->with('error', 'Anda harus login terlebih dahulu.');  
    }  

    $user->name = $request->name;  
    $user->phone = $request->phone;  
    
    if ($request->filled('password')) {  
        $user->password = Hash::make($request->password);  
    }  

    $user->save(); // Ini akan berhasil jika $user adalah instance dari User  

    return back()->with('success', 'Profile berhasil diperbarui');  
}  
} 