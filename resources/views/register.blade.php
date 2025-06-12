<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Register - Dinas Koperasi UKM</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styleregis.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
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
<body>
  <div class="background">
    <div class="overlay"></div>
    <div class="content">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo" />
            <h1 class="title">DINAS KOPERASI, USAHA KECIL, DAN MENENGAH<br>PROVINSI SUMATERA BARAT</h1>
        </div>
      <div class="login-box">
        <h2>Register</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="" method="POST">
            @csrf
            <input type="text" placeholder="NIK" value="{{ old('nik') }}" name="nik" class="form-control">
            <input type="text" placeholder="Nama" value="{{ old('name') }}" name="name" class="form-control">
            <input type="email" placeholder="Email" value="{{ old('email') }}" name="email" class="form-control">
            <input type="text" placeholder="NIK (Nomor Induk Koperasi)" value="{{ old('nik_koperasi') }}" name="nik_koperasi" class="form-control">
            <div class="password-wrapper">
                <input type="password" placeholder="Password" name="password" id="password" class="form-control">
                <span class="toggle-password" onclick="togglePassword()">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                  </span>
            </div>
            <button type="submit">Daftar</button>
            <div class="register">
                <p>Sudah punya akun? <a href="{{ route('login') }}">Silahkan login</a></p>
            </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
