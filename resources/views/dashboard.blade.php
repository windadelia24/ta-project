@extends('layout.navbar')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-8">
            <h2 class="text-dark fw-bold">Selamat Datang, {{ Auth::user()->name }}</h2>
        </div>
        <div class="col-4 text-end">
            <label class="form-label text-muted small mb-1">Filter Tahun</label>
            <select class="form-select" id="yearFilter" style="width: auto; display: inline-block;">
                <option value="2025" {{ date('Y') == 2025 ? 'selected' : '' }}>2025</option>
                <option value="2026" {{ date('Y') == 2026 ? 'selected' : '' }}>2026</option>
                <option value="2027" {{ date('Y') == 2027 ? 'selected' : '' }}>2027</option>
                <option value="2028" {{ date('Y') == 2028 ? 'selected' : '' }}>2028</option>
                <option value="2029" {{ date('Y') == 2029 ? 'selected' : '' }}>2029</option>
            </select>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #28a745 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">TOTAL KOPERASI DIPERIKSA</h6>
                            <h2 class="fw-bold mb-0" id="totalKoperasi">{{ $statistics['total_koperasi'] ?? 0 }}</h2>
                        </div>
                        <div class="bg-success bg-opacity-10 p-3 rounded">
                            <i class="fas fa-building text-success fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #dc3545 !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">KOPERASI YANG MENINDAKLANJUTI</h6>
                            <h2 class="fw-bold mb-0" id="koperasiMenindaklanjuti">{{ $statistics['koperasi_menindaklanjuti'] ?? 0 }}</h2>
                        </div>
                        <div class="bg-danger bg-opacity-10 p-3 rounded">
                            <i class="fas fa-check-circle text-danger fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow-sm" style="border-left: 4px solid #6c757d !important;">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-1">KOPERASI YANG BELUM MENINDAKLANJUTI</h6>
                            <h2 class="fw-bold mb-0" id="koperasiBelumMenindaklanjuti">{{ $statistics['koperasi_belum_menindaklanjuti'] ?? 0 }}</h2>
                        </div>
                        <div class="bg-secondary bg-opacity-10 p-3 rounded">
                            <i class="fas fa-clock text-secondary fa-2x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row">
        <!-- Chart Kota -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-dark fw-bold">Koperasi Yang Menindaklanjuti Per Kota</h5>
                </div>
                <div class="card-body">
                    <div style="height: 400px;">
                        <canvas id="kotaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Chart Kabupaten -->
        <div class="col-12 mb-4">
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-bottom">
                    <h5 class="mb-0 text-dark fw-bold">Koperasi Yang Menindaklanjuti Per Kabupaten</h5>
                </div>
                <div class="card-body">
                    <div style="height: 500px;">
                        <canvas id="kabupatenChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.card {
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: translateY(-2px);
}

.form-select-sm {
    font-size: 0.875rem;
    padding: 0.375rem 0.75rem;
}

