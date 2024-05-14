<?php
  use \App\Http\Controllers\SourceCtrl;
  $source = New SourceCtrl;

  $total_benefit = $total1 = $total2 = $total3 = $total4 = $total5 = 0;
  if(isset($customerable) && count($customerable) > 0)
  for($i=0; $i<count($customerable); $i++)
  { 
    $total1 += $customerable[$i]->monthly;
    $total2 += $customerable[$i]->annual;
    $total3 += $customerable[$i]->amount;
    $total4 += $customerable[$i]->amount2;
    $total5 += ($customerable[$i]->amount - $customerable[$i]->amount2);
    $total_benefit += $customerable[$i]->benefit_amount;
  }
?>



<style>

h1{
color:white;
margin-top: 2em;
}
p{
color:white;
}
/******************************
Stati - minimal statistical cards
*******************************/
.stati{
background: #fff;
height: 5em;
padding:1em;
margin:1em 0;
-webkit-transition: margin 0.5s ease,box-shadow 0.5s ease; /* Safari */
transition: margin 0.5s ease,box-shadow 0.5s ease;
-moz-box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
-webkit-box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
box-shadow:0px 0.2em 0.4em rgb(0, 0, 0,0.8);
}
.stati:hover{
margin-top:0.5em;
-moz-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8);
-webkit-box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8);
box-shadow:0px 0.4em 0.5em rgb(0, 0, 0,0.8);
}
.stati i{
font-size:2.5em;
}
.stati div{
width: calc(100% - 3.5em);
display: block;
float:right;
text-align:right;
}
.stati div b {
font-size:1.2em;
width: 100%;
padding-top:0px;
margin-top:-0.2em;
margin-bottom:-0.2em;
display: block;
}
.stati div span {
font-size:1em;
width: 100%;
color: rgb(0, 0, 0,0.8); !important;
display: block;
}
.stati.left div{
float:left;
text-align:left;
}
.stati.bg-turquoise { background: rgb(26, 188, 156); color:white;}
.stati.bg-emerald { background: rgb(46, 204, 113); color:white;}
.stati.bg-peter_river { background: rgb(52, 152, 219); color:white;}
.stati.bg-amethyst { background: rgb(155, 89, 182); color:white;}
.stati.bg-wet_asphalt { background: rgb(52, 73, 94); color:white;}
.stati.bg-green_sea { background: rgb(22, 160, 133); color:white;}
.stati.bg-nephritis { background: rgb(39, 174, 96); color:white;}
.stati.bg-belize_hole { background: rgb(41, 128, 185); color:white;}
.stati.bg-wisteria { background: rgb(142, 68, 173); color:white;}
.stati.bg-midnight_blue { background: rgb(44, 62, 80); color:white;}
.stati.bg-sun_flower { background: rgb(241, 196, 15); color:white;}
.stati.bg-carrot { background: rgb(230, 126, 34); color:white;}
.stati.bg-alizarin { background: rgb(231, 76, 60); color:white;}
.stati.bg-clouds { background: rgb(236, 240, 241); color:white;}
.stati.bg-concrete { background: rgb(149, 165, 166); color:white;}
.stati.bg-orange { background: rgb(243, 156, 18); color:white;}
.stati.bg-pumpkin { background: rgb(211, 84, 0); color:white;}
.stati.bg-pomegranate { background: rgb(192, 57, 43); color:white;}
.stati.bg-silver { background: rgb(189, 195, 199); color:white;}
.stati.bg-asbestos { background: rgb(127, 140, 141); color:white;}
.stati.turquoise { color: rgb(26, 188, 156); }
.stati.emerald { color: rgb(46, 204, 113); }
.stati.peter_river { color: rgb(52, 152, 219); }
.stati.amethyst { color: rgb(155, 89, 182); }
.stati.wet_asphalt { color: rgb(52, 73, 94); }
.stati.green_sea { color: rgb(22, 160, 133); }
.stati.nephritis { color: rgb(39, 174, 96); }
.stati.belize_hole { color: rgb(41, 128, 185); }
.stati.wisteria { color: rgb(142, 68, 173); }
.stati.midnight_blue { color: rgb(44, 62, 80); }
.stati.sun_flower { color: rgb(241, 196, 15); }
.stati.carrot { color: rgb(230, 126, 34); }
.stati.alizarin { color: rgb(231, 76, 60); }
.stati.clouds { color: rgb(236, 240, 241); }
.stati.concrete { color: rgb(149, 165, 166); }
.stati.orange { color: rgb(243, 156, 18); }
.stati.pumpkin { color: rgb(211, 84, 0); }
.stati.pomegranate { color: rgb(192, 57, 43); }
.stati.silver { color: rgb(189, 195, 199); }
.stati.asbestos { color: rgb(127, 140, 141); }

