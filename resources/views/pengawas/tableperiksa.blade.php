<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Tanggal Pemeriksaan</th>
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
                        <td class="text-center">{{ ($periksa->currentPage() - 1) * $periksa->perPage() + $index + 1 }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_periksa)->isoFormat('D MMMM Y') }}</td>
                        <td class="text-wrap" style="max-width: 200px;">
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                {{ $item->koperasi->nama_koperasi ?? 'Data Belum Tersedia' }}
                            </div>
                        </td>
                        <td>{{ $item->koperasi->kabupaten ?? '-' }}</td>
                        <td>{{ $item->user->name ?? '-' }}</td>
                        <td>{{ $item->skor_akhir ?? '-' }}</td>
                        <td class="text-center">
                            <a href="{{ route('lihatperiksa', $item->id_pemeriksaan) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-eye"></i>
                            </a>
                            @if (Auth::check() && Auth::user()->role === 'pengawas')
                                <a href="{{ route('editperiksa', $item->id_pemeriksaan) }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{ route('fileperiksa', $item->id_pemeriksaan) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-file"></i>
                                </a>
                            @endif
                            @if (!empty($item->file_ba))
                                <a href="{{ asset('storage/' . $item->file_ba) }}" class="btn btn-info btn-sm" download>
                                    <i class="fas fa-download"></i></a>
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
