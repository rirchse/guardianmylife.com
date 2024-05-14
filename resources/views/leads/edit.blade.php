@php
use \App\Http\Controllers\SourceCtrl;
$source = New SourceCtrl;
@endphp

@extends('layouts.main')
 <style>
  .pagination{
    float:right !important;
  }
  .hide{display: none}
 </style>
@section('content')
<h3>Edit Lead <a href="{{route('lead.index')}}" class="btn btn-info btn-sm" style="float:right">View Leads</a> </h3><br>
<div class="card">
    <div class="card-body">
        <form action="{{ route('lead.update', $lead->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lead_type">Lead Type</label>
                        <select required class="form-control" id="lead_type" name="lead_type" onchange="showHide(this)">
                            <option value="">--- Select Lead Type ---</option>
                            <option value="Life Insurance" {{$lead->lead_type == 'Life Insurance'? 'selected':''}}>Life Insurance</option>
                            <option value="Small Business" {{$lead->lead_type == 'Small Business'? 'selected':''}}>Small Business</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lead_date">Lead Date</label>
                        <input type="date" class="form-control" id="lead_date" name="lead_date" value="{{$lead->lead_date}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$lead->first_name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$lead->last_name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="home">Home Number</label>
                        <input type="text" class="form-control" id="home" name="home" value="{{$lead->home}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{$lead->mobile}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="work">Work Number</label>
                        <input type="text" class="form-control" id="work" name="work" value="{{$lead->work}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$lead->email}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{$lead->company_name}}">
                    </div>
                </div>
                <div style="clear:both;width:100%"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="street_address">Street Address</label>
                        <input type="text" class="form-control" id="street_address" name="street_address" value="{{$lead->street_address}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$lead->city}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="{{$lead->state}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="{{$lead->zip}}">
                    </div>
                </div>
                <div class="col-md-6 LI">
                    <!-- insurance -->
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{$lead->date_of_birth}}">
                    </div>
                </div>
                <div class="col-md-6 LI">
                    <!-- insurance -->
                    <div class="form-group">
                    <label for="age">Age (Years)</label>
                    <input type="text" class="form-control" id="age" name="age" value="{{$source->ageCalc($lead->date_of_birth)}}">
                </div>
                </div>
                <div class="col-md-12 LI"><br><hr>
                    <!-- insurance -->
                    <div class="form-group">
                    <label for="mortgage">
                    <input type="checkbox" class="" id="mortgage" name="mortgage" value="Yes" onchange="showMortgage(this)" {{$lead->mortgage == 'Yes'? 'checked':''}}> Do you have a Mortgage?</label>
                </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="lender">Lender Name</label>
                        <input type="text" class="form-control" id="lender" name="lender" value="{{$lead->lender}}">
                    </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="mortgage_date">Mortgage Date</label>
                        <input type="date" class="form-control" id="mortgage_date" name="mortgage_date" value="{{$lead->mortgage_date}}">
                    </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="mortgage_amount">Mortgage Total</label>
                        <input type="text" class="form-control" id="mortgage_amount" name="mortgage_amount" value="{{$lead->mortgage_amount}}">
                    </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="mortgage_balance">Mortgage Balance</label>
                        <input type="text" class="form-control" id="mortgage_balance" name="mortgage_balance" value="{{$lead->mortgage_balance}}">
                    </div>
                </div>
                <div class="col-md-12 LI"><br><hr>
                    <!-- insurance -->
                    <div class="form-group">
                    <label for="married">
                    <input type="checkbox" class="" id="married" name="married" value="Yes" onchange="showMarried(this)" {{$lead->married == 'Yes'? 'checked':''}}> Are you Married?</label>
                </div>
                </div>
                <div class="col-md-6 LI">
                    <div class="form-group hide">
                        <label for="spouse_name">Spouse Name</label>
                        <input type="text" class="form-control" id="spouse_name" name="spouse_name" value="{{$lead->spouse_name}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="spouse_birth_date">Spouse Date of Birth</label>
                        <input type="date" class="form-control" id="spouse_birth_date" name="spouse_birth_date" value="{{$lead->spouse_birth_date}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="marriage_date">Wedding Anniversary Date</label>
                        <input type="date" class="form-control" id="marriage_date" name="marriage_date" value="{{$lead->marriage_date}}">
                    </div>
                </div>
                <div class="col-md-6 SB">
                    <!-- small business -->
                    <div class="form-group">
                    <label for="full_name">Contact Full Name</label>
                    <input type="text" class="form-control" id="full_name" name="full_name" value="{{$lead->full_name}}">
                </div>
                </div>
                <div class="col-md-6 SB">
                    <!-- small business -->
                    <div class="form-group">
                    <label for="contact_title">Contact Title</label>
                    <input type="text" class="form-control" id="contact_title" name="contact_title" value="{{$lead->contact_title}}">
                </div>
                </div>
                <!-- small business -->
                <div class="col-md-12 SB">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" value="{{$lead->website}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes">{{$lead->notes}}</textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>

    function showHide(e)
    {
        console.log(e.options[e.selectedIndex].value)
        var SB = document.getElementsByClassName('SB');
        var LI = document.getElementsByClassName('LI');

        if(e.options[e.selectedIndex].value == 'Life Insurance')
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
        else
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
        var mrg = e.parentNode.parentNode.parentNode.nextElementSibling;
        var mrg1 = mrg.firstChild.nextElementSibling;
        var mrg2 = mrg.nextElementSibling.firstChild.nextElementSibling;
        var mrg3 = mrg.nextElementSibling.nextElementSibling.firstChild.nextElementSibling;

        mrg1.classList.toggle('hide');
        mrg2.classList.toggle('hide');
        mrg3.classList.toggle('hide');
    }
    
    showHide(document.getElementById('lead_type'));

    <?php
    if($lead->mortgage)
    {
        echo "showMortgage(document.getElementById('mortgage'));";
    }

    if($lead->married)
    {
        echo "showMarried(document.getElementById('married'));";
    }
    ?>
    
</script>
@endsection