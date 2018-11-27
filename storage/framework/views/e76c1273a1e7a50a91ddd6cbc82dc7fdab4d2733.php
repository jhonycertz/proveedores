<?php $__env->startSection('content'); ?>
	<?php $__env->startComponent('../components/section-card'); ?>
    <?php
        $user = Auth::user();
        $uploadedDocuments = App\Document::where('owner_id', $user->id)->get();
        $requeriments = json_encode($requeriments);
        $requeriments = json_decode($requeriments);
        foreach ($requeriments as $key => $requeriment) {
            foreach($uploadedDocuments as $k => $document){
                if($document->requeriment_id == $requeriment->id && $document->status != 'RECHAZADO'){
                   unset($requeriments[$key]);
                }
            }
        }
        /*foreach($company->companyType->requeriments as $i => $rq){
            foreach($uploadedDocuments as $j => $doc){
                if($doc->requeriment_id == $rq->id && $doc->status == 'PENDIENTE'){
                    $rq->status = 1;
                }elseif($doc->requeriment_id == $rq->id && $doc->status == 'ACEPTADO'){
                    $rq->status = 2;
                    dd(json_encode($company->companyType->requeriments));
                }elseif($doc->requeriment_id == $rq->id && $doc->status == 'RECHAZADO'){
                    $rq->status = 3;
                }else{
                    $rq->status = 4;
                }
            }
        }*/
    ?>
	<div id="app">
        <div class="container">
            <div class="card-body row">
                <div class="col-md-7">
                <form method="POST"  action="<?php echo e(route('home-registrar-documento')); ?>" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                    <div class="col">
                            <label class="col-form-label" for="requeriment_id">Requerimientos faltantes</label>
                            <select id="requeriment_id" class="custom-select" name="requeriment_id">
                                <?php $__currentLoopData = $requeriments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($value->id); ?>">
                                        <?php echo e($value->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col">
                            <label class="col-form-label" for="requeriment_id"> Documento PDF </label>
		    	            <input type="file"  class="custom-select" name="file" accept="application/pdf" required>
                        </div>
                    </div>
                    <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                Guardar
                            </button>
                    </div>
                </form>

                <?php if(count($errors) > 0): ?>
                    <div class="error">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                </div>
                <div class="col-md-5">
                <div class="pt-2">
                    <p> <strong> Estas optando por el puesto </strong> <?php echo e($company->companyType->type); ?> </p>
                    <p> Los Requisitos son los siguientes </p>
                    <div class="list-group">
                        <?php $__currentLoopData = $company->companyType->requeriments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requeriment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="javascript:void(0)" class="list-group-item list-group-item-action flex-column align-items-start">
                        <div class="d-flex w-100 justify-content-between">
                            <p class="mb-1">
                                <?php echo e($requeriment->code); ?> - <?php echo e($requeriment->name); ?>

                            </p>
                            <small class="text-muted"<?php echo e($requeriment->require); ?>> 
                               
                            </small>
                        </div>
                        </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                </div>
            </div>
        </div>
	</div>
	<?php echo $__env->renderComponent(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>