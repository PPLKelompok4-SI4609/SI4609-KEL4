

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Tambah Artikel</h1>
    <form action="<?php echo e(route('admin.articles.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <?php echo $__env->make('admin.articles.form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FloodPPL\AppFlood\LaravelPPLKel4\resources\views/admin/articles/create.blade.php ENDPATH**/ ?>