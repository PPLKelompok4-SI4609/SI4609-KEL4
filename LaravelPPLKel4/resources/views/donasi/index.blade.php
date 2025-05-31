@extends('layouts.app')

@section('title', 'FloodRescue | Donasi & Bantuan Sosial')

@section('content')
<!-- Header Section -->
<header class="bg-blue-700 rounded-lg shadow-lg">
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-20 pb-28">
        <div class="max-w-3xl text-center mx-auto text-white">
            <p class="uppercase text-xs font-semibold mb-3">Good cause for humanity</p>
            <h1 class="text-4xl sm:text-5xl font-bold leading-tight mb-6">Membantu Satu Sama Lain Bisa Membuat Dunia Menjadi Lebih Baik</h1>
            <p class="text-sm sm:text-base max-w-xl mx-auto mb-10">Kami ada di sini untuk membantu orang-orang yang paling membutuhkannya. Donasi Anda dapat mengubah hidup dan membawa harapan bagi banyak orang.</p>
            <div class="flex justify-center space-x-4 mb-6">
                <!-- The donate button is initially disabled, will be enabled after submission -->
                <button id="donateButton" class="border border-white px-8 py-3 rounded text-white font-semibold text-sm hover:bg-white hover:text-blue-700 transition" disabled>Donate</button>
            </div>
        </div>
    </div>
</header>

<!-- Main Content Section -->
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20">
    <section class="flex flex-col lg:flex-row gap-10 mb-20">
        <!-- Left side: Donation Form -->
        <div class="lg:w-1/2 bg-white p-8 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-3">Donasi untuk Korban Banjir</h2>
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

                <button type="submit" class="w-full bg-blue-700 text-white font-semibold py-3 rounded text-sm hover:bg-blue-900 transition">Kirim Donasi</button>
            </form>
        </div>

        <!-- Right side: Aid Request Form -->
        <div class="lg:w-1/2 bg-white p-8 rounded-md shadow-md">
            <h2 class="text-xl font-bold mb-3">Pemesanan Bantuan Sosial</h2>
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

                <button type="submit" class="w-full bg-blue-700 text-white font-semibold py-3 rounded text-sm hover:bg-blue-900 transition">Pesan Bantuan</button>
            </form>
        </div>
    </section>

    <!-- Display Donation and Tracking Information -->
    @if (session('donation'))
        <div class="bg-gray-100 p-8 rounded-md mb-10 shadow-md">
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

<!-- Order Success Pop-up -->
@if(session('order_success'))
    <div id="orderSuccessPopup" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-md">
            <h3 class="font-bold text-xl text-center">{{ session('order_success') }}</h3>
            <p class="mt-4 text-center text-sm text-gray-700">Pesanan Anda saat ini sedang didistribusikan. Nantikan informasi terbarunya.</p>
            <!-- Close Button -->
            <button id="closePopup" class="mt-4 w-full bg-blue-700 hover:bg-blue-900 transition text-white font-semibold py-2 rounded">Close</button>
        </div>
    </div>
@endif


<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Ensure close button exists before adding event listener
        const closePopupButton = document.getElementById('closePopup');
        if (closePopupButton) {
            closePopupButton.addEventListener('click', function() {
                const orderSuccessPopup = document.getElementById('orderSuccessPopup');
                
                if (orderSuccessPopup) {
                    // Hide the popup by adding 'hidden' class
                    orderSuccessPopup.classList.add('hidden');
                    
                    // Optional: If you want to confirm action to user (via a small notification)
                    const confirmationMessage = document.createElement('div');
                    confirmationMessage.classList.add('fixed', 'top-0', 'left-0', 'right-0', 'bg-[#2f7f6f]', 'text-white', 'p-4', 'text-center');
                    confirmationMessage.textContent = "Your order is being processed. Thank you for your patience!";
                    document.body.appendChild(confirmationMessage);

                    // Automatically remove confirmation message after 3 seconds
                    setTimeout(function() {
                        confirmationMessage.remove();
                    }, 3000);
                }
            });
        }
    });
