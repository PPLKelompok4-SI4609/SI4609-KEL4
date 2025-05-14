@extends('layouts.app')

@section('content')
<!-- Header Section -->
<header class="bg-[#2f7f6f]">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-28">
        <div class="max-w-3xl text-center mx-auto text-white">
            <p class="uppercase text-xs font-semibold mb-3">Good cause for humanity</p>
            <h1 class="text-4xl sm:text-5xl font-serif font-bold leading-tight mb-6">Helping Each Other Can Make the World Better</h1>
            <p class="text-sm sm:text-base max-w-xl mx-auto mb-10">We are here to help people who need it most. Your donation can change lives and bring hope to many.</p>
            <div class="flex justify-center space-x-4">
                <button class="border border-white px-8 py-3 rounded text-white font-semibold text-sm hover:bg-white hover:text-[#2f7f6f] transition">Donate</button>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Section -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20">
    <section class="flex flex-col lg:flex-row gap-10 mb-20">
        <!-- Left side: Donation Form -->
        <div class="lg:w-1/2 bg-white p-8 rounded-md shadow-md">
            <h2 class="text-xl font-serif font-bold mb-3">Donasi untuk Korban Banjir</h2>
            <form action="{{ route('donasi.store') }}" method="POST">
                @csrf

                <!-- Donation Amount -->
                <div class="form-group mb-4">
                    <label for="amount" class="block text-sm text-gray-700">Jumlah Donasi</label>
                    <input type="number" name="amount" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" required placeholder="Masukkan jumlah donasi">
                </div>

                <!-- Payment Method -->
                <div class="form-group mb-4">
                    <label for="payment_method" class="block text-sm text-gray-700">Metode Pembayaran</label>
                    <select name="payment_method" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" required>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-[#2f7f6f] text-white font-semibold py-3 rounded text-sm hover:bg-[#276a5c] transition">Kirim Donasi</button>
            </form>
        </div>

        <!-- Right side: Aid Request Form -->
        <div class="lg:w-1/2 bg-white p-8 rounded-md shadow-md">
            <h2 class="text-xl font-serif font-bold mb-3">Pemesanan Bantuan Sosial</h2>
            <form action="{{ route('donasi.store') }}" method="POST">
                @csrf

                <!-- Order Type (Aid Category) -->
                <div class="form-group mb-4">
                    <label for="order_type" class="block text-sm text-gray-700">Jenis Bantuan</label>
                    <select name="order_type" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" required>
                        <option value="food">Makanan</option>
                        <option value="clothes">Pakaian</option>
                        <option value="cleaning_supplies">Perlengkapan Kebersihan</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-[#ffc107] text-white font-semibold py-3 rounded text-sm hover:bg-[#e0a800] transition">Pesan Bantuan</button>
            </form>
        </div>
    </section>

<!-- Display Donation and Tracking Information -->
@if (session('donation'))
    <div class="mt-5 bg-gray-100 p-8 rounded-md">
        <h4 class="font-bold text-lg">Donasi Anda</h4>
        <p>Jumlah Donasi: Rp. {{ session('donation')->amount }}</p>
        <p>Status: {{ session('donation')->status }}</p>

        <h4 class="font-bold text-lg mt-4">Tracking Donasi</h4>
        @if(session('tracking') && session('tracking')->tracking_info)
            <p>{{ session('tracking')->tracking_info }} - {{ session('tracking')->created_at }}</p>
        @else
            <p>No tracking information available yet.</p>
        @endif
    </div>
@endif


 <!-- Section: Let's Come Together -->
   <section class="flex flex-col lg:flex-row gap-10 mb-20">
    <div class="lg:w-1/3">
     <h3 class="text-lg font-serif font-bold mb-4">
      Let's Come Together To Make A Difference
     </h3>
     <p class="text-xs text-gray-600 mb-6">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque aliquam odio et faucibus. Nulla rhoncus feugiat eros quis consectetur.
     </p>
     <div class="mb-4">
      <label class="block text-xs font-semibold mb-1 text-gray-700" for="cause">
       Pick Cause
      </label>
      <select class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2f7f6f]" id="cause">
       <option>
        Education
       </option>
       <option>
        Health
       </option>
       <option>
        Environment
       </option>
       <option>
        Animal Welfare
       </option>
      </select>
     </div>
     <div class="mb-4">
      <label class="block text-xs font-semibold mb-1 text-gray-700" for="donation">
       Donation
      </label>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2f7f6f]" id="donation" type="text" value="$100"/>
     </div>
     <div class="mb-4">
      <label class="block text-xs font-semibold mb-1 text-gray-700" for="email2">
       Email Address
      </label>
      <input class="w-full border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-[#2f7f6f]" id="email2" placeholder="Enter Your Email" type="email"/>
     </div>
    </div>
    <div class="lg:w-1/3 bg-[#d1e1db] rounded-md h-64">
    </div>
    <div class="lg:w-1/3 bg-white border border-[#2f7f6f] rounded-md p-6 text-xs text-[#2f7f6f] font-serif leading-relaxed">
     <p>
      “Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque aliquam odio et faucibus. Nulla rhoncus feugiat eros quis consectetur.”
     </p>
    </div>
   </section>
   <!-- Popular Cause Section -->
   <section class="mb-20">
    <h3 class="text-lg font-serif font-bold mb-8">
     Find The Popular Cause And Donate Them
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
     <!-- Card 1 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="Image representing education cause with children studying" class="mb-3 rounded" height="150" src="https://storage.googleapis.com/a1aa/image/5b1e64f6-ed7b-4ec6-cd70-769e7f2f5ffb.jpg" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Education
      </h4>
      <p class="text-xs text-gray-600 mb-2">
       Ensure Every Child Has Access To Education
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
       <span>
        Raised: $12,000
       </span>
       <span>
        Goal: $20,000
       </span>
      </div>
      <button class="bg-[#2f7f6f] text-white text-xs font-semibold px-4 py-2 rounded hover:bg-[#276a5c] transition">
       Donate Now
      </button>
     </div>
     <!-- Card 2 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="Image representing children welfare with happy kids" class="mb-3 rounded" height="150" src="https://storage.googleapis.com/a1aa/image/2518b3da-c57a-4b49-f8e4-e19b787d8874.jpg" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Children Welfare
      </h4>
      <p class="text-xs text-gray-600 mb-2">
       Protect Children From Abuse And Neglect
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
       <span>
        Raised: $8,500
       </span>
       <span>
        Goal: $15,000
       </span>
      </div>
      <button class="bg-[#2f7f6f] text-white text-xs font-semibold px-4 py-2 rounded hover:bg-[#276a5c] transition">
       Donate Now
      </button>
     </div>
     <!-- Card 3 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="Image representing animal welfare with a dog and cat" class="mb-3 rounded" height="150" src="https://storage.googleapis.com/a1aa/image/1e386dd6-f9e2-41dc-0dbc-8febc80a1a76.jpg" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Animal Welfare
      </h4>
      <p class="text-xs text-gray-600 mb-2">
       Care For Stray And Abandoned Animals
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
       <span>
        Raised: $5,000
       </span>
       <span>
        Goal: $10,000
       </span>
      </div>
      <button class="bg-[#2f7f6f] text-white text-xs font-semibold px-4 py-2 rounded hover:bg-[#276a5c] transition">
       Donate Now
      </button>
     </div>
     <!-- Card 4 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="Image representing food help with food supplies" class="mb-3 rounded" height="150" src="https://storage.googleapis.com/a1aa/image/40fcd056-7542-4e11-9da0-a300deb23240.jpg" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Help Food
      </h4>
      <p class="text-xs text-gray-600 mb-2">
       Provide Food To The Hungry And Homeless
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
       <span>
        Raised: $7,000
       </span>
       <span>
        Goal: $12,000
       </span>
      </div>
      <button class="bg-[#2f7f6f] text-white text-xs font-semibold px-4 py-2 rounded hover:bg-[#276a5c] transition">
       Donate Now
      </button>
     </div>
    </div>
   </section>
   <!-- Testimonials -->
   <section class="bg-[#2f2f38] text-white py-16 px-4 sm:px-6 lg:px-8 text-center">
    <h3 class="text-lg font-serif font-semibold mb-8">
     What People Say
    </h3>
    <div class="flex items-center justify-center space-x-12 mb-6">
     <button aria-label="Previous testimonial" class="text-white text-2xl hover:text-gray-400 transition">
      <i class="fas fa-chevron-left">
      </i>
     </button>
     <div class="w-24 h-24 rounded-full bg-gray-400 mx-auto">
     </div>
     <button aria-label="Next testimonial" class="text-white text-2xl hover:text-gray-400 transition">
      <i class="fas fa-chevron-right">
      </i>
     </button>
    </div>
    <p class="text-xs max-w-3xl mx-auto leading-relaxed px-4 sm:px-0">
     Sam Choi: Dedicated volunteer at various Donate Lifeline Hub. Co-Founder: Life Heroes Speak, which Won’t Die. Shawn: California native. Runs a non-profit. Helping save lives. Believes in the power of community. Proud Fundraiser. Chris: Donor. Tech Geek. Caring &amp; Respect. Owner: “Better Things” Downtown. Strongly Supports Government’s Initiatives. Compassionate Donator.
    </p>
   </section>
   <!-- Stats and Partners -->
   <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <h3 class="text-lg font-serif font-semibold mb-12">
     We Believe That We Can Save More Lifes With You
    </h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mb-16">
     <div class="bg-[#d1e1db] rounded-md p-6 text-center">
      <p class="text-2xl font-serif font-bold text-[#2f7f6f] mb-2">
       4597+
      </p>
      <p class="text-xs font-semibold text-[#2f7f6f]">
       Happy Donators
      </p>
     </div>
     <div class="bg-[#d1e1db] rounded-md p-6 text-center">
      <p class="text-2xl font-serif font-bold text-[#2f7f6f] mb-2">
       8945+
      </p>
      <p class="text-xs font-semibold text-[#2f7f6f]">
       Volunteers
      </p>
     </div>
     <div class="bg-[#d1e1db] rounded-md p-6 text-center">
      <p class="text-2xl font-serif font-bold text-[#2f7f6f] mb-2">
       10M+
      </p>
      <p class="text-xs font-semibold text-[#2f7f6f]">
       Donations Given
      </p>
     </div>
     <div class="bg-[#d1e1db] rounded-md p-6 text-center">
      <p class="text-2xl font-serif font-bold text-[#2f7f6f] mb-2">
       100+
      </p>
      <p class="text-xs font-semibold text-[#2f7f6f]">
       Campaigns
      </p>
     </div>
    </div>
    <div class="flex justify-center items-center space-x-12">
     <img alt="Partner logo 1" class="h-10 w-auto" height="40" src="https://storage.googleapis.com/a1aa/image/6f7068dc-0ce3-43a9-0b68-993d4c0d2ce9.jpg" width="100"/>
     <img alt="Partner logo 2" class="h-10 w-auto" height="40" src="https://storage.googleapis.com/a1aa/image/89adb656-2d6b-4903-52f8-304314dd0e4b.jpg" width="100"/>
     <img alt="Partner logo 3" class="h-10 w-auto" height="40" src="https://storage.googleapis.com/a1aa/image/2be6742d-570d-4ce1-ffeb-1b9f011cd9e3.jpg" width="100"/>
     <img alt="Partner logo 4" class="h-10 w-auto" height="40" src="https://storage.googleapis.com/a1aa/image/039e5b40-ad88-4084-88d6-76640691d7d2.jpg" width="100"/>
    </div>
   </section>
  </main>
  

<!-- Footer Section -->
<footer class="bg-[#2f7f6f] text-white py-12 text-center">
    <p>&copy; 2025 FloodRescue. All rights reserved.</p>
    <div class="flex justify-center space-x-6">
        <a href="#" class="text-white">Facebook</a>
        <a href="#" class="text-white">Twitter</a>
        <a href="#" class="text-white">Instagram</a>
        <a href="#" class="text-white">LinkedIn</a>
    </div>
</footer>

@endsection
