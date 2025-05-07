<?php $__env->startComponent('mail::message'); ?>
# FloodRescue Authentication

<?php if(isset($user) && is_object($user)): ?>
Hello <?php echo e($user->name); ?>,
<?php else: ?>
Hello,
<?php endif; ?>

Your two-factor authentication code is:

<?php $__env->startComponent('mail::panel'); ?>
<?php if(isset($user) && is_object($user)): ?>
<?php echo e($user->two_factor_code); ?>

<?php endif; ?>
<?php echo $__env->renderComponent(); ?>

This code will expire in 10 minutes.

If you didn't request this code, please ignore this email.

Thanks,<br>
<?php echo e(config('app.name')); ?>

<?php echo $__env->renderComponent(); ?><?php /**PATH C:\Users\Asus\Documents\GitHub\SI4609-KEL4\LaravelPPLKel4\resources\views/emails/auth/two-factor-code.blade.php ENDPATH**/ ?>