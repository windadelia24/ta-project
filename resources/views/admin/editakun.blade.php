@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Edit Akun</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('updateakun', $users->nik_nip) }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="nama" class="form-label" style="font-weight: bold;">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" value="{{ $users->name }}" required>
        </div>
        <div class="mb-2">
            <label for="email" class="form-label" style="font-weight: bold;">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $users->email }}" required>
        </div>
        <div class="mb-2">
            <label for="role" class="form-label" style="font-weight: bold;">Role</label>
            <select class="form-control" id="role" name="role" required>
                <option value="" disabled hidden>Pilih Role</option>
                <option value="pengurus" {{ $users->role == 'pengurus' ? 'selected' : '' }}>Pengurus</option>
                <option value="pengawas" {{ $users->role == 'pengawas' ? 'selected' : '' }}>Pengawas</option>
                <option value="kadin" {{ $users->role == 'kadin' ? 'selected' : '' }}>Kadin</option>
                <option value="kapeng" {{ $users->role == 'kapeng' ? 'selected' : '' }}>Kapeng</option>
                <option value="admin" {{ $users->role == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label" style="font-weight: bold;">Password (Kosongkan jika tidak ingin diubah)</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password Baru">
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Update</button>
        </div>
    </form>
</div>
@endsection
