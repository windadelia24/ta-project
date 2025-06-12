<div class="topbar">
    <button id="toggle-sidebar" class="btn btn-light d-md-none me-auto">
        <i class="fa-solid fa-bars"></i>
    </button>
    <div class="user-info">
        <span>{{ Auth::user()->email }}</span>
        <img src="{{ asset('profil.png') }}" alt="User" class="user-pic" />
    </div>
</div>
