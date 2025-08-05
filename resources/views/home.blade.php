@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('layouts.main')

@section('content')
<div class="row">
  <div class="col-md-12">
    <div class="card card-body">

      <h1>
        <span style="font-size:20px">Welcome</span>
        <br>
        {{Auth::user()->name}}
        <br>
        <span style="font-size:20px">
          @if(Auth::user()->role == 1)
          Admin
          @elseif(Auth::user()->role == 2)
          Agent
          @else
          Freelancer
          @endif
          Dashboard
        </span>
      </h1>
        @if(Auth::user()->role == 2)
        <p>Your referral link: <a id="referral_link" target="_blank" href="{{$source->host().'/agents/'.Auth::user()->username}}">{{$source->host().'/agents/'.Auth::user()->username}}</a> <button onclick="copyUrl()" class="btn btn-info btn-sm">Copy Link</button></p>
        @endif
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
            @if(Auth::user()->role != 1)
            <a href="{{route('lead.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @endif
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
            @if(Auth::user()->role != 1)
            <a href="{{route('call.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @endif
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
            @if(Auth::user()->role != 1)
            <a href="{{route('appointments.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @endif
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
            @if(Auth::user()->role != 1)
            <a href="{{route('customer.index')}}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            @endif
          </div>
        </div><!-- ./col -->
      </div>
    </div>
  </div>
</div>
@endif

<script>
  function copyUrl() {
      var range = document.createRange();
      range.selectNode(document.getElementById("referral_link"));
      window.getSelection().removeAllRanges(); // clear current selection
      window.getSelection().addRange(range); // to select text
      document.execCommand("copy");
      window.getSelection().removeAllRanges();// to deselect
  }
</script>
    
@endsection
