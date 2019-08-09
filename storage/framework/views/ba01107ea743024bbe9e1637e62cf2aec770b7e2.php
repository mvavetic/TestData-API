<countries>
<?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

   <country>
       <id><?php echo e($country->id); ?></id>
       <name><?php echo e($country->name); ?></name>
       <code><?php echo e($country->code); ?></code>
       <?php if($country->relationLoaded('cities')): ?>
       <?php $__currentLoopData = $country->cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
       <cities>
            <city>
                <name><?php echo e($city->name); ?></name>
            </city>
       </cities>
       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
       <?php endif; ?>
   </country>

<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</countries><?php /**PATH C:\contacts_api\resources\views/XML/country/list.blade.php ENDPATH**/ ?>