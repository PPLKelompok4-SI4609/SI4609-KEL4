@extends('layouts.app')

@section('title', 'Payment Method | Donasi')

@section('content')
<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
    <div class="flex justify-between gap-12">
        <!-- Left Side: Payment Form -->
        <div class="w-2/3 bg-white p-8 rounded-md shadow-md">
            <h2 class="text-2xl font-serif font-bold text-[#2f7f6f] mb-4">Metode Pembayaran</h2>
            <p class="text-sm text-gray-600 mb-6">Silakan pilih metode pembayaran Anda dan lengkapi informasi berikut.</p>
            <form action="{{ route('payment.process') }}" method="POST">
                @csrf
                <input type="hidden" name="donation_id" value="{{ session('donation')->id }}">

                <!-- Donation Amount Displayed -->
                <div class="form-group mb-4">
                    <label for="amount" class="block text-sm text-gray-700">Jumlah Donasi</label>
                    <input type="text" name="amount" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" value="Rp. {{ number_format(session('donation')->amount, 0, ',', '.') }}" disabled>
                </div>

                <!-- Payment Method Selection -->
                <div class="form-group mb-4">
                    <label for="payment_method" class="block text-sm text-gray-700">Metode Pembayaran</label>
                    <select name="payment_method" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" id="payment_method" required>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="e_wallet">E-Wallet</option>
                    </select>
                </div>

                <!-- Card Number Input (only visible if Kartu Kredit is selected) -->
                <div id="card_number_group" class="form-group mb-4 hidden">
                    <label for="card_number" class="block text-sm text-gray-700">Nomor Kartu</label>
                    <input type="text" name="card_number" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" placeholder="1234 1234 1234 1234">
                </div>

                <!-- CCV Input (only visible if Kartu Kredit is selected) -->
                <div id="ccv_group" class="form-group mb-4 hidden">
                    <label for="ccv" class="block text-sm text-gray-700">CCV</label>
                    <input type="text" name="ccv" class="form-control mt-2 p-3 border border-gray-300 rounded w-full" placeholder="123">
                </div>

                <!-- Bank Transfer Selection (only visible if Transfer Bank is selected) -->
                <div id="bank_transfer_group" class="form-group mb-4 hidden">
                    <label for="bank_provider" class="block text-sm text-gray-700">Pilih Bank</label>
                    <div class="space-y-4">
                        <div>
                            <input type="radio" id="bca" name="bank_provider" value="bca" class="mr-2">
                            <label for="bca" class="text-sm text-gray-700">Bank Central Asia (BCA) (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="mandiri" name="bank_provider" value="mandiri" class="mr-2">
                            <label for="mandiri" class="text-sm text-gray-700">Bank Mandiri (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="bri" name="bank_provider" value="bri" class="mr-2">
                            <label for="bri" class="text-sm text-gray-700">Bank Rakyat Indonesia (BRI) (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="bni" name="bank_provider" value="bni" class="mr-2">
                            <label for="bni" class="text-sm text-gray-700">Bank Negara Indonesia (BNI) (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="cimb" name="bank_provider" value="cimb" class="mr-2">
                            <label for="cimb" class="text-sm text-gray-700">CIMB Niaga (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="permata" name="bank_provider" value="permata" class="mr-2">
                            <label for="permata" class="text-sm text-gray-700">Bank Permata (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="syariah" name="bank_provider" value="syariah" class="mr-2">
                            <label for="syariah" class="text-sm text-gray-700">Bank Syariah Indonesia (BSI) (+Rp. 2,500)</label>
                        </div>
                        <div>
                            <input type="radio" id="btn" name="bank_provider" value="btn" class="mr-2">
                            <label for="btn" class="text-sm text-gray-700">Bank Tabungan Negara (BTN) (+Rp. 2,500)</label>
                        </div>
                    </div>
                </div>

                <!-- E-Wallet Selection (only visible if E-Wallet is selected) -->
                <div id="ewallet_group" class="form-group mb-4 hidden">
                    <label for="ewallet_provider" class="block text-sm text-gray-700">Pilih E-Wallet</label>
                    <div class="space-y-4">
                        <div>
                            <input type="radio" id="ovo" name="ewallet_provider" value="ovo" class="mr-2">
                            <label for="ovo" class="text-sm text-gray-700">OVO (+Rp. 1,350)</label>
                        </div>
                        <div>
                            <input type="radio" id="dana" name="ewallet_provider" value="dana" class="mr-2">
                            <label for="dana" class="text-sm text-gray-700">DANA (+Rp. 1,350)</label>
                        </div>
                        <div>
                            <input type="radio" id="qris" name="ewallet_provider" value="qris" class="mr-2">
                            <label for="qris" class="text-sm text-gray-700">QRIS (+Rp. 1,065)</label>
                        </div>
                        <div>
                            <input type="radio" id="shopeepay" name="ewallet_provider" value="shopeepay" class="mr-2">
                            <label for="shopeepay" class="text-sm text-gray-700">ShopeePay (+Rp. 1,350)</label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="w-full bg-[#2f7f6f] text-white font-semibold py-3 rounded text-sm hover:bg-[#276a5c] transition">Selesaikan Pembayaran</button>
            </form>
        </div>

        <!-- Right Side: Transaction Summary -->
        <div class="w-1/3 bg-[#f4faff] p-6 rounded-md shadow-md">
            <h3 class="text-xl font-serif font-bold text-[#2f7f6f] mb-4">Rincian Transaksi</h3>
            <div class="flex justify-between text-sm mb-3">
                <span>Total</span>
                <span id="donation_amount">Rp. {{ number_format(session('donation')->amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between text-sm mb-3">
                <span>Biaya Transaksi</span>
                <span id="transaction_fee">+Rp. 0</span>
            </div>
            <div class="flex justify-between text-xl font-semibold mb-4">
                <span>Total Pembayaran</span>
                <span id="total_amount">Rp. {{ number_format(session('donation')->amount, 0, ',', '.') }}</span>
            </div>
        </div>
    </div>
</main>

<script>
    // Store the original donation amount as a number
    const originalDonationAmount = {{ session('donation')->amount }};
    
    // Get DOM elements
    const paymentMethodSelect = document.getElementById('payment_method');
    const cardNumberGroup = document.getElementById('card_number_group');
    const ccvGroup = document.getElementById('ccv_group');
    const bankTransferGroup = document.getElementById('bank_transfer_group');
    const ewalletGroup = document.getElementById('ewallet_group');
    const donationAmount = document.getElementById('donation_amount');
    const transactionFee = document.getElementById('transaction_fee');
    const totalAmount = document.getElementById('total_amount');
    
    // Bank transfer provider fees
    const bankProviders = {
        'bca': 2500,
        'mandiri': 2500,
        'bri': 2500,
        'bni': 2500,
        'cimb': 2500,
        'permata': 2500,
        'syariah': 2500,
        'btn': 2500
    };
    
    // E-wallet provider fees
    const ewalletProviders = {
        'ovo': 1350,
        'dana': 1350,
        'qris': 1065,
        'shopeepay': 1350
    };

    // Function to format number as Indonesian currency
    function formatCurrency(amount) {
        return new Intl.NumberFormat('id-ID').format(amount);
    }

    // Function to update transaction summary
    function updateTransactionSummary() {
        let fee = 0;
        let method = paymentMethodSelect.value;

        if (method === 'e_wallet') {
            const selectedProvider = document.querySelector('input[name="ewallet_provider"]:checked');
            if (selectedProvider) {
                fee = ewalletProviders[selectedProvider.value] || 0;
            }
        } else if (method === 'bank_transfer') {
            const selectedBank = document.querySelector('input[name="bank_provider"]:checked');
            if (selectedBank) {
                fee = bankProviders[selectedBank.value] || 0;
            }
        } else if (method === 'credit_card') {
            fee = 0; // No fee for credit card
        }

        // Update transaction fee display
        transactionFee.textContent = fee > 0 ? `+Rp. ${formatCurrency(fee)}` : `Rp. 0`;
        
        // Calculate and update total amount
        const total = originalDonationAmount + fee;
        totalAmount.textContent = `Rp. ${formatCurrency(total)}`;
    }

    // Function to show/hide payment method specific fields
    function togglePaymentFields() {
        const method = paymentMethodSelect.value;
        
        // Hide all conditional fields first
        cardNumberGroup.classList.add('hidden');
        ccvGroup.classList.add('hidden');
        bankTransferGroup.classList.add('hidden');
        ewalletGroup.classList.add('hidden');
        
        // Show relevant fields based on selected method
        if (method === 'credit_card') {
            cardNumberGroup.classList.remove('hidden');
            ccvGroup.classList.remove('hidden');
        } else if (method === 'bank_transfer') {
            bankTransferGroup.classList.remove('hidden');
        } else if (method === 'e_wallet') {
            ewalletGroup.classList.remove('hidden');
        }
        
        // Update transaction summary
        updateTransactionSummary();
    }

    // Event listener for payment method selection
    paymentMethodSelect.addEventListener('change', togglePaymentFields);

    // Event listeners for bank transfer provider selection
    const bankRadioButtons = document.querySelectorAll('input[name="bank_provider"]');
    bankRadioButtons.forEach(radio => {
        radio.addEventListener('change', updateTransactionSummary);
    });

    // Event listeners for e-wallet provider selection
    const ewalletRadioButtons = document.querySelectorAll('input[name="ewallet_provider"]');
    ewalletRadioButtons.forEach(radio => {
        radio.addEventListener('change', updateTransactionSummary);
    });

    // Initial setup
    togglePaymentFields();
</script>
@endsection