@extends('layout.app')
@section('title')
System Administration
@endsection

@push('styles')
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            padding-bottom: 80px; /* Space for the navbar */
        }

        .content {
            padding: 20px;
            min-height: 100vh;
        }

        /* Bottom Navigation Bar */
        .bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: #fff;
            display: flex;
            justify-content: space-around;
            align-items: center;
            padding: 10px 0;
            box-shadow: 0 -2px 10px rgba(0, 0, 0, 0.1);
            z-index: 1000;
        }

        .nav-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-decoration: none;
            color: #555;
            font-size: 12px;
            flex: 1;
            position: relative;
        }

        .nav-item i {
            font-size: 22px;
            margin-bottom: 4px;
        }

        .nav-item.active {
            color: #4a6bff;
        }

        /* Center Booking Button */
        .booking-btn {
            position: relative;
            bottom: 20px;
            background: linear-gradient(135deg, #4a6bff, #6a5acd);
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            box-shadow: 0 4px 12px rgba(74, 107, 255, 0.3);
        }

        .booking-btn i {
            font-size: 28px;
        }

        .booking-label {
            position: absolute;
            bottom: -20px;
            font-size: 12px;
            color: #555;
        }

        /* Hide on desktop */
        @media (min-width: 768px) {
            .bottom-nav {
                display: none;
            }
        }
    </style>
@endpush

@section('main-section')
<nav class="sb-topnav navbar navbar-expand  navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="{{route('home')}}">Ezystay System</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <i class= "fa-solid fa-bell text-white d-md-inline-block  ms-auto me-0 me-md-3 my-2 my-md-0">
               
            </i>
            <!-- Navbar-->
            <ul class="navbar-nav d-none d-md-inline-block ms-auto ms-md-0 me-3 me-lg-4 ">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        
                        <li><hr class="dropdown-divider" /></li>
                        <a href="{{ route('logout') }}" 
                        class="dropdown-item" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
                  
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link {{ request()->routeIs('dashboard') ? 'active bg-warning' : '' }}" href="{{Route('dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Bookings</div>
                            <a class="nav-link  {{ request()->routeIs('newbooking') ? 'active bg-warning' : '' }}" href="{{Route('newbooking')}}">
                                <div class="font-weight-bold sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               New Booking
                            </a>
                            <!-- <a class="nav-link " href="">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Add Document
                            </a> -->
                            <a class="nav-link {{ request()->routeIs('checkout_room') ? 'active bg-warning' : '' }}" href="{{Route('checkout_room')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Check-out
                            </a>
                            
                            <a class="nav-link {{ request()->routeIs('bookinglist') ? 'active bg-warning' : '' }}" href="{{Route('bookinglist')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               Booking List
                            </a>
                            <!-- <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div> -->
                            <div class="sb-sidenav-menu-heading">Manage Room`s</div>
                            <a class="nav-link {{ request()->routeIs('allroom') ? 'active bg-warning' : '' }}" href="{{Route('allroom')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                               All Room
                            </a>
                            <a class="nav-link {{ request()->routeIs('addroom') ? 'active bg-warning' : '' }}" href="{{Route('addroom')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Add Room
                            </a>
                            <a class="nav-link " href="{{Route('dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                              Room Inventry
                            </a>
<!-- manage rooms -->
                           
<!-- finanace and billing -->
                            <div class="sb-sidenav-menu-heading">Finanace</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Report
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                               Revenue Report
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Guest History
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                       Ezystay System
                    </div>
                </nav>
            </div>
            <!-- left side bar code here -->
            <div id="layoutSidenav_content">
          
@yield('dashboard')
    <!-- Bottom Navigation -->
    <nav class="bottom-nav">
        <a href="{{Route('dashboard')}}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i>
            <span>Home</span>
        </a>
        <a href="{{Route('checkout_room')}}" class="nav-item {{ request()->routeIs('checkout_room') ? 'active' : '' }}">
            <i class="fas fa-sign-out-alt"></i>
            <span>Check Out</span>
        </a>
        <div class="nav-item">
     
        <a href="{{Route('newbooking')}}" class="nav-item {{ request()->routeIs('newbooking') ? 'active' : '' }}">
            <div class="booking-btn">
                <i class="fas fa-plus"></i>
            </div>
            
            </a>
        </div>
        <a href="{{Route('allroom')}}" class="nav-item  {{ request()->routeIs('allroom') ? 'active' : '' }}">
            <i class="fas fa-bed"></i>
            <span>Room</span>
        </a>
        <a href="{{ route('logout') }}" 
                        class="nav-item" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fas fa-power-off"></i>
            <span>Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
        
    </nav>
@push('scripts')
    <script>
        // Add active class to clicked nav item
        document.querySelectorAll('.nav-item').forEach(item => {
            item.addEventListener('click', function(e) {
                // Don't apply active class to the booking button container
                if (!this.classList.contains('booking-btn') && !this.querySelector('.booking-btn')) {
                    document.querySelectorAll('.nav-item').forEach(nav => nav.classList.remove('active'));
                    this.classList.add('active');
                }
            });
        });

       
    </script>
@endpush
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Ezystay 2025</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        
   @endsection