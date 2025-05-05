@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <div class="row justify-content-center align-items-center m-0" style="min-height: 90vh; background: #e3f2fd;">
        <div class="col-12 text-center">
            <div class="welcome-container" style="padding: 4rem 2rem;">
                <h1 class="mega-title mb-4" style="font-family: 'Poppins', sans-serif; font-size: 4.5rem; font-weight: 700; color: #1565c0; text-shadow: 2px 2px 4px rgba(0,0,0,0.1);">
                    Selamat datang di FloodRescue!
                </h1>
                <p class="sub-title" style="font-family: 'Poppins', sans-serif; font-size: 2rem; color: #424242; margin-bottom: 2rem;">
                    Bersama Lawan Banjir
                </p>
            </div>
        </div>
    </div>
</div>

<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap');

@media (max-width: 768px) {
    .mega-title {
        font-size: 3rem !important;
    }
    .sub-title {
        font-size: 1.5rem !important;
    }
}
</style>
@endsection