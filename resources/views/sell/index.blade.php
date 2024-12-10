@extends('layouts.app')

@section('content')
<div class="container mx-auto py-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <h1 class="text-2xl font-semibold mb-6 text-center">Bike Sales</h1>

        <!-- Sale Form -->
        <form action="{{ route('sell.store') }}" method="POST">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column: Buyer, Contact, Address -->
                <div class="space-y-4">
                    <div class="mb-4">
                        <label for="buyer_name" class="block text-sm font-semibold text-gray-700">Buyer Name</label>
                        <input type="text" id="buyer_name" name="buyer_name" class="p-3 border rounded-lg w-full focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="contact" class="block text-sm font-semibold text-gray-700">Contact</label>
                        <input type="text" id="contact" name="contact" class="p-3 border rounded-lg w-full focus:ring-2 focus:ring-blue-500" required>
                    </div>

                    <div class="mb-4">
                        <label for="address" class="block text-sm font-semibold text-gray-700">Address</label>
                        <input type="text" id="address" name="address" class="p-3 border rounded-lg w-full focus:ring-2 focus:ring-blue-500" required>
                    </div>
                </div>

                <!-- Right Column: Bike Selection -->
                <div class="space-y-4">
                    <div id="bikes_section">
                        <div class="bike_entry" id="bike_0">
                            <div class="mb-4">
                                <label for="bike_barcode" class="block text-sm font-semibold text-gray-700">Bike Barcode</label>
                                <input type="text" name="bikes[0][barcode]" class="p-3 border rounded-lg w-full bike-barcode" placeholder="Scan or Enter Barcode" required>
                            </div>

                            <div class="mb-4">
                                <label for="bike_name" class="block text-sm font-semibold text-gray-700">Bike Name</label>
                                <select name="bikes[0][bike_id]" class="p-3 border rounded-lg w-full bike-name" required>
                                    <option value="">Select a bike</option>
                                    @foreach($bikes as $bike)
                                        <option value="{{ $bike->id }}" data-barcode="{{ $bike->barcode }}" data-price="{{ $bike->price }}">{{ $bike->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mb-4">
                                <label for="bike_price" class="block text-sm font-semibold text-gray-700">Bike Price</label>
                                <input type="text" name="bikes[0][price]" class="p-3 border rounded-lg w-full bike-price" placeholder="Price" readonly>
                            </div>

                            <div class="mb-4">
                                <label for="quantity" class="block text-sm font-semibold text-gray-700">Quantity</label>
                                <input type="number" name="bikes[0][quantity]" class="p-3 border rounded-lg w-full bike-quantity" min="1" value="1" required>
                            </div>
                        </div>
                    </div>

                    <button type="button" id="add_bike" class="bg-blue-500 text-white py-3 px-6 rounded-lg hover:bg-blue-600 w-full">Add Another Bike</button>
                </div>
            </div>

            <!-- Total Amount -->
            <div class="mb-4">
                <label for="total_amount" class="block text-sm font-semibold text-gray-700">Total Amount</label>
                <input type="number" id="total_amount" name="total_amount" class="p-3 border rounded-lg w-full focus:ring-2 focus:ring-blue-500" readonly>
            </div>

            <button type="submit" class="bg-red-600 text-white font-semibold text-lg px-6 py-3 rounded-lg shadow-md hover:bg-red-700 focus:ring-2 focus:ring-red-500 transition duration-300 w-full sm:w-auto">Submit Sale</button>
        </form>
    </div>
</div>

<script>
    // Function to search for a bike by barcode and auto-select the bike name and price
    function searchAndPopulateBike(inputValue, barcodeInput) {
        const bikes = @json($bikes); // Pass bikes array from PHP to JavaScript

        // Search for the bike by barcode
        const foundBike = bikes.find(bike => bike.barcode === inputValue);

        if (foundBike) {
            // Set bike ID and price in the form
            barcodeInput.closest('.bike_entry').querySelector('.bike-name').value = foundBike.id;
            barcodeInput.closest('.bike_entry').querySelector('.bike-price').value = foundBike.price;

            // Select the bike name in the dropdown
            const bikeDropdown = barcodeInput.closest('.bike_entry').querySelector('.bike-name');
            const optionToSelect = Array.from(bikeDropdown.options).find(option => option.value == foundBike.id);
            if (optionToSelect) {
                bikeDropdown.value = optionToSelect.value;
            }

            // Automatically update the total amount
            updateTotalAmount();
        } else {
            // If not found, clear the fields
            barcodeInput.closest('.bike_entry').querySelector('.bike-name').value = '';
            barcodeInput.closest('.bike_entry').querySelector('.bike-price').value = '';
        }
    }

    // Handle quantity and total calculation
    function updateTotalAmount() {
        const bikes = document.querySelectorAll('.bike_entry');
        let totalAmount = 0;

        bikes.forEach((bike) => {
            const quantityInput = bike.querySelector('.bike-quantity');
            const priceInput = bike.querySelector('.bike-price');
            const price = parseFloat(priceInput.value || 0);
            const quantity = parseInt(quantityInput.value || 0);

            totalAmount += price * quantity;
        });

        document.getElementById('total_amount').value = totalAmount;
    }

    // Handle dropdown change event to update total amount
    function handleDropdownChange(event) {
        const bikeDropdown = event.target;
        const bikePriceInput = bikeDropdown.closest('.bike_entry').querySelector('.bike-price');

        const selectedOption = bikeDropdown.selectedOptions[0];
        if (selectedOption) {
            const price = selectedOption.dataset.price;
            bikePriceInput.value = price;

            // Update total amount when price changes
            updateTotalAmount();
        }
    }

    // Handle quantity change event to update total amount
    function handleQuantityChange(event) {
        // Update total amount when quantity changes
        updateTotalAmount();
    }

    // Update total amount on input change
    document.getElementById('bikes_section').addEventListener('input', (event) => {
        if (event.target.classList.contains('bike-quantity')) {
            handleQuantityChange(event);
        }
    });

    // Add another bike selection field dynamically
    document.getElementById('add_bike').addEventListener('click', function() {
        const bikeEntries = document.getElementById('bikes_section');
        const bikeCount = bikeEntries.getElementsByClassName('bike_entry').length;

        // Create new bike entry set (fresh fields)
        const newBikeEntry = document.createElement('div');
        newBikeEntry.classList.add('bike_entry');
        newBikeEntry.id = `bike_${bikeCount}`;

        // Create fresh set of inputs for new bike entry
        newBikeEntry.innerHTML = `
            <div class="mb-4">
                <label for="bike_barcode" class="block text-sm font-semibold text-gray-700">Bike Barcode</label>
                <input type="text" name="bikes[${bikeCount}][barcode]" class="p-3 border rounded-lg w-full bike-barcode" placeholder="Scan or Enter Barcode" required>
            </div>

            <div class="mb-4">
                <label for="bike_name" class="block text-sm font-semibold text-gray-700">Bike Name</label>
                <select name="bikes[${bikeCount}][bike_id]" class="p-3 border rounded-lg w-full bike-name" required>
                    <option value="">Select a bike</option>
                    @foreach($bikes as $bike)
                        <option value="{{ $bike->id }}" data-barcode="{{ $bike->barcode }}" data-price="{{ $bike->price }}">{{ $bike->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label for="bike_price" class="block text-sm font-semibold text-gray-700">Bike Price</label>
                <input type="text" name="bikes[${bikeCount}][price]" class="p-3 border rounded-lg w-full bike-price" placeholder="Price" readonly>
            </div>

            <div class="mb-4">
                <label for="quantity" class="block text-sm font-semibold text-gray-700">Quantity</label>
                <input type="number" name="bikes[${bikeCount}][quantity]" class="p-3 border rounded-lg w-full bike-quantity" min="1" value="1" required>
            </div>
        `;

        // Attach event listeners for new bike input
        const barcodeInput = newBikeEntry.querySelector('.bike-barcode');
        barcodeInput.addEventListener('input', function (e) {
            const inputValue = e.target.value;
            searchAndPopulateBike(inputValue, barcodeInput);
        });

        const bikeDropdown = newBikeEntry.querySelector('.bike-name');
        bikeDropdown.addEventListener('change', handleDropdownChange);

        // Append new bike entry to the section
        bikeEntries.appendChild(newBikeEntry);
    });

    // Add event listener to barcode input fields for live search
    document.querySelectorAll('.bike-barcode').forEach(barcodeInput => {
        barcodeInput.addEventListener('input', function (e) {
            const inputValue = e.target.value;
            searchAndPopulateBike(inputValue, barcodeInput);
        });
    });

    // Attach dropdown change event listener to existing dropdowns
    document.querySelectorAll('.bike-name').forEach(bikeDropdown => {
        bikeDropdown.addEventListener('change', handleDropdownChange);
    });
</script>

@endsection
