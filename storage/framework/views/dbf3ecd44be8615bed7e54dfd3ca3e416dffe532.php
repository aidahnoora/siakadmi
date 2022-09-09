<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link text-center">
        <span class="brand-text font-weight-light">SIAKAD MI NGLARAN 1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo e(asset('AdminLTE/dist/img/profile.jpg')); ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Selamat Datang <?php echo e(Auth::user()->name); ?>!</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/home" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Home
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>
                            Data Master
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/guru" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Guru</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/kelas" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Kelas</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/siswa" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Siswa</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/mapel" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Mata Pelajaran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="/jadwal" class="nav-link">
                        <i class="nav-icon fas fa-calendar-week"></i>
                        <p>Jadwal</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/absensi" class="nav-link">
                        <i class="nav-icon fas fa-bell"></i>
                        <p>Absensi</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="/nilai" class="nav-link">
                        <i class="nav-icon fas fa-trophy"></i>
                        <p>Nilai Siswa</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>Setting
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/user" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/profil_sekolah" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profil Sekolah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/profilku" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profilku</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo e(route('logout')); ?>"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>Logout</p>
                    </a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none">
                        <?php echo csrf_field(); ?>
                    </form>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\siakad\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>