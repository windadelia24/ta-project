<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="icon" href="{{ asset('logo.png') }}" type="image/png">
  <title>Reset Password - Dinas Koperasi UKM</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/style.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<script>
    function togglePassword(inputId, iconId) {
      const passwordInput = document.getElementById(inputId);
      const eyeIcon = document.getElementById(iconId);
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
            <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" />
            <h1 class="title">DINAS KOPERASI, USAHA KECIL, DAN MENENGAH<br>PROVINSI SUMATERA BARAT</h1>
        </div>
      <h2 class="welcome">Reset Password</h2>
      <div class="login-box">
        <h2>Buat Password Baru</h2>
        <p class="reset-description">
            Masukkan password baru untuk akun {{ $email }}
        </p>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $item)
                        <li>{{$item}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="password-fields">
                <input type="password" placeholder="Password Baru" name="password" id="password" class="form-control" required>
                <span class="toggle-password" onclick="togglePassword('password', 'eyeIcon')">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </span>
            </div>

            <div class="password-wrapper">
                <input type="password" placeholder="Konfirmasi Password Baru" name="password_confirmation" id="password_confirmation" class="form-control" required>
                <span class="toggle-password" onclick="togglePassword('password_confirmation', 'eyeIcon2')">
                    <i id="eyeIcon2" class="fas fa-eye"></i>
                </span>
            </div>

            <button type="submit" class="btn-reset">
                <i class="fas fa-key"></i> Reset Password
            </button>
        </form>
        <div class="login-link">
            <p>Ingat password Anda? <a href="{{ route('login') }}">Silahkan Login</a></p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
