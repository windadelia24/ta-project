<div class="table-responsive">
    <table class="table table-bordered">
        <thead class="table-success text-center">
            <tr>
                <th>No.</th>
                <th>Nama</th>
                <th>Email</th>
                <th>NIP</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if($users->isEmpty())
            <tr>
                <td colspan="6" class="text-center">Belum ada data yang tersedia.</td>
            </tr>
            @endif
            @foreach($users as $index => $user)
            <tr>
                <td class="text-center">{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->nik_nip }}</td>
                <td>{{ $user->role }}</td>
                <td class="text-center">
                    <a href="{{ route('editakun', $user->nik_nip) }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="javascript:void(0);" onclick="confirmDelete('{{ route('hapusakun', $user->nik_nip) }}')" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
