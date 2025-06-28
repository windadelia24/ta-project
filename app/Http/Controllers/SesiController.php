<?php

namespace App\Http\Controllers;

use App\Models\Koperasi;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SesiController extends Controller
{
    function index(){
        return view('login');
    }
    function login(Request $request){
        $request->validate([
            'email'=> 'required',
            'password'=> 'required'
        ],[
            'email.required'=>'Email wajib diisi',
            'password.required'=>'Password wajib diisi',
        ]);

        $infologin = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if(Auth::attempt($infologin)){
            if(Auth::user()->role == 'pengurus'){
                return redirect('pengurus');
            } elseif (Auth::user()->role == 'admin'){
                return redirect('admin');
            } elseif (Auth::user()->role == 'pengawas'){
                return redirect('pengawas');
            } elseif (Auth::user()->role == 'kabid'){
                return redirect('kabid');
            }
        }else{
            return redirect('')->withErrors('Email atau password salah')->withInput();
        }
    }

    function logout(){
        Auth::logout();
        return redirect('');
    }

    function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik' => 'required|unique:users,nik_nip',
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'nik_koperasi' => 'required',
            'password' => 'required|min:6',
        ], [
            'nik.required' => 'NIK wajib diisi',
            'nik.unique' => 'Nomor Induk Koperasi sudah terdaftar',
            'name.required' => 'Nama wajib diisi',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'nik_koperasi.required' => 'Nomor Induk Koperasi wajib diisi',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
        ]);

        $koperasi = Koperasi::where('nik', $request->nik_koperasi)->first();

        if (!$koperasi) {
            return back()->withErrors(['nik' => 'Koperasi anda tidak terdaftar, silahkan hubungi pengawas koperasi untuk didaftarkan'])->withInput();
        }

        // Simpan ke tabel users
        $user = User::create([
            'nik_nip' => $request->nik,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'pengurus',
        ]);

        // Simpan ke tabel pengurus
        Pengurus::create([
            'nik_nip' => $user->nik_nip, // foreign key ke tabel users
            'nik' => $koperasi->nik, // foreign key ke tabel koperasi
        ]);

        // Redirect ke login
        return redirect()->route('login')->with('success', 'Registrasi berhasil, silahkan login!');
    }

    function profile(){
        $user = User::where('nik_nip', Auth::user()->nik_nip)->first();
        return view('profile', compact('user'));
    }

    public function updateprofile(Request $request)
    {
        $user = User::where('nik_nip', Auth::user()->nik_nip)->first();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'nip' => 'required|string|max:255',
            'no_telp' => 'nullable|string|max:20',
            'jabatan' => 'nullable|string|max:255',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Cek jika ada password yang mau diubah
        if ($request->filled('current_password') || $request->filled('new_password')) {
            // Jika salah satu password field diisi, maka keduanya harus diisi
            if (!$request->filled('current_password') || !$request->filled('new_password')) {
                return redirect()->route('profile')->with('error', 'Untuk mengubah password, mohon isi password lama dan password baru.');
            }

            // Cek apakah password lama sesuai
            if (!Hash::check($request->current_password, (string) $user->password)) {
                return redirect()->route('profile')->with('error', 'Password lama tidak sesuai.');
            }

            // Update password
            $user->password = Hash::make($request->new_password);
        }

        // Handle upload foto
        if ($request->hasFile('photo')) {
            $folder = 'user_picture';
            $destinationPath = storage_path('app/public/' . $folder);

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            // Hapus foto lama jika ada
            if ($user->user_picture && Storage::exists('public/' . $folder . '/' . $user->user_picture)) {
                Storage::delete('public/' . $folder . '/' . $user->user_picture);
            }

            // Upload foto baru
            $file = $request->file('photo');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs($folder, $filename, 'public');

            $user->user_picture = $filename;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telp = $request->no_telp;
        $user->jabatan = $request->jabatan;

        $user->save();

        return redirect()->route('profile')->with('success', 'Profile berhasil diperbarui.');
    }
}
