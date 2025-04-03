@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
    <div class="container-fluid px-4">
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

           <form action="{{ route('booking_store') }}" method="POST">
<!-- booking interface codee -->
@csrf
<div class="row">
    <!-- guest information -->
    <div class="col-md-6">

       <div class="container mt-2">
       <h4 class="mb-4">Guest Information</h4>

        <!-- Row 1: Name and Email -->
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="guestName" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="guestName" name="name" required>
            </div>
            <div class="col-md-6">
                <label for="guestEmail" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="guestEmail" name="email" required>
            </div>
        </div>

        <!-- Row 2: Phone and Address -->
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="guestPhone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="guestPhone" name="phone" required>
            </div>
            <div class="col-md-6">
                <label for="guestAddress" class="form-label">Address</label>
                <textarea class="form-control" id="guestAddress" name="address" rows="1"></textarea>
            </div>
        </div>

        <!-- Row 3: Document Type and Number -->
        <div class="row mb-3">
            <div class="col-md-6 mb-3 mb-md-0">
                <label for="documentType" class="form-label">Document Type</label>
                <select class="form-select" id="documentType" name="document_type" required>
                    <option value="" selected disabled>Select document type</option>
                    <option value="passport">Passport</option>
                    <option value="aadhar card">Aadhaar Card</option>
                    <option value="driving_license">Driving License</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="col-md-6">
                <label for="documentNumber" class="form-label">Document Number</label>
                <input type="text" class="form-control" id="documentNumber" name="document_number" required>
            </div>
        </div>

     </div>

    </div>
     <!--end guest information -->
    <!-- room available details section -->
    <div class="col-md-6">
      <!-- room finder -->
       <div class="container-fuild mt-2">
       <h4 class="mb-2">Available Rooms:</h4>
       <!-- Desktop Layout - Columns -->
       <div class="row">
        @foreach($availableRooms as $type => $rooms)
                <div class="col-md-6 col-lg-4 col-sm-6 mb-md-2 mb-2">
                    <div class="card h-100 border-primary">
                        <div class="card-header bg-primary text-white p-2">
                            <h5 class="card-title mb-0 text-center">{{ ucfirst($type)}}</h5>
                        </div>
                        <div class="card-body p-2 d-flex flex-wrap">
                        @foreach($rooms as $room)
                                <button type="button" 
                                      class="btn btn-sm btn-success m-1"
                                        onclick="selectRoom({{ $room->id }},{{ $room->price }},'{{ $room->type }}','{{ $room->room_no }}','{{ $room->floor }}')"
                         data-room-id="{{ $room->id }}">
                             {{ $room->room_no }}
                             <input type=""  class="form-control" hidden value=" {{ $room->id}}" readonly  name="room_id" id="selected_room_id_no" >
                                </button>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        
    </div>
    
    <!--end room available details section -->
</div>
<!-- room finder -->

<div class="row">
    <div class="col-md-4">   
                <label for="guestAddress" class="form-label">Room No.</label>
               <input type="text"  class="form-control" value="" readonly   id="selected_room_id" >
    </div>
    <div class="col-md-4">   
                <label for="guestAddress" class="form-label">Room Floor.</label>
              <input type="text" readonly  class="form-control" id="selected_room_floor">  
            </div>
    <div class="col-md-4">   
                <label for="guestAddress" class="form-label">Room Type.</label>
              <input type="" readonly   class="form-control" id="selected_room_type">
  </div>
    </div>
    <!-- room finder -->
</div>

    <!-- end room available details section -->

    <hr class="mt-2 mb-2">

    <!-- payment and date differance -->
    <div class="row">
        <!-- date checkin-checkout -->
        <div class="col-md-12">
        <div class="container-fluid mt-1">
            
    <h4 class="mb-2">Check-in & Payment Details:</h4>
    <div class="row">
        <div class="col-md-3">
            <div class="mb-3">
                <label for="checkin_date" class="form-label">Check-In Date</label>
                <input type="date" class="form-control" id="checkin_date" name="check_in_date" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label for="checkout_date" class="form-label">Check-Out Date</label>
                <input type="date" class="form-control" id="checkout_date" name="check_out_date" required>
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Room Price(Rs.)</label>
                <input type="text" readonly value="" class="form-control bg-warning font-weight-bolder text-dark"  id="selected_room_price">  
            </div>
        </div>
        <div class="col-md-3">
            <div class="mb-3">
                <label class="form-label">Number of Nights</label>
                <input type="text" class="form-control" name="no_of_nights" id="nights_count" readonly>
            </div>
        </div>
        <div class="row mb-3 sub">
        <div class="col-md-6">
            <label class="form-label">Subtotal</label>
            <input type="text" class="form-control" name="subtotal" id="subtotal" readonly>
        </div>
        <div class="col-md-6">
            <label for="payment_status" class="form-label">Payment Method</label>
            <select class="form-select" id="payment_status" name="payment_status" required>
                <option value="" selected disabled>Select payment method</option>
                <option value="cash">Cash</option>
                <option value="online">Online Payment</option>
                <option value="card">Credit/Debit Card</option>
            </select>
        </div>
        <div class="col-md-3 mt-2">
            <label for="discount" class="form-label">Discount (if any)</label>
            <div class="input-group">
                <input type="number" class="form-control" id="discount" name="discount" min="0" value="0">
                <span class="input-group-text">%</span>
            </div>
        </div>
           <div class="col-md-3 mt-2">
            <label for="discount" class="form-label">Adv Payment</label>
            <div class="input-group">
                <input type="number" class="form-control" id="advance" name="advance_payment" value="0">
                <span class="input-group-text">Rs</span>
            </div>
        </div>
        <div class="col-md-3 mt-2">
            <label class="form-label">Net Payable</label>
            <input type="text" class="form-control" name="net_amount" id="net_payable" readonly>
        </div>
        <!-- end sub row -->
    </div>
        <!-- end row payment and checking -->
    </div>
   
