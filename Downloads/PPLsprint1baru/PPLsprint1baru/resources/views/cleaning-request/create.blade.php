@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Service Address</h5>
                    <form action="{{ route('cleaning-request.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                            @error('full_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address_line1" class="form-label">Address Line 1</label>
                            <input type="text" class="form-control @error('address_line1') is-invalid @enderror" 
                                id="address_line1" name="address_line1" value="{{ old('address_line1') }}" required>
                            @error('address_line1')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="address_line2" class="form-label">Address Line 2 (Optional)</label>
                            <input type="text" class="form-control" id="address_line2" name="address_line2" 
                                value="{{ old('address_line2') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" 
                                    id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="state" class="form-label">State</label>
                                <select class="form-select @error('state') is-invalid @enderror" 
                                    id="state" name="state" required>
                                    <option value="">Select state</option>
                                    @foreach($states as $code => $name)
                                        <option value="{{ $code }}" {{ old('state') == $code ? 'selected' : '' }}>
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('state')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-3 mb-3">
                                <label for="zip_code" class="form-label">Zip Code</label>
                                <input type="text" class="form-control @error('zip_code') is-invalid @enderror" 
                                    id="zip_code" name="zip_code" value="{{ old('zip_code') }}" required>
                                @error('zip_code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <h5 class="mt-4 mb-3">Payment Method</h5>
                        <div class="mb-3">
                            <label for="card_name" class="form-label">Name on Card</label>
                            <input type="text" class="form-control @error('card_name') is-invalid @enderror" 
                                id="card_name" name="card_name" value="{{ old('card_name') }}" required>
                            @error('card_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="card_number" class="form-label">Card Number</label>
                            <input type="text" class="form-control @error('card_number') is-invalid @enderror" 
                                id="card_number" name="card_number" value="{{ old('card_number') }}" required>
                            @error('card_number')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="expiry_date" class="form-label">Expiry Date</label>
                                <input type="text" class="form-control @error('expiry_date') is-invalid @enderror" 
                                    id="expiry_date" name="expiry_date" placeholder="MM/YYYY" 
                                    value="{{ old('expiry_date') }}" required>
                                @error('expiry_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control @error('cvv') is-invalid @enderror" 
                                    id="cvv" name="cvv" value="{{ old('cvv') }}" required>
                                @error('cvv')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Order Summary</h5>
                    <div class="mb-3">
                        <p class="mb-1">Cleaning Service</p>
                        <p class="text-muted small">Standard cleaning package</p>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Subtotal</span>
                        <span>$80.00</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Service Fee</span>
                        <span>$5.00</span>
                    </div>

                    <div class="d-flex justify-content-between mb-2">
                        <span>Tax</span>
                        <span>$6.80</span>
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between mb-3">
                        <strong>Total</strong>
                        <strong>$91.80</strong>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Place Order</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection