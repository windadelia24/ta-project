@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 id="form-title" class="mb-3" style="font-weight: bold; font-size: 36px;">Pilih Koperasi</h1>

    {{-- Progress Bar --}}
    <div class="progress mb-4">
        <div id="progress-bar"
            class="progress-bar progress-bar-striped progress-bar-animated"
            role="progressbar"
            style="width: 33%;"
            aria-valuenow="33" aria-valuemin="0" aria-valuemax="100">
            Step 1 of 5
        </div>
    </div>

    {{-- Form --}}
    <form action="{{ route('storeperiksa') }}" method="POST">
        @csrf

        {{-- Step 1 --}}
        <div id="step1">
            <div class="mb-3">
                <label for="koperasi" class="form-label fw-bold">Koperasi</label>
                <div class="select-wrapper">
                    <select class="form-control" id="koperasi" name="koperasi" required>
                        <option value="" disabled selected hidden>Pilih Koperasi</option>
                        @foreach($koperasi as $item)
                            <option value="{{ $item->nik }}">{{ $item->nama_koperasi }}</option>
                        @endforeach
                    </select>
                    <i class="fas fa-caret-down form-control-icon"></i>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
        </div>

        {{-- Step 2 --}}
        <div id="step2" style="display:none;">

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
                        <span class="badge bg-success" id="section-score-{{ $sectionIndex }}">0.00</span>
                    </h5>
                    <input type="hidden" name="judul_section_{{ $sectionIndex }}" id="judul-section-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#section-{{ $sectionIndex }}">
                        Tampilkan/Sembunyikan
                    </button>
                </div>

                <div class="collapse mt-3" id="section-{{ $sectionIndex }}">
                    @foreach($section['items'] as $itemIndex => $item)
                    <div class="mb-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <label class="form-label fw-bold mb-0">
                                {{ $itemIndex + 1 }}. {{ $item['judul'] }}
                            </label>
                            <small class="text-muted">
                                Pilih:
                                <span id="skor-display-{{ $sectionIndex }}-{{ $itemIndex }}">0</span>
                                dari {{ count($item['indikator']) }}
                                <span class="badge bg-secondary" id="skor-kategori-{{ $sectionIndex }}-{{ $itemIndex }}">0</span>
                            </small>
                            <div class="d-flex gap-2 mb-2">
                                <button type="button" class="btn btn-sm btn-outline-primary"
                                    onclick="cekSemua('{{ $sectionIndex }}-{{ $itemIndex }}')">
                                    Ceklis Semua
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-danger"
                                    onclick="hapusCeklis('{{ $sectionIndex }}-{{ $itemIndex }}')">
                                    Hapus Ceklis
                                </button>
                            </div>
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
                                        onchange="updateScore('{{ $sectionIndex }}-{{ $itemIndex }}', {{ count($item['indikator']) }})">
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

            <h5>Skor Tata Kelola:
                <span class="badge bg-success" id="skor-tata-kelola">0.00</span>
            </h5>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
        </div>

        {{-- Step 3 --}}
        <div id="step3" style="display:none;">

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
                            <span class="badge bg-success" id="section-pr-{{ $sectionIndex }}">0.00</span>
                        </h5>
                        <input type="hidden" name="judul_prsection_{{ $sectionIndex }}" id="judul-prsection-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                        <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#section-{{ $sectionIndex }}">
                            Tampilkan/Sembunyikan
                        </button>
                    </div>

                    <div class="collapse mt-2" id="section-{{ $sectionIndex }}">
                        @php $globalSubIndex = 0; @endphp
                        @foreach($section['risiko'] as $riskIndex => $risk)
                            <h6 class="mt-3 d-flex justify-content-between align-items-center">
                                <span>{{ $riskIndex + 1 }}. {{ $risk['jenis'] }}</span>
                                <span class="badge bg-primary" id="risk-score-{{ $sectionIndex }}-{{ $riskIndex }}">0.00</span>
                            </h6>

                            @foreach($risk['subkomponen'] as $subIndex => $sub)
                                <div class="mb-2 d-flex justify-content-between align-items-center" data-subcontainer="{{ $sectionIndex }}-{{ $globalSubIndex }}">
                                    <div>
                                        <strong>{{ $subIndex + 1 }}. {{ $sub['judul'] }}</strong>
                                    </div>

                                    {{-- Tampilkan badge skor jika tidak ada indikator --}}
                                    @if(!isset($sub['indikator']))
                                        <span class="badge bg-secondary" id="badge-indikator-{{ $sectionIndex }}-{{ $globalSubIndex }}">0</span>
                                    @endif
                                </div>

                                {{-- Jika ada indikator, tampilkan checkbox --}}
                                @if(isset($sub['indikator']))
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <small class="text-muted">
                                            Total Dipilih:
                                            <span id="total-terpilih-{{ $sectionIndex }}-{{ $globalSubIndex }}">0</span>
                                            dari {{ count($sub['indikator']) }}
                                            <span class="badge bg-secondary" id="badge-indikator-{{ $sectionIndex }}-{{ $globalSubIndex }}">0</span>
                                        </small>
                                        <div class="d-flex gap-2 mb-2">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                onclick="checkAllIndikator('{{ $sectionIndex }}-{{ $globalSubIndex }}')">
                                                Ceklis semua
                                            </button>
                                            <button type="button" class="btn btn-sm btn-outline-danger"
                                                onclick="uncheckAllIndikator('{{ $sectionIndex }}-{{ $globalSubIndex }}')">
                                                Hapus ceklis
                                            </button>
                                        </div>
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
                                    <strong>Input Tambahan untuk Risiko Likuiditas:</strong>
                                    <div class="mb-2">
                                        <label for="kas-bank-{{ $sectionIndex }}" class="form-label">Jumlah kas, bank, simpanan pada koperasi lainnya</label>
                                        <input type="text" class="form-control rupiah-format" id="kas-bank-{{ $sectionIndex }}" placeholder="Masukkan jumlah" data-raw="">
                                        <input type="hidden" name="likuiditas[{{ $sectionIndex }}][kas_bank]" id="kas-bank-{{ $sectionIndex }}-hidden">
                                    </div>
                                    <div class="mb-2">
                                        <label for="aktiva-{{ $sectionIndex }}" class="form-label">Jumlah aktiva</label>
                                        <input type="text" class="form-control rupiah-format" id="aktiva-{{ $sectionIndex }}" placeholder="Masukkan jumlah" data-raw="">
                                        <input type="hidden" name="likuiditas[{{ $sectionIndex }}][aktiva]" id="aktiva-{{ $sectionIndex }}-hidden">
                                    </div>
                                    <div class="mb-2">
                                        <label for="kewajiban-{{ $sectionIndex }}" class="form-label">Jumlah kewajiban lancar</label>
                                        <input type="text" class="form-control rupiah-format" id="kewajiban-{{ $sectionIndex }}" placeholder="Masukkan jumlah" data-raw="">
                                        <input type="hidden" name="likuiditas[{{ $sectionIndex }}][kewajiban]" id="kewajiban-{{ $sectionIndex }}-hidden">
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            @endforeach

            <h5>Skor Profil Resiko:
                <span class="badge bg-success" id="skor-profil-resiko">0.00</span>
            </h5>

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
        </div>

        {{-- Step 4 --}}
        <div id="step4" style="display:none;">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                    <label for="ekuitas">1. Jumlah Ekuitas</label>
                    <input type="text" class="form-control rp-format" id="ekuitas" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="ekuitas-hidden" name="ekuitas">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="pinjaman-usaha">2. Jumlah Pinjaman/Piutang Usaha</label>
                    <input type="text" class="form-control rp-format" id="pinjaman-usaha" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="pinjaman-usaha-hidden" name="pinjaman-usaha">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="kewajiban-ekuitas">3. Jumlah Kewajiban dan Ekuitas</label>
                    <input type="text" class="form-control rp-format" id="kewajiban-ekuitas" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="kewajiban-ekuitas-hidden" name="kewajiban-ekuitas">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="hutang-pajak">4. Hutang Pajak</label>
                    <input type="text" class="form-control rp-format" id="hutang-pajak" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="hutang-pajak-hidden" name="hutang-pajak">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-masuk">5. Beban yang Masih Harus Dibayar</label>
                    <input type="text" class="form-control rp-format" id="beban-masuk" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="beban-masuk-hidden" name="beban-masuk">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="hutang-biaya">6. Hutang Biaya/PKP-RI</label>
                    <input type="text" class="form-control rp-format" id="hutang-biaya" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="hutang-biaya-hidden" name="hutang-biaya">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="aktiva-lancar">7. Jumlah Aktiva Lancar</label>
                    <input type="text" class="form-control rp-format" id="aktiva-lancar" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="aktiva-lancar-hidden" name="aktiva-lancar">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="persediaan">8. Persediaan Barang Dagang</label>
                    <input type="text" class="form-control rp-format" id="persediaan" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="persediaan-hidden" name="persediaan">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="piutang-dagang">9. Piutang Dagang</label>
                    <input type="text" class="form-control rp-format" id="piutang-dagang" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="piutang-dagang-hidden" name="piutang-dagang">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpanan-pokok">10. Simpanan Pokok</label>
                    <input type="text" class="form-control rp-format" id="simpanan-pokok" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="simpanan-pokok-hidden" name="simpanan-pokok">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpanan-wajib">11. Simpanan Wajib</label>
                    <input type="text" class="form-control rp-format" id="simpanan-wajib" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="simpanan-wajib-hidden" name="simpanan-wajib">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="tabungan-anggota">12. Tabungan/simpanan anggota</label>
                    <input type="text" class="form-control rp-format" id="tabungan-anggota" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="tabungan-anggota-hidden" name="tabungan-anggota">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="tabungan-nonanggota">13. Tabungan/simpanan non anggota/waserda</label>
                    <input type="text" class="form-control rp-format" id="tabungan-nonanggota" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="tabungan-nonanggota-hidden" name="tabungan-nonanggota">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpanan-jangkaanggota">14. Simpanan berjangka anggota</label>
                    <input type="text" class="form-control rp-format" id="simpanan-jangkaanggota" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="simpanan-jangkaanggota-hidden" name="simpanan-jangkaanggota">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="simpananjangka-calonanggota">15. Simpanan berjangka calon anggota & koperasi lain</label>
                    <input type="text" class="form-control rp-format" id="simpananjangka-calonanggota" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="simpananjangka-calonanggota-hidden" name="simpananjangka-calonanggota">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="aktiva-lalu">16. Jumlah Aktiva Tahun Lalu</label>
                    <input type="text" class="form-control rp-format" id="aktiva-lalu" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="aktiva-lalu-hidden" name="aktiva-lalu">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="ekuitas-lalu">17. Jumlah Ekuitas Tahun Lalu</label>
                    <input type="text" class="form-control rp-format" id="ekuitas-lalu" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="ekuitas-lalu-hidden" name="ekuitas-lalu">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="shu">18. Sisa Hasil Usaha Setelah Pajak</label>
                    <input type="text" class="form-control rp-format" id="shu" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="shu-hidden" name="shu">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="partisipasi-bruto">19. Jumlah Partisipasi Bruto Anggota</label>
                    <input type="text" class="form-control rp-format" id="partisipasi-bruto" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="partisipasi-bruto-hidden" name="partisipasi-bruto">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-pokok">20. Jumlah Beban Pokok Anggota</label>
                    <input type="text" class="form-control rp-format" id="beban-pokok" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="beban-pokok-hidden" name="beban-pokok">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="porsi-beban">21. Porsi Beban Usaha Anggota</label>
                    <input type="text" class="form-control rp-format" id="porsi-beban" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="porsi-beban-hidden" name="porsi-beban">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-perkoperasian">22. Jumlah Beban Perkoperasian</label>
                    <input type="text" class="form-control rp-format" id="beban-perkoperasian" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="beban-perkoperasian-hidden" name="beban-perkoperasian">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-usaha">23. Jumlah Beban Usaha</label>
                    <input type="text" class="form-control rp-format" id="beban-usaha" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="beban-usaha-hidden" name="beban-usaha">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="shu-kotor">24. Sisa Hasil Usaha Kotor</label>
                    <input type="text" class="form-control rp-format" id="shu-kotor" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="shu-kotor-hidden" name="shu-kotor">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="beban-penjualan">25. Beban Pokok Penjualan</label>
                    <input type="text" class="form-control rp-format" id="beban-penjualan" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="beban-penjualan-hidden" name="beban-penjualan">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="penjualan-anggota">26. Penjualan pada Anggota</label>
                    <input type="text" class="form-control rp-format" id="penjualan-anggota" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="penjualan-anggota-hidden" name="penjualan-anggota">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="penjualan-nonanggota">27. Penjualan pada Non Anggota</label>
                    <input type="text" class="form-control rp-format" id="penjualan-nonanggota" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="penjualan-nonanggota-hidden" name="penjualan-nonanggota">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="pendapatan">28. Jumlah Pendapatan</label>
                    <input type="text" class="form-control rp-format" id="pendapatan" placeholder="Masukkan jumlah" data-raw="" >
                    <input type="hidden" id="pendapatan-hidden" name="pendapatan">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="shu-lalu">29. Sisa Hasil Usaha Setelah Pajak Tahun Lalu</label>
                    <input type="text" class="form-control rp-format" id="shu-lalu" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="shu-lalu-hidden" name="shu-lalu">
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
                        <span class="badge bg-success" id="section-kk-{{ $sectionIndex }}">0.00</span>
                    </h5>
                    <input type="hidden" name="judul_kksection_{{ $sectionIndex }}" id="judul-kksection-{{ $sectionIndex }}" value="{{ $section['judul'] }}">
                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#section-{{ $sectionIndex }}">
                        Tampilkan/Sembunyikan
                    </button>
                </div>
                <div class="collapse mt-3" id="section-{{ $sectionIndex }}">
                    @foreach($section['sub'] as $subIndex => $sub)
                    <div class="mb-3">
                        <h6 class="d-flex justify-content-between align-items-center">
                            <span>{{ $subIndex + 1 }}. {{ $sub['jenis'] }}</span>
                            <span class="badge bg-info" id="sub-score-{{ $sectionIndex }}-{{ $subIndex }}">0.00</span>
                        </h6>
                        <ul>
                            @foreach($sub['indikator'] as $indikatorIndex => $indikator)
                            <li>
                                {{ $indikator }}
                                <span class="badge bg-secondary" id="kk-indikator-{{ $sectionIndex }}-{{ $subIndex }}-{{ $indikatorIndex }}">0</span>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach

            <h5>Skor Kinerja Keuangan:
                <span class="badge bg-success" id="skor-kinerja-keuangan">0.00</span>
            </h5>


            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
            </div>
        </div>

        {{-- Step 5 --}}
        <div id="step5" style="display:none;">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-md-4 mb-3">
                    <label for="titipan-dana">1. Titipan Dana Kebajikan Anggota</label>
                    <input type="text" class="form-control rupiah" id="titipan-dana" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="titipan-dana-hidden" name="titipan-dana">
                    </div>

                    <div class="col-md-4 mb-3">
                    <label for="kewajiban-panjang">2. Jumlah Kewajiban Jangka Panjang </label>
                    <input type="text" class="form-control rupiah" id="kewajiban-panjang" placeholder="Masukkan jumlah" data-raw="">
                    <input type="hidden" id="kewajiban-panjang-hidden" name="kewajiban-panjang">
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
                            <span class="badge bg-success" id="section-pk-{{ $sectionIndex }}">0.00</span>
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
                                    <span class="badge bg-secondary" id="pk-indikator-{{ $sectionIndex }}-{{ $indikatorIndex }}">0</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach

            <h5>Skor Permodalan:
                <span class="badge bg-success" id="skor-permodalan">0.00</span>
            </h5>

            <input type="hidden" name="hidden_koperasi" id="hidden_koperasi" />
            <input type="hidden" name="hidden_tata_kelola" id="hidden_tata_kelola" />
            <input type="hidden" name="hidden_prinsip_koperasi" id="hidden_prinsip_koperasi" />
            <input type="hidden" name="hidden_kelembagaan" id="hidden_kelembagaan" />
            <input type="hidden" name="hidden_manajemen_koperasi" id="hidden_manajemen_koperasi" />
            <input type="hidden" name="hidden_profil_resiko" id="hidden_profil_resiko" />
            <input type="hidden" name="hidden_resiko_inheren" id="hidden_resiko_inheren" />
            <input type="hidden" name="hidden_kpmr" id="hidden_kpmr" />
            <input type="hidden" name="hidden_kinerja_keuangan" id="hidden_kinerja_keuangan" />
            <input type="hidden" name="hidden_evaluasi" id="hidden_evaluasi" />
            <input type="hidden" name="hidden_manajemen_keuangan" id="hidden_manajemen_keuangan" />
            <input type="hidden" name="hidden_kesinambungan" id="hidden_kesinambungan" />
            <input type="hidden" name="hidden_permodalan" id="hidden_permodalan" />
            <input type="hidden" name="hidden_kecukupan" id="hidden_kecukupan" />
            <input type="hidden" name="hidden_pengelolaan" id="hidden_pengelolaan" />
            <input type="hidden" name="hidden_kas_bank" id="hidden_kas_bank" />
            <input type="hidden" name="hidden_aktiva" id="hidden_aktiva" />
            <input type="hidden" name="hidden_kewajiban" id="hidden_kewajiban" />

            <div class="d-flex justify-content-between mt-4">
                <button type="button" class="btn btn-secondary" onclick="prevStep()">Kembali</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script src="{{ asset('js/perhitungan.js') }}"></script>
@endsection
