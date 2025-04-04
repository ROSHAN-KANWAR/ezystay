@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')

<main>
                    <div class="container-fluid px-4">
                        <h4 class="mt-4">Dashboard</h1>

                        <div class="container mt-4">
    <div class="container-fluid py-4 bg-light">
        <div class="row g-4">
            <!-- Occupied Rooms Box -->
            <div class="col-md-4">
                <div class="card border-start border-info border-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Room Occupancy</h6>
                                <h6 class="mb-1">{{$room->where('status','occupied')->count()}}/{{$room->count()}}</h2>
                                <p class="mb-0 text-muted">{{$room->where('status','occupied')->count()}} Booked | {{$room->where('status','available')->count()}} Available</p>
                            </div>
                            <div class="bg-info bg-opacity-10 p-3 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-door-closed text-info" viewBox="0 0 16 16">
                                    <path d="M3 2a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1v13h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V2zm1 13h8V2H4v13z"/>
                                    <path d="M9 9a1 1 0 1 0 2 0 1 1 0 0 0-2 0z"/>
                                </svg>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

            <!-- Active Bookings Box -->
            <div class="col-md-4">
                <div class="card border-start border-warning border-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Today's Check-outs</h6>
                                <h6 class="mb-1">12</h2>
                                <p class="mb-0 text-muted">Active Bookings: {{$room->where('status','occupied')->count()}}</p>
                            </div>
                            <div class="bg-warning bg-opacity-10 p-3 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-calendar-check text-warning" viewBox="0 0 16 16">
                                    <path d="M10.854 7.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 1 1 .708-.708L7.5 9.793l2.646-2.647a.5.5 0 0 1 .708 0z"/>
                                    <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z"/>
                                </svg>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>

            <!-- Revenue Box -->
            <div class="col-md-4">
                <div class="card border-start border-success border-4 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="text-uppercase text-muted mb-2">Revenue</h6>
                                <h6 class="mb-1">Rs {{number_format($bookedrooms->sum('subtotal'),2)}}</h2>
                                <p class="mb-0 text-muted">One Weeks : Rs {{$todayamount}}</p>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-currency-dollar text-success" viewBox="0 0 16 16">
                                    <path d="M4 10.781c.148 1.667 1.513 2.85 3.591 3.003V15h1.043v-1.216c2.27-.179 3.678-1.438 3.678-3.3 0-1.59-.947-2.51-2.956-3.028l-.722-.187V3.467c1.122.11 1.879.714 2.07 1.616h1.47c-.166-1.6-1.54-2.748-3.54-2.875V1H7.591v1.233c-1.939.23-3.27 1.472-3.27 3.156 0 1.454.966 2.483 2.661 2.917l.61.162v4.031c-1.149-.17-1.94-.8-2.131-1.718H4zm3.391-3.836c-1.043-.263-1.6-.825-1.6-1.616 0-.944.704-1.641 1.8-1.828v3.495l-.2-.05zm1.591 1.872c1.287.323 1.852.859 1.852 1.769 0 1.097-.826 1.828-2.2 1.939V8.73l.348.086z"/>
                                </svg>
                            </div>
                        </div>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
   

    <!-- Widget 5: Today's Revenue -->
    
                        <!-- small box show number of data -->
                        
    <div class="container-fluid py-4">
        <div class="card shadow-sm">
            <div class="card-header bg-white d-flex justify-content-between align-items-center flex-wrap">
                <h5 class="mb-2 mb-md-0">Booking Management</h5>
                <div class="d-flex gap-2 flex-wrap">
                </div>
            </div>
            <div class="card-body">
               
   
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

             
            </div>
        </div>
    </div>

                      <!-- small box show number of data -->
                     

                    </div>
                </main>
        
   @endsection