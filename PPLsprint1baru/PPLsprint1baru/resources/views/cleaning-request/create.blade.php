<!DOCTYPE html>
<html>
  <head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="" />
    <link
      rel="stylesheet"
      as="style"
      onload="this.rel='stylesheet'"
      href="https://fonts.googleapis.com/css2?display=swap&amp;family=Noto+Sans%3Awght%40400%3B500%3B700%3B900&amp;family=Work+Sans%3Awght%40400%3B500%3B700%3B900"
    />

    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
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
              console.error('Error:', error);
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

        document.querySelector('input[name="room_length"]').addEventListener('input', calculatePrices);
        document.querySelector('input[name="room_width"]').addEventListener('input', calculatePrices);
        document.querySelector('select[name="service_type"]').addEventListener('change', calculatePrices);
      });
    </script>
  </head>
  <body>
    <div
      class="relative flex size-full min-h-screen flex-col bg-white group/design-root overflow-x-hidden"
      style="--radio-dot-svg: url('data:image/svg+xml,%3csvg viewBox=\'0 0 16 16\' fill=\'rgb(17,21,24)\' xmlns=\'http://www.w3.org/2000/svg\'%3e%3ccircle cx=\'8\' cy=\'8\' r=\'3\'/%3e%3c/svg%3e'); --select-button-svg: url('data:image/svg+xml,%3csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'24px\' height=\'24px\' fill=\'rgb(99,124,136)\' viewBox=\'0 0 256 256\'%3e%3cpath d=\'M181.66,170.34a8,8,0,0,1,0,11.32l-48,48a8,8,0,0,1-11.32,0l-48-48a8,8,0,0,1,11.32-11.32L128,212.69l42.34-42.35A8,8,0,0,1,181.66,170.34Zm-96-84.68L128,43.31l42.34,42.35a8,8,0,0,0,11.32-11.32l-48-48a8,8,0,0,0-11.32,0l-48,48A8,8,0,0,0,85.66,85.66Z\'%3e%3c/path%3e%3c/svg%3e'); font-family: 'Work Sans', 'Noto Sans', sans-serif;"
    >
      <div class="layout-container flex h-full grow flex-col">
        <div class="px-40 flex flex-1 justify-center py-5">
          <div class="layout-content-container flex flex-col w-[512px] max-w-[512px] py-5 max-w-[960px] flex-1">
            <div class="flex flex-wrap justify-between gap-3 p-4">
              <p class="text-[#111518] tracking-light text-[32px] font-bold leading-tight min-w-72">Yuk, pesan layanan kebersihan sekarang!</p>
            </div>
            <form method="POST" action="{{ route('cleaning-request.store') }}" class="space-y-4">
              @csrf
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Nama Lengkap</p>
                  <input
                    name="full_name"
                    placeholder="Nama Lengkap"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    value="{{ old('full_name') }}"
                    required
                  />
                </label>
              </div>
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Nomor Telepon</p>
                  <input
                    name="contact_number"
                    placeholder="Nomor Telepon"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    value="{{ old('contact_number') }}"
                    required
                  />
                </label>
              </div>
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Alamat</p>
                  <input
                    name="full_address"
                    placeholder="Alamat"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    value="{{ old('full_address') }}"
                    required
                  />
                </label>
              </div>
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Kode Pos</p>
                  <input
                    name="postal_code"
                    placeholder="Kode Pos"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    value="{{ old('postal_code') }}"
                    required
                  />
                </label>
              </div>
              <h3 class="text-[#111518] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Detail layanan</h3>
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Panjang ruangan (m)</p>
                  <input
                    name="room_length"
                    placeholder="Panjang ruangan (m)"
                    type="number"
                    step="0.01"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    value="{{ old('room_length') }}"
                    required
                  />
                </label>
              </div>
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Lebar ruangan (m)</p>
                  <input
                    name="room_width"
                    placeholder="Lebar ruangan (m)"
                    type="number"
                    step="0.01"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    value="{{ old('room_width') }}"
                    required
                  />
                </label>
              </div>
              <div class="flex max-w-[480px] flex-wrap items-end gap-4 px-4 py-3">
                <label class="flex flex-col min-w-40 flex-1">
                  <p class="text-[#111518] text-base font-medium leading-normal pb-2">Jenis layanan</p>
                  <select
                    name="service_type"
                    class="form-input flex w-full min-w-0 flex-1 resize-none overflow-hidden rounded-xl text-[#111518] focus:outline-0 focus:ring-0 border-none bg-[#f0f3f4] focus:border-none h-14 bg-[image:--select-button-svg] placeholder:text-[#637c88] p-4 text-base font-normal leading-normal"
                    required
                  >
                    <option value="">Pilih jenis layanan</option>
                    <option value="home_cleaning" {{ old('service_type') == 'home_cleaning' ? 'selected' : '' }}>Pembersihan Rumah</option>
                    <option value="office_cleaning" {{ old('service_type') == 'office_cleaning' ? 'selected' : '' }}>Pembersihan Kantor</option>
                    <option value="furniture_cleaning" {{ old('service_type') == 'furniture_cleaning' ? 'selected' : '' }}>Pembersihan Perabotan</option>
                  </select>
                </label>
              </div>
              <h3 class="text-[#111518] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Metode Pembayaran</h3>
              <div class="flex flex-col gap-3 p-4">
                <label class="flex items-center gap-4 rounded-xl border border-solid border-[#dce2e5] p-[15px] flex-row-reverse">
                  <input
                    type="radio"
                    name="payment_method"
                    value="credit_card"
                    class="h-5 w-5 border-2 border-[#dce2e5] bg-transparent text-transparent checked:border-[#111518] checked:bg-[image:--radio-dot-svg] focus:outline-none focus:ring-0 focus:ring-offset-0 checked:focus:border-[#111518]"
                    {{ old('payment_method', 'credit_card') == 'credit_card' ? 'checked' : '' }}
                    required
                  />
                  <div class="flex grow flex-col"><p class="text-[#111518] text-sm font-medium leading-normal">Kartu Kredit</p></div>
                </label>
                <label class="flex items-center gap-4 rounded-xl border border-solid border-[#dce2e5] p-[15px] flex-row-reverse">
                  <input
                    type="radio"
                    name="payment_method"
                    value="debit_card"
                    class="h-5 w-5 border-2 border-[#dce2e5] bg-transparent text-transparent checked:border-[#111518] checked:bg-[image:--radio-dot-svg] focus:outline-none focus:ring-0 focus:ring-offset-0 checked:focus:border-[#111518]"
                    {{ old('payment_method') == 'debit_card' ? 'checked' : '' }}
                  />
                  <div class="flex grow flex-col"><p class="text-[#111518] text-sm font-medium leading-normal">Kartu Debit</p></div>
                </label>
                <label class="flex items-center gap-4 rounded-xl border border-solid border-[#dce2e5] p-[15px] flex-row-reverse">
                  <input
                    type="radio"
                    name="payment_method"
                    value="bank_transfer"
                    class="h-5 w-5 border-2 border-[#dce2e5] bg-transparent text-transparent checked:border-[#111518] checked:bg-[image:--radio-dot-svg] focus:outline-none focus:ring-0 focus:ring-offset-0 checked:focus:border-[#111518]"
                    {{ old('payment_method') == 'bank_transfer' ? 'checked' : '' }}
                  />
                  <div class="flex grow flex-col"><p class="text-[#111518] text-sm font-medium leading-normal">Transfer Bank</p></div>
                </label>
              </div>

              <!-- Hidden fields for calculated values -->
              <input type="hidden" name="subtotal" id="subtotal-input">
              <input type="hidden" name="service_fee" id="service-fee-input">
              <input type="hidden" name="tax" id="tax-input">
              <input type="hidden" name="total" id="total-input">
              <input type="hidden" name="estimated_duration" id="duration-input">
              <input type="hidden" name="scheduled_datetime" value="{{ now() }}">

              @if ($errors->any())
                <div class="px-4">
                  <div class="rounded-md bg-red-50 p-4">
                    <div class="flex">
                      <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">There were errors with your submission</h3>
                        <div class="mt-2 text-sm text-red-700">
                          <ul class="list-disc pl-5 space-y-1">
                            @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              <div class="flex px-4 py-3">
                <button
                  type="submit"
                  class="flex min-w-[84px] max-w-[480px] cursor-pointer items-center justify-center overflow-hidden rounded-xl h-12 px-5 flex-1 bg-[#19a2e6] text-white text-base font-bold leading-normal tracking-[0.015em] hover:bg-[#1792cf] focus:outline-none focus:ring-2 focus:ring-[#19a2e6] focus:ring-offset-2"
                >
                  <span class="truncate">Lakukan pemesanan</span>
                </button>
              </div>
            </form>
          </div>
          <div class="layout-content-container flex flex-col w-[512px] max-w-[512px] py-5">
            <h3 class="text-[#111518] text-lg font-bold leading-tight tracking-[-0.015em] px-4 pb-2 pt-4">Ringkasan pesanan</h3>
            <div class="p-4">
              <div class="flex justify-between gap-x-6 py-2">
                <p class="text-[#637c88] text-sm font-normal leading-normal">Luas total</p>
                <p class="text-[#111518] text-sm font-normal leading-normal text-right" id="total-area">0 m²</p>
              </div>
              <div class="flex justify-between gap-x-6 py-2">
                <p class="text-[#637c88] text-sm font-normal leading-normal">Durasi perkiraan</p>
                <p class="text-[#111518] text-sm font-normal leading-normal text-right" id="estimated-duration">0 jam</p>
              </div>
              <div class="flex justify-between gap-x-6 py-2">
                <p class="text-[#637c88] text-sm font-normal leading-normal">Subtotal</p>
                <p class="text-[#111518] text-sm font-normal leading-normal text-right" id="subtotal">Rp 0</p>
              </div>
              <div class="flex justify-between gap-x-6 py-2">
                <p class="text-[#637c88] text-sm font-normal leading-normal">Biaya layanan</p>
                <p class="text-[#111518] text-sm font-normal leading-normal text-right" id="service-fee">Rp 0</p>
              </div>
              <div class="flex justify-between gap-x-6 py-2">
                <p class="text-[#637c88] text-sm font-normal leading-normal">Pajak (5%)</p>
                <p class="text-[#111518] text-sm font-normal leading-normal text-right" id="tax">Rp 0</p>
              </div>
              <div class="flex justify-between gap-x-6 py-2">
                <p class="text-[#637c88] text-sm font-normal leading-normal">Total keseluruhan</p>
                <p class="text-[#111518] text-sm font-normal leading-normal text-right" id="grand-total">Rp 0</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
