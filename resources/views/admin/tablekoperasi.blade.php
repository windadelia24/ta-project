<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Nama Koperasi</th>
                <th>Kota/Kabupaten</th>
                <th>Nomor Badan Hukum</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($koperasi->isEmpty())
            <tr>
                <td colspan="6" class="text-center">Belum ada data yang tersedia.</td>
            </tr>
            @endif
            @foreach($koperasi as $index => $kop)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $kop->nama_koperasi }}</td>
                <td>{{ $kop->kabupaten }}</td>
                <td>{{ $kop->nbh }}</td>
                <td class="text-center">
                    <a href="{{ route('editkoperasi', $kop->nik) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" onclick="confirmDelete('{{ route('hapuskoperasi', $kop->nik) }}')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
