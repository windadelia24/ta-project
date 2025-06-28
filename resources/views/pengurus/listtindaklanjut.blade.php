@extends('layout.navbar')

@section('content')
<div class="akun-container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>List Tindak Lanjut</h1>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div class="search-container w-50">
            <input type="text" id="search" class="form-control" placeholder="Cari Data">
        </div>
    </div>

    <div id="table-container">
        @include('pengurus.tabletindaklanjut')
    </div>

    <div class="d-flex justify-content-center mt-4" id="pagination-container">
        {{ $periksa->appends(request()->query())->links('layout.pagination') }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let searchTimeout;
    function confirmDelete(url) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data yang dihapus tidak bisa dikembalikan!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    }

    $(document).ready(function () {
        $('#search').on('keyup', function () {
            let query = $(this).val();

            // Clear timeout sebelumnya
            clearTimeout(searchTimeout);

            // Set timeout baru untuk menghindari terlalu banyak request
            searchTimeout = setTimeout(function() {
                performSearch(query);
            }, 300); // 300ms delay
        });

        // Handle pagination clicks untuk search results
        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let search = $('#search').val();

            if (search) {
                // Jika ada search, gunakan route caripengaduan
                $.ajax({
                    url: "{{ route('caritindaklanjut') }}",
                    type: "GET",
                    data: {
                        search: search,
                        page: getPageFromUrl(url)
                    },
                    success: function (response) {
                        $('#table-container').html(response.html);
                        $('#pagination-container').html(response.pagination);
                    },
                    error: function() {
                        console.error('Error loading search page');
                    }
                });
            } else {
                // Jika tidak ada search, redirect ke halaman biasa
                window.location.href = url;
            }
        });
    });

    function performSearch(query) {
        $.ajax({
            url: "{{ route('caritindaklanjut') }}",
            type: "GET",
            data: { search: query },
            success: function (response) {
                $('#table-container').html(response.html);
                $('#pagination-container').html(response.pagination);
            },
            error: function() {
                console.error('Error performing search');
            }
        });
    }

    function getPageFromUrl(url) {
        const urlParams = new URLSearchParams(url.split('?')[1]);
        return urlParams.get('page') || 1;
    }
</script>
<style>
    .pagination {
        margin: 0;
    }

    .pagination .page-link {
        border-radius: 6px;
        margin: 0 2px;
        border: 1px solid #dee2e6;
    }

    .pagination .page-item.active .page-link {
        background-color: #007bff;
        border-color: #007bff;
    }

    .spinner-border {
        width: 2rem;
        height: 2rem;
    }

    #loading {
        padding: 2rem;
    }

    @media (max-width: 768px) {
        .akun-container {
            padding: 10px;
        }

        .row .col-md-4 {
            margin-top: 10px;
        }

        .search-container .input-group {
            max-width: 100%;
        }
    }
</style>
@endsection
