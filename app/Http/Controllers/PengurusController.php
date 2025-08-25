<?php

namespace App\Http\Controllers;

use App\Models\DetailTindakLanjut;
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

        if ($user->role === 'pengurus') {
            $koperasi = $user->pengurus?->koperasi;

            $periksa = $koperasi
                ? $koperasi->pemeriksaan()->with(['koperasi', 'user', 'tindakLanjut']) ->orderBy('created_at', 'desc')->paginate(10)
                : collect();
        } else {
            $periksa = Pemeriksaan::whereHas('tindakLanjut', function ($query) {
                $query->whereNotNull('created_at');
            })
            ->with(['koperasi', 'user', 'tindakLanjut'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        }

        Carbon::setLocale('id');
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
            'kinerja_keuangan' => 'nullable|string',
            'bukti_tl_kk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',

            // Bagian Permodalan
            'permodalan' => 'nullable|string',
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

        $tindakLanjut = TindakLanjut::create([
            'id_pemeriksaan' => $request->id_pemeriksaan,
            'status_tindaklanjut' => 'Ditindaklanjuti',
        ]);

        DetailTindakLanjut::create([
            'id_tindaklanjut' => $tindakLanjut->id_tindaklanjut,
            'nama_aspek' => 'Tata Kelola',
            'deskripsi' => [
                'prinsip_koperasi' => $request->prinsip_koperasi,
                'kelembagaan' => $request->kelembagaan,
                'manajemen_koperasi' => $request->manajemen_koperasi,
                'prinsip_syariah' => $request->prinsip_syariah,
            ],
            'bukti_tindaklanjut' => $bukti_tl_tk,
        ]);

        DetailTindakLanjut::create([
            'id_tindaklanjut' => $tindakLanjut->id_tindaklanjut,
            'nama_aspek' => 'Profil Resiko',
            'deskripsi' => [
                'risiko_inheren' => $request->risiko_inheren,
                'kpmr' => $request->kpmr,
            ],
            'bukti_tindaklanjut' => $bukti_tl_pr,
        ]);

        if ($request->kinerja_keuangan || !empty($bukti_tl_kk)) {
            DetailTindakLanjut::create([
                'id_tindaklanjut' => $tindakLanjut->id_tindaklanjut,
                'nama_aspek' => 'Kinerja Keuangan',
                'deskripsi' => [
                    'kinerja_keuangan' => $request->kinerja_keuangan,
                ],
                'bukti_tindaklanjut' => $bukti_tl_kk,
            ]);
        }

        if ($request->permodalan || !empty($bukti_tl_pk)) {
            DetailTindakLanjut::create([
                'id_tindaklanjut' => $tindakLanjut->id_tindaklanjut,
                'nama_aspek' => 'Permodalan',
                'deskripsi' => [
                    'permodalan' => $request->permodalan,
                ],
                'bukti_tindaklanjut' => $bukti_tl_pk,
            ]);
        }

        if ($request->temuan_lainnya || !empty($bukti_tl_tl)) {
            DetailTindakLanjut::create([
                'id_tindaklanjut' => $tindakLanjut->id_tindaklanjut,
                'nama_aspek' => 'Temuan Lainnya',
                'deskripsi' => [
                    'temuan_lainnya' => $request->temuan_lainnya,
                ],
                'bukti_tindaklanjut' => $bukti_tl_tl,
            ]);
        }

        return redirect()->route('listtindaklanjut')->with('success', 'Data berhasil disimpan.');
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

    public function lihattindaklanjut($id_tindaklanjut)
    {
        $tindaklanjut = TindakLanjut::with('detailTindakLanjuts')->findOrFail($id_tindaklanjut);
        return view('pengurus.lihattindaklanjut', compact('tindaklanjut'));
    }

    public function edittindaklanjut($id_tindaklanjut)
    {
        $tindaklanjut = TindakLanjut::with('detailTindakLanjuts')->findOrFail($id_tindaklanjut);
        $statusAspekTl = json_decode($tindaklanjut->status_aspektl, true);
        return view('pengurus.edittindaklanjut', compact('tindaklanjut', 'statusAspekTl'));
    }

    public function updatetindaklanjut(Request $request, $id_tindaklanjut)
    {
        $request->validate([
            'prinsip_koperasi' => 'nullable|string',
            'kelembagaan' => 'nullable|string',
            'manajemen_koperasi' => 'nullable|string',
            'prinsip_syariah' => 'nullable|string',
            'risiko_inheren' => 'nullable|string',
            'kpmr' => 'nullable|string',
            'kinerja_keuangan' => 'nullable|string',
            'permodalan' => 'nullable|string',
            'temuan_lainnya' => 'nullable|string',
            'bukti_tl_tk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_pr.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_kk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_pk.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
            'bukti_tl_tl.*' => 'nullable|file|max:10240|mimes:jpg,jpeg,png,pdf,doc,docx,xls,xlsx',
        ]);

        $tindaklanjut = TindakLanjut::findOrFail($id_tindaklanjut);
        $buktitk = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Tata Kelola')->first()->bukti_tindaklanjut;
        $buktipr = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Profil Resiko')->first()->bukti_tindaklanjut;
        $buktikk = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Kinerja Keuangan')->first()->bukti_tindaklanjut;
        $buktipk = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Permodalan')->first()->bukti_tindaklanjut;
        $buktitl = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', 'Temuan Lainnya')->first()->bukti_tindaklanjut;

        // Proses file upload dan hapus
        $bukti_tl_tk = $this->handleFileUpload($request, $buktitk, 'bukti_tl_tk', 'deletedFilesBuktiTk');
        $bukti_tl_pr = $this->handleFileUpload($request, $buktipr, 'bukti_tl_pr', 'deletedFilesBuktiPr');
        $bukti_tl_kk = $this->handleFileUpload($request, $buktikk, 'bukti_tl_kk', 'deletedFilesBuktiKk');
        $bukti_tl_pk = $this->handleFileUpload($request, $buktipk, 'bukti_tl_pk', 'deletedFilesBuktiPk');
        $bukti_tl_tl = $this->handleFileUpload($request, $buktitl, 'bukti_tl_tl', 'deletedFilesBuktiTl');

        $aspekData = [
            'Tata Kelola' => [
                'fields' => [
                    'prinsip_koperasi' => $request->prinsip_koperasi,
                    'kelembagaan' => $request->kelembagaan,
                    'manajemen_koperasi' => $request->manajemen_koperasi,
                    'prinsip_syariah' => $request->prinsip_syariah,
                ],
                'bukti' => $bukti_tl_tk,
            ],
            'Profil Resiko' => [
                'fields' => [
                    'risiko_inheren' => $request->risiko_inheren,
                    'kpmr' => $request->kpmr,
                ],
                'bukti' => $bukti_tl_pr,
            ],
            'Kinerja Keuangan' => [
                'fields' => [
                    'kinerja_keuangan' => $request->kinerja_keuangan,
                ],
                'bukti' => $bukti_tl_kk,
            ],
            'Permodalan' => [
                'fields' => [
                    'permodalan' => $request->permodalan,
                ],
                'bukti' => $bukti_tl_pk,
            ],
            'Temuan Lainnya' => [
                'fields' => [
                    'temuan_lainnya' => $request->temuan_lainnya,
                ],
                'bukti' => $bukti_tl_tl,
            ],
        ];

        foreach ($aspekData as $namaAspek => $data) {
            $detail = $tindaklanjut->detailTindakLanjuts->where('nama_aspek', $namaAspek)->first();

            if ($detail) {
                $deskripsi = $detail->deskripsi ?? [];

                foreach ($data['fields'] as $key => $value) {
                    if ($request->filled($key)) {
                        $deskripsi[$key] = $value;
                    }
                }

                $detail->deskripsi = $deskripsi;
                $detail->bukti_tindaklanjut = $data['bukti'];
                $detail->save();
            }
        }

        return redirect()->route('listtindaklanjut')->with('success', 'Data berhasil diperbarui');
    }

    private function handleFileUpload(Request $request, $existingFiles, $inputName, $deletedInputName)
    {
        $files = $existingFiles ?: [];

        // Hapus file jika diminta
        if ($request->has($deletedInputName) && !empty($request->{$deletedInputName})) {
            $deletedFilePaths = $request->{$deletedInputName}; // Decode JSON

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

        foreach ($tindaklanjut->detailTindakLanjuts as $detail) {
            $this->hapusFiles($detail->bukti_tindaklanjut);
        }

        DetailTindakLanjut::where('id_tindaklanjut', $id_tindaklanjut)->delete();
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

    public function caritindaklanjut(Request $request)
    {
        $search = $request->get('search');
        $user = Auth::user();

        if ($user->role === 'pengurus') {
            // Pencarian untuk pengurus berdasarkan koperasi
            $koperasi = $user->pengurus?->koperasi;
            if ($koperasi) {
                $periksa = Pemeriksaan::with(['koperasi', 'user', 'tindakLanjut'])
                ->whereHas('koperasi', function ($q) use ($koperasi) {
                    $q->where('nik', $koperasi->nik);
                })
                ->where(function ($query) use ($search) {
                    $query->whereHas('tindakLanjut', function($q) use ($search) {
                        $q->where(function ($sub) use ($search) {
                            $sub->where('created_at', 'like', '%' . $search . '%')
                                ->orWhere('status_tindaklanjut', 'like', '%' . $search . '%');
                        });

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
                                    $q->orWhere('created_at', 'like', '%-' . $nomorBulan . '-%');
                                }
                            }
                        }
                    })
                    ->orWhereHas('user', function($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
                })
                ->paginate(10);
            } else {
                $periksa = collect()->paginate(10);
            }
        } else {
            // Pencarian untuk pengawas (semua data pemeriksaan)
            $periksa = Pemeriksaan::with(['koperasi', 'user', 'tindakLanjut'])
                ->whereHas('tindakLanjut', function($query) use ($search) {
                    $query->whereNotNull('created_at')
                        ->where(function($q) use ($search) {
                        $q->where('created_at', 'like', '%' . $search . '%')
                        ->orWhere('status_tindaklanjut', 'like', '%' . $search . '%');
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
                                $query->orWhere('created_at', 'like', '%-' . $nomorBulan . '-%');
                            }
                        }
                    }
                })
                ->orWhereHas('koperasi', function($q) use ($search) {
                    $q->where('nama_koperasi', 'like', '%' . $search . '%')
                    ->orWhere('kabupaten', 'like', '%' . $search . '%');
                })
                ->orWhereHas('user', function($q) use ($search) {
                    $q->where('name', 'like', '%' . $search . '%');
                })
                ->paginate(10);
        }

        Carbon::setLocale('id');

        // Format tanggal setelah query selesai
        $periksa->getCollection()->transform(function ($item) {
            if ($item->tindakLanjut) {
                $item->tindakLanjut->tanggal_formatted = Carbon::parse($item->tindakLanjut->created_at)->isoFormat('D MMMM Y');
            }
            return $item;
        });

        // Untuk AJAX request, return partial view
        if ($request->ajax()) {
            $html = view('pengurus.tabletindaklanjut', compact('periksa'))->render();
            $pagination = $periksa->appends(request()->query())->links('layout.pagination')->render();

            return response()->json([
                'html' => $html,
                'pagination' => $pagination
            ]);
        }

        return view('pengurus.listtindaklanjut', compact('periksa'));
    }
}
