<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@400;500;600;700&family=Noto+Sans:wght@400;500;600;700&display=swap"
    />
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <title>FloodRescue - Daftar Pesanan</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
  </head>
  <body>
    <div class="relative flex size-full min-h-screen flex-col bg-[#e6f3ff] group/design-root overflow-x-hidden">
      <div class="layout-container flex h-full grow flex-col">
        <header class="flex items-center justify-between whitespace-nowrap border-b border-solid border-b-[#dce2e5] px-10 py-3 bg-white">
          <div class="flex items-center gap-4">
            <img src="{{ asset('image/FloodRescueLogo.png') }}" alt="FloodRescue Logo" class="h-12 w-12">
            <h2 class="text-[#111518] text-lg font-bold leading-tight tracking-[-0.015em]">FloodRescue</h2>
          </div>
          <div class="flex flex-1 justify-end gap-8">
            <div class="flex items-center gap-9">
              <a class="text-[#111518] text-sm font-medium leading-normal" href="#services">Layanan</a>
              <a class="text-[#111518] text-sm font-medium leading-normal" href="#about">Tentang Kami</a>
              <a class="text-[#111518] text-sm font-medium leading-normal" href="#contact">Kontak</a>
            </div>
            <div class="flex gap-2">
              <a href="{{ route('cleaning-request.create') }}" 
                 class="flex items-center justify-center px-4 py-2 bg-[#19a2e6] text-white rounded-lg hover:bg-[#1792cf] transition-colors">
                Pesan Layanan
              </a>
            </div>
          </div>
        </header>

        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <h1 class="text-[#111518] tracking-light text-[32px] font-bold leading-tight">Daftar Pesanan Anda</h1>
            </div>

            @if(count($orders) > 0)
              @foreach($orders as $order)
                <div class="bg-white rounded-lg shadow-sm mb-4">
                  <div class="flex items-center justify-between p-4">
                    <div class="flex items-center gap-4">
                      <div class="bg-[#f0f3f4] rounded-lg p-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 256 256">
                          <path d="M174,47.75a254.19,254.19,0,0,0-41.45-38.3,8,8,0,0,0-9.18,0A254.19,254.19,0,0,0,82,47.75C54.51,79.32,40,112.6,40,144a88,88,0,0,0,176,0C216,112.6,201.49,79.32,174,47.75ZM128,216a72.08,72.08,0,0,1-72-72c0-57.23,55.47-105,72-118,16.53,13,72,60.75,72,118A72.08,72.08,0,0,1,128,216Z"></path>
                        </svg>
                      </div>
                      <div>
                        <h3 class="text-[#111518] text-lg font-semibold">Order #{{ $order->id }}</h3>
                        <p class="text-[#637c88]">{{ $order->created_at->format('d/m/Y') }}</p>
                      </div>
                    </div>
                    <div class="text-right">
                      <p class="text-lg font-semibold">Rp {{ number_format($order->total, 0, ',', '.') }}</p>
                      <p class="text-[#637c88]">{{ ucfirst($order->service_type) }}</p>
                      <a href="{{ route('cleaning-request.confirmation', $order->id) }}" 
                         class="inline-block mt-2 text-[#19a2e6] hover:text-[#1792cf]">
                        Lihat Detail
                      </a>
                    </div>
                  </div>
                </div>
              @endforeach
            @else
              <div class="bg-white rounded-lg shadow-sm p-8 text-center">
                <p class="text-[#637c88] text-lg">Anda belum memiliki pesanan</p>
                <a href="{{ route('cleaning-request.create') }}" 
                   class="inline-block mt-4 px-6 py-3 bg-[#19a2e6] text-white rounded-lg hover:bg-[#1792cf] transition-colors">
                  Pesan Layanan Sekarang
                </a>
              </div>
            @endif
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
