<?php

namespace App\Http\Controllers;

use App\Models\Pemeriksaan;
use App\Models\Pengaduan;
use App\Models\TindakLanjut;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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

    public function updatetindaklanjut(Request $request, $id_tindaklanjut)
    {
        $request->validate([
            'prinsip_koperasi' => 'required|string',
            'kelembagaan' => 'required|string',
            'manajemen_koperasi' => 'required|string',
            'prinsip_syariah' => 'required|string',
            'risiko_inheren' => 'required|string',
            'kpmr' => 'required|string',
            'kinerja_keuangan' => 'required|string',
            'permodalan' => 'required|string',
            'temuan_lainnya' => 'nullable|string',
            'bukti_tl_tk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_pr.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_kk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_pk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_tl.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
        ]);

        $tindaklanjut = TindakLanjut::findOrFail($id_tindaklanjut);

        // Proses file upload dan hapus
        $bukti_tl_tk = $this->handleFileUpload($request, $tindaklanjut->bukti_tl_tk, 'bukti_tl_tk', 'deletedFilesBuktiTk');
        $bukti_tl_pr = $this->handleFileUpload($request, $tindaklanjut->bukti_tl_pr, 'bukti_tl_pr', 'deletedFilesBuktiPr');
        $bukti_tl_kk = $this->handleFileUpload($request, $tindaklanjut->bukti_tl_kk, 'bukti_tl_kk', 'deletedFilesBuktiKk');
        $bukti_tl_pk = $this->handleFileUpload($request, $tindaklanjut->bukti_tl_pk, 'bukti_tl_pk', 'deletedFilesBuktiPk');
        $bukti_tl_tl = $this->handleFileUpload($request, $tindaklanjut->bukti_tl_tl, 'bukti_tl_tl', 'deletedFilesBuktiTl');

        // Kalau sudah sesuai, lanjutkan simpan
        $tindaklanjut->update([
            'prinsip_koperasi' => $request->prinsip_koperasi,
            'kelembagaan' => $request->kelembagaan,
            'manajemen_koperasi' => $request->manajemen_koperasi,
            'prinsip_syariah' => $request->prinsip_syariah,
            'risiko_inheren' => $request->risiko_inheren,
            'kpmr' => $request->kpmr,
            'kinerja_keuangan' => $request->kinerja_keuangan,
            'permodalan' => $request->permodalan,
            'temuan_lainnya' => $request->temuan_lainnya,
            'bukti_tl_tk' => json_encode($bukti_tl_tk),
            'bukti_tl_pr' => json_encode($bukti_tl_pr),
            'bukti_tl_kk' => json_encode($bukti_tl_kk),
            'bukti_tl_pk' => json_encode($bukti_tl_pk),
            'bukti_tl_tl' => json_encode($bukti_tl_tl),
        ]);

        return redirect()->route('listtindaklanjut')->with('success', 'Data berhasil diperbarui');
    }

    private function handleFileUpload(Request $request, $existingFiles, $inputName, $deletedInputName)
    {
        $files = $existingFiles ? json_decode($existingFiles, true) : [];

        // Hapus file jika diminta
        if ($request->has($deletedInputName) && !empty($request->{$deletedInputName}[0])) {
            $deletedFilesJson = $request->{$deletedInputName}[0]; // Ambil string JSON
            $deletedFilePaths = json_decode($deletedFilesJson, true); // Decode JSON

            foreach ($deletedFilePaths as $filePath) {
                // Cari dan hapus berdasarkan path
                $index = array_search($filePath, $files);
                if ($index !== false) {
                    $path = str_replace('storage/', '', $filePath);
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                    unset($files[$index]);
                }
            }
            $files = array_values($files); // Reindex array
        }

        // Upload file baru
        if ($request->hasFile($inputName)) {
            foreach ($request->file($inputName) as $file) {
                $folderPath = 'uploads/' . $inputName;
                $destinationPath = storage_path('app/public/' . $folderPath);

                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true);
                }

                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                // Simpan file ke folder tujuan
                $path = $file->storeAs($folderPath, $filename, 'public');

                // Simpan path yang bisa diakses browser
                $files[] = 'storage/' . $path;
            }
        }

        return $files;
    }

    public function hapustindaklanjut($id_tindaklanjut)
    {
        $tindaklanjut = TindakLanjut::findOrFail($id_tindaklanjut);

        // Hapus semua file terkait
        $this->hapusFiles(json_decode($tindaklanjut->bukti_tl_tk));
        $this->hapusFiles(json_decode($tindaklanjut->bukti_tl_pr));
        $this->hapusFiles(json_decode($tindaklanjut->bukti_tl_kk));
        $this->hapusFiles(json_decode($tindaklanjut->bukti_tl_pk));
        $this->hapusFiles(json_decode($tindaklanjut->bukti_tl_tl));

        // Hapus record
        $tindaklanjut->delete();

        return redirect()->back()->with('success', 'Tindak lanjut berhasil dihapus');
    }

    private function hapusFiles($files)
    {
        if ($files && is_array($files)) {
            foreach ($files as $file) {
                $filePath = storage_path('app/public/' . str_replace('storage/', '', $file));
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
        }
    }

    public function listpengaduan()
    {
        $user = Auth::user();

        if ($user->role == 'pengurus') {
            // Ambil pengaduan berdasarkan koperasi user dengan pagination
            $koperasi = $user->pengurus?->koperasi;
            $pengaduan = $koperasi
                ? Pengaduan::with('responPengaduan')->where('nik', $koperasi->nik)->paginate(10)
                : collect()->paginate(10);
        } else {
            // Kalau pengawas, ambil semua pengaduan dengan pagination
            $pengaduan = Pengaduan::with(['koperasi', 'responPengaduan'])->paginate(10);
        }

        Carbon::setLocale('id');
        return view('pengurus.listpengaduan', compact('pengaduan'));
    }

    public function inputpengaduan(Request $request)
    {
        // Ambil user yang sedang login
        $user = Auth::user();

        // Ambil data koperasi yang dipegang user
        $koperasi = $user->pengurus?->koperasi;

        // Cek jika koperasi ditemukan
        if (!$koperasi) {
            return back()->with('error', 'Koperasi tidak ditemukan.');
        }

        // Simpan data pengaduan
        Pengaduan::create([
            'tanggal_pengaduan' => Carbon::now()->toDateString(),
            'kendala' => $request->kendala,
            'status_pengaduan' => 'Diajukan',
            'nik' => $koperasi->nik,
        ]);

        return back()->with('success', 'Pengaduan berhasil diajukan.');
    }

    public function updatepengaduan(Request $request, $id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);

        $pengaduan->update([
            'kendala' => $request->kendala,
        ]);

        return back()->with('success', 'Pengaduan berhasil diperbarui.');
    }

    public function hapuspengaduan($id_pengaduan)
    {
        $pengaduan = Pengaduan::findOrFail($id_pengaduan);
        $pengaduan->delete();

        return back()->with('success', 'Pengaduan berhasil dihapus.');
    }

    public function caripengaduan(Request $request)
    {
        $search = $request->get('search');
        $user = Auth::user();

        if ($user->role == 'pengurus') {
        // Pencarian untuk pengurus berdasarkan koperasi
            $koperasi = $user->pengurus?->koperasi;
            if ($koperasi) {
                $pengaduan = Pengaduan::with('responPengaduan')
                    ->where('nik', $koperasi->nik)
                    ->where(function($query) use ($search) {
                        $query->where('tanggal_pengaduan', 'like', '%' . $search . '%');

                        if ($search) {
                            $bulanMap = [
                                'januari' => '01', 'februari' => '02', 'maret' => '03',
                                'april' => '04', 'mei' => '05', 'juni' => '06',
                                'juli' => '07', 'agustus' => '08', 'september' => '09',
                                'oktober' => '10', 'november' => '11', 'desember' => '12'
                            ];

                            $searchLower = strtolower($search);
                            foreach ($bulanMap as $namaBulan => $nomorBulan) {
                                if (strpos($namaBulan, $searchLower) !== false) {
                                    $query->orWhere('tanggal_pengaduan', 'like', '%-' . $nomorBulan . '-%');
                                }
                            }
                        }
                    })
                    ->paginate(10);
            } else {
                $pengaduan = collect()->paginate(10);
            }
        } else {
            // Pencarian untuk pengawas (semua pengaduan)
            $pengaduan = Pengaduan::with(['koperasi', 'responPengaduan'])
                ->where(function($query) use ($search) {
                $query->where('tanggal_pengaduan', 'like', '%' . $search . '%')
                    ->orWhereHas('koperasi', function($q) use ($search) {
                        $q->where('nama_koperasi', 'like', '%' . $search . '%')
                        ->orWhere('kabupaten', 'like', '%' . $search . '%');
                    });
                    // Tambahan: Cari berdasarkan nama bulan Indonesia
                    if ($search) {
                        $bulanMap = [
                            'januari' => '01', 'februari' => '02', 'maret' => '03',
                            'april' => '04', 'mei' => '05', 'juni' => '06',
                            'juli' => '07', 'agustus' => '08', 'september' => '09',
                            'oktober' => '10', 'november' => '11', 'desember' => '12'
                        ];

                        $searchLower = strtolower($search);
                        foreach ($bulanMap as $namaBulan => $nomorBulan) {
                            if (strpos($namaBulan, $searchLower) !== false) {
                                $query->orWhere('tanggal_pengaduan', 'like', '%-' . $nomorBulan . '-%');
                            }
                        }
                    }
                })
                ->paginate(10);
        }

        Carbon::setLocale('id');

        // Format tanggal setelah query selesai
        $pengaduan->getCollection()->transform(function ($item) {
            $item->tanggal_formatted = Carbon::parse($item->tanggal_pengaduan)->isoFormat('D MMMM Y');
            return $item;
        });

        // Untuk AJAX request, return partial view
        if ($request->ajax()) {
            $html = view('pengurus.tablepengaduan', compact('pengaduan'))->render();
            $pagination = $pengaduan->appends(request()->query())->links('layout.pagination')->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }
        return view('pengurus.listpengaduan', compact('pengaduan'));
    }
}
