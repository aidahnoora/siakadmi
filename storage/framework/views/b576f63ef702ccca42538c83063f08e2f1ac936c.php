<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <li class="nav-item">
            <div class="btn-group" role="group">
                <a id="btnGroupDrop1" style="margin-right: 40px;" type="button" class="dropdown-toggle text-capitalize" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="nav-icon fas fa-user-circle"></i> &nbsp; <?php echo e(Auth::user()->name); ?>

                </a>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                    <?php if(Auth::user()->role != 'siswa'): ?>
                    <a class="dropdown-item" href="<?php echo e(route('profil')); ?>"><i class="nav-icon fas fa-user"></i> &nbsp; Profilku</a>
                    <?php endif; ?>
                    <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="nav-icon fas fa-sign-out-alt"></i> &nbsp; Log Out</a>
                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?>
                    </form>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <?php echo e(__('Logout')); ?>

                        </a>
                    </div>
                </div>
            </div>
        </li>
    </ul>
</nav>
<?php /**PATH C:\xampp\htdocs\siakad\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>