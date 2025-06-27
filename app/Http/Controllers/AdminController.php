<?php

namespace App\Http\Controllers;

use App\Models\Koperasi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index(){
        return view('dashboard');
    }

    public function listakun()
    {
        $users = User::paginate(10);
        return view('admin.listakun', compact('users'));
    }

    function tambahakun(){
        return view('admin.tambahakun');
    }

    function createakun(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nama' => 'required|string|max:255',
            'nik_nip' => 'required|string|max:18|unique:users',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6',
        ], [
                'nama.required' => 'Nama wajib diisi',
                'nama.string' => 'Nama harus berupa teks',
                'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
                'nik_nip.required' => 'NIK/NIP wajib diisi',
                'nik_nip.max' => 'NIK/NIP tidak boleh lebih dari 18 karakter',
                'nik_nip.unique' => 'NIK/NIP sudah terdaftar',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Format email tidak valid',
                'email.unique' => 'Email sudah digunakan',
                'role.required' => 'Role wajib diisi',
                'password.required' => 'Password wajib diisi',
                'password.min' => 'Password harus memiliki minimal 6 karakter',
        ]);

        // Create a new user instance and save data
        $user = User::create([
            'nik_nip' => $request->nik_nip,
            'name' => $request->nama,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);

        // Redirect back with a success message
        return redirect()->route('listakun')->with('success', 'Akun berhasil ditambahkan!');
    }

    function editakun($nik_nip)
    {
        $users = User::where('nik_nip', $nik_nip)->firstOrFail();
        return view('admin.editakun', compact('users'));
    }

    function updateakun(Request $request, $nik_nip)
    {
        // Validasi input terlebih dahulu
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $nik_nip . ',nik_nip',
            'role' => 'required',
            'password' => 'nullable|string|min:6',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.string' => 'Nama harus berupa teks',
            'nama.max' => 'Nama tidak boleh lebih dari 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.max' => 'Email tidak boleh lebih dari 255 karakter',
            'email.unique' => 'Email sudah digunakan',
            'role.required' => 'Role wajib diisi',
            'password.string' => 'Password harus berupa teks.',
            'password.min' => 'Password harus memiliki minimal 6 karakter.',
        ]);

        // Setelah lolos validasi, baru ambil user
        $user = User::where('nik_nip', $nik_nip)->firstOrFail();

        // Update data user
        $user->name = $request->nama;
        $user->email = $request->email;
        $user->role = $request->role;

        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return redirect()->route('listakun')->with('success', 'Akun berhasil diperbarui.');
    }

    function hapusakun($nik_nip)
    {
        $user = User::where('nik_nip', $nik_nip)->first();

        $user->delete();
        return redirect()->back()->with('success', 'Akun berhasil dihapus.');
    }

    public function cariakun(Request $request)
    {
        $search = $request->input('search');

        if (empty($search)) {
            $users = User::paginate(10);
        } else {
            $users = User::query()
                ->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('nik_nip', 'like', "%{$search}%")
                ->orWhere('role', 'like', "%{$search}%")
                ->paginate(10);

            // Append search parameter ke pagination links
            $users->appends(['search' => $search]);
        }

        // Jika request adalah AJAX, kembalikan partial view dengan pagination
        if ($request->ajax()) {
            $html = view('admin.tableakun', compact('users'))->render();
            // Gunakan custom pagination view yang sama seperti di main view
            $pagination = $users->appends(['search' => $search])->links('layout.pagination')->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        // Jika bukan AJAX, kembalikan view utama
        return view('admin.listakun', compact('users'));
    }

    function listkoperasi(Request $request)
    {
        $koperasi = Koperasi::paginate(10);

        if ($request->ajax()) {
            return view('admin.tablekoperasi', compact('koperasi'))->render();
        }

        return view('admin.listkoperasi', compact('koperasi'));
    }

    function tambahkoperasi(){
        return view('admin.tambahkoperasi');
    }

    function createkoperasi(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'nik' => 'required|string|max:20|unique:koperasi,nik',
            'nama_koperasi' => 'required|string|max:255',
            'nbh' => 'required|string|max:50|unique:koperasi,nbh',
            'alamat' => 'required|string',
            'kabupaten' => 'required',
            'jenis_koperasi' => 'required',
            'bentuk_koperasi' => 'required',
        ], [
            'nik.required' => 'Nomor Induk Koperasi wajib diisi',
            'nik.string' => 'Nomor Induk Koperasi harus berupa teks',
            'nik.max' => 'Nomor Induk Koperasi tidak boleh lebih dari 20 karakter',
            'nik.unique' => 'Nomor Induk Koperasi sudah terdaftar',
            'nama_koperasi.required' => 'Nama Koperasi wajib diisi',
            'nama_koperasi.string' => 'Nama Koperasi harus berupa teks',
            'nama_koperasi.max' => 'Nama Koperasi tidak boleh lebih dari 255 karakter',
            'nbh.required' => 'Nomor Badan Hukum wajib diisi',
            'nbh.string' => 'Nomor Badan Hukum harus berupa teks',
            'nbh.max' => 'Nomor Badan Hukum tidak boleh lebih dari 50 karakter',
            'nbh.unique' => 'NIK/NIP sudah terdaftar',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.string' => 'Alamat harus berupa teks',
            'kabupaten.required' => 'Kabupaten wajib diisi',
            'jenis_koperasi.required' => 'Jenis Koperasi wajib diisi',
            'bentuk_koperasi.required' => 'Bentuk Koperasi wajib diisi',
        ]);

        // Create a new user instance and save data
        $koperasi = Koperasi::create([
            'nik' => $request->nik,
            'nama_koperasi' => $request->nama_koperasi,
            'nbh' => $request->nbh,
            'alamat' => $request->alamat,
            'kabupaten' => $request->kabupaten,
            'jenis_koperasi' => $request->jenis_koperasi,
            'bentuk_koperasi' => $request->bentuk_koperasi,
        ]);

        // Redirect back with a success message
        return redirect()->route('listkoperasi')->with('success', 'Koperasi berhasil ditambahkan!');
    }

    function editkoperasi($nik)
    {
        $koperasi = Koperasi::where('nik', $nik)->firstOrFail();
        return view('admin.editkoperasi', compact('koperasi'));
    }

    function updatekoperasi(Request $request, $nik)
    {
        // Validasi input terlebih dahulu
        $request->validate([
            'nama_koperasi' => 'required|string|max:255',
            'nbh' => 'required|string|max:50|unique:koperasi,nbh,' . $nik . ',nik',
            'alamat' => 'required|string',
            'kabupaten' => 'required',
            'jenis_koperasi' => 'required',
            'bentuk_koperasi' => 'required',
        ], [
            'nama_koperasi.required' => 'Nama Koperasi wajib diisi',
            'nama_koperasi.string' => 'Nama Koperasi harus berupa teks',
            'nama_koperasi.max' => 'Nama Koperasi tidak boleh lebih dari 255 karakter',
            'nbh.required' => 'Nomor Badan Hukum wajib diisi',
            'nbh.string' => 'Nomor Badan Hukum harus berupa teks',
            'nbh.max' => 'Nomor Badan Hukum tidak boleh lebih dari 50 karakter',
            'nbh.unique' => 'NIK/NIP sudah terdaftar',
            'alamat.required' => 'Alamat wajib diisi',
            'alamat.string' => 'Alamat harus berupa teks',
            'kabupaten.required' => 'Kabupaten wajib diisi',
            'jenis_koperasi.required' => 'Jenis Koperasi wajib diisi',
            'bentuk_koperasi.required' => 'Bentuk Koperasi wajib diisi',
        ]);

        // Setelah lolos validasi, baru ambil user
        $koperasi = Koperasi::where('nik', $nik)->firstOrFail();

        // Update data user
        $koperasi->nama_koperasi = $request->nama_koperasi;
        $koperasi->nbh = $request->nbh;
        $koperasi->alamat = $request->alamat;
        $koperasi->kabupaten = $request->kabupaten;
        $koperasi->jenis_koperasi = $request->jenis_koperasi;
        $koperasi->bentuk_koperasi = $request->bentuk_koperasi;

        $koperasi->save();

        return redirect()->route('listkoperasi')->with('success', 'Data koperasi berhasil diperbarui.');
    }

    function hapuskoperasi($nik)
    {
        $koperasi = Koperasi::where('nik', $nik)->first();

        $koperasi->delete();
        return redirect()->back()->with('success', 'Koperasi berhasil dihapus.');
    }


    function carikoperasi(Request $request)
    {
        $search = $request->input('search');

        if (empty($search)) {
            $koperasi = Koperasi::paginate(10);
        } else {
            $koperasi = Koperasi::query()
                ->where('nama_koperasi', 'like', "%{$search}%")
                ->orWhere('kabupaten', 'like', "%{$search}%")
                ->orWhere('nbh', 'like', "%{$search}%")
                ->paginate(10);

            // Append search parameter to pagination links
            $koperasi->appends(['search' => $search]);
        }

        // Jika request adalah AJAX, kembalikan partial view
        if ($request->ajax()) {
            return view('admin.tablekoperasi', compact('koperasi'))->render();
        }

        // Jika bukan AJAX, kembalikan view utama
        return view('admin.listkoperasi', compact('koperasi'));
    }
}
