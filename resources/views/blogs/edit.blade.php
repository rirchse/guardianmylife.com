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
<h3>Edit Blog</h3><br>
<div class="card">
    <div class="card-body">
        <div class="col-md-12" style="width:100%">
            <a class="btn btn-sm btn-info" style="float:right" href="{{route('blog.index')}}">View</a>
            <div class="clearfix"></div>
        </div>

        <form action="{{ route('blog.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{$blog->title}}">
                    </div>
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                        @if($blog->image)
                        <br>
                        <a href="{{$blog->image}}" target="_blank">
                            <img src="{{$blog->image}}" alt="" style="max-width:250px">
                        </a>
                        @endif
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control" id="details" name="details" rows=15>{{$blog->details}}</textarea>
                    </div>
                </div>
                <div class="col-md-12"><br>
                    <div class="form-group">
                        <label for="status">
                        <input type="checkbox" class="" id="status" name="status" value="Published" {{$blog->status == 'Published' ? 'checked':''}}> Status</label>
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
      //bootstrap WYSIHTML5 - text editor
      $('#details').wysihtml5()
    });
  </script>
@endsection