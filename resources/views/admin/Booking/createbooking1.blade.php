@extends('admin.layout.app')
@section('title') Create Booking @endsection
@section('dashboard')
<main>
    <div class="container-fluid px-2 mt-2">
        @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endif

        <form action="{{ route('booking_stores') }}" method="POST">
            @csrf
            
            <!-- 1. Room Selection Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Room Selection</h4>
                </div>
                <div class="d-flex mt-2 px-1">
                            <span class="badge bg-success me-2">Available</span>
                            <span class="badge bg-danger me-2">Occupied</span>
                            
                            <span class="badge bg-warning me-2">Maintenance</span>
                        </div>
                <div class="card-body">
                    <div class="row">

                        @foreach($availableRooms as $type => $rooms)
                        <div class="col-md-3 mb-3">
                            <h5>{{ ucfirst($type) }}</h5>
                            <div class="d-flex flex-wrap">
                                @foreach($rooms as $room)
                                @if($room->status === 'available')
        <!-- Available Room (Clickable) -->
                        <button 
                            type="button" 
                            class="btn btn-sm m-1 room-pill btn-success"
                            onclick="selectRoom({{ $room->id }}, {{ $room->price }}, '{{ $room->room_no }}')"
                            data-room-id="{{ $room->id }}"
                            style="width: 60px; height: 40px; padding: 0;"
                        >
                            {{ $room->room_no }}
                        </button>
                        @endif
                       @if($room->status === 'occupied')
        <!-- Occupied Room (Checkout Button) -->
        <button 
    type="button" 
    class="btn btn-sm m-1 room-pill btn-danger"
    data-toggle="modal" 
    data-target="#checkoutModal{{ $room->id }}"
    style="width: 60px; height: 40px; padding: 0; cursor: not-allowed;"
>
    {{ $room->room_no }}
</button>
 @endif
 @if($room->status === 'maintenance')
 <button 
    type="button" 
    class="btn btn-sm m-1 room-pill btn-warning"
    data-toggle="modal" 
    data-target="#checkoutModal{{ $room->id }}"
    style="width: 60px; height: 40px; padding: 0; cursor: not-allowed;"
>
    {{ $room->room_no }}
</button>
                        @endif
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label class="form-label">Selected Room No.</label>
                            <input type="text" class="form-control" readonly id="selected_room_id">
                            <input type="hidden" name="room_id" id="selected_room_id_no">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Room Price (₹)</label>
                            <input type="text" class="form-control" readonly id="selected_room_price">
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Guest Information Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Guest Information</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="guestName" class="form-label">Full Name *</label>
                            <input type="text" class="form-control" id="guestName" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="guestEmail" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="guestEmail" name="email">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="guestPhone" class="form-label">Phone Number *</label>
                            <input type="tel" class="form-control" id="guestPhone" name="phone" required>
                        </div>
                        <div class="col-md-6">
                            <label for="guestAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="guestAddress" name="address" rows="1"></textarea>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6 mb-3 mb-md-0">
                            <label for="documentType" class="form-label">ID Proof Type *</label>
                            <select class="form-select" id="documentType" name="document_type" required>
                                <option value="" selected disabled>Select document type</option>
                                <option value="passport">Passport</option>
                                <option value="aadhar_card">Aadhaar Card</option>
                                <option value="driver_license">Driving License</option>
                                <option value="voter_id">Voter ID</option>
                                <option value="pan_card">PAN Card</option>
                                <option value="other">Other</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="documentNumber" class="form-label">ID Proof Number *</label>
                            <input type="text" class="form-control" id="documentNumber" name="document_number" required>
                        </div>
                    </div>

                    <div class="row mb-3" hidden>
                        <div class="col-md-6">
                            <label for="purpose_of_visit" class="form-label">Purpose of Visit</label>
                            <input type="text" class="form-control" id="purpose_of_visit" name="purpose_of_visit">
                        </div>
                        <div class="col-md-6" hidden>
                            <label for="expected_checkin_time" class="form-label">Expected Check-in Time</label>
                            <input type="time" class="form-control" id="expected_checkin_time" name="expected_checkin_time">
                        </div>
                    </div>

                    <div class="mb-3" hidden>
                        <label for="special_requests" class="form-label">Special Requests</label>
                        <textarea class="form-control" id="special_requests" name="special_requests" rows="2"></textarea>
                    </div>
                </div>
            </div>

            <!-- 3. Stay Details Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Stay Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="checkin_date" class="form-label">Check-In Date *</label>
                                <input type="date" class="form-control" id="checkin_date" name="check_in_date" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="checkout_date" class="form-label">Check-Out Date *</label>
                                <input type="date" class="form-control" id="checkout_date" name="check_out_date" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">Number of Nights</label>
                                <input type="text" class="form-control" name="no_of_nights" id="nights_count" readonly>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="no_of_adults" class="form-label">Adults *</label>
                                <input type="number" class="form-control" name="no_of_adults" id="no_of_adults" min="0" value="0" required>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="no_of_children" class="form-label">Children</label>
                                <input type="number" class="form-control" name="no_of_children" id="no_of_children" min="0" value="0">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                            <div class="mb-3">
                                <label for="total_on_guest" class="form-label">Total Guest *</label>
                                <input type="number" class="form-control" name="total_on_guest" id="no_of_adults" min="1" value="1" required>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" id="is_company_booking" name="is_company_booking">
                                <label class="form-check-label" for="is_company_booking">
                                    Corporate Booking
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Corporate Booking Fields (Hidden by Default) -->
                    <div id="corporateFields" class="row" style="display: none;">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="company_name" class="form-label">Company Name</label>
                                <input type="text" class="form-control" id="company_name" name="company_name">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="company_address" class="form-label">Company Address</label>
                                <input type="text" class="form-control" id="company_address" name="company_address">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="company_website" class="form-label">Company Website</label>
                                <input type="text" class="form-control" id="company_website" name="company_website">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="company_degignation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="company_degignation" name="company_degignation">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 4. Payment Section -->
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Payment Details</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="form-label">Subtotal (₹)</label>
                            <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
                        </div>
                        <div class="col-md-3">
                            <label for="discount" class="form-label">Discount</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="discount" name="discount" min="0" value="0">
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Tax Amount (₹)</label>
                            <input type="text" class="form-control" name="tax_amount" id="tax_amount" readonly value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="extra_charges" class="form-label">Extra Charges (₹)</label>
                            <input type="number" class="form-control" id="extra_charges" name="extra_charges" min="0" value="0">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="advance_payment" class="form-label">Advance Payment (₹)</label>
                            <input type="number" class="form-control" id="advance" name="advance_payment" value="0">
                        </div>
                        <div class="col-md-3">
                            <label for="payment_method" class="form-label">Payment Method *</label>
                            <select class="form-select" id="payment_method" name="payment_method" required>
                                <option value="online">Online</option>
                                <option value="cash" selected>Cash</option>
                                <option value="debit_card">Debit Card</option>
                                <option value="credit_card">Credit Card</option>
                                <option value="upi">UPI</option>
                                <option value="bank_transfer">Bank Transfer</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="payment_status" class="form-label">Payment Status *</label>
                            <select class="form-select" id="payment_status" name="payment_status" required>
                                <option value="pending" selected>Pending</option>
                                <option value="partial">Partial</option>
                                <option value="paid">Paid</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Net Payable (₹)</label>
                            <input type="text" class="form-control bg-warning fw-bold" name="net_amount" id="net_payable" readonly>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Form Actions -->
            <div class="d-grid gap-2 d-md-flex justify-content-center mb-4">
                <button type="submit" class="btn btn-primary btn-lg me-md-3">
                    <i class="fas fa-save me-2"></i> Create Booking
                </button>
                <a href="{{ route('allroom') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-times me-2"></i> Cancel
                </a>
            </div>
        </form>
    </div>
