let nilaiKas = 0;
let nilaiAktiva = 0;
let nilaiKewajiban = 0;
let currentStep = 1;
let dataPemeriksaan = {};

    function updateProgressBar(step) {
        const progressBar = document.getElementById("progress-bar");
        const totalSteps = 5;
        const percentage = (step / totalSteps) * 100;

        // Ini mengatur panjang progress barnya
        progressBar.style.width = percentage + "%";

        // Ini hanya untuk teks dalam barnya
        progressBar.textContent = `Step ${step} of ${totalSteps}`;
    }

    function nextStep() {
        if (currentStep === 1) {
            const koperasi = document.getElementById("koperasi").value;
            if (!koperasi) {
                alert("Silakan pilih koperasi terlebih dahulu.");
                return;
            }

            dataPemeriksaan.koperasi = koperasi;

            document.getElementById("step1").style.display = "none";
            document.getElementById("step2").style.display = "block";
            document.getElementById("form-title").innerText = "Tata Kelola";
        } else if (currentStep === 2) {
            const skorElem = document.getElementById("skor-tata-kelola");
            const skorTataKelola = skorElem ? parseFloat(skorElem.textContent) || 0 : 0;

            dataPemeriksaan["skor_tata_kelola"] = skorTataKelola;

            const skorTk1 = document.getElementById("section-score-0");
            const skorTk1final = skorTk1 ? parseFloat(skorTk1.textContent) || 0 : 0;

            dataPemeriksaan["skor_section_0"] = skorTk1final;

            const skorTk2 = document.getElementById("section-score-1");
            const skorTk2final = skorTk2 ? parseFloat(skorTk2.textContent) || 0 : 0;

            dataPemeriksaan["skor_section_1"] = skorTk2final;

            const skorTk3 = document.getElementById("section-score-2");
            const skorTk3final = skorTk3 ? parseFloat(skorTk3.textContent) || 0 : 0;

            dataPemeriksaan["skor_section_2"] = skorTk3final;

            document.getElementById("step2").style.display = "none";
            document.getElementById("step3").style.display = "block";
            document.getElementById("form-title").innerText = "Profil Risiko";
        } else if (currentStep === 3) {
            const skorPr = document.getElementById("skor-profil-resiko");
            const skorProfilResiko = skorPr ? parseFloat(skorPr.textContent) || 0 : 0;

            dataPemeriksaan["skor_profil_resiko"] = skorProfilResiko;

            const skorPr1 = document.getElementById("section-pr-0");
            const skorPr1final = skorPr1 ? parseFloat(skorPr1.textContent) || 0 : 0;

            dataPemeriksaan["skor_pr_0"] = skorPr1final;

            const skorPr2 = document.getElementById("section-pr-1");
            const skorPr2final = skorPr2 ? parseFloat(skorPr2.textContent) || 0 : 0;

            dataPemeriksaan["skor_pr_1"] = skorPr2final;

            nilaiKas = parseFloat(document.querySelector('#kas-bank-0-hidden')?.value || 0);
            nilaiAktiva = parseFloat(document.querySelector('#aktiva-0-hidden')?.value || 1);
            nilaiKewajiban = parseFloat(document.querySelector('#kewajiban-0-hidden')?.value || 1);

            document.getElementById("step3").style.display = "none";
            document.getElementById("step4").style.display = "block";
            document.getElementById("form-title").innerText = "Kinerja Keuangan";
        } else if (currentStep === 4) {
            const skorKk = document.getElementById("skor-kinerja-keuangan");
            const skorKinerjaKeuangan = skorKk ? parseFloat(skorKk.textContent) || 0 : 0;

            dataPemeriksaan["skor_kinerja_keuangan"] = skorKinerjaKeuangan;

            const skorKk1 = document.getElementById("section-kk-0");
            const skorKk1final = skorKk1 ? parseFloat(skorKk1.textContent) || 0 : 0;

            dataPemeriksaan["skor_kk_0"] = skorKk1final;

            const skorKk2 = document.getElementById("section-kk-1");
            const skorKk2final = skorKk2 ? parseFloat(skorKk2.textContent) || 0 : 0;

            dataPemeriksaan["skor_kk_1"] = skorKk2final;

            const skorKk3 = document.getElementById("section-kk-2");
            const skorKk3final = skorKk3 ? parseFloat(skorKk3.textContent) || 0 : 0;

            dataPemeriksaan["skor_kk_2"] = skorKk3final;

            nilaiShu = parseFloat(document.querySelector('#shu-hidden')?.value || 0);
            nilaiEkuitas = parseFloat(document.querySelector('#ekuitas-hidden')?.value || 0);
            nilaiPinjamanUsaha = parseFloat(document.querySelector('#pinjaman-usaha-hidden')?.value || 0);
            nilaiKewajibanEkuitas = parseFloat(document.querySelector('#kewajiban-ekuitas-hidden')?.value || 0);
            nilaiHutangPajak = parseFloat(document.querySelector('#hutang-pajak-hidden')?.value || 0);
            nilaiBebanMasuk = parseFloat(document.querySelector('#beban-masuk-hidden')?.value || 0);
            nilaiHutangBiaya = parseFloat(document.querySelector('#hutang-biaya-hidden')?.value || 0);
            nilaiAktivaLancar = parseFloat(document.querySelector('#aktiva-lancar-hidden')?.value || 0);
            nilaiPersediaan = parseFloat(document.querySelector('#persediaan-hidden')?.value || 0);
            nilaiPiutangDagang = parseFloat(document.querySelector('#piutang-dagang-hidden')?.value || 0);
            nilaiTabunganAnggota = parseFloat(document.querySelector('#tabungan-anggota-hidden')?.value || 0);
            nilaiTabunganNonAnggota = parseFloat(document.querySelector('#tabungan-nonanggota-hidden')?.value || 0);
            nilaiSimpananJangkaAnggota = parseFloat(document.querySelector('#simpanan-jangkaanggota-hidden')?.value || 0);
            nilaiSimpananJangkaCalonAnggota = parseFloat(document.querySelector('#simpananjangka-calonanggota-hidden')?.value || 0);
            nilaiPartisipasiBruto = parseFloat(document.querySelector('#partisipasi-bruto-hidden')?.value || 0);
            nilaiBebanPokok = parseFloat(document.querySelector('#beban-pokok-hidden')?.value || 0);
            nilaiPorsiBeban = parseFloat(document.querySelector('#porsi-beban-hidden')?.value || 0);
            nilaiBebanPerkoperasian = parseFloat(document.querySelector('#beban-perkoperasian-hidden')?.value || 0);
            nilaiBebanUsaha = parseFloat(document.querySelector('#beban-usaha-hidden')?.value || 0);
            nilaiShuKotor = parseFloat(document.querySelector('#shu-kotor-hidden')?.value || 0);
            nilaiBebanPenjualan = parseFloat(document.querySelector('#beban-penjualan-hidden')?.value || 0);
            nilaiPenjualanAnggota = parseFloat(document.querySelector('#penjualan-anggota-hidden')?.value || 0);
            nilaiPenjualanNonAnggota = parseFloat(document.querySelector('#penjualan-nonanggota-hidden')?.value || 0);
            nilaiPendapatan = parseFloat(document.querySelector('#pendapatan-hidden')?.value || 0);
            nilaiSimpanPokok = parseFloat(document.querySelector('#simpanan-pokok-hidden')?.value || 0);
            nilaiSimpanWajib = parseFloat(document.querySelector('#simpanan-wajib-hidden')?.value || 0);
            nilaiAktivaLalu = parseFloat(document.querySelector('#aktiva-lalu-hidden')?.value || 0);
            nilaiEkuitasLalu = parseFloat(document.querySelector('#ekuitas-lalu-hidden')?.value || 0);
            nilaiShuLalu = parseFloat(document.querySelector('#shu-lalu-hidden')?.value || 0);

            document.getElementById('hidden_koperasi').value = dataPemeriksaan.koperasi;
            console.log('Hidden koperasi:', document.getElementById('hidden_koperasi').value);

            document.getElementById('hidden_tata_kelola').value = dataPemeriksaan.skor_tata_kelola;
            console.log("Skor Tata Kelola:", dataPemeriksaan["skor_tata_kelola"]);

            document.getElementById('hidden_prinsip_koperasi').value = dataPemeriksaan["skor_section_0"];
            console.log("Skor Prinsip Koperasi:", dataPemeriksaan["skor_section_0"]);

            document.getElementById('hidden_kelembagaan').value = dataPemeriksaan["skor_section_1"];
            console.log("Skor Kelembagaan:", dataPemeriksaan["skor_section_1"]);

            document.getElementById('hidden_manajemen_koperasi').value = dataPemeriksaan["skor_section_2"];
            console.log("Skor Manajemen Koperasi:", dataPemeriksaan["skor_section_2"]);

            document.getElementById('hidden_profil_resiko').value = dataPemeriksaan.skor_profil_resiko;
            console.log("Skor Profil Resiko:", dataPemeriksaan["skor_profil_resiko"]);

            document.getElementById('hidden_resiko_inheren').value = dataPemeriksaan["skor_pr_0"];
            console.log("Skor Resiko Inheren:", dataPemeriksaan["skor_pr_0"]);

            document.getElementById('hidden_kpmr').value = dataPemeriksaan["skor_pr_1"];
            console.log("Skor KPMR:", dataPemeriksaan["skor_pr_1"]);

            document.getElementById('hidden_kinerja_keuangan').value = dataPemeriksaan.skor_kinerja_keuangan;
            console.log("Skor Kinerja Keuangan:", dataPemeriksaan["skor_kinerja_keuangan"]);

            document.getElementById('hidden_evaluasi').value = dataPemeriksaan["skor_kk_0"];
            console.log("Skor Evaluasi Kinerja Keuangan:", dataPemeriksaan["skor_kk_0"]);

            document.getElementById('hidden_manajemen_keuangan').value = dataPemeriksaan["skor_kk_1"];
            console.log("Skor Manajemen Keuangan:", dataPemeriksaan["skor_kk_1"]);

             document.getElementById('hidden_kesinambungan').value = dataPemeriksaan["skor_kk_2"];
            console.log("Skor Kesinambungan Keaungan:", dataPemeriksaan["skor_kk_2"]);

            document.getElementById('hidden_kas_bank').value = nilaiKas;
            console.log("Kas Bank:", nilaiKas);

            document.getElementById('hidden_aktiva').value = nilaiAktiva;
            console.log("Aktiva:", nilaiAktiva);

            document.getElementById('hidden_kewajiban').value = nilaiKewajiban;
            console.log("Kewajiban:", nilaiKewajiban);

            document.getElementById("step4").style.display = "none";
            document.getElementById("step5").style.display = "block";
            document.getElementById("form-title").innerText = "Permodalan";

            kalkulasiPermodalan();
            kalkulasiSectionPermodalan();
            kalkulasiSkorPermodalan();
        }

        currentStep++;
        updateProgressBar(currentStep);
    }

    function prevStep() {
        if (currentStep === 5) {
            document.getElementById("step5").style.display = "none";
            document.getElementById("step4").style.display = "block";
            document.getElementById("form-title").innerText = "Kinerja Keuangan";
        } else if (currentStep === 4) {
            document.getElementById("step4").style.display = "none";
            document.getElementById("step3").style.display = "block";
            document.getElementById("form-title").innerText = "Profil Risiko";
        } else if (currentStep === 3) {
            document.getElementById("step3").style.display = "none";
            document.getElementById("step2").style.display = "block";
            document.getElementById("form-title").innerText = "Tata Kelola";
        } else if (currentStep === 2) {
            document.getElementById("step2").style.display = "none";
            document.getElementById("step1").style.display = "block";
            document.getElementById("form-title").innerText = "Pilih Koperasi";
        }

        currentStep--;
        updateProgressBar(currentStep);
    }


    function cekSemua(id) {
        const checkboxes = document.querySelectorAll(`input[onchange*="${id}"]`);
        checkboxes.forEach(cb => cb.checked = true);

        const totalIndikator = checkboxes.length;
        updateScore(id, totalIndikator);
    }

    function hapusCeklis(id) {
        const checkboxes = document.querySelectorAll(`input[onchange*="${id}"]`);
        checkboxes.forEach(cb => cb.checked = false);

        const totalIndikator = 0;
        updateScore(id, totalIndikator);
    }

    function updateScore(id, totalIndikator) {
        const checkboxes = document.querySelectorAll(`input[onchange*="${id}"]`);
        let checked = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) checked++;
        });

        // Update tampilan skor asli
        const skorDisplayElem = document.getElementById(`skor-display-${id}`);
        if (skorDisplayElem) {
            skorDisplayElem.textContent = checked;
        }

        // Default konversi jika tidak ada yang dipilih
        let skorKonversi = 1;

        if (checked > 0) {
            const rasio = totalIndikator > 0 ? (checked / totalIndikator) : 0;

            let skorKategori;
            if (rasio <= 0.25) {
                skorKategori = 4;
            } else if (rasio <= 0.5) {
                skorKategori = 3;
            } else if (rasio <= 0.75) {
                skorKategori = 2;
            } else {
                skorKategori = 1;
            }

            // Konversi skorKategori sesuai rumus Excel
            const konversiMap = { 4: 1, 3: 2, 2: 3, 1: 4 };
            skorKonversi = konversiMap[skorKategori];
        }

        // Update tampilan skor kategori terkonversi
        const skorKategoriElem = document.getElementById(`skor-kategori-${id}`);
        if (skorKategoriElem) {
            skorKategoriElem.textContent = skorKonversi;
        }

        // Ambil sectionIndex dari ID (misalnya: "0-1" → "0")
        const [sectionIndex] = id.split("-");
        const totalSubjudul = document.querySelectorAll(`[id^="skor-kategori-${sectionIndex}-"]`).length;
        updateSectionScore(sectionIndex, totalSubjudul);

        updateTataKelolaScore();
    }

    function updateSectionScore(sectionIndex, totalSubjudul) {
        let totalSkor = 0;

        for (let i = 0; i < totalSubjudul; i++) {
            const val = parseInt(document.getElementById(`skor-kategori-${sectionIndex}-${i}`).textContent);
            if (!isNaN(val)) totalSkor += val;
        }

        const skorAkhir = ((totalSkor / (totalSubjudul * 4)) * 100) || 0;
        document.getElementById(`section-score-${sectionIndex}`).textContent = skorAkhir.toFixed(2);
    }

    function updateTataKelolaScore() {
        const skorElems = document.querySelectorAll('[id^="skor-kategori-"]');
        let totalSkor = 0;
        let totalSubjudul = 0;

        skorElems.forEach(elem => {
            const val = parseInt(elem.textContent);
            if (!isNaN(val)) {
                totalSkor += val;
            }
            totalSubjudul++; // Hitung semua subjudul, bukan hanya yang diceklis
        });

        const skorAkhir = totalSubjudul > 0 ? ((totalSkor / (totalSubjudul * 4)) * 100) : 0;
        const skorElem = document.getElementById("skor-tata-kelola");
        if (skorElem) {
            skorElem.textContent = skorAkhir.toFixed(2);
        }
    }

    function updateIndikatorTerpilih(sectionIndex, subIndex) {
        // Ambil semua checkbox untuk subkomponen ini
        const checkboxes = document.querySelectorAll(`input.indikator-checkbox[id^="section-${sectionIndex}-"][id*="-sub-${subIndex}-"]`);
        const totalIndikator = checkboxes.length;
        const totalDipilih = Array.from(checkboxes).filter(cb => cb.checked).length;

        const totalSpan = document.getElementById(`total-terpilih-${sectionIndex}-${subIndex}`);
        const badge = document.getElementById(`badge-indikator-${sectionIndex}-${subIndex}`);

        // Hitung rasio dan skor kategori
        const rasio = totalIndikator > 0 ? totalDipilih / totalIndikator : 0;
        let skorKategori = 1;
        if (rasio <= 0.25) {
            skorKategori = 4;
        } else if (rasio <= 0.5) {
            skorKategori = 3;
        } else if (rasio <= 0.75) {
            skorKategori = 2;
        }

        // Konversi skor sesuai mapping
        const konversiMap = { 4: 1, 3: 2, 2: 3, 1: 4 };
        const skorTerkonversi = konversiMap[skorKategori];

        // Tampilkan skor terkonversi di badge dan total terpilih
        if (totalSpan) totalSpan.textContent = totalDipilih;
        if (badge) badge.textContent = skorTerkonversi;
        updateRiskScore(sectionIndex);

        calculateSectionScoreSum(sectionIndex);
        updateProfilResikoSkor();
    }

    function checkAllIndikator(id) {
        const [sectionIndex, subIndex] = id.split("-");

        // Ambil semua checkbox yang sesuai section dan subindex
        const checkboxes = document.querySelectorAll(`input.indikator-checkbox[id^="section-${sectionIndex}-"][id*="-sub-${subIndex}-"]`);

        checkboxes.forEach(cb => {
            cb.checked = true;
            cb.dispatchEvent(new Event('change')); // agar onchange-nya jalan
        });

        // Update skor indikator
        updateIndikatorTerpilih(sectionIndex, subIndex);
    }

    function uncheckAllIndikator(id) {
        const [sectionIndex, subIndex] = id.split("-");

        // Ambil semua checkbox yang sesuai section dan subindex
        const checkboxes = document.querySelectorAll(`input.indikator-checkbox[id^="section-${sectionIndex}-"][id*="-sub-${subIndex}-"]`);

        checkboxes.forEach(cb => {
            cb.checked = false;
            cb.dispatchEvent(new Event('change')); // agar onchange-nya jalan
        });

        // Update skor indikator
        updateIndikatorTerpilih(sectionIndex, subIndex);
    }

    function konversiSkorAwalAktiva(nilaiPersen) {
        const nilai = nilaiPersen / 100;
        if (nilai <= 0.05) return 4;
        else if (nilai <= 0.10) return 3;
        else if (nilai <= 0.15) return 2;
        else return 1;
    }

    function konversiSkorAwalKewajiban(nilaiPersen) {
        const nilai = nilaiPersen / 100;
        if (nilai <= 0.07) return 4;
        else if (nilai <= 0.14) return 3;
        else if (nilai <= 0.21) return 2;
        else return 1;
    }

    function konversiFinal(skorAwal) {
        const mapping = { 4: 1, 3: 2, 2: 3, 1: 4 };
        return mapping[skorAwal] ?? 0;
    }

    function formatRupiah(angka) {
        return angka.toLocaleString('id-ID', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function updateHiddenInput(visibleInputId, rawValue) {
        const hiddenInputId = visibleInputId + '-hidden';
        const hiddenInput = document.getElementById(hiddenInputId);
        if (hiddenInput) {
            hiddenInput.value = rawValue;
        }
    }

    function kalkulasiSkor() {
        const kas = parseFloat(document.querySelector('#kas-bank-0-hidden')?.value || 0);
        const aktiva = parseFloat(document.querySelector('#aktiva-0-hidden')?.value || 1);
        const kewajiban = parseFloat(document.querySelector('#kewajiban-0-hidden')?.value || 1);

        const skor1Rasio = kas && aktiva ? (kas / aktiva) * 100 : 0;
        const skor1Awal = konversiSkorAwalAktiva(skor1Rasio);
        const skor1Final = konversiFinal(skor1Awal);
        document.querySelector('#badge-indikator-0-4').innerText = skor1Final;

        const skor2Rasio = kas && kewajiban ? (kas / kewajiban) * 100 : 0;
        const skor2Awal = konversiSkorAwalKewajiban(skor2Rasio);
        const skor2Final = konversiFinal(skor2Awal);
        document.querySelector('#badge-indikator-0-5').innerText = skor2Final;
        calculateSectionScoreSum(0);
    }

    function updateRiskScore(sectionIndex) {
        // Ambil semua risk berdasarkan section
        const riskElements = document.querySelectorAll(`#section-${sectionIndex} h6`);

        riskElements.forEach((riskElement, riskIndex) => {
            const badgeSpans = [];
            let pointer = riskElement.nextElementSibling;

            while (pointer && !pointer.tagName.startsWith('H6')) {
                const subIndexMatch = pointer.getAttribute("data-subcontainer");
                if (subIndexMatch) {
                    const badge = document.querySelector(`#badge-indikator-${sectionIndex}-${subIndexMatch.split("-")[1]}`);
                    if (badge) {
                        const value = parseInt(badge.textContent);
                        if (!isNaN(value)) {
                            badgeSpans.push(value);
                        }
                    }
                }
                pointer = pointer.nextElementSibling;
            }

            const totalNilai = badgeSpans.reduce((sum, val) => sum + val, 0);
            const jumlahSub = badgeSpans.length;
            if (jumlahSub > 0) {
                const nilai = ((totalNilai / (jumlahSub * 4)) * 100).toFixed(2);
                const scoreElement = document.getElementById(`risk-score-${sectionIndex}-${riskIndex}`);
                if (scoreElement) {
                    scoreElement.textContent = nilai;
                }
            }
        });
    }

    function calculateSectionScoreSum(sectionIndex) {
        const badges = document.querySelectorAll(`[id^="badge-indikator-${sectionIndex}-"]`);

        let totalSkor = 0;

        badges.forEach(badge => {
            const val = parseInt(badge.textContent);
            if (!isNaN(val)) totalSkor += val;
        });

        const skorAkhir = ((totalSkor / (badges.length * 4)) * 100) || 0;
        console.log(`Section ${sectionIndex} → total badge: ${badges.length}, skor akhir: ${skorAkhir}`);
        document.getElementById(`section-pr-${sectionIndex}`).textContent = skorAkhir.toFixed(2);
    }

    function updateProfilResikoSkor() {
        const badgeElems = document.querySelectorAll('[id^="badge-indikator-"]');
        let totalSkor = 0;
        let totalBadge = 0;

        badgeElems.forEach(elem => {
            const val = parseFloat(elem.textContent);
            if (!isNaN(val)) {
                totalSkor += val;
                totalBadge++;
            }
        });

        const skorAkhir = totalBadge > 0 ? ((totalSkor / (totalBadge * 4)) * 100) : 0;

        const skorElem = document.getElementById("skor-profil-resiko");
        if (skorElem) {
            skorElem.textContent = skorAkhir.toFixed(2);
        }
    }

    function formatRupiahManual(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
    }

    function konversiRoa(value) {
        if (value < 0.03) return 4;
        else if (value < 0.05) return 3;
        else if (value < 0.07) return 2;
        else return 1;
    }

    function konversiRoe(value) {
        if (value < 0.05) return 4;
        else if (value < 0.07) return 3;
        else if (value < 0.10) return 2;
        else return 1;
    }

    function konversiMandiri(value) {
        if (value < 1) return 4;
        else if (value < 1.1) return 3;
        else if (value < 1.2) return 2;
        else return 1;
    }

    function konversiBiayapendapatan(value) {
        if (value < 0.8) return 1;
        else if (value < 0.9) return 2;
        else if (value < 1) return 3;
        else return 4;
    }

    function konversiBiayashukotor(value) {
        if (value < 0.4) return 1;
        else if (value <= 0.6) return 2;
        else if (value <= 0.8) return 3;
        else return 4;
    }

    function konversiKaskewajiban(value) {
        if (value < 0.1) return 4;
        else if (value < 0.15) return 3;
        else if (value < 0.2) return 2;
        else return 1;
    }

    function konversiPiutangdana(value) {
        if (value < 0.6) return 4;
        else if (value < 0.75) return 3;
        else if (value < 0.9) return 2;
        else return 1;
    }

    function konversiAsetkewajiban(value) {
        if (value < 0.75) return 4;
        else if (value < 1) return 3;
        else if (value < 1.25) return 2;
        else return 1;
    }

    function konversiPutarpersedian(value) {
        if (value < 4) return 4;
        else if (value < 7) return 3;
        else if (value < 10) return 2;
        else return 1;
    }

    function konversiTagihrata(value) {
        if (value < 100) return 1;
        else if (value < 140) return 2;
        else if (value < 180) return 3;
        else return 4;
    }

    function konversiPutarpiutang(value) {
        if (value < 4) return 4;
        else if (value < 7) return 3;
        else if (value < 10) return 2;
        else return 1;
    }

    function konversiPutarmodal(value) {
        if (value < 0.25) return 4;
        else if (value < 0.75) return 3;
        else if (value < 1.25) return 2;
        else return 1;
    }

    function konversiPutaraktiva(value) {
        if (value < 0.05) return 4;
        else if (value < 0.15) return 3;
        else if (value < 0.25) return 2;
        else return 1;
    }

    function konversiTumbuhaset(value) {
    if (value < 0.04) return 4;
        else if (value < 0.07) return 3;
        else if (value < 0.1) return 2;
        else return 1;
    }

    function konversiTumbuhekuitas(value) {
        if (value < 0.04) return 4;
        else if (value < 0.07) return 3;
        else if (value < 0.1) return 2;
        else return 1;
    }

    function konversiTumbuhshu(value) {
        if (value < 0.01) return 4;
        else if (value < 0.03) return 3;
        else if (value < 0.05) return 2;
        else return 1;
    }

    function konversiEkuitasAset(value) {
        if (value < 0.1) return 4;
        else if (value < 0.2) return 3;
        else if (value < 0.3) return 2;
        else return 1;
    }

    function konversiKewajibanPanjangEkuitas(value) {
        if (value <= 1) return 1;
        else if (value <= 1.25) return 2;
        else if (value <= 1.5) return 3;
        else return 4;
    }

    function konversiRasiopendapatan(value) {
        if (value < 0.35) return 4;
        else if (value < 0.6) return 3;
        else if (value < 0.85) return 2;
        else return 1;
    }

    function konversiShusimpanan(value) {
        if (value < 0.1) return 4;
        else if (value < 0.2) return 3;
        else if (value < 0.3) return 2;
        else return 1;
    }

    function konversiPinjamanAset(value) {
        if (value < 0.1) return 4;
        else if (value < 0.2) return 3;
        else if (value < 0.3) return 2;
        else return 1;
    }

    function konversiPartisipasianggota(value) {
        if (value < 0.25) return 4;
        else if (value < 0.51) return 3;
        else if (value < 0.75) return 2;
        else return 1;
    }

    function kalkulasiKeuangan(){
        const shu = parseFloat(document.getElementById('shu-hidden').value || 0);
        const ekuitas = parseFloat(document.getElementById('ekuitas-hidden').value || 0);
        const pinjamanUsaha = parseFloat(document.getElementById('pinjaman-usaha-hidden').value || 0);
        const kewajibanEkuitas = parseFloat(document.getElementById('kewajiban-ekuitas-hidden').value || 0);
        const hutangPajak = parseFloat(document.getElementById('hutang-pajak-hidden').value || 0);
        const bebanMasuk = parseFloat(document.getElementById('beban-masuk-hidden').value || 0);
        const hutangBiaya = parseFloat(document.getElementById('hutang-biaya-hidden').value || 0);
        const aktivaLancar = parseFloat(document.getElementById('aktiva-lancar-hidden').value || 0);
        const persediaan = parseFloat(document.getElementById('persediaan-hidden').value || 0);
        const piutangDagang = parseFloat(document.getElementById('piutang-dagang-hidden').value || 0);
        const tabunganAnggota = parseFloat(document.getElementById('tabungan-anggota-hidden').value || 0);
        const tabunganNonAnggota = parseFloat(document.getElementById('tabungan-nonanggota-hidden').value || 0);
        const simpananJangkaanggota = parseFloat(document.getElementById('simpanan-jangkaanggota-hidden').value || 0);
        const simpananJangkacalonanggota = parseFloat(document.getElementById('simpananjangka-calonanggota-hidden').value || 0);
        const partisipasiBruto = parseFloat(document.getElementById('partisipasi-bruto-hidden').value || 0);
        const bebanPokok = parseFloat(document.getElementById('beban-pokok-hidden').value || 0);
        const porsiBeban = parseFloat(document.getElementById('porsi-beban-hidden').value || 0);
        const bebanPerkoperasian = parseFloat(document.getElementById('beban-perkoperasian-hidden').value || 0);
        const bebanUsaha = parseFloat(document.getElementById('beban-usaha-hidden').value || 0);
        const shuKotor = parseFloat(document.getElementById('shu-kotor-hidden').value || 0);
        const bebanPenjualan = parseFloat(document.getElementById('beban-penjualan-hidden').value || 0);
        const penjualanAnggota = parseFloat(document.getElementById('penjualan-anggota-hidden').value || 0);
        const penjualanNonanggota = parseFloat(document.getElementById('penjualan-nonanggota-hidden').value || 0);
        const pendapatan = parseFloat(document.getElementById('pendapatan-hidden').value || 0);
        const simpanPokok = parseFloat(document.getElementById('simpanan-pokok-hidden').value || 0);
        const simpanWajib = parseFloat(document.getElementById('simpanan-wajib-hidden').value || 0);
        const aktivaLalu = parseFloat(document.getElementById('aktiva-lalu-hidden').value || 0);
        const ekuitasLalu = parseFloat(document.getElementById('ekuitas-lalu-hidden').value || 0);
        const shuLalu = parseFloat(document.getElementById('shu-lalu-hidden').value || 0);

        const safeDivide = (numerator, denominator) => {
            return denominator === 0 ? 0 : numerator / denominator;
        };

        const roa = safeDivide(shu, nilaiAktiva);
        const skor1Awal = konversiRoa(roa);
        const roafinal = konversiFinal(skor1Awal);
        document.getElementById('kk-indikator-0-0-0').innerText = roafinal;

        const roe = safeDivide(shu, ekuitas);
        const skor2Awal = konversiRoe(roe);
        const roefinal = konversiFinal(skor2Awal);
        document.getElementById('kk-indikator-0-0-1').innerText = roefinal;

        const mandiri = safeDivide(partisipasiBruto - bebanPokok, porsiBeban + bebanPerkoperasian);
        const skor3Awal = konversiMandiri(mandiri);
        const mandirifinal = konversiFinal(skor3Awal);
        document.getElementById('kk-indikator-0-0-2').innerText = mandirifinal;

        const biayaPendapatan = safeDivide(bebanPokok + porsiBeban + bebanPerkoperasian, partisipasiBruto);
        const skor4Awal = konversiBiayapendapatan(biayaPendapatan);
        const biayaPendapatanfinal = konversiFinal(skor4Awal);
        document.getElementById('kk-indikator-0-1-0').innerText = biayaPendapatanfinal;

        const biayaShukotor = safeDivide(bebanUsaha, shuKotor);
        const skor5Awal = konversiBiayashukotor(biayaShukotor);
        const biayaShukotorfinal = konversiFinal(skor5Awal);
        document.getElementById('kk-indikator-0-1-1').innerText = biayaShukotorfinal;

        const kasKewajiban = safeDivide(nilaiKas, nilaiKewajiban);
        const skor6Awal = konversiKaskewajiban(kasKewajiban);
        const kasKewajibanfinal = konversiFinal(skor6Awal);
        document.getElementById('kk-indikator-1-0-0').innerText = kasKewajibanfinal;

        const piutangDana = safeDivide(pinjamanUsaha, kewajibanEkuitas - hutangPajak - bebanMasuk - hutangBiaya);
        const piutangDanaFinal = konversiFinal(konversiPiutangdana(piutangDana));
        document.getElementById('kk-indikator-1-0-1').innerText = piutangDanaFinal;

        const asetKewajiban = safeDivide(aktivaLancar, nilaiKewajiban);
        const asetKewajibanfinal = konversiFinal(konversiAsetkewajiban(asetKewajiban));
        document.getElementById('kk-indikator-1-0-2').innerText = asetKewajibanfinal;

        const putarPersedian = safeDivide(bebanPenjualan, persediaan);
        const putarPersedianfinal = konversiFinal(konversiPutarpersedian(putarPersedian));
        document.getElementById('kk-indikator-1-1-0').innerText = putarPersedianfinal;

        const tagihRata = safeDivide(piutangDagang, (penjualanAnggota + penjualanNonanggota) / 365);
        const tagihRatafinal = konversiFinal(konversiTagihrata(tagihRata));
        document.getElementById('kk-indikator-1-1-1').innerText = tagihRatafinal;

        const putarPiutang = safeDivide(penjualanAnggota + penjualanNonanggota, piutangDagang);
        const putarPiutangfinal = konversiFinal(konversiPutarpiutang(putarPiutang));
        document.getElementById('kk-indikator-1-1-2').innerText = putarPiutangfinal;

        const putarModal = safeDivide(penjualanAnggota + penjualanNonanggota, ekuitas);
        const putarModalfinal = konversiFinal(konversiPutarmodal(putarModal));
        document.getElementById('kk-indikator-1-1-3').innerText = putarModalfinal;

        const putarAktiva = safeDivide(penjualanAnggota + penjualanNonanggota, nilaiAktiva);
        const putarAktivafinal = konversiFinal(konversiPutaraktiva(putarAktiva));
        document.getElementById('kk-indikator-1-1-4').innerText = putarAktivafinal;

        const tumbuhAset = safeDivide(nilaiAktiva - aktivaLalu, aktivaLalu);
        const tumbuhAsetfinal = konversiFinal(konversiTumbuhaset(tumbuhAset));
        document.getElementById('kk-indikator-2-0-0').innerText = tumbuhAsetfinal;

        const tumbuhEkuitas = safeDivide(ekuitas - ekuitasLalu, ekuitasLalu);
        const tumbuhEkuitasfinal = konversiFinal(konversiTumbuhekuitas(tumbuhEkuitas));
        document.getElementById('kk-indikator-2-0-1').innerText = tumbuhEkuitasfinal;

        const tumbuhShu = safeDivide(shu - shuLalu, shuLalu);
        const tumbuhShufinal = konversiFinal(konversiTumbuhshu(tumbuhShu));
        document.getElementById('kk-indikator-2-0-2').innerText = tumbuhShufinal;

        const rasioPendapatan = safeDivide(partisipasiBruto, pendapatan);
        const rasioPendapatanfinal = konversiFinal(konversiRasiopendapatan(rasioPendapatan));
        document.getElementById('kk-indikator-2-1-0').innerText = rasioPendapatanfinal;

        const shuSimpanan = safeDivide(shu, simpanPokok + simpanWajib);
        const shuSimpananfinal = konversiFinal(konversiShusimpanan(shuSimpanan));
        document.getElementById('kk-indikator-2-1-1').innerText = shuSimpananfinal;

        const partisipasiAnggota = safeDivide(tabunganAnggota + simpananJangkaanggota, tabunganAnggota + tabunganNonAnggota + simpananJangkaanggota + simpananJangkacalonanggota);
        console.log('partisipasi: ',partisipasiAnggota);
        const partisipasiAnggotafinal = konversiFinal(konversiPartisipasianggota(partisipasiAnggota));
        document.getElementById('kk-indikator-2-1-2').innerText = partisipasiAnggotafinal;
    }

    function calculateAllSubScores() {
        // Cari semua badge skor sub
        const subScoreBadges = document.querySelectorAll('[id^="sub-score-"]');

        subScoreBadges.forEach(badge => {
            const idParts = badge.id.split('-'); // ex: ['sub', 'score', '0', '1']
            const sectionIndex = idParts[2];
            const subIndex = idParts[3];

            // Cari semua indikator badge yang sesuai dengan sectionIndex dan subIndex
            const indikatorBadges = document.querySelectorAll(`[id^="kk-indikator-${sectionIndex}-${subIndex}-"]`);
            let totalSkor = 0;
            let jumlahIndikator = 0;

            indikatorBadges.forEach(indikator => {
                const val = parseInt(indikator.textContent);
                if (!isNaN(val)) {
                    totalSkor += val;
                    jumlahIndikator++;
                }
            });

            const skorAkhir = ((totalSkor / (jumlahIndikator * 4)) * 100) || 0;
            badge.textContent = skorAkhir.toFixed(2);
        });
    }

    function calculateAllSectionScores() {
        const sectionBadges = document.querySelectorAll('[id^="section-kk-"]');

        sectionBadges.forEach(badge => {
            const idParts = badge.id.split('-'); // ['section', 'kk', '0']
            const sectionIndex = idParts[2];

            // Ambil semua indikator di dalam section tersebut
            const indikatorBadges = document.querySelectorAll(`[id^="kk-indikator-${sectionIndex}-"]`);

            let totalSkor = 0;
            let jumlahIndikator = 0;

            indikatorBadges.forEach(badge => {
                const val = parseInt(badge.textContent);
                if (!isNaN(val)) {
                    totalSkor += val;
                    jumlahIndikator++;
                }
            });

            const skorAkhir = ((totalSkor / (jumlahIndikator * 4)) * 100) || 0;
            badge.textContent = skorAkhir.toFixed(2);

            console.log(`Section ${sectionIndex} → Total Skor: ${totalSkor}, Indikator: ${jumlahIndikator}, Skor Akhir: ${skorAkhir}`);
        });
    }

    function calculateTotalKinerjaKeuanganScore() {
        const indikatorBadges = document.querySelectorAll('[id^="kk-indikator-"]');

        let totalSkor = 0;
        let jumlahIndikator = 0;

        indikatorBadges.forEach(badge => {
            const val = parseInt(badge.textContent);
            if (!isNaN(val)) {
                totalSkor += val;
                jumlahIndikator++;
            }
        });

        const skorAkhir = ((totalSkor / (jumlahIndikator * 4)) * 100) || 0;

        const badge = document.getElementById('skor-kinerja-keuangan');
        if (badge) {
            badge.textContent = skorAkhir.toFixed(2);
        }

        console.log(`Kinerja Keuangan → Total Skor: ${totalSkor}, Indikator: ${jumlahIndikator}, Skor Akhir: ${skorAkhir}`);
    }

    function kalkulasiPermodalan(){
        const titipanDana = parseFloat(document.getElementById('titipan-dana-hidden').value || 0);
        const kewajibanPanjang = parseFloat(document.getElementById('kewajiban-panjang-hidden').value || 0);

        const safeDivide = (numerator, denominator) => {
            return denominator === 0 ? 0 : numerator / denominator;
        };

        const ekuitasAset = safeDivide(nilaiEkuitas, nilaiAktiva);
        console.log('ekuitas :', ekuitasAset);
        const skor1Awal = konversiEkuitasAset(ekuitasAset);
        const ekuitasAsetfinal = konversiFinal(skor1Awal);
        document.getElementById('pk-indikator-0-0').innerText = ekuitasAsetfinal;

        const pinjamanAset = safeDivide(nilaiTabunganAnggota + nilaiSimpananJangkaAnggota + titipanDana, nilaiAktiva);
        console.log('pinjaman :', pinjamanAset);
        const skor2Awal = konversiPinjamanAset(pinjamanAset);
        const pinjamanAsetfinal = konversiFinal(skor2Awal);
        document.getElementById('pk-indikator-1-0').innerText = pinjamanAsetfinal;

        const kewajibanPanjangekuitas = safeDivide(kewajibanPanjang, nilaiEkuitas);
        console.log('kewajiban :', kewajibanPanjangekuitas);
        const skor3Awal = konversiKewajibanPanjangEkuitas(kewajibanPanjangekuitas);
        const kewajibanPanjangekuitasfinal = konversiFinal(skor3Awal);
        document.getElementById('pk-indikator-1-1').innerText = kewajibanPanjangekuitasfinal;
    }

    function kalkulasiSectionPermodalan() {
        const sectionBadges = document.querySelectorAll('[id^="section-pk-"]');

        sectionBadges.forEach(badge => {
            const idParts = badge.id.split('-'); // ['section', 'pk', '0']
            const sectionIndex = idParts[2];

            // Ambil semua indikator di dalam section tersebut
            const indikatorBadges = document.querySelectorAll(`[id^="pk-indikator-${sectionIndex}-"]`);

            let totalSkor = 0;
            let jumlahIndikator = 0;

            indikatorBadges.forEach(badge => {
                const val = parseInt(badge.textContent);
                if (!isNaN(val)) {
                    totalSkor += val;
                    jumlahIndikator++;
                }
            });

            const skorAkhir = ((totalSkor / (jumlahIndikator * 4)) * 100) || 0;
            badge.textContent = skorAkhir.toFixed(2);

            console.log(`Section ${sectionIndex} → Total Skor: ${totalSkor}, Indikator: ${jumlahIndikator}, Skor Akhir: ${skorAkhir}`);
            const skorPk1 = document.getElementById("section-pk-0");
            const skorPk1final= skorPk1 ? parseFloat(skorPk1.textContent) || 0 : 0;

            dataPemeriksaan["skor_pk_0"] = skorPk1final;

            document.getElementById('hidden_kecukupan').value = skorPk1final;
            console.log("Skor Kecukupan:", skorPk1final);

            const skorPk2 = document.getElementById("section-pk-1");
            const skorPk2final= skorPk2 ? parseFloat(skorPk2.textContent) || 0 : 0;

            dataPemeriksaan["skor_pk_1"] = skorPk2final;

            document.getElementById('hidden_pengelolaan').value = skorPk2final;
            console.log("Skor Pengelolaan:", skorPk2final);
        });
    }

    function kalkulasiSkorPermodalan() {
        const indikatorBadges = document.querySelectorAll('[id^="pk-indikator-"]');

        let totalSkor = 0;
        let jumlahIndikator = 0;

        indikatorBadges.forEach(badge => {
            const val = parseInt(badge.textContent);
            if (!isNaN(val)) {
                totalSkor += val;
                jumlahIndikator++;
            }
        });

        const skorAkhir = ((totalSkor / (jumlahIndikator * 4)) * 100) || 0;

        const badge = document.getElementById('skor-permodalan');
        if (badge) {
            badge.textContent = skorAkhir.toFixed(2);
        }

        console.log(`Skor Permodalan → Total Skor: ${totalSkor}, Indikator: ${jumlahIndikator}, Skor Akhir: ${skorAkhir}`);
        const skorPk = document.getElementById("skor-permodalan");
        const skorPermodalan = skorPk ? parseFloat(skorPk.textContent) || 0 : 0;

        dataPemeriksaan["skor_permodalan"] = skorPermodalan;

        document.getElementById('hidden_permodalan').value = skorPermodalan;
        console.log("Skor Permodalan:", skorPermodalan);
    }

    document.addEventListener("DOMContentLoaded", function () {
        updateProgressBar(currentStep);

        // Event listener untuk semua indikator checkbox
        document.querySelectorAll(".indikator-checkbox").forEach(function (checkbox) {
            checkbox.addEventListener("change", function () {
                const checkboxId = checkbox.id;
                const match = checkboxId.match(/section-(\d+)-risk-\d+-sub-(\d+)-indikator-\d+/);

                if (match) {
                    const sectionIndex = match[1];
                    const subIndex = match[2];
                    updateIndikatorTerpilih(sectionIndex, subIndex);
                }
            });
        });

        document.querySelectorAll('.rupiah-format').forEach(function (input) {
            input.addEventListener('focus', function () {
                this.value = this.dataset.raw || '';
            });

            input.addEventListener('input', function () {
                const raw = this.value.replace(/\D/g, '');
                this.dataset.raw = raw;
                document.getElementById(this.id + '-hidden').value = raw;
            });

            input.addEventListener('blur', function () {
                const raw = this.dataset.raw || '0';
                const formatted = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
                }).format(raw);
                this.value = formatted;
                kalkulasiSkor();
            });
        });

        document.querySelectorAll('.rp-format').forEach(function (input) {
            input.addEventListener('focus', function () {
                this.value = this.dataset.raw || '';
            });

            input.addEventListener('input', function () {
                const raw = this.value.replace(/\D/g, '');
                this.dataset.raw = raw;
                document.getElementById(this.id + '-hidden').value = raw;
            });

            input.addEventListener('blur', function () {
                const raw = this.dataset.raw || '0';
                const formatted = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
                }).format(raw);
                this.value = formatted;
                kalkulasiKeuangan();
                calculateAllSubScores();
                calculateAllSectionScores();
                calculateTotalKinerjaKeuanganScore();
            });
        });

        document.querySelectorAll('.rupiah').forEach(function (input) {
            input.addEventListener('focus', function () {
                this.value = this.dataset.raw || '';
            });

            input.addEventListener('input', function () {
                const raw = this.value.replace(/\D/g, '');
                this.dataset.raw = raw;
                document.getElementById(this.id + '-hidden').value = raw;
            });

            input.addEventListener('blur', function () {
                const raw = this.dataset.raw || '0';
                const formatted = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
                }).format(raw);
                this.value = formatted;
                kalkulasiPermodalan();
                kalkulasiSectionPermodalan();
                kalkulasiSkorPermodalan();
            });
        });
    });


