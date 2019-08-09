<people>

<?php $__currentLoopData = $people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $person): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

<person>
    <id><?php echo e($person->id); ?></id>
    <first_name><?php echo e($person->first_name); ?></first_name>
    <last_name><?php echo e($person->last_name); ?></last_name>
    <nickname><?php echo e($person->nickname); ?></nickname>
    <birth_date><?php echo e($person->birth_date); ?></birth_date>
    <?php if($person->relationLoaded('country')): ?>
    <country>
        <name><?php echo e($person->country->name); ?></name>
    </country>
    <?php endif; ?>
    <?php if($person->relationLoaded('sport')): ?>
    <sport>
        <name><?php echo e($person->sport->name); ?></name>
    </sport>
    <?php endif; ?>
</person>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

</people><?php /**PATH C:\contacts_api\resources\views/XML/people/list.blade.php ENDPATH**/ ?>