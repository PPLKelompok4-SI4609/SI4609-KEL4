

<?php $__env->startSection('content'); ?>
<div class="col-12 text-center">
    <div class="welcome-container" style="padding: 4rem 2rem;">
        <div class="logo-container mb-4" style="display: flex; justify-content: center; align-items: center;">
            <img src="<?php echo e(asset('images/logo.png')); ?>" alt="FloodRescue Logo" class="welcome-logo animate-float" 
                    style="width: 200px; height: auto; margin: 0 auto;">
        </div>
        
        <h1 class="mega-title mb-4 animate-fade-in" style="font-family: 'Poppins', sans-serif; font-size: 4.5rem; font-weight: 700; color: #1565c0; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
            Selamat datang di FloodRescue!
        </h1>
        
        <p class="sub-title animate-fade-in-delay" style="font-family: 'Poppins', sans-serif; font-size: 2rem; color: #424242; margin-bottom: 2rem;">
            Bersama Lawan Banjir
        </p>
        
        <div class="countdown-container animate-fade-in-delay-2" style="background: rgba(255, 255, 255, 0.9); padding: 1rem 2rem; border-radius: 15px; display: inline-block; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <p class="countdown mb-0" style="font-family: 'Poppins', sans-serif; font-size: 1.2rem; color: #666;">
                Mengalihkan ke halaman utama dalam <span id="timer" style="font-weight: 600; color: #1565c0;">5</span> detik...
            </p>
        </div>
    </div>
</div>
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

.animate-float {
    animation: float 3s ease-in-out infinite;
}

.animate-fade-in {
    opacity: 0;
    animation: fadeIn 1s ease-out forwards;
}

.animate-fade-in-delay {
    opacity: 0;
    animation: fadeIn 1s ease-out 0.5s forwards;
}

.animate-fade-in-delay-2 {
    opacity: 0;
    animation: fadeIn 1s ease-out 1s forwards;
}

@keyframes float {
    0% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
    100% { transform: translateY(0px); }
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Tambahan styling untuk logo */
.logo-container {
    min-height: 150px;
    display: flex;
    align-items: center;
    justify-content: center;
}

.welcome-logo {
    display: block;
    max-width: 100%;
    object-fit: contain;
}

@media (max-width: 768px) {
    .mega-title {
        font-size: 3rem !important;
    }
    .sub-title {
        font-size: 1.5rem !important;
    }
    .welcome-logo {
        width: 80px !important;
    }
    .logo-container {
        min-height: 100px;
    }
    .welcome-logo {
        width: 150px !important;
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let timeLeft = 5;
    const timerElement = document.getElementById('timer');
    
    const countdown = setInterval(function() {
        timeLeft--;
        timerElement.textContent = timeLeft;
        
        if (timeLeft <= 0) {
            clearInterval(countdown);
            window.location.href = '/';
        }
    }, 1000);
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\SI4609-KEL4\LaravelPPLKel4\resources\views/dashboard.blade.php ENDPATH**/ ?>