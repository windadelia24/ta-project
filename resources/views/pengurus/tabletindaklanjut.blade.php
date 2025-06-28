<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Tanggal Tilakes</th>
                @if(Auth::check() && Auth::user()->role === 'pengawas')
                    <th>Nama Koperasi</th>
                    <th>Kota/Kabupaten</th>
                @endif
                <th>Nama Pengawas</th>
                <th>Status Tilakes</th>
                @if(Auth::check() && Auth::user()->role === 'pengurus')
                    <th>Pemeriksaan</th>
                @endif
                <th>Respon Tilakes</th>
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
                        <td class="text-center">{{ ($periksa->currentPage() - 1) * $periksa->perPage() + $index + 1 }}</td>
                        <td class="text-center">
                            @if($item->tindakLanjut)
                                {{ \Carbon\Carbon::parse($item->tindakLanjut->created_at)->isoFormat('D MMMM Y') }}
                            @else
                                <span class="text-muted">-</span>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->role === 'pengawas')
                            <td class="text-wrap" style="max-width: 200px;">
                                <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                    {{ $item->koperasi->nama_koperasi ?? 'Data Belum Tersedia' }}
                                </div>
                            </td>
                            <td class="text-wrap" style="max-width: 180px;">
                                <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                    {{ $item->koperasi->kabupaten ?? 'Data Belum Tersedia' }}
                                </div>
                            </td>
                        @endif
                        <td class="text-wrap" style="max-width: 80px;">
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                {{ $item->user->name ?? 'Data Belum Tersedia' }}
                            </div>
                        </td>
                        <td class="text-center">
                            @if ($item->tindakLanjut)
                                @php
                                    $status = $item->tindakLanjut->status_tindaklanjut;
                                    $badgeClass = match($status) {
                                        'Ditindaklanjuti' => 'text-bg-success',
                                        'Direspon' => 'text-bg-primary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }}">{{ $status }}</span>
                            @else
                                <span class="badge text-bg-warning">Belum Ditindaklanjuti</span>
                            @endif
                        </td>
                        @if(Auth::check() && Auth::user()->role === 'pengurus')
                            <td class="text-center">
                                <a href="{{ route('lihatperiksa', $item->id_pemeriksaan) }}" class="btn btn-warning btn-sm">
                                    Cek
                                </a>
                                @if (!empty($item->file_ba))
                                    <a href="{{ asset('storage/' . $item->file_ba) }}" class="btn btn-info btn-sm" download>
                                        <i class="fas fa-download"></i></a>
                                @endif
                            </td>
                        @endif
                        <td class="text-center">
                            @if($item->tindakLanjut)
                                @if($item->tindakLanjut->status_tindaklanjut === 'Ditindaklanjuti')
                                    <span class="badge bg-secondary">Belum Diperiksa</span>
                                @elseif($item->tindakLanjut->status_tindaklanjut === 'Direspon')
                                    <a href="{{ route('lihatrespontl', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-warning btn-sm">
                                        Cek
                                    </a>
                                @endif
                            @else
                                <span class="badge bg-secondary">Belum Diperiksa</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if ($item->tindakLanjut)
                                <a href="{{ route('lihattindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                @if(Auth::check() && Auth::user()->role === 'pengurus')
                                    <a href="{{ route('edittindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-primary btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @php
                                        $status = $item->tindakLanjut->status_tindaklanjut ?? null;
                                    @endphp

                                    @if($status === 'Ditindaklanjuti')
                                        <a href="javascript:void(0);" onclick="confirmDelete('{{ route('hapustindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}')" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @endif
                                @endif
                                @if(Auth::check() && Auth::user()->role === 'pengawas')
                                    @php
                                        $status = $item->tindakLanjut->status_tindaklanjut ?? null;
                                    @endphp

                                    @if($status === 'Ditindaklanjuti')
                                        <a href="{{ route('respontindaklanjut', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-success btn-sm">
                                            <i class="fas fa-plus"></i>
                                        </a>
                                    @elseif($status === 'Direspon')
                                        <a href="{{ route('editrespontl', $item->tindakLanjut->id_tindaklanjut) }}" class="btn btn-primary btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    @endif
                                @endif
                            @else
                                @if(Auth::check() && Auth::user()->role === 'pengurus')
                                    <a href="{{ route('inputtindaklanjut', $item->id_pemeriksaan) }}" class="btn btn-success btn-sm">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                @else
                                    <span class="badge bg-secondary">Tidak Ada Aksi</span>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
