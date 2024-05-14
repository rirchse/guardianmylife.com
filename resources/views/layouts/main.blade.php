<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name')}} | Home Page</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="icon" href="/favicon.png">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
  {{-- <link rel="stylesheet" href="{{asset('/summernote/summernote-bs4.css')}}"> --}}
  <link rel="stylesheet" href="{{asset('/ckeditor/bootstrap3-wysihtml5.min.css')}}">
  <link rel="stylesheet" href="{{asset('/ckeditor/glyphicons.css')}}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
  <link rel="stylesheet" href="{{asset('admin/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
  @yield('styles')
  <style>
    .content-wrapper>.content{padding: 25px 20px;}
    .mt-3{margin-top:0!important}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>     
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->     
    <li class="d-flex align-items-center"><button id="timerButton" class="btn btn-primary">Start Timer</button>
      <div id="timerDisplay" class="ml-2">00:00:00</div></li>
      <!-- Notifications Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" href="{{ route('logout') }}"
        onclick="logOut()" title="Logout">
            {{-- <a class="nav-link" data-toggle="dropdown" href="#"> --}}
            <i class="fas fa-power-off"></i>      
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
        {{-- <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">                          
          <a href="#" class="dropdown-item dropdown-footer">Logout</a>
        </div> --}}
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="position: fixed;">
    <!-- Brand Logo -->
    <img src="/logo.png" alt="logo" style="max-width:54px;display:inline-block;margin-left:15px" class="logo">
    <a href="/" class="brand-link" style="display:inline-block">     
      <span class="brand-text font-weight-light">{{config('app.name')}}</span>
    </a>
    <br><br>

    <!-- Sidebar -->
    <div class="sidebar" style="height:85vh;overflow:auto">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('admin/logo.png')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar nav-child-indent flex-column" data-widget="treeview" role="menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{route('home')}}" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>Dashboard</p>
            </a>          
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="fas fa-list"></i>
              <p>Leads <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              @if(Auth::user()->role != 3)
              <li>
                <a href="{{route('lead.upload')}}" class="nav-link"><i class="fas fa-upload"></i> File Upload</a>
              </li>
              <li>
                <a href="{{route('lead.create')}}" class="nav-link"><i class="fas fa-plus"></i> Add Lead</a>
              </li>
              @endif
              <li>
                <a href="{{route('lead.index')}}" class="nav-link"><i class="fas fa-list"></i> View Leads</a>
              </li>
              @if(Auth::user()->role == 2 || Auth::user()->role == 1)
              <li>
                <a href="{{route('employeeleads.assign.index')}}" class="nav-link">
                  <i class="fas fa-file-pdf"></i>
                  <p>Employee Assign Leads</p>
                </a>
              </li>
              @endif
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{route('appointments.index')}}" class="nav-link">
                <i class="fa fa-calendar-check"></i>
              <p>Appointments</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('applicant.index')}}" class="nav-link">
                <i class="fas fa-calendar-check"></i>
              <p>Applicants</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('customer.index')}}" class="nav-link">
                <i class="fas fa-users"></i>
              <p>Customers</p>
            </a>
          </li>
          @if(Auth::user()->role == 2 || Auth::user()->role == 1)
          <li class="nav-item">
            <a href="{{route('remainder.index')}}" class="nav-link">
              <i class="fa fa-bell" aria-hidden="true"></i>
              <p>Reminders</p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role != 1)
          <li class="nav-item">
            <a href="{{route('call.index')}}" class="nav-link">
                <i class="fas fa-phone-square-alt"></i>
              <p>Calls</p>
            </a>
          </li>
          @endif
          @if(Auth::user()->role == 2)
          <li class="nav-item">
            <a href="{{route('budget.index')}}" class="nav-link">
                <i class="fas fa-money-check-alt"></i>
              <p>Budget</p>
            </a>
          </li> 
          @endif 
          @if(Auth::user()->role == 1 ||Auth::user()->role == 2 )         
          <li class="nav-item">
            <a href="{{route('logs.index')}}" class="nav-link">
              <i class="fa fa-address-book" aria-hidden="true"></i>
              <p> Login Log </p>
            </a>
          </li> 
          @endif
          @if(Auth::user()->role != 3)
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-file"></i>
              <p> Reports  <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('reports.dailysumhours')}}" class="nav-link">View Reports</a>
              </li>
            </ul>
          </li>         
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p>Users</p>
            </a>
          </li>                        
          <li class="nav-item">
            <a href="{{route('user.forgetpassword')}}" class="nav-link">
              <i class="fa fa-users" aria-hidden="true"></i>
              <p>Forgot Password</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fa fa-list-ol"></i>
              <p>Schedules <i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="{{route('schedule.create')}}">Add Schedule</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('schedule.index')}}">View Schedule</a>
              </li>
            </ul>
          </li>

          @endif   
        </ul>
      </nav> <!-- /.sidebar-menu -->
    </div> <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="height: auto !important">
    <!-- Content Header (Page header) -->  

    <!-- Main content -->
    <section class="content mt-3">

      <!-- Default box -->
          @include('layouts.message')
          @yield('content')
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy;  <a href="http://fflfalcon.com">FFL Falcon</a> Admin Panel.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{asset('admin/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('admin/dist/js/demo.js')}}"></script>
<!-- Notify.js library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/notify.min.js"></script>
<!-- Notify.js CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/notify/0.4.2/styles/metro/notify-metro.min.css" />

{{-- <script src="{{asset('/summernote/summernote-bs4.min.js')}}"></script> --}}
<script src="{{asset('/js/ckeditor.js')}}"></script>
<script src="{{asset('/ckeditor/bootstrap3-wysihtml5.all.min.js')}}"></script>

<!-- DataTables  & Plugins -->
<script src="{{asset('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('admin/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>

@yield('scripts')

<script>
  // Timer variables
  let startTime;
  let elapsedTime = 0;
  let timerInterval;

  // Retrieve start time from local storage on page load
  document.addEventListener("DOMContentLoaded", function()
  {
    const storedStartTime = localStorage.getItem("startTime");
    if (storedStartTime) {
      startTime = parseInt(storedStartTime, 10);
      elapsedTime = new Date().getTime() - startTime;
      displayTime(elapsedTime);

      // Automatically trigger the button click event
      document.getElementById("timerButton").click();
    }
  });

  // Button click event handler
  document.getElementById("timerButton").addEventListener("click", startTimer);
  function startTimer()
  {
    if (!timerInterval)
    {
      // Start the timer
      startTime = new Date().getTime() - elapsedTime;
      localStorage.setItem("startTime", startTime);
      timerInterval = setInterval(updateTimer, 1000);
      this.textContent = "Stop Timer";
    } else {
      storeTimeInDatabase(elapsedTime);
      // Reset the timer to zero
      clearInterval(timerInterval);
      timerInterval = null;
      elapsedTime = 0;
      displayTime(elapsedTime);
      this.textContent = "Start Timer";

      // Clear the start time from local storage
      localStorage.removeItem("startTime");

      // Store the elapsed time in the database      
    }
  };

  // Timer update function
  function updateTimer()
  {
    const currentTime = new Date().getTime();
    elapsedTime = currentTime - startTime;
    displayTime(elapsedTime);
  }

  // Display the elapsed time
  function displayTime(time)
  {
    const hours = Math.floor(time / (1000 * 60 * 60));
    const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((time % (1000 * 60)) / 1000);
    const formattedTime = padTime(hours) + ":" + padTime(minutes) + ":" + padTime(seconds);
    document.getElementById("timerDisplay").textContent = formattedTime;
  }

  // Pad single-digit time values with leading zeros
  function padTime(time)
  {
    return time.toString().padStart(2, "0");
  }

  // Store the elapsed time in the database using AJAX
  function storeTimeInDatabase(time)
  {
    const hours = Math.floor(time / (1000 * 60 * 60));
    const minutes = Math.floor((time % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((time % (1000 * 60)) / 1000);

    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      type: "POST",
      url: "{{ route('workingHours') }}",
      data: {
        hours: hours,
        minutes: minutes,
        seconds: seconds
      },
      success: function(response)
      {
        console.log("Time stored in the database!");
        $.notify('Your Daily Working Hours Saved Successfully', {
          align: 'center',
          verticalAlign: 'top',
          className: 'success'
        });
      },
      error: function(error) {
        console.log("Error storing time: " + error);
      }
    });
  }

  //logout
  function logOut()
  {
    startTimer(); 
    event.preventDefault();
    // console.log(event);
    setTimeout(function(){
    document.getElementById('logout-form').submit();
    }, 2000);
  }

  

  // Automatic logout if mouse no use 15 mins.
  window.onload = function () 
  {
    //start working timer
    var timerDisplay = document.getElementById('timerDisplay');
    if(timerDisplay.innerHTML == '00:00:00')
    {
      startTimer();
    }
    /* ========== Stop working detection max 10 minutes [start] ===========*/
    // mouse event
    mouseStopEvent.limit = 1000 * 1;
    var timeLeft = 0;
    mouseStopEvent.fnc = function ()
    {
      // console.log("[JS] The mouse stopped");
      timeLeft = 0;
    }
    mouseStopEvent.start();

    //counter
    setInterval(function()
    {
      timeLeft++;
      if(timeLeft == 600)
      {
        document.getElementById('logout-form').submit();
        startTimer();
      }
      // console.log(timeLeft);
    }, 1000);
  }

  // mouseStopEvent
  var mouseStopEvent = function ()
  {
    var MouseStopEvent = {
      timer: null,
      limit: 1000 * 60 * 3,
      fnc: function () {},
      start: function () {
        MouseStopEvent.timer = window.setTimeout(MouseStopEvent.fnc, MouseStopEvent.limit);
      },
      reset: function () {
        window.clearTimeout(MouseStopEvent.timer);
        MouseStopEvent.start();
      }
    };

    document.onmousemove = function ()
    {
      MouseStopEvent.reset();
    };

    return MouseStopEvent;
  }();
  /* ============ Stop working detection max 10 minutes [end] ===========*/

  // let isReloading = false;

  // // Set the flag when the page is being reloaded
  // window.addEventListener('beforeunload', function () {
  //     isReloading = true;
  // });

  // // Reset the flag when the page is loaded
  // window.addEventListener('load', function () {
  //     isReloading = false;
  // });

  // // Handle the beforeunload event
  // window.addEventListener('beforeunload', function (event) {
  //     if (!isReloading) {
  //         // Your code to handle browser close event
  //         // For example, you can display a confirmation message
  //         event.returnValue = 'Are you sure you want to leave?';
  //     }
  // });

</script>
</body>
</html>