<people>

<?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<person>
    <id><?php echo e($person->id); ?></id>
    <first_name><?php echo e($person->first_name); ?></first_name>
    <last_name><?php echo e($person->last_name); ?></last_name>
    <nickname><?php echo e($person->nickname); ?></nickname>
    <birth_date><?php echo e($person->birth_date); ?></birth_date>
</person>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</people><?php /**PATH C:\contacts_api\resources\views/xml.blade.php ENDPATH**/ ?>