@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Shipping Address</h5>
                    <form action="{{ route('cleaning-request.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                id="full_name" name="full_name" placeholder="First & Last Name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="full_address" class="form-label">Address 1</label>
                            <input type="text" class="form-control @error('full_address') is-invalid @enderror" 
                                id="full_address" name="full_address" placeholder="Street address or P.O. Box" value="{{ old('full_address') }}" required>
                            @error('full_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address_2" class="form-label">Address 2</label>
                            <input type="text" class="form-control" 
                                id="address_2" name="address_2" placeholder="Apartment, suite, etc." value="{{ old('address_2') }}">
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City" value="{{ old('city') }}" required>
                            </div>
                            <div class="col-md-4">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip" placeholder="Zip code" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="card-title">Service Details</h5>
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="room_length" class="form-label">Room Length (meters)</label>
                                    <input type="number" step="0.01" min="0" class="form-control @error('room_length') is-invalid @enderror" 
                                        id="room_length" name="room_length" value="{{ old('room_length') }}" required>
                                    @error('room_length')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="room_width" class="form-label">Room Width (meters)</label>
                                    <input type="number" step="0.01" min="0" class="form-control @error('room_width') is-invalid @enderror" 
                                        id="room_width" name="room_width" value="{{ old('room_width') }}" required>
                                    @error('room_width')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="service_type" class="form-label">Service Type</label>
                                <select class="form-select @error('service_type') is-invalid @enderror" 
                                    id="service_type" name="service_type" required>
                                    <option value="">Select service type</option>
                                    @foreach($serviceTypes as $value => $label)
                                        <option value="{{ $value }}" {{ old('service_type') == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('service_type')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="scheduled_datetime" class="form-label">Scheduled Date and Time</label>
                                <input type="datetime-local" class="form-control @error('scheduled_datetime') is-invalid @enderror" 
                                    id="scheduled_datetime" name="scheduled_datetime" value="{{ old('scheduled_datetime') }}" required>
                                @error('scheduled_datetime')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-4">
                            <h5 class="card-title">Payment Method</h5>
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <div class="card payment-method-card active">
                                        <div class="card-body text-center">
                                            <i class="fas fa-credit-card mb-2"></i>
                                            <div>Card</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card payment-method-card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-wallet mb-2"></i>
                                            <div>Wallet</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card payment-method-card">
                                        <div class="card-body text-center">
                                            <i class="fas fa-money-bill mb-2"></i>
                                            <div>COD</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4">Order Summary</h5>
                    <div class="d-flex align-items-center mb-3">
                        <div class="flex-shrink-0">
                            <img src="{{ asset('path/to/service-icon.png') }}" alt="Service Icon" width="50">
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-0" id="selected-service">Selected Service</h6>
                            <small class="text-muted">Premium quality service</small>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-2">
                            <span>Area</span>
                            <span id="area" data-area>0 m²</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Subtotal</span>
                            <span id="subtotal" data-subtotal>Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Service Fee</span>
                            <span id="service_fee" data-service-fee>Rp 0</span>
                        </div>
                        <div class="d-flex justify-content-between mb-2">
                            <span>Tax</span>
                            <span id="tax" data-tax>Rp 0</span>
                        </div>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-4">
                        <strong>Total</strong>
                        <strong id="total" data-total>Rp 0</strong>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Place Order</button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
.payment-method-card {
    cursor: pointer;
    transition: all 0.3s ease;
}

.payment-method-card:hover,
.payment-method-card.active {
    border-color: #6366f1;
    background-color: #eef2ff;
}

.payment-method-card i {
    font-size: 24px;
    color: #6366f1;
}
</style>
@endpush

@push('scripts')
<script>
function updatePrices() {
    const length = document.getElementById('room_length').value || 0;
    const width = document.getElementById('room_width').value || 0;
    const serviceType = document.getElementById('service_type').value;

    if (length > 0 && width > 0 && serviceType) {
        fetch('{{ route("cleaning-request.calculate-price") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                room_length: length,
                room_width: width,
                service_type: serviceType
            })
        })
        .then(response => response.json())
        .then(data => {
            document.querySelector('[data-area]').textContent = data.area.toFixed(2) + ' m²';
            document.querySelector('[data-subtotal]').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.subtotal);
            document.querySelector('[data-service-fee]').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.service_fee);
            document.querySelector('[data-tax]').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.tax);
            document.querySelector('[data-total]').textContent = 'Rp ' + new Intl.NumberFormat('id-ID').format(data.total);
        });
    }
}

// Payment method selection
document.querySelectorAll('.payment-method-card').forEach(card => {
    card.addEventListener('click', function() {
        document.querySelectorAll('.payment-method-card').forEach(c => c.classList.remove('active'));
        this.classList.add('active');
        document.getElementById('card-details').style.display = 
            this.querySelector('.card-body').textContent.trim() === 'Card' ? 'block' : 'none';
    });
});

// Update prices when inputs change
document.getElementById('room_length').addEventListener('input', updatePrices);
document.getElementById('room_width').addEventListener('input', updatePrices);
document.getElementById('service_type').addEventListener('change', updatePrices);

// Update selected service name
document.getElementById('service_type').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    document.getElementById('selected-service').textContent = selectedOption.text;
});
</script>
@endpush