<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('../components/section-card'); ?>
	<div id="app-register">

	</div>
	<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('welcome.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>