</main>

@push('scripts')
<script>
    // Room Selection
    function selectRoom(roomId, roomPrice, roomNo) {
        // Update visible fields
        document.getElementById('selected_room_id').value = roomNo;
        document.getElementById('selected_room_id_no').value = roomId;
        document.getElementById('selected_room_price').value = roomPrice;
        
      
        
        // Recalculate amounts if dates are set
        calculateAmounts();
    }

    // Date Calculations
    document.addEventListener('DOMContentLoaded', function() {
        const checkinDate = document.getElementById('checkin_date');
        const checkoutDate = document.getElementById('checkout_date');
        
        // Set minimum dates
        const today = new Date().toISOString().split('T')[0];
        checkinDate.min = today;
        checkinDate.value = today;
        
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        checkoutDate.min = tomorrow.toISOString().split('T')[0];
        checkoutDate.value = tomorrow.toISOString().split('T')[0];
        
        // Calculate initial nights
        calculateNights();
        
        // Add event listeners
        checkinDate.addEventListener('change', function() {
            if (new Date(checkinDate.value) >= new Date(checkoutDate.value)) {
                const newCheckout = new Date(checkinDate.value);
                newCheckout.setDate(newCheckout.getDate() + 1);
                checkoutDate.value = newCheckout.toISOString().split('T')[0];
            }
            checkoutDate.min = checkinDate.value;
            calculateNights();
            calculateAmounts();
        });
       
        checkoutDate.addEventListener('change', function() {
            calculateNights();
            calculateAmounts();
        });
        
        function calculateNights() {
            if (checkinDate.value && checkoutDate.value) {
                const date1 = new Date(checkinDate.value);
                const date2 = new Date(checkoutDate.value);
                const diffTime = Math.abs(date2 - date1);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
                document.getElementById('nights_count').value = diffDays;
            }
        }
    });

    // Payment Calculations
    function calculateAmounts() {
        const roomPrice = parseFloat(document.getElementById('selected_room_price').value) || 0;
        const nightsCount = parseInt(document.getElementById('nights_count').value) || 0;
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const advance = parseFloat(document.getElementById('advance').value) || 0;
        const extraCharges = parseFloat(document.getElementById('extra_charges').value) || 0;
        
        // Calculate subtotal
        const subtotal = roomPrice * nightsCount;
        document.getElementById('subtotal').value = subtotal.toFixed(2);
         
        // Calculate tax (12% GST - 6% CGST + 6% SGST)
        const taxAmount = subtotal * 0.12;
        document.getElementById('tax_amount').value = taxAmount.toFixed(2);
        
        // Calculate discount amount
        const discountAmount = subtotal * (discount / 100);
        
        // Calculate net payable
        const netPayable = subtotal + taxAmount + extraCharges - discountAmount - advance;
        document.getElementById('net_payable').value = netPayable.toFixed(2);
    }

    // Initialize calculation on page load
    document.getElementById('discount').addEventListener('input', calculateAmounts);
    document.getElementById('advance').addEventListener('input', calculateAmounts);
    document.getElementById('extra_charges').addEventListener('input', calculateAmounts);

    // Corporate booking toggle
    document.getElementById('is_company_booking').addEventListener('change', function() {
        document.getElementById('corporateFields').style.display = this.checked ? 'block' : 'none';
    });
</script>
@endpush

@endsection
