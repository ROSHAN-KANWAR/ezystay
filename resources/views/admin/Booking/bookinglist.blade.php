@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')


<main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Booking List</h1>
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
                                <th>Room Type</th>
                                <th>Room No.</th>
                                <th>Check-In</th>
                                <th>Check-Out</th>
                                <th>Status</th>
                                <th>Total Price</th>
                                <th>Payment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>BK-1001</td>
                                <td>John Smith</td>
                                <td>Deluxe Suite</td>
                                <td>205</td>
                                <td>2023-06-15</td>
                                <td>2023-06-20</td>
                                <td><span class="badge bg-success">Checked In</span></td>
                                <td>$1,250</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" title="Print">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>BK-1002</td>
                                <td>Sarah Johnson</td>
                                <td>Standard Room</td>
                                <td>112</td>
                                <td>2023-06-18</td>
                                <td>2023-06-22</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>$480</td>
                                <td><span class="badge bg-warning text-dark">Pending</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>BK-1003</td>
                                <td>Michael Brown</td>
                                <td>Executive Suite</td>
                                <td>301</td>
                                <td>2023-06-20</td>
                                <td>2023-06-25</td>
                                <td><span class="badge bg-primary">Confirmed</span></td>
                                <td>$1,750</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>BK-1004</td>
                                <td>Emily Davis</td>
                                <td>Family Room</td>
                                <td>118</td>
                                <td>2023-06-12</td>
                                <td>2023-06-17</td>
                                <td><span class="badge bg-danger">Cancelled</span></td>
                                <td>$900</td>
                                <td><span class="badge bg-secondary">Refunded</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>BK-1005</td>
                                <td>Robert Wilson</td>
                                <td>Standard Room</td>
                                <td>107</td>
                                <td>2023-06-16</td>
                                <td>2023-06-19</td>
                                <td><span class="badge bg-success">Checked In</span></td>
                                <td>$360</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Additional sample rows -->
                            <tr>
                                <td>6</td>
                                <td>BK-1006</td>
                                <td>Lisa Taylor</td>
                                <td>Deluxe Suite</td>
                                <td>208</td>
                                <td>2023-06-22</td>
                                <td>2023-06-27</td>
                                <td><span class="badge bg-primary">Confirmed</span></td>
                                <td>$1,250</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>BK-1007</td>
                                <td>David Miller</td>
                                <td>Executive Suite</td>
                                <td>305</td>
                                <td>2023-06-25</td>
                                <td>2023-06-30</td>
                                <td><span class="badge bg-primary">Confirmed</span></td>
                                <td>$1,750</td>
                                <td><span class="badge bg-success">Paid</span></td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-outline-primary">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-printer"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
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
        
   