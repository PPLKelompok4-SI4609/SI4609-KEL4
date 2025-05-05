

<?php $__env->startSection('content'); ?>
<style>
    main {
        color: black;
        font-size: 18px;
    }
    b {
        background-color: #f5f5f5;
    }
</style>
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <div class="text-center mb-8">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="FloodRescue Logo" class="h-32 mx-auto mb-4"> <!-- Mengubah h-16 menjadi h-32 -->
            <h2 class="text-3xl font-bold text-blue-600">FloodRescue</h2> <!-- Mengubah text-2xl menjadi text-3xl -->
            <p class="text-gray-600 text-lg">Bersama Lawan Banjir!</p> <!-- Menambahkan text-lg -->
        </div>

        <form method="POST" action="<?php echo e(route('login')); ?>">
            <?php echo csrf_field(); ?>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['email'];
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

            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                <?php $__errorArgs = ['password'];
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

            <div class="flex items-center justify-between mb-6">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                </label>
                <a href="<?php echo e(route('password.request')); ?>" class="text-sm text-blue-600 hover:underline">
                    Lupa password?
                </a>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-200">
                    Login
                </button>
            </div>

            <div class="mt-4 text-center">
                <p class="text-sm text-gray-600">
                    Belum punya akun? 
                    <a href="<?php echo e(route('register')); ?>" class="text-blue-600 hover:underline">Register</a>
                </p>
            </div>
        </form>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SI4609-KEL4\LaravelPPLKel4\resources\views/auth/login.blade.php ENDPATH**/ ?>