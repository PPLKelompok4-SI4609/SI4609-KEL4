

<?php $__env->startSection('content'); ?>
<body class="bg-white text-gray-900">

  <!-- Navigation -->
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

  <!-- Articles header -->
  <div class="bg-gray-500 text-white font-semibold text-center py-8 text-lg sm:text-xl">
    Articles
  </div>

  <!-- Add Article Button -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-4 text-right">
    <a href="<?php echo e(route('articles.create')); ?>" class="bg-blue-900 text-white px-4 py-2 rounded hover:bg-blue-800 transition">
      Tambah Artikel
    </a>
  </div>

  <!-- Search Form -->
  <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 flex flex-col sm:flex-row sm:space-x-4 space-y-4 sm:space-y-0 justify-center">
    <select aria-label="Category" class="border border-gray-400 rounded px-3 py-2 text-sm w-full sm:w-48">
      <option>Category</option>
    </select>

    <form action="<?php echo e(route('articles.index')); ?>" method="GET" class="flex border border-gray-400 rounded w-full sm:w-64">
      <input name="search" value="<?php echo e(old('search', $searchQuery)); ?>" aria-label="Search" class="flex-grow px-3 py-2 text-sm focus:outline-none" placeholder="Search" type="text"/>
      <button type="submit" aria-label="Search button" class="px-3 flex items-center justify-center border-l border-gray-400 text-gray-700 hover:text-black">
        <i class="fas fa-search"></i>
      </button>
    </form>
  </div>

  <!-- Articles grid -->
  <main class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
    <?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <article class="space-y-3">
      
      <?php if($article->image_url): ?>
        <img alt="<?php echo e($article->title); ?>" class="w-full h-48 object-cover rounded-lg shadow-md" src="<?php echo e(asset('storage/' . $article->image_url)); ?>" />
      <?php else: ?>
        <div class="w-full h-48 bg-gray-200 flex items-center justify-center rounded-lg shadow-md">
          <span class="text-gray-500">No Image</span>
        </div>
      <?php endif; ?>

      <div class="flex items-center space-x-2 text-xs text-gray-500">
        <i class="fas fa-file-alt"></i>
        <span><?php echo e($article->category); ?></span>
      </div>
      <h3 class="text-blue-900 font-semibold text-sm leading-tight hover:underline cursor-pointer">
        <?php echo e($article->title); ?>

      </h3>
      <p class="text-xs leading-snug text-gray-700">
        <?php echo e(Str::limit($article->content, 100)); ?>

      </p>
      
      <!-- Read More Button -->
      <div class="mt-4">
        <a href="<?php echo e(route('articles.show', $article->id)); ?>" class="bg-blue-900 text-white text-xs px-3 py-1 rounded hover:bg-blue-800 transition">
          Read More
        </a>
      </div>

      <!-- Edit and Delete Buttons -->
      <div class="flex space-x-2 mt-2">
          <a href="<?php echo e(route('articles.edit', $article->id)); ?>" class="bg-yellow-500 text-white text-xs px-3 py-1 rounded hover:bg-yellow-400 transition">Edit</a>
          
          <form action="<?php echo e(route('articles.destroy', $article->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
              <?php echo csrf_field(); ?>
              <?php echo method_field('DELETE'); ?>
              <button type="submit" class="bg-red-600 text-white text-xs px-3 py-1 rounded hover:bg-red-500 transition">Delete</button>
          </form>
      </div>
    </article>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </main>

  <!-- Pagination -->
  <nav aria-label="Pagination" class="max-w-7xl mx-auto px-4 sm:px-8 pb-12 flex justify-center space-x-2 text-xs sm:text-sm">
    <?php echo e($articles->links()); ?>

  </nav>

  <!-- Footer -->
  <footer class="bg-gray-100 text-gray-700 text-xs sm:text-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-8 py-8 grid grid-cols-1 sm:grid-cols-3 gap-6 border-b border-gray-300">
      <div class="text-center sm:text-left">
        Lorem
        <br/>
        info@loremipsum.com
      </div>
      <div class="text-center sm:text-left space-y-2">
        <div class="font-semibold">Lorem Ipsum</div>
        <div class="flex justify-center sm:justify-start space-x-4 text-gray-600">
          <a aria-label="Facebook" class="hover:text-gray-900" href="#"><i class="fab fa-facebook-f"></i></a>
          <a aria-label="Twitter" class="hover:text-gray-900" href="#"><i class="fab fa-twitter"></i></a>
          <a aria-label="Instagram" class="hover:text-gray-900" href="#"><i class="fab fa-instagram"></i></a>
        </div>
      </div>
      <div class="text-center sm:text-left space-y-2">
        <div class="font-semibold">And Typesetting</div>
        <button aria-label="With us" class="bg-blue-900 text-white text-xs sm:text-sm px-4 py-1 rounded hover:bg-blue-800 transition">With us</button>
      </div>
    </div>
    <div class="text-center py-2 text-gray-500">
      Lorem Ipsum Has Been The Industry's Standard Dummy Text Ever Since The 1500s, We
    </div>
  </footer>

</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Asus\Documents\GitHub\SI4609-KEL4\LaravelPPLKel4\resources\views/articles/index.blade.php ENDPATH**/ ?>