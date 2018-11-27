<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('../components/section-card'); ?>
	<div id="app">
        <div class="container">
            <div class="card-body pm-2">
                <form method="POST"  action="<?php echo e(route('home-preguntas')); ?>" >
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <textarea type="text" class="form-control" id="question" name="question" placeholder="Escribe tu pregunta aquì" required></textarea>
                    </div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                    </div>
                </form>
                <div class="list-group">
                    <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div href="#" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                        <h5 class="mb-1"></h5>
                        <small><?php echo e($question->created_at->format('d/m/Y h:m A')); ?></small>
                        </div>
                        <p class="mb-1"><strong>Pregunta :</strong> <?php echo e($question->question); ?></p>
                        <?php if( $question->status == 'pendiente' ): ?>
                            <small class="badge badge-info pm-3"><?php echo e($question->status); ?> </small>
                        <?php else: ?>
                            <p class="mb-1"><strong> Respuesta :</strong> <?php echo e($question->reply->reply); ?></p>
                            <small class="badge badge-info pm-3"><?php echo e($question->status); ?> </small>
                        <?php endif; ?> 
                    </div>     
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <div class="mt-2 pm-2">
                        <?php echo e($questions->links()); ?>

                    </div>
                </div>
            </div>
        </div>
	</div>
	<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>