@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 id="title" class="mb-3" style="font-weight: bold; font-size: 25px;">Koperasi</h1>

    <div id="step1">
        <div class="mb-3">
            <label for="koperasi" class="form-label fw-bold">Koperasi</label>
            <input type="text" class="form-control" value="{{ $pemeriksaan->koperasi->nama_koperasi ?? 'Tidak ditemukan' }}" readonly>
        </div>
    </div>

    {{-- Step 2 --}}
    <h1 id="title" class="mb-3" style="font-weight: bold; font-size: 25px;">Tata Kelola</h1>
        <div id="step2">

            @php
                $sections = [
                    [
                        'judul' => 'Prinsip Koperasi',
                        'items' => [
                            [
                                'judul' => 'Keanggotaan bersifat terbuka',
                                'indikator' => [
                                    'Kepatuhan Koperasi untuk menerima/pengunduran anggota secara sukarela (tidak ada paksaan) yang tercantum dalam anggaran dasar dan anggaran rumah tangga',
                                    'Kepatuhan Koperasi untuk menerima/Pengunduran anggota secara terbuka (bagi semua etnis, suku agama dan lain-lain) yang tercantum dalam anggaran dasar dan anggaran rumah tangga',
                                    'Jumlah tambahan anggota baru yang masuk lebih besar daripada jumlah anggota yang keluar/mengundurkan diri',
                                    'Dokumen pendukung terkait dengan penerimaan dan pengunduruan anggota valid'
                                ]
                            ],
                            [
                                'judul' => 'Pengelolaan dilakukan secara demokratis',
                                'indikator' => [
                                    'Kepatuhan Koperasi dalam pengambilan keputusan dan penetapan kebijakan koperasi, dilakukan oleh anggota secara demokratis One man one vote, dalam Rapat Anggota',
                                    'Kepatuhan Koperasi dalam pengelolaan koperasi, dilakukan oleh anggota secara demokratis One man one vote, dalam Rapat Anggota',
                                    'Semua anggota berhak dipilih dan memilih untuk menjadi pengurus koperasi',
                                    'Semua anggota berhak dipilih dan memilih untuk menjadi pengawas koperasi',
                                    'Keterlibatan anggota dalam menetapkan peraturan'
                                ]
                            ],
                            [
                                'judul' => 'Pembagian SHU secara adil',
                                'indikator' => [
                                    'Kepatuhan Koperasi membagi SHU dan bagian SHU untuk anggota dibagi proprosional dengan besarnya jasa usaha yang ketentuannya tercantum dalam AD/ART',
                                    'Kepatuhan Koperasi membagi SHU dan bagian SHU untuk anggota dibagi proprosional dengan besarnya modal anggota kepada koperasi yang ketentuannya tercantum dalam AD/ART',
                                    'Kepatuhan Koperasi membagi SHU dan bagian SHU untuk anggota dibagi tidak dibagi sama rata, yang ketentuannya tercantum dalam AD/ART'
                                ]
                            ],
                            [
                                'judul' => 'Pemberian balas jasa terhadap modal',
                                'indikator' => [
                                    'Kepatuhan koperasi terkait dengan simpanan sukarela diberikan balas jasa atau imbalan terbatas berupa imbalan (bunga) yang wajar dan disepakati di dalam Rapat Anggota',
                                    'Kepatuhan koperasi terkait dengan simpanan berjangka diberikan balas jasa atau imbalan terbatas berupa imbalan (bunga) yang wajar dan disepakati di dalam Rapat Anggota',
                                    'Kepatuhan koperasi terkait dengan modal penyertaan diberikan balas jasa atau imbalan terbatas berupa imbalan (bunga) yang wajar dan disepakati di dalam Rapat Anggota',
                                    'Koperasi mempunyai ketentuan/peraturan khusus terkait dengan balas jasa'
                                ]
                            ],
                            [
                                'judul' => 'Kemandirian',
                                'indikator' => [
                                    'Kepatuhan koperasi terkait dengan pengelolaan koperasi dilakukan atas dasar pada kemampuan dan kekuatan internal koperasi (mandiri)',
                                    'Kepatuhan koperasi terkait dengan pengelolaan koperasi dilakukan atas dasar tidak tergantung oleh pihak eksternal',
                                    'Kepatuhan koperasi terkait dengan pengelolaan koperasi bahwa bantuan dana hanya digunakan sebagai sarana bukan tujuan berkoperasi',
                                    'Ketersedian dokumen pendukung aspek kemandirian'
                                ]
                            ],
                            [
                                'judul' => 'Pendidikan perkoperasian',
                                'indikator' => [
                                    'Kepatuhan koperasi untuk menyisihkan bagian SHU untuk kepentingan pendidikan dan pelatihan perkoperasian bagi pengurus yang terstruktur dan dilaksanakan secara rutin dan berjenjang setiap tahun',
                                    'Kepatuhan koperasi untuk menyisihkan bagian SHU untuk kepentingan pendidikan dan pelatihan perkoperasian bagi pengawas yang terstruktur dan dilaksanakan secara rutin dan berjenjang setiap tahun',
                                    'Kepatuhan koperasi untuk menyisihkan bagian SHU untuk kepentingan pendidikan dan pelatihan perkoperasian bagi pengelola yang terstruktur dan dilaksanakan secara rutin dan berjenjang setiap tahun',
                                    'Kepatuhan koperasi untuk menyisihkan bagian SHU untuk kepentingan pendidikan dan pelatihan perkoperasian bagi anggota yang terstruktur dan dilaksanakan secara rutin dan berjenjang setiap tahun'
                                ]
                            ],
                            [
                                'judul' => 'Kerja sama koperasi',
                                'indikator' => [
                                    'Ada kerjasama yang dilakukan koperasi dalam bidang usaha baik antar koperasi dan institusi lainnya baik di tingkat kabupaten/kota, provinsi, nasional dan internasional',
                                    'Ada kerjasama yang dilakukan koperasi dalam bidang permodalan baik antar koperasi dan institusi lainnya baik di tingkat kabupaten/kota, provinsi, nasional dan internasional',
                                    'Ada kerjasama yang dilakukan koperasi dalam bidang organisasi dan pengembangan sumber daya manusia, pemasaran dan sistem informasi baik antar koperasi dan institusi lainnya baik di tingkat kabupaten/kota, provinsi, nasional dan internasional',
                                    'Kerjasama yang dilakukan  telah memberikan kontribusi bagi kemajuan koperasi dan anggota'
                                ]
                            ]
                        ]
                    ],
                    [
                        'judul' => 'Kelembagaan',
                        'items' => [
                            [
                                'judul' => 'Legalitas badan hukum koperasi',
                                'indikator' => [
                                    'Keabsahan dokumen badan hukum',
                                    'Kesesuaian jenis usaha dengan dokumen badan hukum',
                                    'Kesesuaian lokasi koperasi dengan dokumen badan hukum'
                                ]
                            ],
                            [
                                'judul' => 'Izin Usaha Sektor Riil',
                                'indikator' => [
                                    'Mengukur keabsahan dokumen Izin Usaha sektor riil',
                                    'Mengukur keabsahan dokumen Kantor cabang',
                                    'Ketersediaan papan nama'
                                ]
                            ],
                            [
                                'judul' => 'Anggaran Dasar',
                                'indikator' => [
                                    'Daftar nama pendiri;',
                                    'Nama dan tempat kedudukan',
                                    'Jenis koperasi',
                                    'Maksud dan tujuan',
                                    'Jangka waktu berdirinya',
                                    'Keanggotaan',
                                    'Jumlah setoran simpanan pokok dan simpanan wajib sebagai modal awal',
                                    'Permodalan',
                                    'Rapat anggota',
                                    'Pengurus',
                                    'Pengawas',
                                    'Pengelolaan dan pengendalian',
                                    'Bidang Usaha',
                                    'Pembagian sisa hasil usaha',
                                    'Ketentuan mengenai pembubaran, penyelesaian, dan hapusnya status badan hukum',
                                    'Sanksi',
                                    'Persus'
                                ]
                            ],
                            [
                                'judul' => 'Keanggotaan',
                                'indikator' => [
                                    'Ketersediaan buku daftar anggota,',
                                    'Tidak terjadi penurunan anggota yang melebihi 20 orang',
                                    'Tingkat keaktifan anggota baik dari aspek simpanan maupun pinjaman/pembiayaan',
                                    'Partisipasi dalam rapat anggota'
                                ]
                            ],
                            [
                                'judul' => 'Kelengkapan Organisasi',
                                'indikator' => [
                                    'Pelaksanaan rapat anggota',
                                    'Ketersediaan pengurus',
                                    'Ketersediaan pengawas dan pengelola'
                                ]
                            ]
                        ]
                    ],
                    [
                        'judul' => 'Manajemen Koperasi',
                        'items' => [
                            [
                                'judul' => 'Manajemen umum',
                                'indikator' => [
                                    'Ketersedian visi, misi dan tujuan koperasi',
                                    'Ketersedian rencana kerja baik jangka panjang dan jangka pendek',
                                    'Pengukuran dan evaluasi atas rencana kerja'
                                ]
                            ],
                            [
                                'judul' => 'Manajemen kelembagaan',
                                'indikator' => [
                                    'Ketersedian struktur organisai',
                                    'Ketersedian uraian tugas',
                                    'Ketersediaan SOM dan SOP',
                                    'Sistem pengamanan dokumen'
                                ]
                            ],
                            [
                                'judul' => 'Manajemen permodalan',
                                'indikator' => [
                                    'Pertumbuhan modal sendiri',
                                    'Pertumbuhan simpanan anggota',
                                    'Peningkatan cadangan',
                                    'Investasi bersumber dari modal sendiri'
                                ]
                            ],
                            [
                                'judul' => 'Manajemen aset',
                                'indikator' => [
                                    'Pembiayaan yang diberikan dengan dukungan agunan',
                                    'Kolektibilitas pembayaran',
                                    'Tingkat pengembaian pembiayaan macet masih dapat tertagih',
                                    'Menjaga prinsip kehati-hatan dalam memberikan pinjaman'
                                ]
                            ],
                            [
                                'judul' => 'Manajemen likuiditas',
                                'indikator' => [
                                    'Memiliki kebijakan tertulis mengenai pengedalian likuiditas',
                                    'Ketersediaan fasilitas pembiayaan dari lembaga keuangan lain',
                                    'Peraturan khusus terkait standar likuiditas',
                                    'Sistem informasi yang mendukung pemantauan likuiditas koperasi'
                                ]
                            ]
                        ]
                    ]
                ];
            @endphp

            @foreach($sections as $sectionIndex => $section)
            <div class="mb-4 border p-3 rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $sectionIndex + 1 }}. {{ $section['judul'] }}
                        @foreach ($subAspekTataKelola->where('nama_subaspek', $section['judul']) as $sub)
                            <span class="badge bg-success" id="section-score-{{ $sectionIndex }}">{{ $sub->skor ?? '0.00' }}</span>
                        @endforeach
                    </h5>
                    <input type="hidden" name="judul_section_{{ $sectionIndex }}" id="judul-section-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#step2-section-{{ $sectionIndex }}">
                        Tampilkan/Sembunyikan
                    </button>
                </div>

                <div class="collapse mt-3" id="step2-section-{{ $sectionIndex }}">
                    @foreach($section['items'] as $itemIndex => $item)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            @php
                                $skorTersimpan = 0;
                                foreach ($item['indikator'] as $indikator) {
                                    if (in_array($indikator, $indikatorTersimpan)) {
                                        $skorTersimpan++;
                                    }
                                }
                                $totalIndikator = count($item['indikator']);
                                $rasio = $totalIndikator > 0 ? $skorTersimpan / $totalIndikator : 0;

                                if ($rasio <= 0.25) {
                                    $skorKategori = 4;
                                } elseif ($rasio <= 0.5) {
                                    $skorKategori = 3;
                                } elseif ($rasio <= 0.75) {
                                    $skorKategori = 2;
                                } else {
                                    $skorKategori = 1;
                                }

                                // Konversi skor sesuai map
                                $konversiMap = [4 => 1, 3 => 2, 2 => 3, 1 => 4];
                                $skorFinal = $konversiMap[$skorKategori];
                            @endphp
                            <label class="form-label fw-bold mb-0">
                                {{ $itemIndex + 1 }}. {{ $item['judul'] }}
                            </label>
                            <small class="text-muted">
                                Pilih:
                                <span id="skor-display-{{ $sectionIndex }}-{{ $itemIndex }}">{{ $skorTersimpan }}</span>
                                dari {{ count($item['indikator']) }}
                                <span class="badge bg-secondary" id="skor-kategori-{{ $sectionIndex }}-{{ $itemIndex }}">{{ $skorFinal }}</span>
                            </small>
                        </div>

                        @foreach($item['indikator'] as $i => $indikator)
                            @if($i % 3 == 0)
                                <div class="row">
                            @endif
                            <div class="col-md-4">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox"
                                        name="section[{{ $sectionIndex }}][items][{{ $itemIndex }}][indikator][]"
                                        value="{{ $indikator }}"
                                        @if(in_array($indikator, $indikatorTersimpan)) checked @endif>
                                    <label class="form-check-label">{{ $indikator }}</label>
                                </div>
                            </div>
                            @if($i % 3 == 2 || $i == count($item['indikator']) - 1)
                                </div>
                            @endif
                        @endforeach

                        <input type="hidden" name="section[{{ $sectionIndex }}][items][{{ $itemIndex }}][skor]"
                            id="skor-{{ $sectionIndex }}-{{ $itemIndex }}" value="0">
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            @php
                $tataKelola = $pemeriksaan->aspekPemeriksaan->firstWhere('nama_aspek', 'Tata Kelola');
            @endphp

            <h5>Skor Tata Kelola:
                <span class="badge bg-success" id="skor-tata-kelola">
                    {{ $tataKelola->skor_total ?? '0.00' }}
                </span>
            </h5>
        </div>

    {{-- Step 3 --}}
    <h1 id="title" class="mb-3" style="font-weight: bold; font-size: 25px;">Profil Resiko</h1>
    <div id="step3">

            @php
            $sections = [
                [
                    'judul' => 'Risiko Inheren',
                    'risiko' => [
                        [
                            'jenis' => 'Risiko Operasional',
                            'subkomponen' => [
                                [
                                    'judul' => 'Skala usaha dan struktur organisasi',
                                    'indikator' => [
                                        'Skala usaha koperasi didukung dengan kapasitas sumber daya yang cukup dan memadai',
                                        'Struktur organisasi terpenuhi lengkap sesuai ketentuan tata kelola Koperasi',
                                        'Terdapat peran aktif dari  pihak yang terdapat pada struktur organisasi koperasi',
                                        'Pihak yang tercantum dalam struktur organisasi memberikan kontribusi positif atas uraian tugas yang diberikan'
                                    ]
                                ],
                                [
                                    'judul' => 'Keberagaman produk dan/atau jasa',
                                    'indikator' => [
                                        'Koperasi memiliki produk/jasa yang beragam selain kegiatan  usaha utama',
                                        'Layanan produk/jasa selain yang utama didukung dengan kemampuan dan keahlian internal koperasi',
                                        'Layanan produk/jasa selain yang utama masih sesuai dengan pelayanan utama koperasi',
                                        'Ragam layanan produk/jasa dilaksanakan secara langsung dengan dukungan sumber daya koperasi'
                                    ]
                                ],
                            ]
                        ],
                        [
                            'jenis' => 'Risiko Kepatuhan',
                            'subkomponen' => [
                                [
                                    'judul' => 'Jenis, signifikansi, dan frekuensi pelanggaran yang dilakukan',
                                    'indikator' => [
                                        'Tidak terdapat pelanggaran yang dilakukan koperasi selama periode penilaian',
                                        'Koperasi tidak dalam hukuman sanksi',
                                        'Koperasi tidak dalam proses hukum karena pelanggaran kepatuhan koperasi',
                                        'Koperasi tidak dalam proses hukum karena pelanggaran kepatuhan koperasi dan berakibat kepada tindakan pidana'
                                    ]
                                ],
                                [
                                    'judul' => 'Signifikansi tindak lanjut atas temuan pelanggaran',
                                    'indikator' => [
                                        'Ada evaluasi atas temuan pelanggaran sebelumnya',
                                        'Temuan pelanggaran ditindaklanjuti untuk perbaikan',
                                        'Tidak terdapat pelanggaran berulang atas pelanggaran sebelumnya',
                                        'Terdapat penurunan frekuensi pelanggaran'
                                    ]
                                ],
                            ]
                        ],
                        [
                            'jenis' => 'Risiko Likuiditas',
                            'subkomponen' => [
                                [
                                    'judul' => 'Aset likuid terhadap total aset',
                                ],
                                [
                                    'judul' => 'Aset likuid terhadap kewajiban lancar',
                                ],
                                [
                                    'judul' => 'Penilaian terhadap seberapa luas/besar koperasi memilki komitmen pendanaan yang dapat digunakan jika dibutuhkan',
                                    'indikator' => [
                                        'Akses koperasi pada sumber pendanaan sangat memadai',
                                        'Reputasi Koperasi sangat baik',
                                        'Pinjaman bank yang sewaktu-waktu dapat ditarik sangat memadai',
                                        'Terdapat komitmen/ dukungan dari anggota koperasi untuk sumber pinjaman anggota',
                                        'Terdapat potensi untuk modal penyertaan'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    'judul' => 'Kualitas Penerapan Manajemen Risiko (KPMR)',
                    'risiko' => [
                        [
                            'jenis' => 'KPMR Operasional',
                            'subkomponen' => [
                                [
                                    'judul' => 'Pengawasan pengurus dan pengawas',
                                    'indikator' => [
                                        'Pengawas telah memberikan persetujuan terhadap kebijakan Manajemen Risiko operasional yang disusun oleh pengurus dan melakukan evaluasi secara berkala',
                                        'Pengawas melakukan evaluasi terhadap pertanggungjawaban pengurus atas pelaksanaan kebijakan Manajemen Risiko operasional secara berkala dan memastikan tindak lanjut hasil evaluasi pada rapat anggota',
                                        'Pengurus telah menyusun kebijakan Manajemen Risiko operasional, melaksanakan secara konsisten, dan melakukan pengkinian secara berkala',
                                        'Pengurus memiliki kemampuan untuk mengambil tindakan yang diperlukan dalam rangka mitigasi Risiko operasional.'
                                    ]
                                ],
                                [
                                    'judul' => 'Kebijakan, prosedur dan limit risiko',
                                    'indikator' => [
                                        'Koperasi telah memiliki kecukupan organisasi yang menangani fungsi operasional dan fungsi Manajemen Risiko operasional',
                                        'Koperasi memiliki prosedur Manajemen Risiko operasional dan penetapan limit Risiko operasional yang ditetapkan oleh pengurus',
                                        'Pengurus telah menerapkan kebijakan pengelolaan SDM dalam rangka penerapan Manajemen Risiko operasional'
                                    ]
                                ],
                                [
                                    'judul' => 'Proses dan sistem informasi manajemen risiko',
                                    'indikator' => [
                                        'Koperasi telah memiliki sistem informasi Manajemen Risiko yang mendukung pengurus dalam pengambilan keputusan terkait Risiko operasional',
                                        'Sistem pengendalian intern terhadap Risiko operasional telah dilaksanakan',
                                        'Koperasi memiliki kebijakan dan prosedur penyelenggaraan teknologi informasi terkait mitigasi risiko operasional',
                                        'Melaksanakan audit secara berkala terhadap penerapan Manajemen Risiko operasional, menyampaikan laporan hasil audit intern, dan memastikan tindaklanjut atas temuan pemeriksaan'
                                    ]
                                ],
                            ]
                        ],
                        [
                            'jenis' => 'KPMR Kepatuhan',
                            'subkomponen' => [
                                [
                                    'judul' => 'Pengawasan pengurus dan pengawas',
                                    'indikator' => [
                                        'Pengawas telah memberikan persetujuan terhadap kebijakan Manajemen Risiko kepatuhan yang disusun oleh pengurus dan melakukan evaluasi secara berkala',
                                        'Pengawas melakukan evaluasi terhadap pertanggungjawaban pengurus atas pelaksanaan kebijakan Manajemen Risiko kepatuhan secara berkala dan memastikan tindak lanjut hasil evaluasi pada rapat anggota',
                                        'Pengurus telah menyusun kebijakan Manajemen Risiko kepatuhan, melaksanakan secara konsisten, dan melakukan pengkinian secara berkala',
                                        'Pengurus memiliki kemampuan untuk mengambil tindakan yang diperlukan dalam rangka mitigasi Risiko kepatuhan'
                                    ]
                                ],
                                [
                                    'judul' => 'Kebijakan, prosedur dan limit risiko',
                                    'indikator' => [
                                        'Koperasi telah memiliki kecukupan organisasi yang menangani fungsi operasional dan fungsi Manajemen Risiko kepatuhan',
                                        'Koperasi memiliki prosedur Manajemen Risiko kepatuhan dan penetapan limit Risiko kepatuhan yang ditetapkan oleh pengurus',
                                        'Pengurus telah menerapkan kebijakan pengelolaan SDM dalam rangka penerapan Manajemen Risiko kepatuhan',
                                        'Pengurus telah menyusun kebijakan internal yang mendukung terselenggaranya fungsi kepatuhan, memberikan perhatian terhadap ketentuan peraturan perundang-undangan perkoperasian.'
                                    ]
                                ],
                                [
                                    'judul' => 'Proses dan sistem informasi manajemen risiko',
                                    'indikator' => [
                                        'Koperasi telah memiliki sistem informasi Manajemen Risiko yang mendukung pengurus dalam pengambilan keputusan terkait Risiko kepatuhan',
                                        'Sistem pengendalian intern terhadap Risiko kepatuhan telah dilaksanakan',
                                        'Koperasi memiliki kebijakan dan prosedur penyelenggaraan teknologi informasi terkait mitigasi risiko kepatuhan',
                                        'Melaksanakan audit secara berkala terhadap penerapan Manajemen Risiko kepatuhan, menyampaikan laporan hasil audit intern, dan memastikan tindaklanjut atas temuan pemeriksaan'
                                    ]
                                ]
                            ]
                        ],
                        [
                            'jenis' => 'KPMR Likuiditas',
                            'subkomponen' => [
                                [
                                    'judul' => 'Pengawasan pengurus dan pengawas',
                                    'indikator' => [
                                        'Pengawas telah memberikan persetujuan terhadap kebijakan Manajemen Risiko  likuiditas yang disusun oleh pengurus dan melakukan evaluasi secara berkala',
                                        'Pengawas melakukan evaluasi terhadap pertanggungjawaban  pengurus atas pelaksanaan kebijakan Manajemen Risiko likuiditas secara berkala dan memastikan tindak lanjut hasil evaluasi pada rapat anggota',
                                        'Pengurus telah menyusun kebijakan Manajemen Risiko likuiditas, melaksanakan secara konsisten, dan melakukan pengkinian secara berkala',
                                        'Pengurus memiliki kemampuan untuk mengambil tindakan yang diperlukan dalam rangka mitigasi Risiko likuiditas'
                                    ]
                                ],
                                [
                                    'judul' => 'Kebijakan, prosedur dan limit risiko',
                                    'indikator' => [
                                        'Koperasi telah memiliki kecukupan organisasi yang menangani fungsi operasional dan fungsi Manajemen Risiko likuiditas',
                                        'Koperasi memiliki prosedur Manajemen Risiko likuiditas dan penetapan limit Risiko likuiditas yang ditetapkan oleh pengurus',
                                        'Pengurus telah menerapkan kebijakan pengelolaan SDM dalam rangka penerapan Manajemen Risiko likuiditas',
                                        'Pengurus telah menyusun kebijakan internal yang mendukung terselenggaranya fungsi ketersediaan likuiditas, memberikan perhatian terhadap ketentuan peraturan perundang-undangan perkoperasian',
                                        'Penanganan permasalahan Risiko konsentrasi likuiditas, pencegahan ketergantungan terhadap sumber pendanaan tertentu, dan disusun dengan mempertimbangkan visi, misi, skala usaha dan kompleksitas bisnis, serta kecukupan SDM.'
                                    ]
                                ],
                                [
                                    'judul' => 'Proses dan sistem informasi manajemen risiko',
                                    'indikator' => [
                                        'Koperasi telah memiliki sistem informasi Manajemen likuiditas yang mendukung pengurus dalam pengambilan keputusan terkait Risiko likuiditas',
                                        'Sistem pengendalian intern terhadap Risiko likuiditas telah dilaksanakan',
                                        'Koperasi memiliki kebijakan dan prosedur penyelenggaraan teknologi informasi terkait mitigasi risiko likuiditas',
                                        'Melaksanakan audit secara berkala terhadap penerapan Manajemen Risiko likuiditas, menyampaikan laporan hasil audit intern, dan memastikan tindaklanjut atas temuan pemeriksaan'
                                    ]
                                ],
                            ]
                        ]
                    ]
                ]
            ];
            @endphp

            @foreach($sections as $sectionIndex => $section)
                <div class="mb-4 border p-3 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">{{ $sectionIndex + 1 }}. {{ $section['judul'] }}
                            @foreach ($subAspekProfilResiko->where('nama_subaspek', $section['judul']) as $sub)
                                <span class="badge bg-success" id="section-pr-{{ $sectionIndex }}">{{ $sub->skor ?? '0.00' }}</span>
                            @endforeach

                        </h5>
                        <input type="hidden" name="judul_prsection_{{ $sectionIndex }}" id="judul-prsection-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#step3-section-{{ $sectionIndex }}">
                            Tampilkan/Sembunyikan
                        </button>
                    </div>

                    <div class="collapse mt-2" id="step3-section-{{ $sectionIndex }}">
                        @php $globalSubIndex = 0; @endphp
                        @foreach($section['risiko'] as $riskIndex => $risk)
                            <h6 class="mt-3 d-flex justify-content-between align-items-center">
                                <span>{{ $riskIndex + 1 }}. {{ $risk['jenis'] }}</span>
                                {{-- <span class="badge bg-primary" id="risk-score-{{ $sectionIndex }}-{{ $riskIndex }}">0.00</span> --}}
                            </h6>

                            @foreach($risk['subkomponen'] as $subIndex => $sub)
                                <div class="mb-2 d-flex justify-content-between align-items-center" data-subcontainer="{{ $sectionIndex }}-{{ $globalSubIndex }}">
                                    <div>
                                        <strong>{{ $subIndex + 1 }}. {{ $sub['judul'] }}</strong>
                                    </div>

                                    {{-- Tampilkan badge skor jika tidak ada indikator --}}
                                    @if(!isset($sub['indikator']))
                                        @php static $indikatorIndex = 0; @endphp

                                        <span class="badge bg-secondary" id="badge-indikator-{{ $sectionIndex }}-{{ $globalSubIndex }}">
                                            {{ $indikatorIndex == 0 ? $skor1 : ($indikatorIndex == 1 ? $skor2 : 0) }}
                                        </span>

                                        @php $indikatorIndex++; @endphp
                                    @endif
                                </div>

                                {{-- Jika ada indikator, tampilkan checkbox --}}
                                @if(isset($sub['indikator']))
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        @php
                                            $skor2Tersimpan = 0;
                                            foreach ($sub['indikator'] as $indikator) {
                                                if (in_array($indikator, $indikator2Tersimpan)) {
                                                    $skor2Tersimpan++;
                                                }
                                            }
                                            $total2Indikator = count($sub['indikator']);
                                            $rasio = $total2Indikator > 0 ? $skor2Tersimpan / $total2Indikator : 0;

                                            if ($rasio <= 0.25) {
                                                $skorKategori = 4;
                                            } elseif ($rasio <= 0.5) {
                                                $skorKategori = 3;
                                            } elseif ($rasio <= 0.75) {
                                                $skorKategori = 2;
                                            } else {
                                                $skorKategori = 1;
                                            }

                                            $konversiMap = [4 => 1, 3 => 2, 2 => 3, 1 => 4];
                                            $skor2Final = $konversiMap[$skorKategori];
                                        @endphp
                                        <small class="text-muted">
                                            Total Dipilih:
                                            <span id="total-terpilih-{{ $sectionIndex }}-{{ $globalSubIndex }}">{{ $skor2Tersimpan }}</span>
                                            dari {{ count($sub['indikator']) }}
                                            <span class="badge bg-secondary" id="badge-indikator-{{ $sectionIndex }}-{{ $globalSubIndex }}">{{ $skor2Final}}</span>
                                        </small>
                                    </div>
                                    <ul class="list-unstyled mt-2">
                                        @foreach($sub['indikator'] as $indikatorIndex => $indikator)
                                            <li class="form-check">
                                                <input
                                                    class="form-check-input indikator-checkbox"
                                                    type="checkbox"
                                                    name="subindikator[{{ $sectionIndex }}][{{ $riskIndex }}][{{ $globalSubIndex }}][]"
                                                    value="{{ $indikator }}"
                                                    id="section-{{ $sectionIndex }}-risk-{{ $riskIndex }}-sub-{{ $globalSubIndex }}-indikator-{{ $indikatorIndex }}"
                                                    data-section="{{ $sectionIndex }}"
                                                    onchange="updateIndikatorTerpilih({{ $sectionIndex }}, {{ $globalSubIndex }})"
                                                    @if(in_array($indikator, $indikator2Tersimpan)) checked @endif
                                                >
                                                <label
                                                    class="form-check-label"
                                                    for="section-{{ $sectionIndex }}-risk-{{ $riskIndex }}-sub-{{ $globalSubIndex }}-indikator-{{ $indikatorIndex }}"
                                                >
                                                    {{ $indikator }}
                                                </label>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif

                                @php $globalSubIndex++; @endphp
                            @endforeach
                            @if($risk['jenis'] === 'Risiko Likuiditas')
                                <div class="mt-3 border p-3 rounded bg-light">
                                    <div class="mb-2">
                                        <label for="kas-bank-{{ $sectionIndex }}" class="form-label">Jumlah kas, bank, simpanan pada koperasi lainnya</label>
                                        <input type="text" class="form-control" id="kas-bank-{{ $sectionIndex }}"
                                            value="{{ number_format($pemeriksaan->keuangan->kas_bank ?? 0, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label for="aktiva-{{ $sectionIndex }}" class="form-label">Jumlah aktiva</label>
                                        <input type="text" class="form-control" id="aktiva-{{ $sectionIndex }}"
                                            value="{{ number_format($pemeriksaan->keuangan->aktiva ?? 0, 0, ',', '.') }}" readonly>
                                    </div>
                                    <div class="mb-2">
                                        <label for="kewajiban-{{ $sectionIndex }}" class="form-label">Jumlah kewajiban lancar</label>
                                        <input type="text" class="form-control" id="kewajiban-{{ $sectionIndex }}"
                                            value="{{ number_format($pemeriksaan->keuangan->kewajiban_lancar ?? 0, 0, ',', '.') }}" readonly>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            @php
                $profilResiko = $pemeriksaan->aspekPemeriksaan->firstWhere('nama_aspek', 'Profil Resiko');
            @endphp

            <h5>Skor Profil Resiko:
                <span class="badge bg-success" id="skor-profil-resiko">{{ $profilResiko->skor_total ?? '0.00' }}</span>
            </h5>
    </div>

     {{-- Step 4 --}}
    <h1 id="title" class="mb-3" style="font-weight: bold; font-size: 25px;">Kinerja Keuangan</h1>
    <div id="step4">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                    <label for="ekuitas">1. Jumlah Ekuitas</label>
                    <input type="text" class="form-control" id="ekuitas"
                        value="{{ number_format($pemeriksaan->keuangan->ekuitas ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="pinjaman-usaha">2. Jumlah Pinjaman/Piutang Usaha</label>
                    <input type="text" class="form-control" id="pinjaman-usaha"
                        value="{{ number_format($pemeriksaan->keuangan->pinjaman_usaha ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="kewajiban-ekuitas">3. Jumlah Kewajiban dan Ekuitas</label>
                    <input type="text" class="form-control" id="kewajiban-ekuitas"
                        value="{{ number_format($pemeriksaan->keuangan->kewajiban_ekuitas ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="hutang-pajak">4. Hutang Pajak</label>
                    <input type="text" class="form-control" id="hutang-pajak"
                        value="{{ number_format($pemeriksaan->keuangan->hutang_pajak ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-masuk">5. Beban yang Masih Harus Dibayar</label>
                    <input type="text" class="form-control" id="beban-masuk"
                        value="{{ number_format($pemeriksaan->keuangan->beban_masuk ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="hutang-biaya">6. Hutang Biaya/PKP-RI</label>
                    <input type="text" class="form-control" id="hutang-biaya"
                        value="{{ number_format($pemeriksaan->keuangan->hutang_biaya ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="aktiva-lancar">7. Jumlah Aktiva Lancar</label>
                    <input type="text" class="form-control" id="aktiva-lancar"
                        value="{{ number_format($pemeriksaan->keuangan->aktiva_lancar ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="persediaan">8. Persediaan Barang Dagang</label>
                    <input type="text" class="form-control" id="persediaan"
                        value="{{ number_format($pemeriksaan->keuangan->persediaan ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="piutang-dagang">9. Piutang Dagang</label>
                    <input type="text" class="form-control" id="piutang-dagang"
                        value="{{ number_format($pemeriksaan->keuangan->piutang_dagang ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpanan-pokok">10. Simpanan Pokok</label>
                    <input type="text" class="form-control" id="simpanan-pokok"
                        value="{{ number_format($pemeriksaan->keuangan->simpanan_pokok ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpanan-wajib">11. Simpanan Wajib</label>
                    <input type="text" class="form-control" id="simpanan-wajib"
                        value="{{ number_format($pemeriksaan->keuangan->simpanan_wajib ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="tabungan-anggota">12. Tabungan/simpanan anggota</label>
                    <input type="text" class="form-control" id="tabungan-anggota"
                        value="{{ number_format($pemeriksaan->keuangan->tabungan_anggota ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="tabungan-nonanggota">13. Tabungan/simpanan non anggota/waserda</label>
                    <input type="text" class="form-control" id="tabungan-nonanggota"
                        value="{{ number_format($pemeriksaan->keuangan->tabungan_nonanggota ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpanan-jangkaanggota">14. Simpanan berjangka anggota</label>
                    <input type="text" class="form-control" id="simpanan-jangkaanggota"
                        value="{{ number_format($pemeriksaan->keuangan->simpanan_jangka_anggota ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpananjangka-calonanggota">15. Simpanan berjangka calon anggota & koperasi lain</label>
                    <input type="text" class="form-control" id="simpananjangka-calonanggota"
                        value="{{ number_format($pemeriksaan->keuangan->simpanan_jangka_calonanggota ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="aktiva-lalu">16. Jumlah Aktiva Tahun Lalu</label>
                    <input type="text" class="form-control" id="aktiva-lalu"
                    value="{{ number_format($pemeriksaan->keuangan->aktiva_lalu ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="ekuitas-lalu">17. Jumlah Ekuitas Tahun Lalu</label>
                    <input type="text" class="form-control" id="ekuitas-lalu"
                    value="{{ number_format($pemeriksaan->keuangan->ekuitas_lalu ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="shu">18. Sisa Hasil Usaha Setelah Pajak</label>
                    <input type="text" class="form-control" id="shu"
                    value="{{ number_format($pemeriksaan->keuangan->shu ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="partisipasi-bruto">19. Jumlah Partisipasi Bruto Anggota</label>
                    <input type="text" class="form-control" id="partisipasi-bruto"
                    value="{{ number_format($pemeriksaan->keuangan->partisipasi_bruto ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-pokok">20. Jumlah Beban Pokok Anggota</label>
                    <input type="text" class="form-control" id="beban-pokok"
                    value="{{ number_format($pemeriksaan->keuangan->beban_pokok ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="porsi-beban">21. Porsi Beban Usaha Anggota</label>
                    <input type="text" class="form-control" id="porsi-beban"
                    value="{{ number_format($pemeriksaan->keuangan->porsi_beban ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-perkoperasian">22. Jumlah Beban Perkoperasian</label>
                    <input type="text" class="form-control" id="beban-perkoperasian"
                    value="{{ number_format($pemeriksaan->keuangan->beban_perkoperasian ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-usaha">23. Jumlah Beban Usaha</label>
                    <input type="text" class="form-control" id="beban-usaha"
                    value="{{ number_format($pemeriksaan->keuangan->beban_usaha ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="shu-kotor">24. Sisa Hasil Usaha Kotor</label>
                    <input type="text" class="form-control" id="shu-kotor"
                    value="{{ number_format($pemeriksaan->keuangan->shu_kotor ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-penjualan">25. Beban Pokok Penjualan</label>
                    <input type="text" class="form-control" id="beban-penjualan"
                    value="{{ number_format($pemeriksaan->keuangan->beban_penjualan ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="penjualan-anggota">26. Penjualan pada Anggota</label>
                    <input type="text" class="form-control" id="penjualan-anggota"
                    value="{{ number_format($pemeriksaan->keuangan->penjualan_anggota ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="penjualan-nonanggota">27. Penjualan pada Non Anggota</label>
                    <input type="text" class="form-control" id="penjualan-nonanggota"
                    value="{{ number_format($pemeriksaan->keuangan->penjualan_nonanggota ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="pendapatan">28. Jumlah Pendapatan</label>
                    <input type="text" class="form-control" id="pendapatan"
                    value="{{ number_format($pemeriksaan->keuangan->pendapatan ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="shu-lalu">29. Sisa Hasil Usaha Setelah Pajak Tahun Lalu</label>
                    <input type="text" class="form-control" id="shu-lalu"
                    value="{{ number_format($pemeriksaan->keuangan->shu_lalu ?? 0, 0, ',', '.') }}" readonly>
                    </div>
                </div>
            </div>

            @php
            $sections = [
                [
                    'judul' => 'Evaluasi Kinerja Keuangan',
                    'sub' => [
                        [
                            'jenis' => 'Rentabilitas',
                            'indikator' => [
                                'Rentabilitas Aset (Return on Asset)',
                                'Rentabilitas Ekuitas (Return on Equity)',
                                'Kemandirian Operasional'
                            ]
                        ],
                        [
                            'jenis' => 'Efisiensi',
                            'indikator' => [
                                'Biaya Operasional terhadap Pendapatan Operasional',
                                'Biaya Usaha terhadap SHU Kotor'
                            ]
                        ]
                    ]
                ],
                [
                    'judul' => 'Manajemen Keuangan',
                    'sub' => [
                        [
                            'jenis' => 'Likuiditas',
                            'indikator' => [
                                'Kas dan Bank terhadap Kewajiban Jangka Pendek',
                                'Piutang terhadap dana yang diterima',
                                'Aset Lancar terhadap Kewajiban Jangka Pendek'
                            ]
                        ],
                        [
                            'jenis' => 'Manajemen Aktiva dan Investasi',
                            'indikator' => [
                                'Perputaran Persediaan',
                                'Periode Penagihan Rata-Rata',
                                'Perputaran Piutang',
                                'Perputaran Total Modal',
                                'Perputaran Total Aktiva'
                            ]
                        ]
                    ]
                ],
                [
                    'judul' => 'Kesinambungan Keuangan',
                    'sub' => [
                        [
                            'jenis' => 'Pertumbuhan',
                            'indikator' => [
                                'Pertumbuhan Aset',
                                'Pertumbuhan Ekuitas',
                                'Pertumbuhan Hasil Usaha Bersih'
                            ]
                        ],
                        [
                            'jenis' => 'Aspek Jatidiri',
                            'indikator' => [
                                'Pendapatan Utama terhadap Total Pendapatan',
                                'SHU Bersih terhadap Simpanan Pokok dan Simpanan Wajib',
                                'Partisipasi Simpanan Anggota'
                            ]
                        ]
                    ]
                ]
            ];
            @endphp

            @foreach($sections as $sectionIndex => $section)
            <div class="mb-4 border p-3 rounded shadow-sm">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ $sectionIndex + 1 }}. {{ $section['judul'] }}
                        @foreach ($subAspekKinerjaKeuangan->where('nama_subaspek', $section['judul']) as $sub)
                            <span class="badge bg-success" id="section-kk-{{ $sectionIndex }}">{{ $sub->skor ?? '0.00' }}</span>
                        @endforeach
                    </h5>
                    <input type="hidden" name="judul_kksection_{{ $sectionIndex }}" id="judul-kksection-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#section-{{ $sectionIndex }}">
                        Tampilkan/Sembunyikan
                    </button>
                </div>
                <div class="collapse mt-3" id="section-{{ $sectionIndex }}">
                    @foreach($section['sub'] as $subIndex => $sub)
                    <div class="mb-3">
                        @php
                            $totalNilai = 0;
                            $jumlahIndikator = count($sub['indikator']);
                            foreach ($sub['indikator'] as $indikator) {
                                $totalNilai += $skorKeuangan[$indikator] ?? 0;
                            }
                            $maxSkor = $jumlahIndikator * 4;
                            $hasilEvaluasiKinerja = ($maxSkor > 0) ? ($totalNilai / $maxSkor) * 100 : 0;
                        @endphp
                        <h6 class="d-flex justify-content-between align-items-center">
                            <span>{{ $subIndex + 1 }}. {{ $sub['jenis'] }}</span>
                            <span class="badge bg-info" id="sub-score-{{ $sectionIndex }}-{{ $subIndex }}">{{ number_format($hasilEvaluasiKinerja, 2) }}</span>
                        </h6>
                        <ul>
                            @foreach($sub['indikator'] as $indikatorIndex => $indikator)
                            <li>
                                {{ $indikator }}
                                <span class="badge bg-secondary" id="kk-indikator-{{ $sectionIndex }}-{{ $subIndex }}-{{ $indikatorIndex }}">
                                    {{ number_format($skorKeuangan[$indikator] ?? 0) }}
                                </span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            @php
                $kinerjaKeuangan = $pemeriksaan->aspekPemeriksaan->firstWhere('nama_aspek', 'Kinerja Keuangan');
            @endphp

            <h5>Skor Kinerja Keuangan:
                <span class="badge bg-success" id="skor-kinerja-keuangan">{{ $kinerjaKeuangan->skor_total ?? '0.00' }}</span>
            </h5>
    </div>

    {{-- Step 5 --}}
    <h1 id="title" class="mb-3" style="font-weight: bold; font-size: 25px;">Permodalan</h1>
    <div id="step5">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                    <label for="titipan-dana">1. Titipan Dana Kebajikan Anggota</label>
                    <input type="text" class="form-control" id="titipan-dana"
                        value="{{ number_format($pemeriksaan->keuangan->titipan_dana ?? 0, 0, ',', '.') }}" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="kewajiban-panjang">2. Jumlah Kewajiban Jangka Panjang </label>
                    <input type="text" class="form-control rupiah" id="kewajiban-panjang" input type="text" class="form-control" id="titipan-dana"
                        value="{{ number_format($pemeriksaan->keuangan->kewajiban_jangka_panjang ?? 0, 0, ',', '.') }}" readonly>
                    </div>
                </div>
            </div>

            @php
            $sections = [
                [
                    'judul' => 'Kecukupan Permodalan',
                    'indikator' => [
                        'Ekuitas terhadap Total Aset'
                    ]
                ],
                [
                    'judul' => 'Kecukupan Pengelolaan Permodalan',
                    'indikator' => [
                        'Modal Pinjaman Anggota terhadap Total Aset',
                        'Kewajiban Jangka Panjang terhadap Ekuitas'
                    ]
                ]
            ];
            @endphp

            @foreach($sections as $sectionIndex => $section)
                <div class="mb-4 border p-3 rounded shadow-sm">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            {{ $sectionIndex + 1 }}. {{ $section['judul'] }}
                            @foreach ($subAspekPermodalan->where('nama_subaspek', $section['judul']) as $sub)
                                <span class="badge bg-success" id="section-pk-{{ $sectionIndex }}">{{ $sub->skor ?? '0.00' }}</span>
                            @endforeach
                        </h5>
                        <input type="hidden" name="judul_pksection_{{ $sectionIndex }}" id="judul-pksection-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#section-{{ $sectionIndex }}">
                            Tampilkan/Sembunyikan
                        </button>
                    </div>
                    <div class="collapse mt-3" id="section-{{ $sectionIndex }}">
                        <ul>
                            @foreach($section['indikator'] as $indikatorIndex => $indikator)
                                <li>
                                    {{ $indikator }}
                                    <span class="badge bg-secondary" id="pk-indikator-{{ $sectionIndex }}-{{ $indikatorIndex }}">{{ number_format($skorPermodalan[$indikator] ?? 0) }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            @php
                $permodalan = $pemeriksaan->aspekPemeriksaan->firstWhere('nama_aspek', 'Permodalan');
            @endphp

            <h5>Skor Permodalan:
                <span class="badge bg-success" id="skor-permodalan">{{ $permodalan->skor_total ?? '0.00' }}</span>
            </h5>
    </div>
</div>
@endsection
