@extends('layouts.homepage')
@section('style')
<link rel='stylesheet' id='elementor-post-390-css' href='/home/wp-content/uploads/elementor/css/post-39030d6.css' media='all' />
<link rel='stylesheet' id='gform_basic-css' href='/home/wp-content/plugins/gravityforms/assets/css/dist/basic.minfae6.css' media='all' />
<link rel='stylesheet' id='gform_theme-css' href='/home/wp-content/plugins/gravityforms/assets/css/dist/theme.minfae6.css' media='all' />
@endsection

@section('content')
<div data-elementor-type="wp-page" data-elementor-id="390" class="elementor elementor-390" data-elementor-post-type="page">
  <section class="elementor-section elementor-top-section elementor-element elementor-element-6cb472ab elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="6cb472ab" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
     <div class="elementor-background-overlay"></div>
     <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-63488ee" data-id="63488ee" data-element_type="column">
           <div class="elementor-widget-wrap elementor-element-populated">
              <div class="elementor-element elementor-element-65639e1 elementor-widget__width-initial elementor-widget elementor-widget-heading" data-id="65639e1" data-element_type="widget" data-widget_type="heading.default">
                 <div class="elementor-widget-container">
                    <style>/*! elementor - v3.22.0 - 26-06-2024 */
                       .elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}
                    </style>
                    @if(!is_null(Session::get('_agent')))
                    <div style="text-align: center;color:#fff">
                     <div style="color:#fff">Your Insurance Agent</div>
                        <h2 class="elementor-heading-title elementor-size-default">
                           {{strtoupper(Session::get('_agent')->name)}}
                        </h2><br>
                     </div>
                     @endif
                    <h1 class="elementor-heading-title elementor-size-default">Get a Quote</h1>
                 </div>
              </div>
              <div class="elementor-element elementor-element-afb2099 elementor-widget elementor-widget-text-editor" data-id="afb2099" data-element_type="widget" data-widget_type="text-editor.default">
                 <div class="elementor-widget-container" style="color:#fff">
                    <style>
                    /*! elementor - v3.22.0 - 26-06-2024 */
                       .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d; color:#fff}
                       .elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#fff;border:3px solid;background-color:transparent}
                       .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}
                       .elementor-widget-text-editor:not(.elementor-drop-cap-view-default) 
                       .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}
                       .elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}
                    </style>
                    <p>It takes less than 2 minutes to fill out the form below.<br />A GML rep will get back to you within 24 hours.</p>
                    <p>All fields are required.</p>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <section class="elementor-section elementor-top-section elementor-element elementor-element-291f9c16 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="291f9c16" data-element_type="section">
     <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-24582fb3 excludedarkmode " data-id="24582fb3" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
           <div class="elementor-widget-wrap elementor-element-populated">
              <div class="elementor-element elementor-element-2918189 elementor-widget elementor-widget-shortcode" data-id="2918189" data-element_type="widget" data-widget_type="shortcode.default">
                 <div class="elementor-widget-container">
                    <div class="elementor-shortcode">
                       <div class='gf_browser_chrome gform_wrapper gravity-theme gform-theme--no-framework get_quote_wrapper' data-form-theme='gravity-theme' data-form-index='0' id='gform_wrapper_1' >
                          <div id='gf_1' class='gform_anchor' tabindex='-1'></div>
                          <div class='gform_heading'>
                             <p class='gform_required_legend'>&quot;<span class="gfield_required gfield_required_asterisk">*</span>&quot; indicates required fields</p>
                          </div>
