

<?php $__env->startSection('content'); ?>
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <div class="text-center mb-8">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="FloodRescue Logo" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-blue-600">Verifikasi Dua Faktor</h2>
            <p class="text-gray-600 mt-2">Masukkan kode verifikasi yang telah dikirim ke email Anda</p>
        </div>

        <?php if(session('status')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                <?php echo e(session('status')); ?>

            </div>
        <?php endif; ?>

        <form method="POST" action="<?php echo e(route('two-factor.verify')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-6">
                <label for="two_factor_code" class="block text-sm font-medium text-gray-700 mb-2">
                    Kode Verifikasi
                </label>
                <input id="two_factor_code" 
                    type="text" 
                    name="two_factor_code" 
                    required 
                    autocomplete="off"
                    class="w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 <?php $__errorArgs = ['two_factor_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                    placeholder="Masukkan 6 digit kode">

                <?php $__errorArgs = ['two_factor_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <p class="text-red-500 text-sm mt-1"><?php echo e($message); ?></p>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="flex flex-col space-y-4">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-200">
                    Verifikasi Kode
                </button>

                <div class="text-center">
                    <a href="<?php echo e(route('two-factor.resend')); ?>" 
                       class="text-blue-600 hover:text-blue-800 text-sm"
                       onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                        Kirim ulang kode
                    </a>
                </div>
            </div>
        </form>

        <form id="resend-form" action="<?php echo e(route('two-factor.resend')); ?>" method="POST" class="hidden">
            <?php echo csrf_field(); ?>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SI4609-KEL4\LaravelPPLKel4\resources\views/auth/two-factor-challenge.blade.php ENDPATH**/ ?>