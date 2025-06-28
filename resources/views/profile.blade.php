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
        @php
            $user = Auth::user();
            if ($user->role === 'admin') {
                $route = route('admin');
            } elseif ($user->role === 'pengawas') {
                $route = route('pengawas');
            } elseif ($user->role === 'pengurus') {
                $route = route('pengurus');
            } elseif ($user->role === 'kabid') {
                $route = route('kabid');
            } else {
                $route = '#';
            }
        @endphp

        <a href="{{ $route }}" class="top-left flex items-center gap-1 user-link">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>

        <!-- Alert untuk error -->
        @if(session('error'))
        <div class="absolute top-16 left-1/2 transform -translate-x-1/2 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded w-full max-w-md z-10">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
        @endif

        @if(session('success'))
        <div class="absolute top-16 left-1/2 transform -translate-x-1/2 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded w-full max-w-md z-10">
            <strong class="font-bold">Berhasil!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
        @endif

        <!-- Single Form untuk semua data termasuk foto -->
        <form action="{{ route('updateprofile') }}" method="POST" enctype="multipart/form-data" class="w-full flex flex-col md:flex-row items-start gap-10">
            @csrf

            <!-- Profile Image -->
            <div class="flex flex-col items-center mx-auto mt-10">
                <div class="w-24 h-24 rounded-full border-4 border-green-700 overflow-hidden">
                    @if(Auth::user()->user_picture)
                        <img id="profilePreview" src="{{ asset('storage/user_picture/' . Auth::user()->user_picture) }}" alt="Profile Image" class="object-cover w-full h-full">
                    @else
                        <img id="profilePreview" src="{{ asset('profil.png') }}" alt="Profile Image" class="object-cover w-full h-full">
                    @endif
                </div>
                <div class="mt-3 flex flex-col items-center">
                    <label class="text-blue-600 cursor-pointer flex items-center gap-1">
                        <i class="fa-solid fa-pen"></i> Edit
                        <input type="file" name="photo" id="photoInput" class="hidden" accept="image/*" onchange="previewImage(this)">
                    </label>
                </div>
            </div>

            <!-- Profile Form -->
            <div class="flex-1 mt-10">
                <h1 class="text-3xl font-bold mb-6">My Profile</h1>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block mb-1 font-semibold">Nama</label>
                        <input type="text" name="name" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->name }}" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold">NIP/NIK</label>
                        <input type="text" name="nip" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->nik_nip }}" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold">Email</label>
                        <input type="email" name="email" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->email }}" required>
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold">No. Telepon</label>
                        <input type="text" name="no_telp" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->no_telp ?? '' }}">
                    </div>

                    <div>
                        <label class="block mb-1 font-semibold">Jabatan</label>
                        <input type="text" name="jabatan" class="w-full border rounded px-3 py-2" value="{{ Auth::user()->jabatan ?? '' }}">
                    </div>
                </div>

                <hr class="my-6 border-t-2 border-gray-300">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Password Lama -->
                    <div>
                        <label class="block mb-1 font-semibold">Password Lama</label>
                        <div class="relative">
                            <input type="password" name="current_password" id="current_password" class="w-full border rounded px-3 py-2 pr-10">
                            <span class="absolute right-3 top-2.5 text-gray-600 cursor-pointer" onclick="togglePassword('current_password', this)">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>

                    <!-- Password Baru -->
                    <div>
                        <label class="block mb-1 font-semibold">Password Baru</label>
                        <div class="relative">
                            <input type="password" name="new_password" id="new_password" class="w-full border rounded px-3 py-2 pr-10">
                            <span class="absolute right-3 top-2.5 text-gray-600 cursor-pointer" onclick="togglePassword('new_password', this)">
                                <i class="fa-solid fa-eye"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6">
                    <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600">Simpan</button>
                </div>
            </div>
        </form>
    </div>

</body>

<script>
    function previewImage(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                document.getElementById('profilePreview').src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
    function togglePassword(inputId, iconElement) {
        const input = document.getElementById(inputId);
        const icon = iconElement.querySelector('i');

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
</html>
