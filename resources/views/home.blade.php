@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">

      <h1>Welcome To 
        @if(Auth::user()->role == 1)
        Admin
        @elseif(Auth::user()->role == 2)
        Agent 
        @else
        Employee
        @endif
        Dashboard</h1>
    </div>
  </div>
</div>

@if(Auth::user()->role == 1 || Auth::user()->role == 2 || Auth::user()->role == 3)
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <form action="{{ route('main.home') }}" method="get">
        @csrf
        <div class="row">
          <div class="col-md-5">
              <label for="">From</label>
              <input type="date" name="from_date" value="{{request('from_date')}}" class="form-control">     
          </div>
          <div class="col-md-5">
              <label for="">To</label>
              <input type="date" value="{{request('to_date')}}" name="to_date" class="form-control">
          </div>
          <div class="col-md-2">        
              <button class="btn btn-success"  type="submit"  style="margin-top: 2rem">Apply</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-md-12">
    <div class="card card-body">
      <div class="row">
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$leads}}</h3>
              <p>Available Leads</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="{{route('lead.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-warning">
            <div class="inner">
              <h3>{{$calls}}</h3>
              <p>Calls</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="{{route('call.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$appointments}}</h3>
              <p>Appointment Set </p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="{{route('appointments.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3>{{$sold}}</h3>
              <p>Sold</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="{{route('customer.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div><!-- ./col -->
      </div>
    </div>
  </div>
</div>
@endif
    
@endsection
