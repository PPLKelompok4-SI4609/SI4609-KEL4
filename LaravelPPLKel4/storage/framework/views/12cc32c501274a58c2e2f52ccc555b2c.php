

<?php $__env->startSection('content'); ?>
<div class="max-w-3xl mx-auto px-4 py-10">
    <div class="bg-white shadow-2xl rounded-2xl p-8">
        <h2 class="text-3xl font-semibold text-center mb-6 text-gray-800">📝 Create New Article</h2>
        <form action="<?php echo e(route('articles.store')); ?>" method="POST" class="space-y-6">
            <?php echo csrf_field(); ?>
            <div>
                <label for="title" class="block text-lg font-medium text-gray-700">Title</label>
                <input type="text" name="title" id="title" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter article title" required>
            </div>

            <div>
                <label for="content" class="block text-lg font-medium text-gray-700">Content</label>
                <textarea name="content" id="content" rows="6" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Write your article content here..." required></textarea>
            </div>

            <div>
                <label for="category" class="block text-lg font-medium text-gray-700">Category</label>
                <input type="text" name="category" id="category" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter article category" required>
            </div>

            <div>
                <label for="image_url" class="block text-lg font-medium text-gray-700">Image URL</label>
                <input type="url" name="image_url" id="image_url" class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:ring-blue-500 focus:border-blue-500" placeholder="Enter image URL" required>
            </div>

            <div class="text-center">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition duration-300 shadow-md">
                    Publish Article
                </button>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\FloodPPL\AppFlood\LaravelPPLKel4\resources\views/articles/create.blade.php ENDPATH**/ ?>