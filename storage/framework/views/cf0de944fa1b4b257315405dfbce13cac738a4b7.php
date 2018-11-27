<?php $__env->startComponent('../components/nav-menu'); ?>
	<nav class="navbar navbar-dark navbar-expand-lg">
		<a class="navbar-brand" href="<?php echo e(route('home')); ?>">
			<img src="<?php echo e(asset('images/logo.png')); ?>" class="img-fluid" alt="logo">
		</a>
		<button class="navbar-toggler" 
			type="button" 
			data-toggle="collapse" 
			data-target="#navbar" 
			aria-controls="navbar" 
			aria-expanded="false" 
			aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbar">
			<ul class="navbar-nav ml-auto">
 				<li class="nav-item"> <a class="nav-link" href="<?php echo e(route('home-alertas')); ?>">NOTIFICACIONES E INCIDENCIAS</a> </li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo e(route('home-preguntas')); ?>">PREGUNTAS</a> </li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo e(route('home-registrar-documento')); ?>">REGISTRAR DOCUMENTO</a> </li>
				<li class="nav-item"> <a class="nav-link" href="<?php echo e(route('home-documento')); ?>">DOCUMENTOS REGISTRADOS</a> </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" 
                      data-toggle="dropdown" aria-haspopup="true"><?php echo e(Auth::guard('client')->user()->company->name); ?><span class="caret"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <?php echo e(__('cerrar sesiòn')); ?>

                        </a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>
                    </div>
                </li>
			</ul>
		</div>
	</nav>
<?php echo $__env->renderComponent(); ?>





