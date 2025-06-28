@extends('layout.navbar')

@section('content')
<div class="container">
    <h1 class="mb-3" style="font-weight: bold; font-size: 36px;">Tambah Akun</h1>

    @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    <form action="{{ route('createakun') }}" method="POST">
        @csrf
        <div class="mb-2">
            <label for="nama" class="form-label" style="font-weight: bold;">Nama</label>
            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama" required>
        </div>
        <div class="mb-2">
            <label for="nip" class="form-label" style="font-weight: bold;">NIP</label>
            <input type="text" class="form-control" id="nik_nip" name="nik_nip" placeholder="Masukkan NIP" required>
        </div>
        <div class="mb-2">
            <label for="email" class="form-label" style="font-weight: bold;">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" required>
        </div>
        <div class="mb-2">
            <label for="role" class="form-label" style="font-weight: bold;">Role</label>
            <div class="select-wrapper">
                <select class="form-control" id="role" name="role" required>
                    <option value="" disabled selected hidden>Pilih Role</option>
                    <option value="pengawas">Pengawas</option>
                    <option value="kabid">Kabid</option>
                    <option value="admin">Admin</option>
                </select>
                <i class="fas fa-caret-down form-control-icon"></i>
            </div>
        </div>
        <div class="mb-3 position-relative">
            <label for="password" class="form-label fw-bold">Password</label>
            <div class="input-group">
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                <span class="input-group-text" onclick="togglePassword()">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </span>
            </div>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary px-4">Simpan</button>
        </div>
    </form>
</div>
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<script>
    function togglePassword() {
      const passwordInput = document.getElementById('password');
      const eyeIcon = document.getElementById('eyeIcon');
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);

      if (type === 'text') {
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
      } else {
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
      }
    }
</script>
@endsection