<form action="{{route('signup.store')}}" method="POST" enctype="multipart/form-data" class='g/et_quote'  >
@csrf

   <div class='gform-body gform_body'>
      <div id='gform_fields_1' class='gform_fields top_label form_sublabel_below description_below validation_below'>
      <div id="field_1_1" class="gfield gfield--width-half">
         <label class='gfield_label' for='first_name'>First Name<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
         <div class='ginput_container ginput_container_text'>
            <input name='first_name' id='first_name' type='text' class='large' required />
         </div>
      </div>
         <div id="field_1_1" class="gfield gfield--width-half"  data-js-reload="field_1_1" >
            <label class='gfield_label' for='input_1_1'>Last Name<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_text'><input name='last_name' id='input_1_1' type='text' class='large' required /> </div>
         </div>
         <div id="field_1_3" class="gfield gfield--width-half">
            <label class='gfield_label' for='email'>Email Address<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_email'>
               <input name='email' id='email' type='email' class='large' required />
            </div>
         </div>
         <div id="field_1_5" class="gfield gfield--width-half gfield_contains_required"  data-js-reload="field_1_5" >
            <label class='gfield_label' for='mobile'>Phone Number<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_phone'>
               <input name='mobile' id='mobile' type='tel' class='large' onkeyup="phoneFormat(this)" required />
            </div>
         </div>
         <div id="field_2_16" class="gfield gfield--type-textarea gfield--input-type-textarea" >
            <label class='gfield_label gform-field-label' for='address'>Street Address:<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_textarea'>
               <textarea name='street_address' id='address' rows='3' placeholder="Street Address"></textarea>
            </div>
         </div>
         <div id="field_1_6" class="gfield gfield--width-half">
            <label class='gfield_label' for='city'>City<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_text'>
               <input name='city' id='city' type='text' class='large' required />
            </div>
         </div>
         <div id="field_1_11" class="gfield gfield--width-half">
            <label class='gfield_label' for='state'>State<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_select'>
               <select name='state' id='state' class='large gfield_select' required>
                  <option value=''>--Select--</option>
                  <option value='Alabama' >Alabama</option>
                  <option value='Alaska' >Alaska</option>
                  <option value='Arizona' >Arizona</option>
                  <option value='Arkansas' >Arkansas</option>
                  <option value='California' >California</option>
                  <option value='Colorado' >Colorado</option>
                  <option value='Connecticut' >Connecticut</option>
                  <option value='Delaware' >Delaware</option>
                  <option value='Dist. Of Columbia' >Dist. Of Columbia</option>
                  <option value='Florida' >Florida</option>
                  <option value='Georgia' >Georgia</option>
                  <option value='Hawaii' >Hawaii</option>
                  <option value='Idaho' >Idaho</option>
                  <option value='Illinois' >Illinois</option>
                  <option value='Indiana' >Indiana</option>
                  <option value='Iowa' >Iowa</option>
                  <option value='Kansas' >Kansas</option>
                  <option value='Kentucky' >Kentucky</option>
                  <option value='Louisiana' >Louisiana</option>
                  <option value='Maine' >Maine</option>
                  <option value='Maryland' >Maryland</option>
                  <option value='Massachusetts' >Massachusetts</option>
                  <option value='Michigan' >Michigan</option>
                  <option value='Minnesota' >Minnesota</option>
                  <option value='Mississippi' >Mississippi</option>
                  <option value='Missouri' >Missouri</option>
                  <option value='Montana' >Montana</option>
                  <option value='Nebraska' >Nebraska</option>
                  <option value='Nevada' >Nevada</option>
                  <option value='New Hampshire' >New Hampshire</option>
                  <option value='New Jersey' >New Jersey</option>
                  <option value='New Mexico' >New Mexico</option>
                  <option value='New York' >New York</option>
                  <option value='North Carolina' >North Carolina</option>
                  <option value='North Dakota' >North Dakota</option>
                  <option value='Ohio' >Ohio</option>
                  <option value='Oklahoma' >Oklahoma</option>
                  <option value='Oregon' >Oregon</option>
                  <option value='Pennsylvania' >Pennsylvania</option>
                  <option value='Puerto Rico' >Puerto Rico</option>
                  <option value='Rhode Island' >Rhode Island</option>
                  <option value='South Carolina' >South Carolina</option>
                  <option value='South Dakota' >South Dakota</option>
                  <option value='Tennessee' >Tennessee</option>
                  <option value='Texas' >Texas</option>
                  <option value='Utah' >Utah</option>
                  <option value='Vermont' >Vermont</option>
                  <option value='Virginia' >Virginia</option>
                  <option value='Washington' >Washington</option>
                  <option value='West Virginia' >West Virginia</option>
                  <option value='Wisconsin' >Wisconsin</option>
                  <option value='Wyoming' >Wyoming</option>
               </select>
            </div>
         </div>
         <div id="field_1_4" class="gfield gfield--width-half gfield_contains_required">
            <label class='gfield_label' for='date_of_birth'>Date of Birth<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_date'>
               <input name='date_of_birth' id='date_of_birth' type='date' class='large' required />
            </div>
         </div>
         <div id="field_1_8" class="gfield gfield--width-half">
            <label class='gfield_label' for='input_1_8'>Who would you list as a &#039;Beneficiary&#039;?<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_select'>
               <select name='beneficiary' id='input_1_8' class='large' required>
                  <option value=''>--Select--</option>
                  <option value='a Spouse' >a Spouse</option>
                  <option value='a Child' >a Child</option>
                  <option value='a Parent' >a Parent</option>
                  <option value='a Grandparent' >a Grandparent</option>
                  <option value='a Domestic Partner' >a Domestic Partner</option>
                  <option value='Other' >Other</option>
               </select>
            </div>
         </div>
         <div id="field_1_10" class="gfield gfield--width-full"  data-js-reload="field_1_10" >
            <label class='gfield_label' for='insurance_amount'>How much insurance are you looking to purchase?<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_contai/ner_number'>
               <span style="display: inline">
                  <input id='insurance_amount' name='insurance_amount' type='text' step='0.01' class='large' placeholder="$00.00" style="width:49%" />
               </span>               
               <span style="color:#fff">
                  &nbsp; OR &nbsp; 
                  <button type='button' class='large gform_button button' value="Calculate" style="display:iniline; background: #00f; width:30%;padding:10px;font-size:16px" onclick="modalConfirm()"><i class="fa fa-calculator"></i> Calculate</button>
               </span>
            </div>
         </div>
      </div>
   </div>
   <div class='gform_footer top_label'>
   <input type='submit' class='gform_button button' value='Submit ➞' />
   </div>
</form>
                       </div>
                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
