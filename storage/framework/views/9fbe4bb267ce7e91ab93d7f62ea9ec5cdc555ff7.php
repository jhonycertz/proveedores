<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('../components/section-card'); ?>
	<div id="app">
        <div class="container">
       

        </div>
	</div>
	<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>