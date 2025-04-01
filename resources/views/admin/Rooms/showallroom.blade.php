@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Rooms Inventry</h1>
<!-- new booking code -->

    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-2 mb-md-0">Rooms Management</h5>
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
                                <th>Room No</th>
                                <th>Price</th>
                                <th>Floor</th>
                                <th>Room Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                      
                        @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->id }}</td>
                            <td>{{ $room->room_no}}</td>
                            <td>${{ number_format($room->price, 2) }}</td>
                            <td>{{ $room->floor }}</td>
                            <td>{{ $room->type }}</td>
                            <td>
                            <span class="badge rounded-pill text-white
    @if($room->status == 'available') bg-success
    @elseif($room->status == 'occupied') bg-danger
    @else bg-warning
    @endif">
    {{ ucfirst($room->status) }}
</span>
                            </td>
                            <td>
                                <a href="" class="btn btn-sm btn-info">View</a>
                                <a href="" class="btn btn-sm btn-primary">Edit</a>
                                <form action="" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
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


                    </div>
                </main>
        
   @endsection
        
   