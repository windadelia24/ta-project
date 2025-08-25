<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email - Dinas Koperasi UKM Sumbar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo {
            max-width: 80px;
            height: auto;
        }
        .title {
            color: #2c5530;
            font-size: 18px;
            margin: 10px 0;
        }
        .button {
            display: inline-block;
            padding: 12px 30px;
            background-color: #297b81;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #225f65;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1 class="title">DINAS KOPERASI, USAHA KECIL, DAN MENENGAH<br>PROVINSI SUMATERA BARAT</h1>
        </div>

        <h2>Verifikasi Email Akun Anda</h2>

        <p>Halo {{ $user->name }},</p>

        <p>Terima kasih telah mendaftar di sistem Dinas Koperasi UKM Provinsi Sumatera Barat. Untuk mengaktifkan akun Anda, silahkan klik tombol verifikasi di bawah ini:</p>

        <div style="text-align: center;">
            <a href="{{ $verificationUrl }}" class="button">Verifikasi Email</a>
        </div>

        <p>Atau salin dan tempel tautan berikut ke browser Anda:</p>
        <p style="word-break: break-all; background: #f8f9fa; padding: 10px; border-radius: 5px;">
            {{ $verificationUrl }}
        </p>

        <div class="warning">
            <strong>Penting:</strong> Tautan verifikasi ini akan kedaluwarsa dalam 24 jam. Jika Anda tidak meminta verifikasi ini, abaikan email ini.
        </div>

        <p>Jika Anda mengalami masalah, silahkan hubungi administrator sistem.</p>

        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; 2024 Dinas Koperasi, Usaha Kecil, dan Menengah Provinsi Sumatera Barat</p>
        </div>
    </div>
</body>
</html>