</div> 
<!-- Form Actions -->
                        <div class="d-grid gap-2 d-md-flex justify-content-center">
                            <button type="submit" class="col-md-6 btn btn-primary me-md-2">
                                <i class="bi bi-save"></i> Save Room
                            </button>
                            <a href="{{ route('allroom') }}" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
</form>

<!-- Hidden form field -->
@push('scripts')
<script>
    
function selectRoom(roomId,roomPrice,roomType, roomNo,roomfloor) {
    // Update hidden field
    
    document.getElementById('selected_room_id').value = roomNo;
    document.getElementById('selected_room_price').value = roomPrice;
    document.getElementById('selected_room_floor').value = roomfloor;
    document.getElementById('selected_room_type').value = roomType.toUpperCase();
    // Visual feedback
    document.querySelectorAll('.room-pill').forEach(el => {
        el.classList.remove('selected');
    });

    event.target.classList.add('selected');
    // Optional: Show room details
 
}

</script>
@endpush
<!-- date check in - checkou scripts -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const checkinDate = document.getElementById('checkin_date');
    const checkoutDate = document.getElementById('checkout_date');
    const nightsCount = document.getElementById('nights_count');
    
    // Set minimum dates (today for check-in, tomorrow for check-out)
    const today = new Date().toISOString().split('T')[0];
    checkinDate.min = today;
    checkinDate.value = today;
    
    const tomorrow = new Date();
    checkoutDate.min = tomorrow.toISOString().split('T')[0];
    
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
    });
   
    checkoutDate.addEventListener('change', calculateNights);
    
    function calculateNights() {
        if (checkinDate.value && checkoutDate.value) {
            const date1 = new Date(checkinDate.value);
            const date2 = new Date(checkoutDate.value);
            const diffTime = Math.abs(date2 - date1);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            nightsCount.value = diffDays + (diffDays === 1 ? " night" : " nights");
        }
    }
});
</script>
@endpush

<!-- payment calculating -->
@push('scripts')

<script>
    document.addEventListener('DOMContentLoaded', function() {
    // Get all the necessary elements
    const checkinDateInput = document.getElementById('checkin_date');
    const checkoutDateInput = document.getElementById('checkout_date');
    const roomPriceInput = document.getElementById('selected_room_price');
    const nightsCountInput = document.getElementById('nights_count');
    const subtotalInput = document.getElementById('subtotal');
    const discountInput = document.getElementById('discount');
    const advanceInput = document.getElementById('advance');
    const netPayableInput = document.getElementById('net_payable');

    // Add event listeners to all relevant inputs
    checkinDateInput.addEventListener('change', calculateAmounts);
    checkoutDateInput.addEventListener('change', calculateAmounts);
    roomPriceInput.addEventListener('input', calculateAmounts);
    discountInput.addEventListener('input', calculateAmounts);
    advanceInput.addEventListener('input', calculateAmounts);

    function calculateAmounts() {
        // Get the values from inputs
        const checkinDate = new Date(checkinDateInput.value);
        const checkoutDate = new Date(checkoutDateInput.value);
        const roomPrice = parseFloat(roomPriceInput.value) || 0;
        const discount = parseFloat(discountInput.value) || 0;
        const advance = parseFloat(advanceInput.value) || 0;

        // Calculate number of nights
        let nightsCount = 0;
        if (checkinDate && checkoutDate && checkoutDate > checkinDate) {
            const timeDiff = checkoutDate - checkinDate;
            nightsCount = Math.ceil(timeDiff / (1000 * 60 * 60 * 24));
        }
        nightsCountInput.value = nightsCount;

        // Calculate subtotal
        const subtotal = roomPrice * nightsCount;
        subtotalInput.value = subtotal.toFixed(2);

        // Calculate discount amount and net payable
        const discountAmount = subtotal * (discount / 100);
        const netPayable = subtotal - discountAmount-advance;
        
        // Update the net payable field
        netPayableInput.value = netPayable.toFixed(2);
    }

    // Initialize calculation on page load if values exist
    calculateAmounts();
});
</script>
@endpush

                    </div>
                </main>
        
   @endsection
        
   