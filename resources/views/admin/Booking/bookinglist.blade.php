@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
                    <div class="container-fluid px-4">
                        <h4 class="mt-4">Booking List</h4>
<!-- new booking code -->

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-2 mb-md-0">Booking Management</h5>
                <div class="d-flex gap-2 flex-wrap">
                   
                    <div class="input-group" style="width: 250px;">
                        <span class="input-group-text"><i class="bi bi-search"></i></span>
                        <input type="text" id="searchInput" class="form-control" placeholder="Search bookings...">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap">
                    <div class="mb-2 mb-md-0">
                        <label for="entriesFilter" class="form-label">Show entries:</label>
                        <select id="entriesFilter" class="form-select form-select-sm" style="width: 80px;">
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                    <div class="text-muted">
                        Showing 1 to 10 of 45 entries
                    </div>
                </div>
   
                <div class="table-responsive">
                    <table class="table table-hover table-bordered" id="bookingsTable">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Booking ID</th>
                                <th>Guest Name</th>
                                <th>Guest Phone</th>
                                <th>Room Type</th>
                                <th>Room No.</th>
                                <th>Remain-Amount</th>
                                <th>Check-Out</th>
                                <th>Mode</th>
                                <th>Status</th>
                                
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                             @foreach($bookedrooms as $booked)
                            <tr>
                                <td>{{$booked->id}}</td>
                                <td>{{$booked->booking_id}}</td>
                                <td>{{ucfirst($booked->name)}}</td>
                                <td>{{ucfirst($booked->phone)}}</td>
                                <td>{{ucfirst($booked->room->type)}}</td>
                                <td>{{$booked->room->room_no}}</td>
                                <td>{{$booked->net_amount}}</td>
                                <td>{{$booked->check_out_date}}</td>
                                <td>
                            @if($booked->status === 'checked_in')
                                <span class="badge bg-warning text-dark">{{ $booked->status }}</span>
                            @elseif($booked->status === 'checked_out')
                                <span class="badge bg-success">{{ $booked->status }}</span>
                            @endif
</td>
                                <td>
                                @if($booked->payment_mode === 'incomplete')
                                <span class="badge bg-warning text-dark">{{$booked->payment_mode}}</span>
                            @elseif($booked->payment_mode === 'paid')
                                <span class="badge bg-success">{{$booked->payment_mode}}</span>
                            @endif

 <td>
                                    <div class="d-flex gap-2">
                                        <button  class="btn btn-sm btn-outline-primary" data-booking-id="{{ $booked->id }}" title="Edit">
                                           <a href="{{route('booking_invoice' ,$booked->booking_id)}}"><i class="bi bi-pencil">Print</i></a> 
                                        </button>
                                        
                                    </div>
                                </td>
                            </tr>
@endforeach
                        </tbody>
                    </table>
                </div>

                <nav aria-label="Page navigation">
                    <ul class="pagination justify-content-end">
                        <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                        </li>
                        <li class="page-item active"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

 

@push('scripts')
<script>
// Add this to your view or JS file
$(document).ready(function() {
    // Handle print button click
    $('.print-booking').click(function() {
        var bookingId = $(this).data('booking-id');
        var url = "{{ route('booking_invoice', ':id') }}".replace(':id', bookingId);
        
        // Load invoice via AJAX
        $.get(url, function(data) {
            $('#invoiceContent').html(data);
            $('#printModal').modal('show');
        });
    });

    // Print button in modal
    $('#printInvoiceBtn').click(function() {
        var printContent = $('#invoiceContent').html();
        var originalContent = $('body').html();
        
        $('body').html(printContent);
        window.print();
        $('body').html(originalContent);
        $('#printModal').modal('show');
    });
});
</script>
@endpush


@push('scripts')
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Simple search functionality
        document.getElementById('searchInput').addEventListener('keyup', function() {
            const searchValue = this.value.toLowerCase();
            const rows = document.querySelectorAll('#bookingsTable tbody tr');
            
            rows.forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(searchValue) ? '' : 'none';
            });
        });

        // Entries filter functionality
        document.getElementById('entriesFilter').addEventListener('change', function() {
            const entriesToShow = parseInt(this.value);
            const rows = document.querySelectorAll('#bookingsTable tbody tr');
            
            rows.forEach((row, index) => {
                row.style.display = index < entriesToShow ? '' : 'none';
            });
            
            // Update showing entries text
            const showingText = `Showing 1 to ${Math.min(entriesToShow, rows.length)} of ${rows.length} entries`;
            document.querySelector('.text-muted').textContent = showingText;
        });
    </script>
@endpush

                    </div>
                </main>
        
   @endsection
        
   