</script>

   <!-- Popular Cause Section -->
   <section class="mb-20">
    <h3 class="text-lg font-bold mb-8">
     Semua donasi akan disalurkan untuk:
    </h3>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

     <!-- Card 1 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="anak korban banjir" class="mb-3 rounded" height="150" src="{{ asset('images/anakbanjir.jpeg') }}" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Pendidikan untuk Anak Korban Banjir
      </h4>
      <p class="text-xs text-gray-600 mb-2 text-justify">
       Memberikan akses pendidikan bagi anak-anak terdampak banjir, agar mereka tetap dapat belajar meskipun dalam kondisi sulit, dan memiliki masa depan yang lebih baik.
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
      </div>
     </div>

     <!-- Card 2 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="Anak dan Warga" class="mb-3 rounded" height="150" src="{{ asset('images/evakuasi.jpeg') }}" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Bantuan untuk Warga Terdampak Banjir
      </h4>
      <p class="text-xs text-gray-600 mb-2 text-justify">
       Memberikan bantuan perlengkapan dasar untuk anak-anak dan keluarga yang terkena dampak banjir, seperti pakaian, obat-obatan, dan tempat tinggal sementara.
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
      </div>
     </div>

     <!-- Card 3 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="hewan terdampak" class="mb-3 rounded" height="150" src="{{ asset('images/kucing.webp') }}" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Bantuan untuk Hewan Terdampak Banjir
      </h4>
      <p class="text-xs text-gray-600 mb-2 text-justify">
       Merawat hewan terlantar akibat banjir dengan memberikan makanan, tempat berlindung, dan perawatan medis yang dibutuhkan.
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
      </div>
     </div>
     
     <!-- Card 4 -->
     <div class="bg-white border border-gray-200 rounded-md p-4">
      <img alt="pengungsi" class="mb-3 rounded" height="150" src="{{ asset('images/pengungsi.jpeg') }}" width="200"/>
      <h4 class="font-semibold text-sm mb-1">
       Menyediakan Makanan untuk Korban Banjir
      </h4>
      <p class="text-xs text-gray-600 mb-2 text-justify">
       Memberikan makanan bergizi bagi korban banjir yang kehilangan tempat tinggal untuk menjaga kesehatan dan daya tahan tubuh mereka.
      </p>
      <div class="flex justify-between text-xs text-[#2f7f6f] font-semibold mb-3">
      </div>
     </div>
    </div>
   </section>
<!-- Testimonials -->
<section class="bg-blue-900 text-white py-16 px-4 sm:px-6 lg:px-8 text-center rounded-lg shadow-lg">
  <h3 class="text-lg font-semibold mb-8">
    What People Say
  </h3>
  <div class="flex items-center justify-center space-x-12 mb-6">
    <button aria-label="Previous testimonial" class="text-white text-2xl hover:text-gray-400 transition" id="prevBtn">
      <i class="fas fa-chevron-left"></i>
    </button>
    <div id="testimonialImage" class="w-24 h-24 rounded-full bg-gray-400 mx-auto">
      <!-- Testimonial Image will go here -->
    </div>
    <button aria-label="Next testimonial" class="text-white text-2xl hover:text-gray-400 transition" id="nextBtn">
      <i class="fas fa-chevron-right"></i>
    </button>
  </div>
  <h4 class="text-lg font-bold mb-2" id="testimonialName">Nama</h4>
  <p class="text-xs max-w-3xl mx-auto leading-relaxed px-4 sm:px-0">
    <span id="testimonialText">
      <!-- Testimonial Text will go here -->
    </span>
  </p>
</section>

<script>
// Testimonial content array with image paths relative to public/images
const testimonials = [
  {
    img: 'Rio.jpg',
    name: 'Rio Ramadhani',
    text: 'Saya merasa bangga bisa berpartisipasi dalam perubahan nyata. Setiap donasi yang saya berikan selalu membawa dampak positif bagi mereka yang membutuhkan.'
  },
  {
    img: 'yodha.jpeg',
    name: 'Wendy Shakur',
    text: 'Memberikan donasi membuat saya merasa lebih dekat dengan mereka yang membutuhkan. Melihat senyum mereka adalah hadiah terbaik bagi saya.'
  },
  {
    img: 'abid.png',
    name: 'Abid Jordy',
    text: 'Saya tidak hanya memberikan uang, tetapi juga harapan. Saya percaya bahwa kebaikan itu akan kembali, dan itu memberi kebahagiaan bagi saya.'
  },
  {
    img: 'kirana.jpg',
    name: 'Kirana Adira',
    text: 'Menjadi bagian dari perubahan ini adalah pengalaman yang sangat berarti. Melihat bagaimana bantuan saya membuat hidup seseorang lebih baik sangat memuaskan.'
  },
  {
    img: 'Suzanaya.jpg',
    name: 'Suzanaya Putri',
    text: 'Dengan berkontribusi, saya tahu saya telah membuat perbedaan. Mungkin sedikit, tapi setiap langkah kecil itu penting untuk mereka.'
  },
  {
    img: 'diva.jpg',
    name: 'Ladiva Zahra',
    text: 'Donasi saya mungkin kecil, tapi saya tahu itu membantu. Semoga ini bisa memberi mereka kesempatan baru dalam hidup, sama seperti yang saya harapkan untuk diri saya.'
  }
];

