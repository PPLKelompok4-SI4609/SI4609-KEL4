<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloodRescue - Professional Post-Flood Cleaning Services</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1e40af;
            --secondary-blue: #3b82f6;
            --light-blue: #93c5fd;
        }
    </style>
</head>
<body class="font-sans">
    <!-- Navigation Bar -->
    <nav class="bg-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <img src="{{ asset('images/logo.png') }}" alt="FloodRescue Logo" class="h-8 w-auto">
                </div>
                <div class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-blue-600">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Services</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">About</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600">Contact</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-blue-50 py-20">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Professional Post-Flood Cleaning Services</h1>
            <p class="text-xl text-gray-600 mb-8">Fast, reliable, and professional flood cleanup services</p>
            <a href="#contact" class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition">
                Get Help Now
            </a>
        </div>
    </div>

    <!-- Services Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Our Services</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($services as $service)
                <div class="text-center p-6 rounded-lg shadow-lg">
                    <i class="{{ $service->icon }} text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-semibold mb-3">{{ $service->title }}</h3>
                    <p class="text-gray-600">{{ $service->description }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Why Choose Us</h2>
            <div class="grid md:grid-cols-4 gap-8">
                @foreach ($benefits as $benefit)
                <div class="text-center">
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <i class="{{ $benefit->icon }} text-3xl text-blue-600 mb-4"></i>
                        <h3 class="text-lg font-semibold mb-2">{{ $benefit->title }}</h3>
                        <p class="text-gray-600">{{ $benefit->description }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4">
            <h2 class="text-3xl font-bold text-center mb-12">Customer Testimonials</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach ($testimonials as $testimonial)
                <div class="bg-blue-50 p-6 rounded-lg">
                    <div class="flex items-center mb-4">
                        <img src="{{ $testimonial->avatar }}" alt="Customer" class="w-12 h-12 rounded-full">
                        <div class="ml-4">
                            <h4 class="font-semibold">{{ $testimonial->name }}</h4>
                            <div class="text-yellow-400">
                                @for ($i = 0; $i < $testimonial->rating; $i++)
                                    <i class="fas fa-star"></i>
                                @endfor
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-600 italic">"{{ $testimonial->comment }}"</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-16 bg-blue-600">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold text-white mb-4">Need Emergency Flood Cleanup?</h2>
            <p class="text-blue-100 mb-8">Our team is available 24/7 for your emergency needs</p>
            <a href="#contact" class="bg-white text-blue-600 px-8 py-3 rounded-lg hover:bg-blue-50 transition">
                Contact Us Now
            </a>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-7xl mx-auto px-4">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">FloodRescue</h3>
                    <p class="text-gray-400">Professional flood cleanup services you can trust.</p>
                </div>
                <!-- Add more footer content as needed -->
            </div>
        </div>
    </footer>
</body>
</html>