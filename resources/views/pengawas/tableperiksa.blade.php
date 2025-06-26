<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Nama Koperasi</th>
                <th>Kota/Kabupaten</th>
                <th>Nama Pengawas</th>
                <th>Skor</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($periksa->isEmpty())
                <tr>
                    <td colspan="6" class="text-center">Belum ada data yang tersedia.</td>
                </tr>
            @else
                @foreach($periksa as $index => $item)
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->koperasi->nama_koperasi ?? '-' }}</td>
                        <td>{{ $item->koperasi->kabupaten ?? '-' }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->skor_akhir ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('lihatperiksa', $item->id_pemeriksaan) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('editperiksa', $item->id_pemeriksaan) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="{{ route('fileperiksa', $item->id_pemeriksaan) }}" class="btn btn-success btn-sm">
                                <i class="fas fa-file"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
