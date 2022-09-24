<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link text-center">
        <div class="image">
            <?php $__currentLoopData = $logo; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <img src="<?php echo e(Storage::url('public/logo/').$item->logo); ?>" class="brand-image img-circle elevation-3" alt="User Image">
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <span class="brand-text font-weight-light">SIAKAD MI NGLARAN 1</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
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
                            <a href="/sekolah" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Profil Sekolah</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<?php /**PATH C:\xampp\htdocs\siakad\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>