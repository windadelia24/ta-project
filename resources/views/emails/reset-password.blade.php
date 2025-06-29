<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Dinas Koperasi UKM</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            padding: 20px 0;
            border-bottom: 2px solid #007bff;
        }
        .header img {
            max-width: 80px;
            height: auto;
        }
        .header h1 {
            color: #007bff;
            margin: 10px 0;
            font-size: 18px;
        }
        .content {
            padding: 30px 0;
        }
        .button {
            display: inline-block;
            background-color: #007bff;
            color: white;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 5px;
            margin: 20px 0;
            font-weight: bold;
        }
        .button:hover {
            background-color: #0056b3;
        }
        .footer {
            border-top: 1px solid #eee;
            padding-top: 20px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ asset('logo.png') }}" alt="Logo">
            <h1>DINAS KOPERASI, USAHA KECIL, DAN MENENGAH<br>PROVINSI SUMATERA BARAT</h1>
        </div>

        <div class="content">
            <h2>Reset Password</h2>
            <p>Halo,</p>
            <p>Kami menerima permintaan untuk reset password akun Anda. Klik tombol di bawah ini untuk membuat password baru:</p>

            <div style="text-align: center;">
                <a href="{{ $url }}" class="button">Reset Password</a>
            </div>

            <div class="warning">
                <strong>Peringatan:</strong>
                <ul>
                    <li>Link ini hanya berlaku selama 60 menit</li>
                    <li>Jika Anda tidak meminta reset password, abaikan email ini</li>
                    <li>Jangan bagikan link ini kepada siapa pun</li>
                </ul>
            </div>

            <p>Jika tombol di atas tidak berfungsi, Anda dapat menyalin dan menempel URL berikut ke browser Anda:</p>
            <p style="word-break: break-all; background-color: #f8f9fa; padding: 10px; border-radius: 5px;">
                {{ $url }}
            </p>

            <p>Terima kasih,<br>
            Tim Dinas Koperasi UKM Provinsi Sumatera Barat</p>
        </div>

        <div class="footer">
            <p>&copy; 2024 Dinas Koperasi, Usaha Kecil, dan Menengah Provinsi Sumatera Barat</p>
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
