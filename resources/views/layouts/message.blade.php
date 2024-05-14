@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
<div class="clearfix"></div>
</div>

@endif

@if ($message = Session::get('error'))

<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  <div class="clearfix"></div>

</div>

@endif

@if ($message = Session::get('warning'))

<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  <div class="clearfix"></div>

</div>

@endif

@if ($message = Session::get('info'))

<div class="alert alert-info alert-dismissible fade show" role="alert">
  <strong>{{ $message }}</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" onclick="this.parentNode.style.display='none'" style="position:absolute;right:10px;"><i class="fa fa-times"></i></button>
  <div class="clearfix"></div>

</div>

@endif

@if ($errors->any())

<div class="alert alert-danger alert-dismissible fade show" role="alert">

  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>

</div>

@endif