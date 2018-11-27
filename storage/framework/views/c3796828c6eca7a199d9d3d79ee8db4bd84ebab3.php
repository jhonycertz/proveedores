<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('../components/section-card'); ?>
	<div id="app">
		<div class="container">
			
                <h4 style="margin-top: 12px;">Documentos registrados</h4>
			<div class="row pt-3">
				<div class="col-5">
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div style="margin: 1em !important">
							<a class="nav-link <?php if($document->status == 'PENDIENTE'): ?> 
										alert-info
									<?php elseif($document->status == 'RECHAZADO'): ?> 
										alert-danger
									<?php else: ?>
										alert-success
									<?php endif; ?>" 
								id="v-pills-home-tab" 
								data-toggle="pill" 
								href="/<?php echo e($document->file_path); ?>" 
								role="tab" 
								aria-controls="<?php echo e($document->requeriment->id); ?>-pills" 
								aria-selected="false"><?php if($document->status == 'PENDIENTE'): ?> 
										<small><i class="fa fa-exclamation" aria-hidden="true"></i>&nbsp;Pendiente</small>
									<?php elseif($document->status == 'RECHAZADO'): ?> 
										<small><i class="fa fa-times" aria-hidden="true"></i>&nbsp;Rechazado</small>
									<?php else: ?>
										<small><i class="fa fa-check" aria-hidden="true"></i>&nbsp;Aceptado</small>
									<?php endif; ?> 
									<br>
									<?php echo e($document->requeriment->name); ?>&nbsp; <a href="/<?php echo e($document->file_path); ?>"><i class="fa fa-file-pdf-o fa-2x"> </i></a></a>
								
						</div>	
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
				</div>
				<div class="col-7">
					<div class="tab-content p-0" id="v-pills-tabContent">
					<?php $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $document): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<div class="tab-pane fade <?php if($loop->first): ?> active show <?php endif; ?>" 
						id="<?php echo e($document->requeriment->id); ?>-pills" role="tabpanel" aria-labelledby="<?php echo e($document->requeriment->id); ?>-pills">
						<embed width="100%" height="500px" type="application/pdf" internalinstanceid="5" src="<?php echo e(asset(Storage::url($document->file_path))); ?>">
						</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</div>
			  </div>
			</div>
		</div>
	</div>
	<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>