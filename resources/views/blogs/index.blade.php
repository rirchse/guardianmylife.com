@php
use \App\Http\Controllers\SourceCtrl;
$source = new SourceCtrl;
@endphp

@extends('layouts.main')
@section('content')
<style>
  .hide{display: none}
  .paginate nav{float:right}
</style>
@php
$counter = 0;
@endphp
<div class="row" id="current_lead">
  <div class="col-md-12">
    <div class="label label-info">
      <h3>View All Blogs</h3>
    </div>
    <div class="card">
        <div class="card-body">
          <div class="col-md-12" style="width:100%">
            <a class="btn btn-sm btn-info" style="float:right" href="{{route('blog.create')}}">Add</a>
              <div class="clearfix"></div>
          </div>
            <table class="table">
              <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Status</th>
                <th>Created At</th>
                <th style="min-width: 100px">Action</th>
              </tr>
              @foreach ($blogs as $blog)
              <tr>
                <td>{{$blog->id}}</td>
                <td>{{$blog->title}}</td>
                <td style="color: {{$blog->status == 'Published'? 'green':'red'}}">{{$blog->status}}</td>
                <td>{{$source->dtformat($blog->created_at)}}</td>
                <td>
                  @if(auth()->user()->role == 2)
                  <a href="{{route('blog.edit', $blog->id)}}" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a>
                  @endif
                </td>
              </tr>
                  @php
                  $counter++;
                  @endphp
              @endforeach
          </table>
          <p><label for="">Total Blogs: ({{$counter}})</label></p>
            <div class="col-md-12 paginate">
              {{$blogs->links()}}
            </div>
        </div>
    </div>
  </div>
</div>

<script>
  function view(e)
    {
        e.parentNode.parentNode.nextElementSibling.classList.toggle('hide');
    }
</script>
@endsection