.loading {
    opacity: 0.6;
    pointer-events: none;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Labels untuk Kota
    const kotaLabels = [
        'Kota Padang',
        'Kota Bukittinggi',
        'Kota Padang Panjang',
        'Kota Pariaman',
        'Kota Payakumbuh',
        'Kota Sawahlunto',
        'Kota Solok'
    ];

    // Labels untuk Kabupaten
    const kabupatenLabels = [
        'Kab. Agam',
        'Kab. Dharmasraya',
        'Kab. Kepulauan Mentawai',
        'Kab. Lima Puluh Kota',
        'Kab. Padang Pariaman',
        'Kab. Pasaman',
        'Kab. Pasaman Barat',
        'Kab. Pesisir Selatan',
        'Kab. Sijunjung',
        'Kab. Solok',
        'Kab. Solok Selatan',
        'Kab. Tanah Datar'
    ];

    // Data default (akan diupdate via AJAX)
    let currentKotaData = [0, 0, 0, 0, 0, 0, 0];
    let currentKabupatenData = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];

    // Inisialisasi Chart Kota
    const ctxKota = document.getElementById('kotaChart').getContext('2d');
    const kotaChart = new Chart(ctxKota, {
        type: 'bar',
        data: {
            labels: kotaLabels,
            datasets: [{
                label: 'Jumlah Koperasi',
                data: currentKotaData,
                backgroundColor: '#4a90a4',
                borderColor: '#4a90a4',
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    bottom: 50
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: '#e9ecef'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 12
                        },
                        padding: 10
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: '#4a90a4',
                    borderWidth: 1
                }
            },
            animation: {
                duration: 800,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Inisialisasi Chart Kabupaten
    const ctxKabupaten = document.getElementById('kabupatenChart').getContext('2d');
    const kabupatenChart = new Chart(ctxKabupaten, {
        type: 'bar',
        data: {
            labels: kabupatenLabels,
            datasets: [{
                label: 'Jumlah Koperasi',
                data: currentKabupatenData,
                backgroundColor: '#6c5ce7',
                borderColor: '#6c5ce7',
                borderWidth: 1,
                borderRadius: 4,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            layout: {
                padding: {
                    bottom: 50
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1
                    },
                    grid: {
                        color: '#e9ecef'
                    }
                },
                x: {
                    ticks: {
                        maxRotation: 45,
                        minRotation: 45,
                        font: {
                            size: 11
                        },
                        padding: 10
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: '#6c5ce7',
                    borderWidth: 1
                }
            },
            animation: {
                duration: 800,
                easing: 'easeInOutQuart'
            }
        }
    });

    // Event listener untuk filter tahun
    document.getElementById('yearFilter').addEventListener('change', function() {
        const selectedYear = this.value;
        loadDataByYear(selectedYear);
    });

    // Function untuk load data berdasarkan tahun via AJAX
    function loadDataByYear(year) {
        // Tampilkan loading state
        document.body.classList.add('loading');

        fetch(`/dashboard/statistics?year=${year}`, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Update statistik cards dengan animasi
            updateStatWithAnimation('totalKoperasi', data.total_koperasi);
            updateStatWithAnimation('koperasiMenindaklanjuti', data.koperasi_menindaklanjuti);
            updateStatWithAnimation('koperasiBelumMenindaklanjuti', data.koperasi_belum_menindaklanjuti);

            // Update chart data jika ada
            if (data.chart_data) {
                // Update chart kota
                if (data.chart_data.kota) {
                    currentKotaData = processChartData(data.chart_data.kota, kotaLabels, 'kota');
                    kotaChart.data.datasets[0].data = currentKotaData;
                    kotaChart.update('active');
                }

                // Update chart kabupaten
                if (data.chart_data.kabupaten) {
                    currentKabupatenData = processChartData(data.chart_data.kabupaten, kabupatenLabels, 'kabupaten');
                    kabupatenChart.data.datasets[0].data = currentKabupatenData;
                    kabupatenChart.update('active');
                }
            }
        })
        .catch(error => {
            console.error('Error loading data:', error);
            alert('Terjadi kesalahan saat memuat data');
        })
        .finally(() => {
            // Hilangkan loading state
            document.body.classList.remove('loading');
        });
    }

    // Function untuk memproses data chart
    function processChartData(serverData, labels, type) {
        let chartData = new Array(labels.length).fill(0);

        serverData.forEach(item => {
            const itemName = item.nama;
            const index = labels.findIndex(label => {
                // Untuk matching yang lebih fleksibel
                if (type === 'kota') {
                    // Hapus prefix "Kota " untuk matching
                    const cleanLabel = label.replace('Kota ', '');
                    const cleanItem = itemName.replace('Kota ', '');
                    return cleanLabel.toLowerCase().includes(cleanItem.toLowerCase()) ||
                           cleanItem.toLowerCase().includes(cleanLabel.toLowerCase());
                } else {
                    // Untuk kabupaten, hapus prefix "Kab. " dan "Kabupaten "
                    const cleanLabel = label.replace('Kab. ', '').replace('Kabupaten ', '');
                    const cleanItem = itemName.replace('Kab. ', '').replace('Kabupaten ', '');
                    return cleanLabel.toLowerCase().includes(cleanItem.toLowerCase()) ||
                           cleanItem.toLowerCase().includes(cleanLabel.toLowerCase());
                }
            });

            if (index !== -1) {
                chartData[index] = item.jumlah;
            }
        });

        return chartData;
    }

    // Fungsi untuk update statistik dengan animasi
    function updateStatWithAnimation(elementId, newValue) {
        const element = document.getElementById(elementId);
        const currentValue = parseInt(element.textContent) || 0;

        // Animasi counter
        const duration = 500;
        const startTime = performance.now();

        function animate(currentTime) {
            const elapsed = currentTime - startTime;
            const progress = Math.min(elapsed / duration, 1);

            const value = Math.round(currentValue + (newValue - currentValue) * progress);
            element.textContent = value;

            if (progress < 1) {
                requestAnimationFrame(animate);
            }
        }

        requestAnimationFrame(animate);
    }

    // Animasi loading untuk cards
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';

        setTimeout(() => {
            card.style.transition = 'all 0.5s ease-out';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });

    // Load data untuk tahun default (2025)
    loadDataByYear(2025);
});
</script>

<!-- Meta tag untuk CSRF token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
