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
                <td colspan="5" class="text-center">Belum ada data yang tersedia.</td>
            </tr>
            @endif
            @foreach($koperasi as $index => $kop)
            <tr>
                <td class="text-center">{{ $koperasi->firstItem() + $index }}</td>
                <td>{{ $kop->nama_koperasi }}</td>
                <td>{{ $kop->kabupaten }}</td>
                <td>{{ $kop->nbh }}</td>
                <td class="text-center">
                    <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal{{ $kop->nik }}">
                        <i class="fas fa-eye"></i>
                    </button>
                    @if (Auth::check() && Auth::user()->role === 'admin')
                        <a href="{{ route('editkoperasi', $kop->nik) }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>
                        <a href="javascript:void(0);" onclick="confirmDelete('{{ route('hapuskoperasi', $kop->nik) }}')" class="btn btn-danger btn-sm">
                            <i class="fas fa-trash"></i>
                        </a>
                    @endif
                </td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="viewModal{{ $kop->nik }}" tabindex="-1" aria-labelledby="viewModalLabel{{ $kop->nik }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="viewModalLabel{{ $kop->nik }}">Detail Koperasi</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                        </div>
                        <div class="modal-body">
                            <p><strong>Nama Koperasi:</strong> {{ $kop->nama_koperasi }}</p>
                            <p><strong>NBH:</strong> {{ $kop->nbh }}</p>
                            <p><strong>Alamat:</strong> {{ $kop->alamat }}</p>
                            <p><strong>Kabupaten:</strong> {{ $kop->kabupaten }}</p>
                            <p><strong>Bentuk Koperasi:</strong> {{ $kop->bentuk_koperasi }}</p>
                            <p><strong>Jenis Koperasi:</strong> {{ $kop->jenis_koperasi }}</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination Links -->
<div class="d-flex justify-content-center align-items-center mt-3">
    <div>
        {{ $koperasi->links('layout.pagination') }}
    </div>
</div>
