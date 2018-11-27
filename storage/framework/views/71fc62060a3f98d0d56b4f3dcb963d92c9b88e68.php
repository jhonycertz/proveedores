<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('../components/section-card'); ?>
	<div id="app">
		<div class="container" style="padding: 1rem;">
		<?php
			$user = Auth::user();
			$news = App\Document::where('owner_id', $user->id)
						->orderBy('updated_at', 'desc')
						->with('requeriment', 'incidences')
						->take(20)
						->get();
			/*$incidences = App\Incidence::where('user_id', $user->id)
						->orderBy('updated_at', 'desc')
						->with('incidenceType')
						->take(15)
						->get();
			$incidences->load(['document' => function($q) {
                         	$q->with('requeriment');
                   	}]);*/
			$quantNews = count($news);
			//$quantInci = count($incidences);
		?>
			<div class="panel panel-info">
			<div class="row">
				<div class="col-md-12">
				<div class="panel-heading">
					<h4>Notificaciones sobre sus documentos</h4>
				</div>
				<div class="panel-body">
				<table class="table">
					<thead class="thead-light">
						<tr>
							<th scope="col">Requerimiento</th>
							<th scope="col">Archivo</th>
							<th scope="col">Status</th>
							<th scope="col">Incidencia</th>
							<th scope="col">Fecha</th>
						</tr>
					</thead>
					<tbody>
						<?php if($quantNews > 0): ?>
							<?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $new): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<?php if($new->status == 'PENDIENTE'): ?>
									<tr>
										<td><?php echo e($new->requeriment->name); ?></td>
										<td><a href="/<?php echo e($new->file_path); ?>" target="_blank"><?php echo e($new->name); ?></a></td>
										<td><?php echo e(ucwords($new->status)); ?></td>
										<?php if(count($new->incidences) >= 1): ?>
											<td><?php echo e($new->incidences[0]->description); ?></td>
										<?php else: ?>
											<td></td>
										<?php endif; ?>
										<td><?php echo e($new->updated_at); ?></td>
									</tr>		
								<?php elseif($new->status == 'ACEPTADO'): ?>
									<tr class="alert alert-success">
										<td><?php echo e($new->requeriment->name); ?></td>
										<td><a href="/<?php echo e($new->file_path); ?>" target="_blank"><?php echo e($new->name); ?></a></td>
										<td><?php echo e(ucwords($new->status)); ?></td>
										<?php if(count($new->incidences) >= 1): ?>
											<td><?php echo e($new->incidences[0]->description); ?></td>
										<?php else: ?>
											<td></td>
										<?php endif; ?>
										<td><?php echo e($new->updated_at); ?></td>
									</tr>			
								<?php else: ?>
									<tr class="alert alert-warning" style="background-color: #f8d7da">
										<td><?php echo e($new->requeriment->name); ?></td>
										<td><a href="/<?php echo e($new->file_path); ?>" target="_blank"><?php echo e($new->name); ?></a></td>
										<td><?php echo e(ucwords($new->status)); ?></td>
										<?php if(count($new->incidences) >= 1): ?>
											<td><?php echo e($new->incidences[0]->description); ?></td>
										<?php else: ?>
											<td></td>
										<?php endif; ?>
										<td><?php echo e($new->updated_at); ?></td>
									</tr>		
								<?php endif; ?>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						<?php else: ?>
							No posee notificaciones. Por favor inicie con la carga de documentos.
						<?php endif; ?>
					</tbody>
				</table>
				</div>
				</div>
				
			</div>
			</div>
		</div>
	</div>
	</div>
	<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>