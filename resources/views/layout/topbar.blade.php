<div class="topbar">
    <button id="toggle-sidebar" class="btn btn-light d-md-none me-auto">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="user-info relative dropdown">
        <span>{{ Auth::user()->email }}</span>
        <img src="{{ Auth::user()->user_picture ? asset('storage/user_picture/' . Auth::user()->user_picture) : asset('profil.png') }}"
        alt="User"
        class="user-pic cursor-pointer hover:opacity-80 transition dropdown-toggle"
        data-bs-toggle="dropdown"
        aria-expanded="false" />
        <!-- Dropdown Menu -->
        <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="{{ route('profile') }}">Profile</a></li>
            <li><a class="dropdown-item" href="/logout">Logout</a></li>
        </ul>
    </div>
</div>
