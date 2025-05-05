<?php $__env->startSection('title', 'FloodRescue | Form Laporan Banjir'); ?>

<?php $__env->startSection('content'); ?>
<style>
    .input-style {
        @apply w-full border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-400;
    }
</style>

<div class="flex justify-center gap-4 mb-6">
    <a href="<?php echo e(route('laporan-banjir.create')); ?>"
       class="px-4 py-2 rounded-md text-sm font-medium transition
       <?php echo e(request()->routeIs('laporan-banjir.create') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200'); ?>">
        Form Laporan
    </a>
    <a href="<?php echo e(route('laporan-banjir.status')); ?>"
       class="px-4 py-2 rounded-md text-sm font-medium transition
       <?php echo e(request()->routeIs('laporan-banjir.status') ? 'bg-blue-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-200'); ?>">
        Status Laporan
    </a>
</div>

<div class="max-w-lg mx-auto bg-white p-6 rounded-xl shadow-md space-y-6">
    <h1 class="text-2xl font-bold text-gray-800 text-center">Form Laporan Banjir</h1>

    <?php if(session('success')): ?>
        <div class="bg-green-100 border border-green-300 text-green-700 p-3 rounded">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <form action="<?php echo e(route('laporan-banjir.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php echo csrf_field(); ?>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="nama" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Lokasi</label>
            <input type="text" name="lokasi" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Deskripsi</label>
            <textarea name="deskripsi" rows="4" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required></textarea>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Kontak</label>
            <input type="text" name="kontak" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" required>
        </div>

        <div>
            <label class="block mb-1 text-sm font-medium text-gray-700">Foto Kejadian</label>
            <div id="imagePreview" class="mb-3 border rounded-lg p-2 text-center text-gray-500 bg-gray-50">
                <p>No image selected</p>
            </div>
            <input 
                type="file" 
                name="foto" 
                accept="image/*" 
                onchange="previewImage(event)"
                class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-300" 
                required>
        </div>

        <div class="text-right">
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white text-sm font-semibold px-6 py-2 rounded-md transition">
                Kirim Laporan
            </button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('imagePreview');
            output.innerHTML = `<img src="${reader.result}" alt="Preview" class="mx-auto rounded-lg shadow w-full max-w-xs h-auto">`;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SI4609-KEL4\LaravelPPLKel4\resources\views/laporan_banjir/form.blade.php ENDPATH**/ ?>