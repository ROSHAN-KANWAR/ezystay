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

<!-- search form -->
<form method="POST" action="{{ route('checkout_search') }}" class="my-4">
    @csrf
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-3">
                    <div class="d-flex flex-row align-items-center">
                        <div class="flex-grow-1 me-3">
                            <label for="searchInput" class="form-label fw-bold mb-1">
                                Search by Booking ID or Room Number
                            </label>
                            <div class="input-group">
                                <input type="text" 
                                       name="search" 
                                       id="searchInput" 
                                       class="form-control" 
                                       placeholder="Enter booking ID or room number" 
                                       required>
                            </div>
                        </div>
                        
                        <div class="flex-shrink-0 align-self-end">
                            <button type="submit" class="btn btn-primary px-4 py-2">
                                <i class="bi bi-search me-2"></i>Search
                            </button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end search form -->
@if(isset($booking))
                    <hr>
                    <h5>Booking Details</h5>
                    <table class="table table-sm">
                       </table>
                    <form method="POST" action="">
                        @csrf
                        <button type="submit" class="btn btn-danger">Confirm Checkout</button>
                       
                    </form>
                    <a href="{{route('checkot_booking')}}">
                             <button  class="btn btn-primary px-4 py-2">
                                <i class="bi bi-search me-2"></i>Cancel
                            </button>
                            </a>
                    @endif
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
        const subtotal = roomPrice * nightsCount +(roomPrice * nightsCount)*(6/100)+(roomPrice * nightsCount)*(6/100);
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
        
   