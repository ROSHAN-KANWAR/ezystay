@extends('admin.layout.app')

@section('title')
System Administration
@endsection

@section('dashboard')
<div class="container-fluid">
    <!-- Date Picker Form (Submits to same page) -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body">
            <form method="GET" action="" class="form-inline">
                <div class="form-group mr-3">
                    <label for="checkout_date" class="mr-2">Filter by Checkout Date:</label>
                    <input 
                        type="date" 
                        name="checkout_date" 
                        id="checkout_date"
                        class="form-control"
                        value="{{ request('checkout_date') ?? now()->toDateString() }}"
                    >
                </div>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-filter"></i> Apply Filter
                </button>
            </form>
        </div>
    </div>

    <!-- Results Table -->
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>Room</th>
                            <th>Guest Name</th>
                            <th>Mobile No.</th>
                            <th>Checkout Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $selectedDate = request('checkout_date') ?: now()->toDateString();
                            $rooms = \App\Models\Booking::whereDate('check_out_date', '>=', $selectedDate)
                            ->where('status','checked_in')            
                            ->orderBy('check_out_date', 'asc')
                                        ->get();
                        @endphp

                        @forelse($rooms as $room)
                            <tr>
                                <td>
                                    <a href="{{ route('checkout_roomid', $room->room_id) }}" class="btn btn-sm btn-danger room-pill" style="min-width: 60px;">
                                        {{ $room->room->room_no ?? 'N/A' }}
                                    </a>
                                </td>
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->phone }}</td>
                                <td>{{ $room->check_out_date->format('Y-m-d') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-muted py-4">No rooms found for checkout.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
    .room-pill {
        border-radius: 20px;
        padding: 0.25rem 0.5rem;
        font-weight: 600;
    }
    .table thead th {
        background-color: #f8f9fa;
        font-weight: 600;
    }
    .table-hover tbody tr:hover {
        background-color: rgba(0,0,0,.02);
    }
</style>
@endsection