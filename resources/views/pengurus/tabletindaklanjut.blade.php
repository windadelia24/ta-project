<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Nama Koperasi</th>
                <th>Kota/Kabupaten</th>
                <th>Nama Pengawas</th>
                <th>Status Tindak Lanjut</th>
                @if(Auth::check() && Auth::user()->role === 'pengurus')
                    <th>Pemeriksaan</th>
                @endif
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($periksa->isEmpty())
                <td colspan="{{ Auth::check() && Auth::user()->role === 'pengurus' ? 7 : 6 }}" class="text-center">
                        Belum ada data yang tersedia.
                </td>
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
                        @if(Auth::check() && Auth::user()->role === 'pengurus')
                            <td class="text-center">
                                <a href="{{ route('lihatperiksa', $item->id_pemeriksaan) }}" class="btn btn-warning btn-sm ">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if (!empty($item->file_ba))
                                    <a href="{{ asset('storage/' . $item->file_ba) }}" class="btn btn-info btn-sm" download>
                                        <i class="fas fa-download"></i></a>
                                @endif
                            </td>
                        @endif
                        <td class="text-center">
                            @if ($item->tindakLanjut)
                                <a href="{{ route('lihattindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Auth::check() && Auth::user()->role === 'pengurus')
                                    <a href="{{ route('edittindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" onclick="confirmDelete('{{ route('hapustindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}')" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                @endif
                                @if(Auth::check() && Auth::user()->role === 'pengawas')
                                    <a href="{{ route('respontindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                @endif
                            @else
                                @if(Auth::check() && Auth::user()->role === 'pengurus')
                                    <a href="{{ route('inputtindaklanjut', $item->id_pemeriksaan) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
