<!doctype html>
<html lang="en">
  <head>
    <title>Luxo-<?php echo $__env->yieldContent('title'); ?> </title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

   <link rel="stylesheet" href="<?php echo e(asset(mix('css/admin.css'))); ?>">
   <link rel="stylesheet" href="<?php echo e(asset(mix('css/animate.min.css'))); ?>">

  </head>

  <body>

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Plugins JS -->
    <script src="<?php echo e(asset(mix('js/admin.js'))); ?>" type="text/javascript"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
  </body>
</html>