.reportfield{
   padding: 1px !important;
    pointer-events: none;
    font-size: 14px !important;
    border: none !important;
    height: 15px !important;
    margin-top: 6px;
    text-align: center;
    border-bottom: 1px solid #7e7a7a !important;
    padding-bottom: 5px !important;
    border-radius: 0px !important;
}

.card-header{
    font-size: 18px !important;
    padding: 10px !important;
    padding-bottom: 0px !important;
    /*text-align: center;*/
    border: 1px solid #adaaaa69 !important;
    border-radius: 0px;
}

.form-group {
    margin-bottom: 0px !important;
}

.table-bordered td, .table-bordered th{
    padding: 5px !important;
    text-align: right;
}

@media  print {

    html, body, .content-wrapper {
      height:100vh; 
      margin: 0 !important; 
      padding: 0 !important;
      overflow: hidden;
    }

}

</style>


<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->role == 1): ?>
<a href="<?php echo e(route('admin.reports')); ?>" class="btn btn-danger my-3 d-print-none">Admin Report</a>
<?php endif; ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css">

<div class="row">
  <div class="col-md-12">
    <div class="card card-body d-print-none">
        <h3>Working Hours Filter</h3>
        <form class="fo/rm for/m-inline"  method="get" action="<?php echo e(route('reports.dailysumhours')); ?>">
          <?php echo csrf_field(); ?>
        <div class="row">  
            <div class="col">
                <div class="form-group">
                  <label>From </label>
                  <input type="date" required class="form-control" value="<?php echo e(request('from')); ?>" id="full_name" name="from" placeholder="Enter Full Name" >          
                </div>     
              </div> 
              <div class="col">
                <div class="form-group">
                  <label> To </label>
                  <input type="date" required class="form-control" value="<?php echo e(request('to')); ?>" id="email" name="to" placeholder="Enter Email" >          
                </div>     
              </div> 
            <?php if(Auth::user()->role == 1): ?>
            <div class="col">
              <div class="form-group">
                <label>User </label>
                  <select name="user_id" required id="" class="form-control">
                    <?php
                        $userId = 0;
                    ?>
                      <option value="">Select User</option>
                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>                   
                      <option value="<?php echo e($user->id); ?>" <?php echo e(($userId && $user->id == $userId) ? 'selected' : ''); ?>>
                        <?php echo e($user->name); ?>

                    </option>
                    
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
              </div>     
            </div> 
            <?php else: ?>
            <input type="hidden" name="user_id" value="<?php echo e(Auth::user()->id); ?>"> 
            <?php endif; ?>              
           <br>
            <button type="submit" style="height:2.5rem;margin-top:2rem !important" class="btn btn-success ml-3 mt-auto mb-3">Submit</button>
          </div>
        </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md-12">
    <div class="card card-body"><div class="d-print-none" style="text-align: right;"><button id="printButton" class="btn btn-primary" style="float: inherit;/* float: right; *//* display: block; */">Print Report</button></div>
    <div class="d-print-block d-none" style="position: relative;">
        <img src="https://track.fflfalcon.com/public/admin/logo.png" class="img-responsive" style="max-width: 100px;height: auto;/* float: left; */position: absolute;top: -45px;">
        <h2 class="text-center" style="font-size: 22px;">Accountability Tracker Report</h2>
    </div>
    
        <div class="row">
            <div class="col-md-6">
                <div class="stati concrete " style="border: 1px solid gray;">
                    <i class="icon-user icons"></i>
                    <div>
                        <b><?php echo e(isset($user_name)? $user_name:''); ?></b>
                        <span>Agent</span>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="stati bg-concrete left" style="border: 1px solid gray;">
                    <i class="icon-calendar icons"></i>
                    <div>
                        <b><?php echo e($source->dformat($from)); ?> - <?php echo e($source->dformat($to)); ?></b>
                        <span>Period</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-3">
                <div class="stati silver " style="border: 1px solid gray;margin-top: 0px;">
                    <i class="icon-call-out icons"></i>
                    <div>
                        <b><?php echo e(isset($calls)? $calls:''); ?></b>
                        <span>Calls</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stati silver left" style="border: 1px solid gray;margin-top: 0px;">
                    <i class="icon-pin icons"></i>
                    <div>
                        <b><?php echo e(isset($appointment_sat)? $appointment_sat:''); ?></b>
                        <span>Appointments</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stati bg-silver " style="border: 1px solid gray;margin-top: 0px;">
                    <i class="icon-basket-loaded icons"></i>
                    <div>
                        <b><?php echo e(isset($sold)?$sold:''); ?></b>
                        <span>Sold</span>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="stati bg-silver left" style="border: 1px solid gray;margin-top: 0px;">
                    <i class="icon-basket icons"></i>
                    <div>
                        <b><?php echo "$". number_format(isset($annualCustomerPayment)? $annualCustomerPayment :0, 2, '.', ','); ?></b>
                        <span>Sales Total</span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="">
            <div class="card-header" style="background: #eee;">
                 <strong>Budget</strong> 
            </div>
            <div style="padding-top: 15px;font-size: 14px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Budget</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($budget)? $budget :0, 2, '.', ',') ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="col-md-6" style="float:left;">Budget Used</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($cost)? $cost :0, 2, '.', ',') ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Balance</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo e("$".number_format($balance, 2)); ?>">
                    </div>
                </div>
            </div>
            
            <div class="card-header" style="background: #eee;">
                 <strong>Leads</strong> 
            </div>
            <div style="padding-top: 15px;font-size: 14px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="col-md-6" style="float:left;">Leads Purchased</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo e(isset($leads)?$leads:''); ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Leads Cost</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($cost)? $cost :0, 2, '.', ',') ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Cost Per Lead</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="$<?php echo e(isset($cost_per_lead) ? number_format($cost_per_lead, 2) : ''); ?>">
                    </div>
                </div>
            </div>
            
            <div class="card-header" style="background: #eee;">
                 <strong>Calls</strong> 
            </div>
            <div style="padding-top: 15px;font-size: 14px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="col-md-6" style="float:left;">Dials</label>
                      <input type="email" class="form-control reportfield col-md-6" value="<?php echo e(isset($calls)?$calls:''); ?>">
                    </div>
                    
                   <div class="form-group col-md-6">
                      <label for="inputEmail4"  class="col-md-6" style="float:left;">Total Call Hours</label>
                      <input type="email" class="form-control reportfield col-md-6" value="<?php echo e(isset($totalcallingHours)? $totalcallingHours : ''); ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4"  class="col-md-6" style="float:left;">Average Call Hours</label>
                      <input type="text" class="form-control reportfield col-md-6" value="<?php echo e(isset($average_call_time)?$average_call_time:''); ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4"  class="col-md-6" style="float:left;">Total Working Hours</label>
                      <input type="text" class="form-control reportfield col-md-6" value="<?php echo e(isset($totalWorkingHours)?$totalWorkingHours:''); ?>">
                    </div>
                </div>
            </div>
            
            <div class="card-header" style="background: #eee;">
                 <strong>Contacts</strong> 
            </div>
            <div style="padding-top: 15px;font-size: 14px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4"  class="col-md-6" style="float:left;">Contact (Yes)</label>
                      <input type="email" class="form-control reportfield col-md-6" value="<?php echo e(isset($yes)?$yes:''); ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4"  class="col-md-6" style="float:left;">Contacts (No)</label>
                      <input type="text" class="form-control reportfield col-md-6" value="<?php echo e(isset($no)?$no:''); ?>">
                    </div>
                    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4"  class="col-md-6" style="float:left;">Contacts (Wrong)</label>
                      <input type="text" class="form-control reportfield col-md-6" value="<?php echo e(isset($wrong)?$wrong:''); ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputEmail4"  class="col-md-6" style="float:left;">Contacts (Not Interested)</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo e(isset($interested)?$interested:''); ?>">
                    </div>
                    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Contact(Remainder)</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo e(isset($remainders)?$remainders:''); ?>">
                    </div>
                    
                   <div class="form-group col-md-6">
                      <label for="inputEmail4"  class="col-md-6" style="float:left;">Contacts (Disconnect)</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo e(isset($disconnect)?$disconnect:''); ?>">
                    </div>
                </div>
            </div>
            
            <div class="card-header" style="background: #eee;">
                 <strong>Appointments</strong> 
            </div>
            <div style="padding-top: 15px;font-size: 14px;">
                <div class="form-row">
                   <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Appointment Sat</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo e(isset($appointment_sat)?$appointment_sat:''); ?>">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Appointments Set</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo e(isset($appoinements)?$appoinements:''); ?>">
                    </div>                    
                </div>
                
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="col-md-6" style="float:left;">Appointment Sat Ratio</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo e(isset($appointment_sat_ratio)? $appointment_sat_ratio : ''); ?>%">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="col-md-6" style="float:left;">Appointments Sold</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo e(isset($sold)?$sold:''); ?>">
                    </div>
                    
                </div>
                
                 <div class="form-row">
                    <div class="form-group col-md-6">
                          <label for="inputPassword4" class="col-md-6" style="float:left;">Appointment Contact Ratio</label>
                          <input type="text" class="form-control col-md-6 reportfield" value="<?php echo e(isset($appointment_ratio)? $appointment_ratio : ''); ?>%">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Sales Ratio</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo e(isset($sales_ratio)?$sales_ratio:''); ?>%">
                    </div>
                </div>        
            </div>
             
            <div class="card-header" style="background: #eee;">
                 <strong>Sales</strong> 
            </div>
            <div style="padding-top: 15px;font-size: 14px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Total Annual Sales</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($annualCustomerPayment)? $annualCustomerPayment :0, 2, '.', ',') ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Total Monthly Sales</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($customerMonthlyPremium)? $customerMonthlyPremium :0, 2, '.', ',') ?>">
                    </div>
                </div>
                
                <div class="form-row">
                    
                    <div class="form-group col-md-6">
                      <label for="inputEmail4" class="col-md-6" style="float:left;">Commission</label>
                      <input type="email" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($total4)? $total4 :0, 2, '.', ',') ?>">
                    </div>
                    
                    <div class="form-group col-md-6">
                      <label for="inputPassword4" class="col-md-6" style="float:left;">Balance Due</label>
                      <input type="text" class="form-control col-md-6 reportfield" value="<?php echo "$". number_format(isset($total5)? $total5 :0, 2, '.', ',') ?>">
                    </div>
                </div> 
            </div>
        </div>
        <hr>
        
        <?php if(isset($customerable) && count($customerable)){ ?>
            <table class="table table-bordered table-striped" style="font-size:12px;">
                <thead>
                    <tr>
                        <th style="text-align: left;">Customer Name</th>
                        <th style="text-align: left;">Company Name</th>
                        <th style="text-align: left;">Policy No</th>
                        <th style="text-align: left;">Appointment By</th>
                        <th style="text-align: left;">Death Benefit</th>
                        <th style="text-align: left;">Monthly Premium</th>
                        <th style="text-align: left;">Annual Premium</th>
                        <th style="text-align: left;">Contract Rate</th>
                        <th style="text-align: left;">Amount</th>
                        <th style="text-align: left;">Commission Rate</th>
                        <th style="text-align: left;">Amount</th>
                        <th style="text-align: left;">Balance</th>
                    </tr>
                </thead>
                
                
                <tbody>
                    <?php 
                    
                    for($i=0; $i<count($customerable); $i++){ ?>
                        <tr>
                            <td style="text-align: left;"><?php echo $customerable[$i]->name; ?></td>    
                            
                            <td style="text-align: left;"><?php echo $customerable[$i]->company_name; ?></td>    
                            <td style="text-align: left;"><?php echo $customerable[$i]->policy_number; ?></td>    
                            <td style="text-align: left;"><?php echo $customerable[$i]->Lead_Owner; ?></td>
                            <td><?php echo "$".number_format($customerable[$i]->benefit_amount, 2); ?></td>
                            <td><?php echo "$".number_format($customerable[$i]->monthly, 2, '.', ','); ?></td>    
                            <td><?php echo "$".number_format($customerable[$i]->annual, 2, '.', ','); ?></td>    
                            <td><?php echo $customerable[$i]->contract_rate."%"; ?></td>    
                            <td><?php echo "$".number_format($customerable[$i]->amount, 2, '.', ','); ?></td>    
                            <td><?php echo $customerable[$i]->commission_rate."%"; ?></td>    
                            <td><?php echo "$".number_format($customerable[$i]->amount2, 2, '.', ','); ?></td>    
                            <td><?php echo "$".number_format(($customerable[$i]->amount - $customerable[$i]->amount2), 2, '.', ','); ?></td>
                        </tr>
                    <?php } ?>
                        <tr>
                            <td colspan="4" style="text-align: center;font-weight: 600;">Total</td>
                            <td><?php echo "$". number_format($total_benefit, 2, '.', ','); ?></td>
                            <td><?php echo "$". number_format($total1, 2, '.', ','); ?></td>
                            <td><?php echo "$". number_format($total2, 2, '.', ','); ?></td>
                            <td> - </td>
                            <td><?php echo "$". number_format($total3, 2, '.', ','); ?></td>
                            <td> - </td>
                            <td><?php echo "$". number_format($total4, 2, '.', ','); ?></td>
                            <td><?php echo "$". number_format($total5, 2, '.', ','); ?></td>
                        </tr>
                </tbody>
            </table>
        <?php } ?>
        
      <!--<table id="example1" class="table table-bordered table-striped">
        
        <tbody>  
        <tr>
          <th>Total Calls</th>
         <td><?php echo e(isset($calls)?$calls:''); ?></td>
         <th>Appointments Set</th>  
         <td><?php echo e(isset($appointment_sat)?$appointment_sat:''); ?></td>                
        </tr>
        <tr>
          <th>Contact (Yes)</th>
         <td><?php echo e(isset($yes)?$yes:''); ?></td>
         <th>Appointment (Sold)</th>  
         <td><?php echo e(isset($sold)?$sold:''); ?></td>            
        </tr>
        <tr>
          <th>Contacts (Wrong)</th>
         <td><?php echo e(isset($wrong)?$wrong:''); ?></td>
         <th>Contacts (Disconnect)</th>  
         <td><?php echo e(isset($disconnect)?$disconnect:''); ?></td>                
        </tr>
        
        <tr>
          <th>Contact(Remainder)</th>
          <td><?php echo e(isset($remainders)?$remainders:''); ?></td>                                       
         <th>Contacts (Not Interested)</th>
         <td><?php echo e(isset($interested)?$interested:''); ?></td>                              
        </tr>

        <tr>
          <th>Total Work Duration</th>
         <td><?php echo e($totalWorkingHours); ?></td>
         <th>Contacts (No)</th>  
         <td><?php echo e(isset($no)?$no:''); ?></td> 
        </tr>

        <tr>
          <th>Appointment Sat</th>
         <td><?php echo e(isset($appoinements)?$appoinements:''); ?></td>
         <th>Commission</th>  
         <td>$<?php echo e(isset($totalCommissionPayment)?$totalCommissionPayment:''); ?></td> 
        </tr>
        
        <tr>
          <th>Sales Ratio</th>
          <td><?php echo e(isset($ratio)?$ratio:''); ?>%</td>
          <th>Balance Due</th>
          <td>$<?php echo e(isset($totalBalanceDueLater)?$totalBalanceDueLater:''); ?></td> 
        </tr>
        <tr>
          <th>Leads Purchased</th>
          <td><?php echo e(isset($leads)?$leads:''); ?></td>  
          <th>Budget</th>
          <td>$<?php echo e(isset($budget)?$budget:''); ?></td>      
        </tr>

        <tr>
          <th>Leads Cost</th>
          <td>$<?php echo e(isset($cost)?$cost:''); ?></td> 
          <th>Budget Used</th>   
          <td>$<?php echo e(isset($cost)?$cost:''); ?></td>   
        </tr>

        <tr>
          <th>Cost Per Lead</th>
          <td>$<?php echo e(isset($cost_per_lead) ? number_format($cost_per_lead, 2) : ''); ?></td>
          <th>Balance</th>
          <td>$<?php echo e(isset($balance)?$balance:''); ?> </td>    
        </tr> 
        <tr>
          <th>Total Call Hours</th>
          <td><?php echo e(isset($totalcallingHours)? $totalcallingHours : ''); ?></td>
          <th>Avernage Call Hours</th>
          <td><?php echo e(isset($average_call_time)?$average_call_time:''); ?> </td>    
        </tr> 
        
        <tr>
          <th>Appointment Ratio</th>
          <td><?php echo e(isset($appointment_ratio)? $appointment_ratio : ''); ?>%</td>
          <th>Appointment Sat Ratio</th>
          <td><?php echo e(isset($appointment_sat_ratio)? $appointment_sat_ratio : ''); ?>%</td>
        </tr> 
        
        <tr>
          <th>Total Monthly Sales</th>
          <td><?php echo e(isset($customerMonthlyPremium)? $customerMonthlyPremium : ''); ?></td>
          <th>Total Annual Sales</th>
          <td><?php echo e(isset($annualCustomerPayment)? $annualCustomerPayment : ''); ?></td>
        </tr> 
        
       </tbody>           
      </table>   -->
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>

<script>
  document.getElementById('printButton').addEventListener('click', function() {
    window.print();
  });
</script>
<script>
   /* $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,      
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');     
    });*/
  </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /srv/www/fflfalcon/resources/views/reports/index.blade.php ENDPATH**/ ?>