</div>

<!-- Modal -->
<style>
   .modal, .modal label{color:#000}
   .form-control{border:1px solid #999!important}
</style>
<div class="modal fade" id="exampleModal" tabindex="-2" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document" style="width:100%; max-width: 900px">
      <div class="modal-content">
         <div class="modal-header">Calculate the right amount you need</div>
         <div class="modal-body calc-form">
            <div class="row">
               <div class="col-md-12" id="CalcQA">
                  <div class="form-group section_1 section_2">
                     <label for="">Are you Married or Single?</label><br>
                     <label for="">
                        <input type="radio" name="married" value="Single" onchange="haveChildren(this)"> Single
                     </label>
                     <label for="">
                        <input type="radio" name="married" value="Married" onchange="married(this)"> 
                        Married
                     </label>
                  </div>
               </div>
            </div>
            <div class="row">
            </div>
         </div>
         <div class="modal-footer">
            <label class="pull-left"> Total = <input id="totalCalc" value="$00.00" disabled /></label>
            <button class="btn btn-warning" onclick="resetForm()"><i class="fa fa-refresh"></i> Reset</button>
            <button class="btn btn-info" data-dismiss="modal" onclick="setCalcValue()">Done</button>
         </div>
      </div>
   </div>
</div>

<div class="modal fade" id="modalConfirm" tabindex="-1" role="dialog" aria-labelledby="modalConfirmLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-body">
            <div class="alert alert-warning">
               At Guardian My Life, we're committed to providing personalized guidance for your insurance needs. To achieve this, we kindly request that you answer the following questions. Please be assured that your responses will be kept strictly confidential and secure by Guardian My Life and our authorized agent partners. Your privacy is our top priority, and your information will only be used to better serve you. It will not be shared with any third parties outside of our authorized network or used for any purposes other than to understand and address your insurance needs. Thank you.
            </div>
         </div>
         <div class="modal-footer">
            <button class="btn btn-danger" onclick="modalDissmis()">Cancel</button>
            <button class="btn btn-info" data-toggle="modal" data-target="#exampleModal" onclick="modalDissmis()">Continue</button>
         </div>
      </div>
   </div>
</div>

<script>

   /* show confirmation */
   function modalConfirm()
   {
      // $("#modalConfirm").fadeIn();

      var c = document.getElementById('modalConfirm');
      c.classList.add('in');
      c.style.display = 'block';
   }

   function modalDissmis()
   {
      var c = document.getElementById('modalConfirm');
      c.style.display = 'none';
   }

   function usdFormat(val)
   {
      const formatter = new Intl.NumberFormat('en-US', {
         style : 'currency',
         currency: 'USD'
      });

      return formatter.format(val);
   }

   function calcSpouseFund()
   {
      var income = document.getElementById('annual_income');
      var amount = document.getElementById('spouse_percent');
      var year = document.getElementById('year');
      var totalCalc = document.getElementById('totalCalc');

      var total = income.value * amount.value / 100;
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + total * year.value);
   }
   
   function calcChildSchoolFund()
   {
      let amount = document.getElementById('child21_school_amount');
      let year = document.getElementById('child21_school_year');
      let totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + amount.value * year.value);
   }

   function calcChildCollegeFund()
   {
      let number = document.getElementById('college_child_number');
      let amount = document.getElementById('college_child_expense');
      let year = document.getElementById('college_child_year');
      let totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + number.value * amount.value * year.value);
   }

   function calcHomeRent()
   {
      let amount = document.getElementById('home_rent_amount');
      let year = document.getElementById('home_rent_pay_year');
      let totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + amount.value * 12 * year.value);
   }

   function calcDebt()
   {
      let amount = document.getElementById('total_debt');
      let totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + Number(amount.value));
   }

   function calcFuneral()
   {
      let amount = document.getElementById('total_funeral');
      let totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));

      totalCalc.value = usdFormat(totalView + Number(amount.value));
   }

   function setCalcValue()
   {
      // const formatter = new Intl.NumberFormat('en-US', {
      //    style : 'currency',
      //    currency: 'USD'
      // });

      var insurance_amount = document.getElementById('insurance_amount');
      var totalCalc = document.getElementById('totalCalc');
      let totalView = Number(totalCalc.value.replace(/[$,]/g, ""));
      insurance_amount.value = usdFormat(totalView);
   }

   function resetForm()
   {
      let totalCalc = document.getElementById('totalCalc');
      totalCalc.value = '$00.00';
      let qaform = document.getElementById('CalcQA');
      CalcQA.innerHTML = '<div class="form-group section_1 section_2"><label for="">Are you Married or Single?</label><br>'+'<label for=""><input type="radio" name="married" value="Single" onchange="haveChildren(this)"> Single &nbsp; </label><label for=""><input type="radio" name="married" value="Married" onchange="married(this)"> Married </label>'+'</div>';
   }

   //remote element next button
   function rmnext(e)
   {
      e.remove();
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

</script>
{{-- question answer insurance --}}
<script src="/home/js/qa_insurance.js?v=0109"></script>

@endsection
@section('script')

@endsection