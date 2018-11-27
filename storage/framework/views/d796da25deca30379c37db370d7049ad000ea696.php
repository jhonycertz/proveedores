<p>
    Tiene una nueva cita para entregar sus documentos.<br>
    <br>
    La cita será el día: <?php echo e($data->date); ?><br>
    <br>
    Su entrevista será con <?php echo e($data->attendant); ?><br>
    <br>
    Si desea realizar algún cambio en la fecha de su cita o realizar preguntas notifiqueselo a su encargado a través de la dirección de correo electronico 
    <?php echo e($data->attendant_mail); ?> o por el número de telefono <?php echo e($data->attendant_phone); ?>.
    <br>
    <br>
    Lo esperamos en la fecha pautada.
    <br>
    <br>
    <small>Best Regards, 4boot.</small>
</p>