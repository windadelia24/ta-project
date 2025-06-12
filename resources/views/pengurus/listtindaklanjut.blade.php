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

    <div class="d-flex justify-content-center mt-4">
        <nav>
            <ul class="pagination">
                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">>></a></li>
            </ul>
        </nav>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- <script>
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
        $('#search').on('keyup', function () {
            let query = $(this).val();

            $.ajax({
                url: "{{ route('carikoperasi') }}",
                type: "GET",
                data: { search: query },
                success: function (data) {
                    $('#table-container').html(data);
                }
            });
        });
    });
</script> --}}
@endsection
