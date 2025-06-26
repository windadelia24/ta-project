<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Nama Koperasi</th>
                <th>Kota/Kabupaten</th>
                <th>Nama Pengawas</th>
                <th>Status Tindak Lanjut</th>
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
                        <td class="text-center">
                            @if ($item->tindakLanjut)
                                <span class="badge text-bg-success">{{ $item->tindakLanjut->status_tindaklanjut }}</span>
                            @else
                                <span class="badge text-bg-warning">Belum Ditindaklanjuti</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('lihatperiksa', $item->id_pemeriksaan) }}" class="btn btn-warning btn-sm ">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="" class="btn btn-success btn-sm">
                                <i class="fas fa-file"></i>
                            </a>
                            @if ($item->tindakLanjut)
                                {{-- Kalau sudah ada tindak lanjut, tampilkan tombol edit --}}
                                <a href="{{ route('edittindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="javascript:void(0);" onclick="confirmDelete('{{ route('hapustindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}')" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i>
                                </a>
                            @else
                                {{-- Kalau belum ada tindak lanjut, tampilkan tombol input --}}
                                <a href="{{ route('inputtindaklanjut', $item->id_pemeriksaan) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
