

<?php $__env->startSection('content'); ?>
<div class="container">
    <h1>Kelola Artikel</h1>
    <a href="<?php echo e(route('admin.articles.create')); ?>" class="btn btn-primary mb-3">+ Tambah Artikel</a>

    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card mb-2">
            <div class="card-body">
                <h5><?php echo e($article->title); ?></h5>
                <p><small>Author: <?php echo e($article->author); ?></small></p>
                <a href="<?php echo e(route('admin.articles.edit', $article)); ?>" class="btn btn-sm btn-warning">Edit</a>

                <form action="<?php echo e(route('admin.articles.destroy', $article)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Hapus artikel ini?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button class="btn btn-sm btn-danger">Hapus</button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php echo e($articles->links()); ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FloodPPL\AppFlood\LaravelPPLKel4\resources\views/admin/articles/index.blade.php ENDPATH**/ ?>