<p>
La empresa esta interesada en que formes parte de nosotros!<br>
<br>
Ya forma parte del proceso de preselección.<br>
Hemos generado un usuario y una contraseña para que pueda acceder a nuestro sitio web e iniciar con la carga de los documentos para iniciar con la siguiente fase.<br>
<br>
Usuario: <?php echo e($data->id); ?><br>
Contraseña: <?php echo e($data->password); ?><br>
<br>
Tenga en cuenta que dependiento del puesto al cual aspire debe ingresar dentro de nuestro sistema los documentos del tipo que aplique, entre estos podrán ser docuimentos de tipo:
<br>
<?php $__currentLoopData = $data->requeriments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $requeriment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<ul>
    <li><?php echo e($requeriment->type); ?></li><br>
</ul>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<br>
<br>
Este usuario fue generado de manera temporal, por lo cual le recomendamos cargar su información en nuestra plataforma en un lapso no mayor a 30 días.</p>
