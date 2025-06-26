<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        .user-link {
            color: black;
        }

        .user-link:hover {
            text-decoration: underline;
        }

        .top-left {
            position: absolute;
            top: 20px;
            left: 35px;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen flex items-center justify-center relative">

    <div class="bg-white p-8 rounded shadow-md w-full max-w-4xl flex flex-col md:flex-row items-start gap-10 relative">

        <!-- Back Button -->
        <button onclick="history.back()" class="top-left flex items-center gap-1 user-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </button>

        <!-- Profile Image -->
        <div class="flex flex-col items-center mx-auto mt-10"> <!-- Tambahkan jarak atas -->
            <div class="w-24 h-24 rounded-full border-4 border-green-700 overflow-hidden">
                {{-- <img src="{{ asset('storage/profile/' . Auth::user()->photo) }}" alt="Profile Image" class="object-cover w-full h-full"> --}}
                <img src="{{ asset('profil.png') }}" alt="Profile Image" class="object-cover w-full h-full">
            </div>
            {{-- {{ route('profile.updatePhoto') }} --}}
            <form action="" method="POST" enctype="multipart/form-data" class="mt-3 flex flex-col items-center">
                @csrf
                @method('PUT')
                <label class="text-blue-600 cursor-pointer flex items-center gap-1">
                    <i class="fa-solid fa-pen"></i> Edit
                    <input type="file" name="photo" class="hidden" onchange="this.form.submit()">
                </label>
            </form>
        </div>

        <!-- Profile Form -->
        <div class="flex-1 mt-10"> <!-- Tambahkan jarak atas -->
            <h1 class="text-3xl font-bold mb-6">My Profile</h1>
            {{-- {{ route('profile.update') }} --}}
            <form action="" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Nama</label>
                    <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">NIP/NIK</label>
                    <input type="text" name="nip" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->nik_nip }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->email }}" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Password Lama</label>
                    <input type="password" name="current_password" class="w-full border rounded px-3 py-2">
                </div>

                <div class="mb-4">
                    <label class="block mb-1 font-semibold">Password Baru</label>
                    <input type="password" name="new_password" class="w-full border rounded px-3 py-2">
                </div>

                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Simpan</button>
            </form>
        </div>
    </div>

</body>

</html>
