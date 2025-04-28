@extends('layouts.app')

@section('content')
<div class="flex justify-center items-center min-h-[80vh]">
    <div class="w-full max-w-md bg-white p-8 rounded-lg shadow-lg">
        <div class="text-center mb-8">
            <img src="{{ asset('images/logo.png') }}" alt="FloodRescue Logo" class="h-16 mx-auto mb-4">
            <h2 class="text-2xl font-bold text-blue-600">Two-Factor Authentication</h2>
            <p class="text-gray-600">Please enter the verification code sent to your email and WhatsApp</p>
        </div>

        @if (session('status'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('two-factor.verify') }}">
            @csrf

            <div class="mb-6">
                <label for="two_factor_code" class="block text-sm font-medium text-gray-700">Verification Code</label>
                <input id="two_factor_code" type="text" name="two_factor_code" required autofocus
                    class="mt-1 w-full px-4 py-2 border rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400 @error('two_factor_code') border-red-500 @enderror">
                @error('two_factor_code')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-full hover:bg-blue-600 transition-all duration-200">
                    Verify Code
                </button>
            </div>
        </form>

        <div class="mt-4 text-center">
            <form method="POST" action="{{ route('two-factor.resend') }}" class="inline">
                @csrf
                <button type="submit" class="text-sm text-blue-600 hover:underline">
                    Resend Code
                </button>
            </form>
        </div>
    </div>
</div>
@endsection