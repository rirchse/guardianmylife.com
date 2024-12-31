@extends('layouts.main')
@section('styles')
 <style>
  .pagination{
    float:right !important;
  }
  .hide{display: none}
 </style>
@stop
@section('content')
<h3>Add Blog</h3><br>
<div class="card">
    <div class="card-body">
        <div class="col-md-12" style="width:100%">
            <a class="btn btn-sm btn-info" style="float:right" href="{{route('blog.index')}}">View</a>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control" id="details" name="details" rows=15></textarea>
                    </div>
                </div>
                <div class="col-md-12"><br>
                    <div class="form-group">
                        <label for="status">
                        <input type="checkbox" class="" id="status" name="status" value="Published"> Status</label>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(function ()
    {
      $('#details').wysihtml5()
    });
    //
  </script>
@endsection