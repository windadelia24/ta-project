<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTindakLanjutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('detail_tindak_lanjut')->insert([

            [
                'id_tindaklanjut' => 1,
                'nama_aspek' => 'Tata Kelola',
                'deskripsi' => json_encode([
                    'prinsip_koperasi' => 'Tidak ada temuan',
                    'kelembagaan' => 'Struktur organisasi sudah diperbaiki dimana posisi penasehat berada disamping pengurus dengan garis koordinasi',
                    'manajemen_koperasi' => 'Sudah ada kebijakan tertulis mengenai likuiditas',
                    'prinsip_syariah' => 'Sudah ada dokumen otentik terkait DPS'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_tk/1749736302_684adb6e3c50d.png"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 1,
                'nama_aspek' => 'Profil Resiko',
                'deskripsi' => json_encode([
                    'risiko_inheren' => 'Sudah diperbaiki beberapa risiko operasional',
                    'kpmr' => 'Sudah ada dokumen kebijakan, prosedur dan llimit risiko'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_pr/1749736302_684adb6e3e6da.png"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 1,
                'nama_aspek' => 'Kinerja Keuangan',
                'deskripsi' => json_encode([
                    'kinerja_keuangan' => 'Kinerja keuangan sudah mulai membaik'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_kk/1749736302_684adb6e3ee25.png"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 1,
                'nama_aspek' => 'Permodalan',
                'deskripsi' => json_encode([
                    'permodalan' => 'Tidak ada temuan'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_pk/1749736302_684adb6e3f273.png"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 1,
                'nama_aspek' => 'Temuan Lainnya',
                'deskripsi' => json_encode([
                    'temuan_lainnya' => 'Sudah ada perincian jenis akad dan ijarah'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_tl/1749736302_684adb6e3f8a0.pdf"]',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id_tindaklanjut' => 3,
                'nama_aspek' => 'Tata Kelola',
                'deskripsi' => json_encode([
                    'prinsip_koperasi' => 'Tidak ada temuan',
                    'kelembagaan' => 'Sudah diperbaiki',
                    'manajemen_koperasi' => 'Dalam perbaikan',
                    'prinsip_syariah' => 'Tidak ada temuan'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_tk/1749740542_684aebfeed22b.png"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 3,
                'nama_aspek' => 'Profil Resiko',
                'deskripsi' => json_encode([
                    'risiko_inheren' => 'ddfd',
                    'kpmr' => 'dfdsf'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_pr/1749632383_6849457f37d39.pdf","storage/uploads/bukti_tl_pr/1749734825_684ad5a98e8eb.jpg"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 3,
                'nama_aspek' => 'Kinerja Keuangan',
                'deskripsi' => json_encode([
                    'kinerja_keuangan' => 'fdef'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_kk/1749632383_6849457f3813e.xlsx","storage/uploads/bukti_tl_kk/1749740067_684aea23904c3.jpg"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 3,
                'nama_aspek' => 'Permodalan',
                'deskripsi' => json_encode([
                    'permodalan' => 'efdefd'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_pk/1749632383_6849457f38443.docx"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 3,
                'nama_aspek' => 'Temuan Lainnya',
                'deskripsi' => json_encode([
                    'temuan_lainnya' => 'blabla'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_tl/1749632383_6849457f387ee.png","storage/uploads/bukti_tl_tl/1751102105_685fb299a67c6.jpg"]',
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'id_tindaklanjut' => 5,
                'nama_aspek' => 'Tata Kelola',
                'deskripsi' => json_encode([
                    'prinsip_koperasi' => 't',
                    'kelembagaan' => 't',
                    'manajemen_koperasi' => 't',
                    'prinsip_syariah' => 't'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_tk/1751270896_686245f03f830.docx"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 5,
                'nama_aspek' => 'Profil Resiko',
                'deskripsi' => json_encode([
                    'risiko_inheren' => 't',
                    'kpmr' => 't'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_pr/1751270896_686245f0449b1.PDF"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 5,
                'nama_aspek' => 'Kinerja Keuangan',
                'deskripsi' => json_encode([
                    'kinerja_keuangan' => 't'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_kk/1751270896_686245f044d00.xlsx"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 5,
                'nama_aspek' => 'Permodalan',
                'deskripsi' => json_encode([
                    'permodalan' => 'tes'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_pk/1751270896_686245f0453ca.PDF"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'id_tindaklanjut' => 5,
                'nama_aspek' => 'Temuan Lainnya',
                'deskripsi' => json_encode([
                    'temuan_lainnya' => 'tes'
                ]),
                'bukti_tindaklanjut' => '["storage/uploads/bukti_tl_tl/1751270896_686245f0456d4.png","storage/uploads/bukti_tl_tl/1751983138_686d242241d35.jpg"]',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
