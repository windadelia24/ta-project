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
<body>
  <div class="background">
    <div class="overlay"></div>
    <div class="content">
        <div class="header">
            <img src="logo.png" alt="Logo" class="logo" />
            <h1 class="title">DINAS KOPERASI, USAHA KECIL, DAN MENENGAH<br>PROVINSI SUMATERA BARAT</h1>
        </div>
      <h2 class="welcome">Reset Password</h2>
      <div class="login-box">
        <h2>Lupa Password?</h2>
        <p class="reset-description">
            Masukkan email Anda untuk menerima link reset password
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
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <input type="email" placeholder="Masukkan Email Anda" value="{{old('email')}}" name="email" class="form-control" required>
            <button type="submit" class="btn-reset">
                <i class="fas fa-paper-plane"></i> Kirim Link Reset Password
            </button>
        </form>
        <div class="login-link">
            <p>Ingat password Anda? <a href="{{ route('login') }}">Silahkan login</a></p>
        </div>
      </div>
    </div>
  </div>
  @if (session('success'))
  <script>
    Swal.fire({
        icon: 'success',
        title: 'Sukses!',
        text: '{{ session('success') }}',
        timer: 3000,
        showConfirmButton: false
    });
  </script>
  @endif
  @if (session('error'))
  <script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: '{{ session('error') }}',
        timer: 3000,
        showConfirmButton: false
    });
  </script>
  @endif
</body>
</html>
