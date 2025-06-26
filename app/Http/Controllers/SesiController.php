<?php

namespace App\Http\Controllers;

use App\Models\Koperasi;
use App\Models\Pengurus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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
        $user = Auth::user();
        return view('profile', compact('user'));
    }
}
