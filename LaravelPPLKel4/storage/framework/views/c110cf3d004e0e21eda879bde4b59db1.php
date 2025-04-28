

<?php $__env->startSection('content'); ?>
<div class="container my-8">
    <h1 class="text-center mb-6 text-3xl font-bold text-black">Edit Article</h1>
    <div class="bg-white shadow-lg rounded-lg p-6 md:w-1/2 mx-auto">
        <form action="<?php echo e(route('articles.update', $article->id)); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <!-- Title -->
            <div class="form-group mb-6">
                <label for="title" class="font-semibold text-lg text-gray-700">Title</label>
                <input type="text" name="title" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300" value="<?php echo e($article->title); ?>" required>
            </div>

            <!-- Content -->
            <div class="form-group mb-6">
                <label for="content" class="font-semibold text-lg text-gray-700">Content</label>
                <textarea name="content" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300" rows="6" required><?php echo e($article->content); ?></textarea>
            </div>

            <!-- Category -->
            <div class="form-group mb-6">
                <label for="category" class="font-semibold text-lg text-gray-700">Category</label>
                <input type="text" name="category" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300" value="<?php echo e($article->category); ?>" required>
            </div>

            <!-- Image Upload -->
            <div class="form-group mb-6">
                <label for="image" class="font-semibold text-lg text-gray-700">Image</label>
                <input type="file" name="image" class="form-control p-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition duration-300">
                <?php if($article->image_url): ?>
                    <div class="mt-4">
                        <img src="<?php echo e(asset('storage/' . $article->image_url)); ?>" alt="Article Image" class="w-48 h-48 object-cover rounded-lg shadow-lg border-2 border-gray-300">
                    </div>
                <?php endif; ?>
            </div>

            <!-- Submit Button -->
            <div class="text-center">
                <button type="submit" class="bg-blue-600 text-white font-semibold py-3 px-8 rounded-lg shadow-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                    Update Article
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\Asus\Documents\GitHub\SI4609-KEL4\LaravelPPLKel4\resources\views/articles/edit.blade.php ENDPATH**/ ?>