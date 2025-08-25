<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Verifikasi Email - Dinas Koperasi UKM</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/styleregis.css') }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
  <div class="background">
    <div class="overlay"></div>
    <div class="content">
        <div class="header">
           <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" />
            <h1 class="title">DINAS KOPERASI, USAHA KECIL, DAN MENENGAH<br>PROVINSI SUMATERA BARAT</h1>
        </div>
      <div class="login-box">
        <h2>Verifikasi Email Diperlukan</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <p class="verification-message">
            Selamat! Akun Anda telah berhasil dibuat. Untuk mengaktifkan akun, silahkan verifikasi email Anda terlebih dahulu.
        </p>

        <div class="email-info">
            <strong>Email verifikasi telah dikirim ke: </strong>{{ session('email') ?? 'alamat email Anda' }}
        </div>

        <div class="steps">
            <div class="step-row">
                <div class="step">
                    <span class="step-number">1.</span> Buka email Anda
                </div>
                <div class="step">
                    <span class="step-number">2.</span> Cari email dari Dinas Koperasi UKM
                </div>
                <div class="step">
                    <span class="step-number">3.</span> Klik tombol "Verifikasi Email"
                </div>
                <div class="step">
                    <span class="step-number">4.</span> Login ke sistem
                </div>
            </div>
        </div>

        <div class="resend-section">
            <p>Tidak menerima email?</p>
            <form action="{{ route('verification.resend') }}" method="POST">
                @csrf
                <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda" required>
                <button type="submit">Kirim Ulang Email</button>
            </form>
        </div>

        <div class="back-to-login">
            <a href="{{ route('login') }}" class="btn-secondary">Kembali ke Login</a>
        </div>

        <p class="help-text">
            Jika Anda mengalami masalah, silahkan hubungi administrator sistem.
        </p>
      </div>
    </div>
  </div>

  <style>
    /* Additional styles for verification page */

    .login-box {
        background: white;
        padding: 40px;
        border-radius: 15px;
        width: 900px;
        max-width: 90%;
        margin: 80px auto 0 auto;;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    .verification-message {
        color: #333;
        font-size: 16px;
        line-height: 1;
        margin-bottom: 10px;
        text-align: center;
    }

    .email-info {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 10px;
        margin: 20px 0;
        border-left: 4px solid #4CAF50;
        text-align: center;
    }

    .steps {
        text-align: left;
        margin: 10px 0;
    }

    .step-row {
        display: flex;
        gap: 15px;
    }

    .step-column {
        flex: 1;
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .step {
        padding: 10px;
        background: #f8f9fa;
        border-radius: 5px;
        border-left: 3px solid #4CAF50;
        font-size: 14px;
    }

    .step-number {
        font-weight: bold;
        color: #4CAF50;
    }

    .resend-section {
        margin-top: 10px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        text-align: center;
    }

    .resend-section p {
        margin-bottom: 15px;
        color: #666;
        font-size: 14px;
    }

    .resend-section .form-control {
        width: 50%;
        margin: 0 auto 15px auto;
        display: block;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 14px;
    }

    .resend-section button {
        width: 50%;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: all 0.3s;
    }

    .back-to-login {
        margin-top: 10px;
        text-align: center;
    }

    .btn-secondary {
        background: #6c757d;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        cursor: pointer;
        transition: all 0.3s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-secondary:hover {
        background: #5a6268;
        transform: translateY(-2px);
    }

    .alert {
        padding: 15px;
        margin-bottom: 10px;
        border-radius: 8px;
    }

    .alert-success {
        background-color: #d4edda;
        border: 1px solid #c3e6cb;
        color: #155724;
    }

    .alert-danger {
        background-color: #f8d7da;
        border: 1px solid #f5c6cb;
        color: #721c24;
    }

    .help-text {
        font-size: 12px;
        color: #666;
        margin-top: 10px;
        text-align: center;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .verification-icon {
            font-size: 40px;
        }

        .step {
            font-size: 12px;
        }

        .email-info {
            padding: 10px;
        }
    }
  </style>
</body>
</html>
