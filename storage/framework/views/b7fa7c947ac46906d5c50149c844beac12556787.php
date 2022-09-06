<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $__env->yieldContent('title'); ?> - SIAKAD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/plugins/fontawesome-free/css/all.min.css')); ?>">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(asset('AdminLTE/dist/css/adminlte.min.css')); ?>">

  <?php echo $__env->yieldContent('css'); ?>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
  <?php echo $__env->make('layouts.navbar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php echo $__env->make('layouts.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php echo $__env->yieldContent('breadcrumbs'); ?>
    <!-- /.content-header -->

    <!-- Main content -->
    <?php echo $__env->yieldContent('content'); ?>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <?php echo $__env->make('layouts.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo e(asset('AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('AdminLTE/dist/js/adminlte.min.js')); ?>"></script>

<?php echo $__env->yieldContent('js'); ?>

</body>
</html>
<?php /**PATH C:\xampp\htdocs\siakad\resources\views/layouts/main.blade.php ENDPATH**/ ?>