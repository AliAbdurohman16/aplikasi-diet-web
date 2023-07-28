<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content" data-simplebar style="height: calc(100% - 60px);">
        <div class="sidebar-brand">
            <a href="">Aplikasi Diet</a>
        </div>

        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}"><i class="uil uil-estate me-2"></i>Dashboard</a></li>
            <li><a href="{{ route('categories.index') }}"><i class="uil uil-apps me-2"></i>Kategori</a></li>
            <li><a href="{{ route('foods.index') }}"><i class="uil uil-utensils me-2"></i>Makanan</a></li>
            <li><a href="{{ route('drinks.index') }}"><i class="uil uil-coffee me-2"></i>Minuman</a></li>
            <li><a href="{{ route('drinks.index') }}"><i class="uil uil-dumbbell me-2"></i>Olahraga</a></li>
            <li><a href="{{ route('drinks.index') }}"><i class="uil uil-comments me-2"></i>Konsultasi</a></li>
            <li><a href="{{ route('users.index') }}"><i class="uil uil-users-alt me-2"></i>Pengguna</a></li>
            <li class="sidebar-dropdown">
                <a href="javascript:void(0)"><i class="uil uil-user me-2"></i>Akun</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{ route('profile.index') }}">Profil</a></li>
                        <li><a href="{{ route('change-password.index') }}">Ganti Kata Sandi</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
<!-- sidebar-wrapper  -->
