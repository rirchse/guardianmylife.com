@extends('layouts.main')
 <style>
  .pagination{
    float:right !important;
  }
  .hide{display: none}
 </style>
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-body">
            <h3>Edit Customer <a href="{{route('customer.index')}}" class="btn btn-info btn-sm" style="float:right">View Customer</a> </h3><br>
            <form action="{{ route('customer.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lead_type">Lead Type</label>
                            <select required class="form-control" id="lead_type" name="lead_type" onchange="showHide(this)">
                                <option value="">--- Select Lead Type ---</option>
                                <option value="Life Insurance" {{$user->lead_type == 'Life Insurance'? 'selected':''}}>Life Insurance</option>
                                <option value="Small Business" {{$user->lead_type == 'Small Business'? 'selected':''}}>Small Business</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="lead_date">Lead Date</label>
                            <input type="date" class="form-control" id="lead_date" name="lead_date" value="{{$user->lead_date}}">
                        </div>
                    </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{$user->first_name}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="last_name">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{$user->last_name}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="home">Home Number</label>
                        <input type="text" class="form-control" id="home" name="home" value="{{$user->home}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Mobile Number</label>
                        <input type="text" class="form-control" id="mobile" name="mobile" value="{{$user->mobile}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="work">Work Number</label>
                        <input type="text" class="form-control" id="work" name="work" value="{{$user->work}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{$user->email}}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_name">Company Name</label>
                        <input type="text" class="form-control" id="company_name" name="company_name" value="{{$user->company_name}}">
                    </div>
                </div>
                <div style="clear:both;width:100%"></div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="street_address">Street Address</label>
                        <input type="text" class="form-control" id="street_address" name="street_address" value="{{$user->street_address}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" name="city" value="{{$user->city}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="state">State</label>
                        <input type="text" class="form-control" id="state" name="state" value="{{$user->state}}">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="zip">Zip</label>
                        <input type="text" class="form-control" id="zip" name="zip" value="{{$user->zip}}">
                    </div>
                </div>
                <div class="col-md-6 LI">
                    <!-- insurance -->
                    <div class="form-group">
                        <label for="date_of_birth">Date of Birth</label>
                        <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="{{$user->date_of_birth}}">
                    </div>
                </div>
                <div class="col-md-6 LI">
                    <!-- insurance -->
                    <div class="form-group">
                       <label for="age">Age</label>
                       <input type="text" class="form-control" id="age" name="age" value="{{$user->age}}">
                   </div>
                </div>
                <div class="col-md-12 LI"><br><hr>
                    <!-- insurance -->
                    <div class="form-group">
                       <label for="mortgage">
                       <input type="checkbox" class="" id="mortgage" name="mortgage" value="Yes" onchange="showMortgage(this)" {{$user->mortgage == 'Yes'? 'checked':''}}> Do you have a Mortgage?</label>
                   </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="lender">Lender Name</label>
                        <input type="text" class="form-control" id="lender" name="lender" value="{{$user->lender}}">
                    </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="mortgage_date">Mortgage Date</label>
                        <input type="date" class="form-control" id="mortgage_date" name="mortgage_date" value="{{$user->mortgage_date}}">
                    </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="mortgage_amount">Mortgage Total</label>
                        <input type="text" class="form-control" id="mortgage_amount" name="mortgage_amount" value="{{$user->mortgage_amount}}">
                    </div>
                </div>
                <!-- insurance -->
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="mortgage_balance">Mortgage Balance</label>
                        <input type="text" class="form-control" id="mortgage_balance" name="mortgage_balance" value="{{$user->mortgage_balance}}">
                    </div>
                </div><div class="col-md-12 LI"><br><hr>
                    <!-- insurance -->
                    <div class="form-group">
                        <label for="beneficiary">
                        <input type="checkbox" class="" id="beneficiary" name="beneficiary" value="Yes" onchange="showMarried(this)" {{$user->beneficiary == 'Yes'? 'checked':''}}> Do you have beneficiary?</label>
                    </div>
                </div>
                <div class="col-md-4 LI BEN">
                    <div class="form-group hide">
                        <label for="relation">Relation with Beneficiary?</label>
                        <input class="form-control" id="relation" name="relation" list="relation_names" onkeyup="checkMarried(this)" value="{{$user->relation}}">
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
                <div class="col-md-4 LI BEN">
                    <div class="form-group hide">
                        <label for="beneficiary_name">Beneficiary Name</label>
                        <input type="text" class="form-control" id="beneficiary_name" name="beneficiary_name" value="{{$user->beneficiary_name}}">
                    </div>
                </div>
                <div class="col-md-4 LI BEN">
                    <div class="form-group hide">
                        <label for="beneficiary_mobile">Beneficiary Mobile</label>
                        <input type="text" class="form-control" id="beneficiary_mobile" name="beneficiary_mobile" onkeyup="phoneFormat(this)" value="{{$user->beneficiary_mobile}}">
                    </div>
                </div>
                <div class="col-md-4 LI BEN">
                    <div class="form-group hide">
                        <label for="beneficiary_email">Beneficiary Email</label>
                        <input type="text" class="form-control" id="beneficiary_email" name="beneficiary_email" value="{{$user->beneficiary_email}}">
                    </div>
                </div>
                <div class="col-md-4 LI BEN">
                    <div class="form-group hide">
                        <label for="spouse_birth_date">Date of Birth</label>
                        <input type="date" class="form-control" id="spouse_birth_date" name="beneficiary_birth_date" value="{{$user->beneficiary_birth_date}}">
                    </div>
                </div>
                <div class="col-md-4 LI">
                    <div class="form-group hide">
                        <label for="marriage_date">Wedding Anniversary Date</label>
                        <input type="date" class="form-control" id="marriage_date" name="marriage_date" value="{{$user->marriage_date}}">
                    </div>
                </div>
                <div class="col-md-6 LI">
                    <div class="form-group">
                        <label for="policy_number">Policy Number</label>
                        <input type="text" class="form-control" id="policy_number" name="policy_number" value="{{$user->policy_number}}">
                    </div>
                </div>
                <div class="col-md-6 LI">
                    <div class="form-group">
                        <label for="policy_issued_date">Policy Issued Date</label>
                        <input type="date" class="form-control" id="policy_issued_date" name="policy_issued_date" value="{{$user->policy_issued_date}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group">
                        <label for="monthly_premium">Monthly Premium</label>
                        <input type="text" class="form-control" id="monthly_premium" name="monthly_premium" value="{{$user->monthly_premium}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group">
                        <label for="contract_rate">Contract Rate %</label>
                        <input type="text" class="form-control" id="contract_rate" name="contract_rate" value="{{$user->contract_rate}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group">
                        <label for="commission_rate">Commission Rate %</label>
                        <input type="text" class="form-control" id="commission_rate" name="commission_rate" value="{{$user->commission_rate}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group">
                        <label for="benefit_amount">Death Benefit Amount</label>
                        <input type="text" class="form-control" id="benefit_amount" name="benefit_amount" value="{{$user->benefit_amount}}">
                    </div>
                </div>
                <div class="col-md-12 LI"><br><hr>
                    <!-- insurance -->
                    <div class="form-group">
                       <label for="married">
                       <input type="checkbox" class="" id="married" name="married" value="Yes" onchange="showMarried(this)" {{$user->married == 'Yes'? 'checked':''}}> Are you Married?</label>
                   </div>
                </div>
                <div class="col-md-6 LI">
                    <div class="form-group hide">
                        <label for="spouse_name">Spouse Name</label>
                        <input type="text" class="form-control" id="spouse_name" name="spouse_name" value="{{$user->spouse_name}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="spouse_birth_date">Spouse Date of Birth</label>
                        <input type="date" class="form-control" id="spouse_birth_date" name="spouse_birth_date" value="{{$user->spouse_birth_date}}">
                    </div>
                </div>
                <div class="col-md-3 LI">
                    <div class="form-group hide">
                        <label for="marriage_date">Wedding Anniversary Date</label>
                        <input type="date" class="form-control" id="marriage_date" name="marriage_date" value="{{$user->marriage_date}}">
                    </div>
                </div>
                <div class="col-md-6 SB">
                    <!-- small business -->
                    <div class="form-group">
                       <label for="full_name">Contact Full Name</label>
                       <input type="text" class="form-control" id="full_name" name="full_name" value="{{$user->full_name}}">
                   </div>
                </div>
                <div class="col-md-6 SB">
                    <!-- small business -->
                    <div class="form-group">
                       <label for="contact_title">Contact Title</label>
                       <input type="text" class="form-control" id="contact_title" name="contact_title" value="{{$user->contact_title}}">
                   </div>
                </div>
                <!-- small business -->
                <div class="col-md-12 SB">
                    <div class="form-group">
                        <label for="website">Website</label>
                        <input type="text" class="form-control" id="website" name="website" value="{{$user->website}}">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="notes">Notes</label>
                        <textarea class="form-control" id="notes" name="notes">{{$user->notes}}</textarea>
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
</div>

<script>

    function showHide(e)
    {
        // console.log(e.options[e.selectedIndex].value)
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

    //benificiary fields show hide
    function showMarried(e)
    {
        var bens = document.getElementsByClassName('BEN');
        for(var x = 0; bens.length > x; x++)
        {
            bens[x].children[0].classList.toggle('hide');
        }
    }
    
    showHide(document.getElementById('lead_type'));

    <?php
    if($user->mortgage)
    {
        echo "showMortgage(document.getElementById('mortgage'));";
    }

    if($user->beneficiary)
    {
       echo "showMarried(document.getElementById('beneficiary'));";
    }    
    ?>
</script>
@endsection