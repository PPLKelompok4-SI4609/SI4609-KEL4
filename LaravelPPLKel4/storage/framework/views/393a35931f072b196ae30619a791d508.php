

<?php $__env->startSection('content'); ?>
<div class="bg-white text-gray-900">

  
  <nav class="bg-white shadow-sm border-b border-gray-200">
    <div class="container px-6 py-3 flex items-center justify-between">
        <a href="/" class="flex items-center gap-2 text-xl font-semibold text-blue-600 hover:text-blue-800">
            <img src="<?php echo e(asset('image/logo.png')); ?>" alt="Logo" class="w-7 h-7">
            FloodRescue
            <a href="#" class="hover:underline">Home</a>
            <a href="#" class="hover:underline">Discover</a>
            <a href="#" class="hover:underline">Blog</a>
            <a href="#" class="hover:underline">About Us</a>
            <a href="#" class="hover:underline">Contact</a>
        </a>
    </div>
  </nav>

  <div class="container mx-auto px-4 sm:px-8 py-8">

    
    <div class="mb-6">
      <?php if($article->image_url): ?>
        <img src="<?php echo e(asset('storage/' . $article->image_url)); ?>" alt="<?php echo e($article->title); ?>" class="w-full rounded-lg shadow-md">
      <?php else: ?>
        <div class="w-full h-64 bg-gray-200 flex items-center justify-center rounded-lg shadow-md">
          <span class="text-gray-500">No Image Available</span>
        </div>
      <?php endif; ?>
    </div>

    
    <div>
      <h1 class="text-3xl font-bold mb-4"><?php echo e($article->title); ?></h1>
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Asus\Documents\GitHub\SI4609-KEL4\LaravelPPLKel4\resources\views/articles/show.blade.php ENDPATH**/ ?>