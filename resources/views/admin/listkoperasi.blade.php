@extends('layout.navbar')

@section('content')
<div class="akun-container">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <h1>List Koperasi</h1>

    <div class="d-flex justify-content-between align-items-center mt-4 mb-4">
        <div class="search-container w-50">
            <input type="text" id="search" class="form-control" placeholder="Cari Data" value="{{ request('search') }}">
        </div>
        @if (Auth::check() && Auth::user()->role === 'admin')
            <div class="button-container">
                <a href="{{ route('tambahkoperasi') }}" class="btn btn-success">
                    <i class="fas fa-plus"></i> Input
                </a>
            </div>
        @endif
    </div>

    <div id="table-container">
        @include('admin.tablekoperasi')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Function untuk konfirmasi penghapusan data
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

    // Function untuk live search
    $(document).ready(function () {
        let searchTimeout;

        $('#search').on('keyup', function () {
            let query = $(this).val();

            // Clear timeout jika user masih mengetik
            clearTimeout(searchTimeout);

            // Set timeout untuk mengurangi beban server
            searchTimeout = setTimeout(function() {
                $.ajax({
                    url: "{{ route('carikoperasi') }}",
                    type: "GET",
                    data: { search: query },
                    success: function (data) {
                        $('#table-container').html(data);
                        // Re-bind click events untuk pagination
                        bindPaginationEvents();
                    },
                    error: function() {
                        console.error('Error occurred while searching');
                    }
                });
            }, 300); // 300ms delay
        });

        // Function untuk bind pagination events
        function bindPaginationEvents() {
            $(document).off('click', '.pagination a').on('click', '.pagination a', function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                let search = $('#search').val();

                if (url && !$(this).closest('li').hasClass('disabled')) {
                    $.ajax({
                        url: url,
                        type: "GET",
                        data: { search: search },
                        success: function(data) {
                            $('#table-container').html(data);
                            bindPaginationEvents(); // Re-bind events
                        },
                        error: function() {
                            console.error('Error occurred while paginating');
                        }
                    });
                }
            });
        }

        // Initial bind
        bindPaginationEvents();
    });
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
