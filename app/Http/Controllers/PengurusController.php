<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\TindakLanjut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PengurusController extends Controller
{
    function index(){
        $user = Auth::user();

        $koperasi = $user->pengurus?->koperasi;

        $pemeriksaan = $koperasi?->pemeriksaan()->latest()->first();

        return view('pengurus.dashboard', [
            'user' => $user,
            'koperasi' => $koperasi,
            'pemeriksaan' => $pemeriksaan,
        ]);
    }

   public function listtindaklanjut()
    {
        $user = Auth::user();

        // Ambil koperasi dari relasi pengurus
        $koperasi = $user->pengurus?->koperasi;

        // Jika koperasi ditemukan, ambil semua pemeriksaan milik koperasi
        $periksa = $koperasi
            ? $koperasi->pemeriksaan()->with(['koperasi', 'user', 'tindakLanjut'])->get()
            : collect(); // kosongkan jika koperasi tidak ada

        return view('pengurus.listtindaklanjut', compact('periksa'));
    }

    function inputtindaklanjut($id_pemeriksaan){
        return view('pengurus.inputtindaklanjut', compact('id_pemeriksaan'));
    }

    public function storetindaklanjut(Request $request)
    {
        // Validasi input
        $request->validate([
            // Bagian Tata Kelola
            'prinsip_koperasi' => 'required|string',
            'kelembagaan' => 'required|string',
            'manajemen_koperasi' => 'required|string',
            'prinsip_syariah' => 'nullable|string',
            'bukti_tl_tk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',

            // Bagian Profil Risiko
            'risiko_inheren' => 'required|string',
            'kpmr' => 'required|string',
            'bukti_tl_pr.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',

            // Bagian Kinerja Keuangan
            'kinerja_keuangan' => 'required|string',
            'bukti_tl_kk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',

            // Bagian Permodalan
            'permodalan' => 'required|string',
            'bukti_tl_pk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',

            // Bagian Temuan Lainnya
            'temuan_lainnya' => 'nullable|string',
            'bukti_tl_tl.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
        ]);

        // Proses upload file
        $bukti_tl_tk = $this->uploadFiles($request->file('bukti_tl_tk'), 'bukti_tl_tk');
        $bukti_tl_pr = $this->uploadFiles($request->file('bukti_tl_pr'), 'bukti_tl_pr');
        $bukti_tl_kk = $this->uploadFiles($request->file('bukti_tl_kk'), 'bukti_tl_kk');
        $bukti_tl_pk = $this->uploadFiles($request->file('bukti_tl_pk'), 'bukti_tl_pk');
        $bukti_tl_tl = $this->uploadFiles($request->file('bukti_tl_tl'), 'bukti_tl_tl');

        // Simpan ke database
        TindakLanjut::create([
            'id_pemeriksaan' => $request->id_pemeriksaan,
            'prinsip_koperasi' => $request->prinsip_koperasi,
            'kelembagaan' => $request->kelembagaan,
            'manajemen_koperasi' => $request->manajemen_koperasi,
            'prinsip_syariah' => $request->prinsip_syariah,
            'bukti_tl_tk' => json_encode($bukti_tl_tk),

            'risiko_inheren' => $request->risiko_inheren,
            'kpmr' => $request->kpmr,
            'bukti_tl_pr' => json_encode($bukti_tl_pr),

            'kinerja_keuangan' => $request->kinerja_keuangan,
            'bukti_tl_kk' => json_encode($bukti_tl_kk),

            'permodalan' => $request->permodalan,
            'bukti_tl_pk' => json_encode($bukti_tl_pk),

            'temuan_lainnya' => $request->temuan_lainnya,
            'bukti_tl_tl' => json_encode($bukti_tl_tl),
            'status_tindaklanjut' => 'Ditindaklanjuti',
        ]);

        return redirect()->route('listtindaklanjut')->with('success', 'Pemeriksaan berhasil diupdate.');
    }

    private function uploadFiles($files, $folder)
    {
        $paths = [];

        if ($files) {
            foreach ($files as $file) {
                // Pastikan folder tujuan ada
                $folderPath = 'uploads/' . $folder;
                $destinationPath = storage_path('app/public/' . $folderPath);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                // Generate nama file unik
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke storage disk public
                $path = $file->storeAs($folderPath, $filename, 'public');

                // Simpan path yang bisa diakses browser
                $paths[] = 'storage/' . $path;
            }
        }

        return $paths;
    }

    public function edittindaklanjut($id_tindaklanjut)
    {
        $tindaklanjut = TindakLanjut::findOrFail($id_tindaklanjut);
        return view('pengurus.edittindaklanjut', compact('tindaklanjut'));
    }
}
