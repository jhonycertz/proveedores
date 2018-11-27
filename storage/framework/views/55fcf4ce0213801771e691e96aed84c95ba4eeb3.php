<!DOCTYPE html>
<html>
    <head>
        <title>Administracion de documentos </title>
        <meta charset="utf-8">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <link rel="dns-prefetch" href="//fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo e(asset(mix('css/welcome.css'))); ?>">
    </head>
    <body data-spy="scroll" data-target="#navbar" data-offset="30">
        <?php echo $__env->make('layouts.menu', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php echo $__env->yieldContent('content'); ?>
        <footer class="my-5 text-center">
            <p class="mb-2"><small> 4boot </small></p>
        </footer>
        <script src="<?php echo e(asset(mix('js/welcome.js'))); ?>"></script>
        <?php echo $__env->yieldContent('script'); ?>
    </body>
</html>
