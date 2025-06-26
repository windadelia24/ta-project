<div class="sidebar" id="sidebar">
    <img src="{{ asset('logo.png') }}" alt="Logo" class="logo" />
    <ul class="menu">

        {{-- <li><a href="{{ route('admin') }}"><i class="fa-solid fa-house"></i> Beranda</a></li> --}}
        @if (Auth::check())
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
                    $route = '#'; // fallback jika role tidak terdefinisi
                }
            @endphp

            <li><a href="{{ $route }}"><i class="fa-solid fa-house"></i> Beranda</a></li>
        @endif

        {{-- Koperasi - hanya pengawas, kapeng, kadin, admin --}}
        @if (in_array(Auth::user()->role, ['pengawas', 'kabid', 'admin']))
            <li><a href="{{ route('listkoperasi') }}"><i class="fa-solid fa-handshake-simple"></i> Koperasi</a></li>
        @endif

        {{-- Pemeriksaan --}}
        @if (in_array(Auth::user()->role, ['pengawas', 'kabid', 'admin']))
             <li><a href="{{ route('listperiksa') }}"><i class="fa-solid fa-list-check"></i> Pemeriksaan</a></li>
        @endif

        {{-- Tindak Lanjut --}}
        <li><a href="{{ route('listtindaklanjut') }}"><i class="fa-solid fa-file-pen"></i> Tindak Lanjut</a></li>

        {{-- Pengaduan --}}
        <li>
            <a href="{{ route('listpengaduan') }}"><i class="fa-solid fa-circle-question"></i> Pengaduan</a>
        </li>

        {{-- Akun - hanya admin --}}
        @if (Auth::user()->role === 'admin')
            <li><a href="{{ route('listakun') }}"><i class="fa-solid fa-circle-user"></i> Akun</a></li>
        @endif

        {{-- Logout --}}
        <li><a href="/logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
    </ul>
</div>


