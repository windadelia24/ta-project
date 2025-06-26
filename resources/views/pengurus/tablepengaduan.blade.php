<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Tanggal Pengaduan</th>
                @if(Auth::user()->role != 'pengurus')
                    <th>Nama Koperasi</th>
                    <th>Kota/Kabupaten</th>
                @endif
                <th>Kendala</th>
                <th>Respon</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($pengaduan->isEmpty())
                <tr>
                    <td colspan="5" class="text-center">Belum ada data yang tersedia.</td>
                </tr>
            @else
                @foreach($pengaduan as $index => $item)
                @php
                    $respon = $item->responPengaduan->first();
                @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->tanggal_pengaduan)->isoFormat('D MMMM Y') }}</td>
                        @if(Auth::user()->role != 'pengurus')
                            <td class="text-wrap" style="max-width: 200px;">
                                <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                    {{ $item->koperasi->nama_koperasi ?? 'Data Belum Tersedia' }}
                                </div>
                            </td>
                            <td class="text-center">{{ $item->koperasi->kabupaten ?? 'Data Belum Tersedia' }}</td>
                        @endif
                        <td class="text-wrap" style="max-width: 300px;">
                            <div style="overflow: hidden; text-overflow: ellipsis; display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical;">
                                {{ $item->kendala }}
                            </div>
                        </td>
                        <td class="text-center">
                            @if(strtolower($item->status_pengaduan) == 'diajukan')
                                <span class="badge bg-warning text-dark">Belum Ada Respon</span>
                            @elseif(strtolower($item->status_pengaduan) == 'direspon')
                                <button type="button" class="badge bg-warning text-dark border-0" data-bs-toggle="modal" data-bs-target="#modalCek{{ $item->id_pengaduan }}">
                                    Cek
                                </button>
                            @endif
                        </td>
                        <td class="text-center">

                            {{-- Tombol Eye Pengaduan, selalu ada --}}
                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#lihatModal{{ $item->id_pengaduan }}">
                                <i class="fas fa-eye"></i>
                            </button>

                            {{-- Tombol khusus untuk pengurus --}}
                            @if(Auth::user()->role == 'pengurus')
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $item->id_pengaduan }}">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('hapuspengaduan', $item->id_pengaduan) }}')">
                                    <i class="fas fa-trash"></i>
                                </button>

                            {{-- Tombol khusus untuk pengawas --}}
                            @elseif(Auth::user()->role == 'pengawas')
                                {{-- Tambah Respon --}}
                                @if(strtolower($item->status_pengaduan) == 'diajukan')
                                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modalRespon{{ $item->id_pengaduan }}">
                                        <i class="fas fa-plus"></i>
                                    </button>
                                @endif

                                @if(strtolower($item->status_pengaduan) == 'direspon')
                                    {{-- Edit Respon --}}
                                    @if($respon)
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit{{ $item->id_pengaduan }}">
                                            <i class="fas fa-edit"></i>
                                        </button>

                                        <button type="button" class="btn btn-danger btn-sm" onclick="confirmDelete('{{ route('hapusrespon', $respon->id_respon) }}')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    @endif
                                @endif
                            @endif
                        </td>
                    </tr>

                    <div class="modal fade" id="editModal{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="editModalLabel{{ $item->id_pengaduan }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <form action="{{ route('updatepengaduan', $item->id_pengaduan) }}" method="POST">
                                    @csrf
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $item->id_pengaduan }}">Edit Pengaduan</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="kendala{{ $item->id_pengaduan }}" class="form-label">Kendala</label>
                                            <textarea class="form-control" id="kendala{{ $item->id_pengaduan }}" name="kendala" rows="3" required>{{ $item->kendala }}</textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Lihat -->
                    <div class="modal fade" id="lihatModal{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="lihatModalLabel{{ $item->id_pengaduan }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="lihatModalLabel{{ $item->id_pengaduan }}">Detail Pengaduan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">

                                    @if(Auth::user()->role != 'pengurus')
                                        <div class="mb-3">
                                            <label class="form-label">Nama Koperasi</label>
                                            <input type="text" class="form-control" value="{{ $item->koperasi->nama_koperasi ?? 'Tidak Diketahui' }}" readonly>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Kota/Kabupaten</label>
                                            <input type="text" class="form-control" value="{{ $item->koperasi->kabupaten ?? 'Tidak Diketahui' }}" readonly>
                                        </div>
                                    @endif

                                    <!-- Kendala -->
                                    <div class="mb-3">
                                        <label class="form-label">Kendala</label>
                                        <textarea class="form-control" rows="4" readonly>{{ $item->kendala }}</textarea>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="modalRespon{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="modalResponLabel{{ $item->id_pengaduan }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <form action="{{ route('inputrespon') }}" method="POST">
                                @csrf
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalResponLabel{{ $item->id_pengaduan }}">Tambah Respon</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="hidden" name="id_pengaduan" value="{{ $item->id_pengaduan }}">
                                        <div class="mb-3">
                                            <label for="respon" class="form-label">Respon</label>
                                            <textarea name="respon" class="form-control" rows="4" required></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="modalCek{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="modalCekLabel{{ $item->id_pengaduan }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalCekLabel{{ $item->id_pengaduan }}">Detail Respon</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @php
                                    $respon = $item->responPengaduan->first();
                                @endphp

                                @if($respon)
                                    <p><strong>Nama Responder:</strong> {{ $respon->nama_responder }}</p>
                                    <p><strong>Respon:</strong> {{ $respon->respon }}</p>
                                @else
                                    <p>Respon tidak ditemukan.</p>
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                            </div>
                        </div>
                    </div>
                    </div>

                    <div class="modal fade" id="modalEdit{{ $item->id_pengaduan }}" tabindex="-1" aria-labelledby="modalEditLabel{{ $item->id_pengaduan }}" aria-hidden="true">
                        <div class="modal-dialog">
                            @if($respon)
                                <form action="{{ route('editrespon', $respon->id_respon ) }}" method="POST">
                                    @csrf
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalEditLabel{{ $item->id_pengaduan }}">Edit Respon</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="respon" class="form-label">Respon</label>
                                                <textarea name="respon" class="form-control" rows="4" required>{{ $respon->respon }}</textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="modalEditLabel{{ $item->id_pengaduan }}">Edit Respon</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Respon tidak ditemukan.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Tutup</button>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            @endif
        </tbody>
    </table>
</div>
