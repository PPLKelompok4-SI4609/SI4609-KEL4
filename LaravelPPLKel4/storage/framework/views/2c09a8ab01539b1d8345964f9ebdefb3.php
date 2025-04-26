

<?php $__env->startSection('content'); ?>
<div class="bg-white text-gray-900">

  
  <nav class="bg-blue-900 text-white px-6 py-4 shadow-md">
    <div class="container mx-auto flex justify-between items-center">
      <a href="<?php echo e(url('/')); ?>" class="text-xl font-semibold">InfoBanjir</a>
      <div class="space-x-4">
        <a href="<?php echo e(route('articles.index')); ?>" class="hover:underline">Articles</a>
        <a href="<?php echo e(url('/about')); ?>" class="hover:underline">About</a>
        <a href="<?php echo e(url('/contact')); ?>" class="hover:underline">Contact</a>
      </div>
    </div>
  </nav>

  <div class="container mx-auto px-4 sm:px-8 py-8">

    
    <img src="<?php echo e($article->image_url); ?>" alt="<?php echo e($article->title); ?>" class="w-full rounded-lg shadow-md">

    
    <div class="mt-6">
      <h1 class="text-3xl font-bold mb-2"><?php echo e($article->title); ?></h1>
      <p class="text-sm text-gray-500 mb-4">
        <span class="font-semibold">Category:</span> <?php echo e($article->category); ?>

      </p>
      <div class="text-base leading-relaxed">
        <?php echo nl2br(e($article->content)); ?>

      </div>
    </div>

    
    <a href="<?php echo e(route('articles.index')); ?>" class="mt-8 inline-block bg-blue-900 text-white text-sm px-4 py-2 rounded hover:bg-blue-800 transition">
      ← Back to Articles
    </a>
  </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FloodPPL\AppFlood\LaravelPPLKel4\resources\views/articles/show.blade.php ENDPATH**/ ?>