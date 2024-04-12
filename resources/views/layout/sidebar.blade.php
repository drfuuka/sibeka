<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            SIBEKA</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ active_class(['/']) }}">
                <a href="{{ url('/') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            @if (Auth::user()->role !== 'Siswa')
                <li class="nav-item {{ request()->is('siswa*') || request()->is('guru*') ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#pengguna" role="button"
                        aria-expanded="{{ request()->is('siswa*') || request()->is('guru*') ? true : false }}"
                        aria-controls="pengguna">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Pengguna</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="collapse {{ request()->is('siswa*') || request()->is('guru*') ? 'show' : '' }}"
                        id="pengguna">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('siswa.index') }}"
                                    class="nav-link {{ active_class(['siswa']) }}">Siswa</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('guru.index') }}"
                                    class="nav-link {{ active_class(['guru']) }}">Guru</a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endif

            <li class="nav-item {{ request()->is('pelanggaran*') ? 'active' : '' }}">
                <a href="{{ url('/pelanggaran') }}" class="nav-link">
                    <i class="link-icon" data-feather="alert-octagon"></i>
                    <span class="link-title">Pelanggaran</span>
                </a>
            </li>

            <li class="nav-item {{ request()->is('bimbingan*') ? 'active' : '' }}">
                <a href="{{ url('/bimbingan') }}" class="nav-link">
                    <i class="link-icon" data-feather="book-open"></i>
                    <span class="link-title">Bimbingan</span>
                </a>
            </li>

        </ul>
    </div>
</nav>
