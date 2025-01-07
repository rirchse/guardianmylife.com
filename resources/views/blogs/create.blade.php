@extends('layouts.main')
@section('styles')
<link rel="stylesheet" href="/summernote/summernote.min.css">
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
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" class="form-control" id="image" name="image">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="details">Details</label>
                        <textarea class="form-control editor" id="details" name="details" rows=15></textarea>
                    </div>
                </div>
                <div class="col-md-6"><br>
                    <div class="form-group">
                        <label for="status"> Status</label>
                        <select name="status" id="status" class="form-control" onchange="checkStatus(this)">
                            <option value="">Select One</option>
                            <option value="Published">Published</option>
                            <option value="Unpublished">Unpublished</option>
                            <option value="Scheduled">Scheduled</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6"><br>
                    <div class="form-group">
                        <label for="publish_at"> Publish Date & Time</label>
                        <input type="datetime-local" class="form-control" id="publish_at" name="publish_at" value="Published">
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
<script src="/summernote/summernote.min.js"></script>
<script>
    // check status
    function checkStatus(e)
    {
        let publish_at = document.getElementById('publish_at');
        let status = e.options[e.selectedIndex].value;
        if(status == 'Scheduled')
        {
            publish_at.setAttribute('required', 'required');
        }
        else
        {
            publish_at.removeAttribute('required');
        }
    }

    // $(function ()
    // {
    //   $('#details').wysihtml5()
    // });

    //this script for text editor
    $(document).ready(function() {
        $('.editor').summernote({
            height: 150
        });
    });
  </script>
@endsection