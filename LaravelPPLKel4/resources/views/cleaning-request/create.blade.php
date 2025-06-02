@extends('layouts.app')

@section('title', 'FloodRescue | Layanan Pembersihan Rumah Setelah Banjir')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="relative flex min-h-screen flex-col bg-white overflow-x-hidden font-sans px-5 mx-6 rounded-xl">
  <div class="container mx-auto px-6 py-10">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

      {{-- Form Section --}}
      <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Yuk, pesan layanan kebersihan sekarang!</h1>

        <form method="POST" action="{{ route('cleaning-request.store') }}" class="space-y-6">
          @csrf
          @php $inputClass = 'w-full rounded-xl border border-gray-200 bg-gray-100 p-4 text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500'; @endphp

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
            <input name="full_name" placeholder="Nama Lengkap" class="{{ $inputClass }}" value="{{ old('full_name') }}" required />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
            <input name="contact_number" placeholder="Nomor Telepon" class="{{ $inputClass }}" value="{{ old('contact_number') }}" required />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
            <input name="full_address" placeholder="Alamat" class="{{ $inputClass }}" value="{{ old('full_address') }}" required />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
            <input name="postal_code" placeholder="Kode Pos" class="{{ $inputClass }}" value="{{ old('postal_code') }}" required />
          </div>

          <h2 class="text-lg font-semibold text-gray-800 mt-6">Detail layanan</h2>

          <div class="grid grid-cols-2 gap-4">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Panjang ruangan (m)</label>
              <input name="room_length" type="number" step="0.01" placeholder="Panjang" class="{{ $inputClass }}" value="{{ old('room_length') }}" required />
            </div>
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Lebar ruangan (m)</label>
              <input name="room_width" type="number" step="0.01" placeholder="Lebar" class="{{ $inputClass }}" value="{{ old('room_width') }}" required />
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Jenis layanan</label>
            <select name="service_type" class="{{ $inputClass }}" required>
              <option value="">Pilih jenis layanan</option>
              <option value="home_cleaning" {{ old('service_type') == 'home_cleaning' ? 'selected' : '' }}>Pembersihan Rumah</option>
              <option value="office_cleaning" {{ old('service_type') == 'office_cleaning' ? 'selected' : '' }}>Pembersihan Kantor</option>
              <option value="furniture_cleaning" {{ old('service_type') == 'furniture_cleaning' ? 'selected' : '' }}>Pembersihan Perabotan</option>
            </select>
          </div>

          <h2 class="text-lg font-semibold text-gray-800 mt-6">Metode Pembayaran</h2>

          <div class="space-y-3">
            @foreach ([
              'credit_card' => 'Kartu Kredit',
              'debit_card' => 'Kartu Debit',
              'bank_transfer' => 'Transfer Bank',
            ] as $method => $label)
              <label class="flex items-center gap-3 bg-gray-50 border border-gray-200 rounded-xl p-3">
                <input type="radio" name="payment_method" value="{{ $method }}" class="h-5 w-5" {{ old('payment_method', 'credit_card') == $method ? 'checked' : '' }} required />
                <span class="text-sm text-gray-700">{{ $label }}</span>
              </label>
            @endforeach
          </div>

          <input type="hidden" name="subtotal" id="subtotal-input">
          <input type="hidden" name="service_fee" id="service-fee-input">
          <input type="hidden" name="tax" id="tax-input">
          <input type="hidden" name="total" id="total-input">
          <input type="hidden" name="estimated_duration" id="duration-input">
          <input type="hidden" name="scheduled_datetime" value="{{ now() }}">

          @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 p-4 rounded">
              <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <button type="submit" class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-3 rounded-xl">Lakukan Pemesanan</button>
        </form>
      </div>

      {{-- Summary Section --}}
      <div>
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Ringkasan Pesanan</h2>
        <div class="space-y-3 text-sm text-gray-700">
          <div class="flex justify-between">
            <span>Luas total</span>
            <span id="total-area">0 m²</span>
          </div>
          <div class="flex justify-between">
            <span>Durasi perkiraan</span>
            <span id="estimated-duration">0 jam</span>
          </div>
          <div class="flex justify-between">
            <span>Subtotal</span>
            <span id="subtotal">Rp 0</span>
          </div>
          <div class="flex justify-between">
            <span>Biaya layanan</span>
            <span id="service-fee">Rp 0</span>
          </div>
          <div class="flex justify-between">
            <span>Pajak (5%)</span>
            <span id="tax">Rp 0</span>
          </div>
          <div class="flex justify-between font-bold text-gray-900">
            <span>Total keseluruhan</span>
            <span id="grand-total">Rp 0</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    function calculatePrices() {
      const length = parseFloat(document.querySelector('input[name="room_length"]').value) || 0;
      const width = parseFloat(document.querySelector('input[name="room_width"]').value) || 0;
      const serviceType = document.querySelector('select[name="service_type"]').value;

      if (length > 0 && width > 0 && serviceType) {
        fetch('/cleaning-request/calculate-price', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
          },
          body: JSON.stringify({ 
            room_length: length, 
            room_width: width, 
            service_type: serviceType 
          })
        })
        .then(response => response.json())
        .then(data => {
          document.getElementById('total-area').textContent = data.area.toFixed(2) + ' m²';
          document.getElementById('estimated-duration').textContent = data.estimated_duration + ' jam';
          document.getElementById('subtotal').textContent = 'Rp ' + data.subtotal.toLocaleString('id-ID');
          document.getElementById('service-fee').textContent = 'Rp ' + data.service_fee.toLocaleString('id-ID');
          document.getElementById('tax').textContent = 'Rp ' + data.tax.toLocaleString('id-ID');
          document.getElementById('grand-total').textContent = 'Rp ' + data.total.toLocaleString('id-ID');

          document.getElementById('subtotal-input').value = data.subtotal;
          document.getElementById('service-fee-input').value = data.service_fee;
          document.getElementById('tax-input').value = data.tax;
          document.getElementById('total-input').value = data.total;
          document.getElementById('duration-input').value = data.estimated_duration;
        })
        .catch(error => {
          console.error('Error fetching price calculation:', error);
        });
      } else {
        document.getElementById('total-area').textContent = '0 m²';
        document.getElementById('estimated-duration').textContent = '0 jam';
        document.getElementById('subtotal').textContent = 'Rp 0';
        document.getElementById('service-fee').textContent = 'Rp 0';
        document.getElementById('tax').textContent = 'Rp 0';
        document.getElementById('grand-total').textContent = 'Rp 0';
        
        document.getElementById('subtotal-input').value = '0';
        document.getElementById('service-fee-input').value = '0';
        document.getElementById('tax-input').value = '0';
        document.getElementById('total-input').value = '0';
        document.getElementById('duration-input').value = '0';
      }
    }

    const roomLengthInput = document.querySelector('input[name="room_length"]');
    const roomWidthInput = document.querySelector('input[name="room_width"]');
    const serviceTypeSelect = document.querySelector('select[name="service_type"]');

    if (roomLengthInput) {
      roomLengthInput.addEventListener('input', calculatePrices);
      roomLengthInput.addEventListener('change', calculatePrices);
    }

    if (roomWidthInput) {
      roomWidthInput.addEventListener('input', calculatePrices);
      roomWidthInput.addEventListener('change', calculatePrices);
    }

    if (serviceTypeSelect) {
      serviceTypeSelect.addEventListener('change', calculatePrices);
    }

    calculatePrices();
  });
</script>
@endsection
