@extends('admin.layout.app')
@section('title')
System Administration
@endsection
@section('dashboard')

<main>
                    <div class="container-fluid">
                        <h4 class="mt-4">Dashboards</h1>

                        <div class="container-fluid mt-4">
                           <div class="container-fluid  bg-light">
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
                                <h6 class="mb-1">₹ {{number_format($bookedrooms->sum('subtotal'),2)}}</h2>
                                <p class="mb-0 text-muted">One Weeks : ₹ {{$todayamount}}</p>
                            </div>
                            <div class="bg-success bg-opacity-10 p-3 rounded">
                            ₹
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
                                <th>Document</th>
                                <th>Mode</th>
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
                                @if($booked->document_verified === 1)
                                <span class="badge bg-danger text-white">
                                <a href="{{route('documentsprint' ,$booked)}}"><i class="bi bi-pencil text-white">Print</i></a>       
                                </span>
                           @endif

                            </td>
                            <td>
                                @if($booked->document_verified === 0)
                                <span class="badge bg-danger text-white">
                                <a href="{{route('add_document_upload' ,$booked->booking_id)}}"><i class="bi bi-pencil text-white">Not verify</i></a>       
                                </span>
                            @elseif($booked->document_verified  === 1)
                                <span class="badge bg-success">Verified</span>
                            @endif

                            </td>
                                <td>
                            @if($booked->status === 'checked_in')
                                <span class="badge bg-warning text-dark">{{ $booked->status }}</span>
                            @elseif($booked->status === 'checked_out')
                                <span class="badge bg-success">{{ $booked->status }}</span>
                            @endif
                                </td>
                                <td>
                                @if($booked->payment_status === 'pending')
                                <span class="badge bg-warning text-dark">{{$booked->payment_status}}</span>
                            @elseif($booked->payment_status === 'paid')
                                <span class="badge bg-success">{{$booked->payment_status}}</span>
                            @endif
</td>

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