let currentIndex = 0;

const testimonialTextElement = document.getElementById('testimonialText');
const testimonialImageElement = document.getElementById('testimonialImage');
const testimonialNameElement = document.getElementById('testimonialName');
const prevBtn = document.getElementById('prevBtn');
const nextBtn = document.getElementById('nextBtn');

function updateTestimonial() {
  const imagePath = `/images/${testimonials[currentIndex].img}`;
  console.log('Image Path:', imagePath); // Check the path in the console
  testimonialTextElement.textContent = testimonials[currentIndex].text;
  testimonialImageElement.style.backgroundImage = `url('${imagePath}')`;
  testimonialImageElement.style.backgroundSize = 'cover';        // Ensure image covers the div
  testimonialImageElement.style.backgroundPosition = 'center';  // Center the image inside the div
  testimonialImageElement.style.backgroundRepeat = 'no-repeat'; // Prevent image repetition
  testimonialNameElement.textContent = testimonials[currentIndex].name;
}


// Function to go to the previous testimonial
function goToPrevious() {
  currentIndex = (currentIndex - 1 + testimonials.length) % testimonials.length;
  updateTestimonial();
}

// Function to go to the next testimonial
function goToNext() {
  currentIndex = (currentIndex + 1) % testimonials.length;
  updateTestimonial();
}

// Event listeners for the buttons
prevBtn.addEventListener('click', goToPrevious);
nextBtn.addEventListener('click', goToNext);

// Initialize with the first testimonial
updateTestimonial();
</script>

   <!-- Stats and Partners -->
   <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h3 class="text-lg font-semibold mb-12">
     We Believe That We Can Save More Lifes With You
    </h3>
    <div class="grid grid-cols-2 sm:grid-cols-4 gap-6 mb-16">
     <div class="bg-blue-200 rounded-md p-6 text-center shadow-md">
      <p class="text-2xl font-bold text-blue-900 mb-2">
       4597+
      </p>
      <p class="text-xs font-semibold text-blue-900">
       Happy Donators
      </p>
     </div>
     <div class="bg-blue-200 rounded-md p-6 text-center">
      <p class="text-2xl font-bold text-blue-900 mb-2">
       8945+
      </p>
      <p class="text-xs font-semibold text-blue-900">
       Volunteers
      </p>
     </div>
     <div class="bg-blue-200 rounded-md p-6 text-center">
      <p class="text-2xl font-bold text-blue-900 mb-2">
       10M+
      </p>
      <p class="text-xs font-semibold text-blue-900">
       Donations Given
      </p>
     </div>
     <div class="bg-blue-200 rounded-md p-6 text-center">
      <p class="text-2xl font-bold text-blue-900 mb-2">
       100+
      </p>
      <p class="text-xs font-semibold text-blue-900">
       Campaigns
      </p>
     </div>
    </div>
    <div class="flex justify-center items-center space-x-12">
     <img alt="Partner logo 1" class="h-10 w-auto" height="40" src="images/logo-damkar.png" width="100"/>
     <img alt="Partner logo 2" class="h-10 w-auto" height="40" src="images/Bandung Bergerak.png" width="100"/>
     <img alt="Partner logo 3" class="h-10 w-auto" height="40" src="images/logo-polda-jabar.png" width="100"/>
     <img alt="Partner logo 4" class="h-10 w-auto" height="40" src="images/BPBD-logo.png" width="100"/>
    </div>
   </section>
  </main>
@endsection
