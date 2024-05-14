<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{config('app.name')}} | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
   <!-- Font Awesome -->
   <link rel="stylesheet" href="{{asset('admin/plugins/fontawesome-free/css/all.min.css')}}">
   <!-- icheck bootstrap -->
   <link rel="stylesheet" href="{{asset('admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
   <!-- Theme style -->
   <link rel="stylesheet" href="{{asset('admin/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-trans/ition regi/ster-page">
<div class="regis/ter-box container col-md-6 col-md-of/fset-2"> 
  <div class="register-logo">
    <a href="#"><b>{{config('app.name')}} Register</b></a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>
        {{-- {{ route('signup.store') }} --}}
      <form action="" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="lead_type">Choose a Service</label>
                    <select required class="form-control" id="lead_type" name="lead_type" onchange="showHide(this)" required>
                        <option value="">--- Service Type ---</option>
                        <option value="Life Insurance">Life Insurance</option>
                        <option value="Health Insurance">Health Insurance</option>
                        <option value="Small Business">Small Business</option>
                    </select>
                </div>
            </div>
            {{-- <div class="col-md-6">
                <div class="form-group">
                    <label for="lead_date">Register Date</label>
                    <input type="date" class="form-control" id="lead_date" name="lead_date">
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <label for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="Type your first name following the Govt. NID Card">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Type your first name following the Govt. NID Card">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="mobile">Mobile Number</label>
                    <input type="text" class="form-control" id="mobile" name="mobile" onkeyup="phoneFormat(this)" required  placeholder="We will send you verification and imortant information">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="home">Home Number</label>
                    <input type="text" class="form-control" id="home" name="home" onkeyup="phoneFormat(this)" required placeholder="We will contact you for emergency">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="work">Work Number (Optional)</label>
                    <input type="text" class="form-control" id="work" name="work" onkeyup="phoneFormat(this)">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="company_name">Company Name</label>
                    <input type="text" class="form-control" id="company_name" name="company_name">
                </div>
            </div>
            <div style="clear:both;width:100%"></div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="street_address">Street Address</label>
                    <input type="text" class="form-control" id="street_address" name="street_address" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label for="zip">Zip</label>
                    <input type="text" class="form-control" id="zip" name="zip" required>
                </div>
            </div>
            <div class="col-md-12 LI">
                <!-- insurance -->
                <div class="form-group">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" required>
                </div>
            </div>
            {{-- <div class="col-md-6 LI">
                <!-- insurance -->
                <div class="form-group">
                <label for="age">Age</label>
                <input type="text" class="form-control" id="age" name="age">
                </div>
            </div> --}}
            <div class="col-md-12 LI"><br><hr>
                <!-- insurance -->
                <div class="form-group">
                <label for="mortgage">
                <input type="checkbox" class="" id="mortgage" name="mortgage" value="Yes" onchange="showMortgage(this)"> I have a Mortgage?</label>
            </div>
            </div>
            <!-- insurance -->
            <div class="col-md-12 LI">
                <div class="form-group hide">
                    <label for="lender">Lender Name</label>
                    <input type="text" class="form-control" id="lender" name="lender">
                </div>
            </div>
            <!-- insurance -->
            <div class="col-md-12 LI">
                <div class="form-group hide">
                    <label for="mortgage_date">Mortgage Date</label>
                    <input type="date" class="form-control" id="mortgage_date" name="mortgage_date">
                </div>
            </div>
            <!-- insurance -->
            <div class="col-md-12 LI">
                <div class="form-group hide">
                    <label for="mortgage_amount">Mortgage Total</label>
                    <input type="text" class="form-control" id="mortgage_amount" name="mortgage_amount">
                </div>
            </div>
            <!-- insurance -->
            <div class="col-md-12 LI">
                <div class="form-group hide">
                    <label for="mortgage_balance">Mortgage Balance</label>
                    <input type="text" class="form-control" id="mortgage_balance" name="mortgage_balance">
                </div>
            </div>
            <div class="col-md-12 LI"><br><hr>
                <!-- insurance -->
                <div class="form-group">
                    <label for="beneficiary">
                    <input type="checkbox" class="" id="beneficiary" name="beneficiary" value="Yes" onchange="showMarried(this)"> I have beneficiary?</label>
                </div>
            </div>
            <div class="col-md-12 LI BEN">
                <div class="form-group hide">
                    <label for="relation">Relation with Beneficiary?</label>
                    <input class="form-control" id="relation" name="relation" list="relation_names" onkeyup="checkMarried(this)">
                    <datalist id="relation_names">
                        <option value="Wife">
                        <option value="Husband">
                        <option value="Son">
                        <option value="Daughter">
                        <option value="Father">
                        <option value="Mother">
                        <option value="Brother">
                        <option value="Sister">
                </datalist>
                </div>
            </div>
            <div class="col-md-12 LI BEN">
                <div class="form-group hide">
                    <label for="beneficiary_name">Beneficiary Name</label>
                    <input type="text" class="form-control" id="beneficiary_name" name="beneficiary_name">
                </div>
            </div>
            <div class="col-md-12 LI BEN">
                <div class="form-group hide">
                    <label for="beneficiary_mobile">Beneficiary Mobile</label>
                    <input type="text" class="form-control" id="beneficiary_mobile" name="beneficiary_mobile" onkeyup="phoneFormat(this)">
                </div>
            </div>
            <div class="col-md-12 LI BEN">
                <div class="form-group hide">
                    <label for="beneficiary_email">Beneficiary Email</label>
                    <input type="text" class="form-control" id="beneficiary_email" name="beneficiary_email">
                </div>
            </div>
            <div class="col-md-12 LI BEN">
                <div class="form-group hide">
                    <label for="spouse_birth_date">Date of Birth</label>
                    <input type="date" class="form-control" id="spouse_birth_date" name="beneficiary_birth_date">
                </div>
            </div>
            <div class="col-md-12 LI">
                <div class="form-group hide">
                    <label for="marriage_date">Wedding Anniversary Date</label>
                    <input type="date" class="form-control" id="marriage_date" name="marriage_date">
                </div>
            </div>
            <div class="col-md-12 SB">
                <!-- small business -->
                <div class="form-group">
                <label for="full_name">Contact Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name">
            </div>
            </div>
            <div class="col-md-12 SB">
                <!-- small business -->
                <div class="form-group">
                <label for="contact_title">Contact Title</label>
                <input type="text" class="form-control" id="contact_title" name="contact_title">
            </div>
            </div>
            <div class="col-md-12 SB">
                <!-- small business -->
                <div class="form-group">
                    <label for="website">Website</label>
                    <input type="text" class="form-control" id="website" name="website">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="notes">Notes</label>
                    <textarea class="form-control" id="notes" name="notes"></textarea>
                </div>
            </div>
            {{-- <div class="col-md-6 IS">
                <div class="form-group">
                    <label for="Assets_Notes">Assets Notes</label>
                    <textarea class="form-control" id="Assets_Notes" name="Assets_Notes"></textarea>
                </div>
            </div> --}}
            <div class="col-md-12">
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </div>
    </form>
      {{-- <a href="{{route('login')}}" class="text-center">I already have an account</a> --}}
    </div> <!-- /.form-box -->
  </div> <!-- /.card -->
</div> <!-- /.register-box -->
<script>

  function view(e)
  {
      e.parentNode.parentNode.nextElementSibling.classList.toggle('hide');
  }

  function showHide(e)
  {
      console.log(e.options[e.selectedIndex].value)
      var SB = document.getElementsByClassName('SB');
      var LI = document.getElementsByClassName('LI');

      if(e.options[e.selectedIndex].value == 'Small Business')
      {
          for(var m = 0; m < LI.length; m++)
          {
              LI[m].classList.add('hide');
          }
          
          for(var m = 0; m < SB.length; m++)
          {
              SB[m].classList.remove('hide');
          }
      }
      else
      {
          for(var m = 0; m < SB.length; m++)
          {
              SB[m].classList.add('hide');
          }

          for(var m = 0; m < LI.length; m++)
          {
              LI[m].classList.remove('hide');
          }
      }
  }

  //mortgage fields show hide
  function showMortgage(e)
  {
      var mrg = e.parentNode.parentNode.parentNode.nextElementSibling;
      var mrg1 = mrg.firstChild.nextElementSibling;
      var mrg2 = mrg.nextElementSibling.firstChild.nextElementSibling;
      var mrg3 = mrg.nextElementSibling.nextElementSibling.firstChild.nextElementSibling;
      var mrg4 = mrg.nextElementSibling.nextElementSibling.nextElementSibling.firstChild.nextElementSibling;

      mrg1.classList.toggle('hide');
      mrg2.classList.toggle('hide');
      mrg3.classList.toggle('hide');
      mrg4.classList.toggle('hide');        
  }

  //mortgage fields show hide
  function showMarried(e)
  {
      var bens = document.getElementsByClassName('BEN');
      for(var x = 0; bens.length > x; x++)
      {
          bens[x].children[0].classList.toggle('hide');
      }
  }

  //phone number format
  function phoneFormat(e)
  {
      var numbers = e.value.replace(/\D/g, ''),
      char = {0:'(', 3:') ', 6:'-'};
      e.value = '';
      for(var i = 0; i < numbers.length; i++)
      {
          e.value += (char[i]||'') + numbers[i];
      }
  }

  /* check married */
  function checkMarried(e)
  {
      var marriage_date = document.getElementById('marriage_date');
      if(e.value == 'Husband' || e.value == 'Wife')
      {
          marriage_date.parentNode.classList.remove('hide');
      }
      else
      {
          marriage_date.parentNode.classList.add('hide');
      }
  }
</script>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
