@extends('layouts.homepage')
@section('style')
<link rel='stylesheet' id='elementor-post-361-css' href='/home/css/post-361bfc4.css?ver=1720647533' media='all' />
<link rel='stylesheet' id='gform_basic-css' href='/home/css/basic.minfae6.css?ver=2.8.14' media='all' />
<link rel='stylesheet' id='gform_theme-css' href='/home/css/theme.minfae6.css?ver=2.8.14' media='all' />
<style>
   .input-radio{transform: scale(1.5); margin-right:15px }
</style>
@endsection
@section('content')
<div data-elementor-type="wp-page" data-elementor-id="361" class="elementor elementor-361" data-elementor-post-type="page">
  <section class="elementor-section elementor-top-section elementor-element elementor-element-422c8197 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="422c8197" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
     <div class="elementor-background-overlay"></div>
     <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-27944c13" data-id="27944c13" data-element_type="column">
           <div class="elementor-widget-wrap elementor-element-populated">
              <div class="elementor-element elementor-element-056bbe6 elementor-widget__width-initial elementor-hidden-mobile elementor-widget elementor-widget-heading" data-id="056bbe6" data-element_type="widget" data-widget_type="heading.default">
                 <div class="elementor-widget-container" style="color: #fff">
                    <style>/*! elementor - v3.22.0 - 26-06-2024 */
                       .elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}
                    </style>

                    @if(!is_null(Session::get('_agent')))
                    <div style="text-align: center;color:#fff">
                        <div style="color:#fff">Your Insurance Agent</div>
                           <h2 class="elementor-heading-title elementor-size-default">
                              {{strtoupper(Session::get('_agent')->name)}}
                           </h2>
                        </div>
                        <br>
                     @endif
                    <h1 class="elementor-heading-title elementor-size-default">Interested in joining us?</h1>
                 </div>
              </div>
              <div class="elementor-element elementor-element-0c70577 elementor-widget__width-initial elementor-hidden-desktop elementor-hidden-tablet elementor-widget elementor-widget-heading" data-id="0c70577" data-element_type="widget" data-widget_type="heading.default">
                 <div class="elementor-widget-container">
                    <h1 class="elementor-heading-title elementor-size-default">Interested in<br> joining us?</h1>
                 </div>
              </div>
              <div class="elementor-element elementor-element-aeb1780 elementor-widget elementor-widget-text-editor" data-id="aeb1780" data-element_type="widget" data-widget_type="text-editor.default">
                 <div class="elementor-widget-container">
                    <style>/*! elementor - v3.22.0 - 26-06-2024 */
                       .elementor-widget-text-editor.elementor-drop-cap-view-stacked .elementor-drop-cap{background-color:#69727d;color:#fff}.elementor-widget-text-editor.elementor-drop-cap-view-framed .elementor-drop-cap{color:#fff;border:3px solid;background-color:transparent}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap{margin-top:8px}.elementor-widget-text-editor:not(.elementor-drop-cap-view-default) .elementor-drop-cap-letter{width:1em;height:1em}.elementor-widget-text-editor .elementor-drop-cap{float:left;text-align:center;line-height:1;font-size:50px}.elementor-widget-text-editor .elementor-drop-cap-letter{display:inline-block}
                    </style>
                    <p style="text-align: center;color:#fff">Once your inquiry is received a Recruiting Manager will contact you within 24 hours. If you do not hear from a manager within 48 hours please email <a href="mailto:recruiter@guardianmylife.com"> Recruiter@guardianmylife.com</a> (we need a subemail that is called recruiter) I will look to see how I can get it without buying another license.</p>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <section class="elementor-section elementor-top-section elementor-element elementor-element-44281a33 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="44281a33" data-element_type="section">
     <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-a8a56e1 excludedarkmode" data-id="a8a56e1" data-element_type="column" data-settings="{&quot;background_background&quot;:&quot;classic&quot;}">
           <div class="elementor-widget-wrap elementor-element-populated">
              <div class="elementor-element elementor-element-1aaf014 elementor-hidden-mobile elementor-widget elementor-widget-text-editor" data-id="1aaf014" data-element_type="widget" data-widget_type="text-editor.default">
                 <div class="elementor-widget-container">
                    <p style="text-align: right;">All fields are required.</p>
                 </div>
              </div>
              <div class="elementor-element elementor-element-0627cf6 elementor-hidden-tablet elementor-hidden-desktop elementor-widget elementor-widget-text-editor" data-id="0627cf6" data-element_type="widget" data-widget_type="text-editor.default">
                 <div class="elementor-widget-container">
                    <p style="text-align: right;">All fields are required.</p>
                 </div>
              </div>
              <div class="elementor-element elementor-element-1270a2f elementor-widget elementor-widget-shortcode" data-id="1270a2f" data-element_type="widget" data-widget_type="shortcode.default">
                 <div class="elementor-widget-container">
                    <div class="elementor-shortcode">
                       <div class='gf_browser_chrome gform_wrapper gravity-theme gform-theme--no-framework get_quote_wrapper' data-form-theme='gravity-theme' data-form-index='0' id='gform_wrapper_2' >
                          <div id='gf_2' class='gform_anchor' tabindex='-1'></div>
                          <div class='gform_heading'>
                             <p class='gform_required_legend'>&quot;<span class="gfield_required gfield_required_asterisk">*</span>&quot; indicates required fields</p>
                          </div>
<form method='post' enctype='multipart/form-data' class='get_quote' action='{{route('agent.signup.store')}}'>
@csrf
   <div class='gform-body gform_body'>
      <div id='gform_fields_2' class='gform_fields top_label form_sublabel_below description_below validation_below'>
         <div id="field_2_1" class="gfield gfield--width-half">
            <label class='gfield_label gform-field-label' for='name'>Full Name<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_text'>
               <input name='name' id='name' type='text' class='large' placeholder="Example: Mr. John Little" />
            </div>
         </div>
         <div class="gfield gfield--width-half">
            <label class="gfield_label gform-field-label" for="username">Username <span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class="ginput_container">
               <input type="text" name="username" id="username" class="large" placeholder="Example: littlejohn" onkeyup="checkUsername(this)" />
            </div>
            <span id="errorShow" style="color:red"></span>
         </div>
         <div id="field_2_3" class="gfield gfield--width-half"  data-js-reload="field_2_3" >
            <label class='gfield_label gform-field-label' for='email'>Email Address<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_email'>
               <input name='email' id='email' type='email' class='large' placeholder="example@email.com" />
            </div>
         </div>
         <div id="field_2_5" class="gfield gfield--width-half"  data-js-reload="field_2_5" >
            <label class='gfield_label gform-field-label' for='phone'>Phone Number<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_phone'>
               <input name='phone' id='phone' type='tel' class='large' onkeyup="phoneFormat(this)"/>
            </div>
         </div>
         <div id="field_2_16" class="gfield gfield--type-textarea gfield--input-type-textarea" >
            <label class='gfield_label gform-field-label' for='address'>Street Address:<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_textarea'>
               <textarea name='address' id='address' rows='3' placeholder="Street Address"></textarea>
            </div>
         </div>
         <div id="field_2_17" class="gfield gfield--type-text gfield--input-type-text gfield--width-half"  data-js-reload="field_2_17" >
            <label class='gfield_label gform-field-label' for='city'>City<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_text'>
               <input name='city' id='city' type='text' class='large' />
            </div>
         </div>
         <div id="field_2_18" class="gfield gfield--width-half"  data-js-reload="field_2_18" >
            <label class='gfield_label gform-field-label' for='state'>State<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_select'>
               <select name='state' id='state' class='large gfield_select'>
                  <option value="">--Select--</option>
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
         <div id="field_2_19" class="gfield gfield--width-half">
            <label class='gfield_label gform-field-label' for='input_2_19'>Do you have an active life insurance license?<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_select'>
               <label><input type="radio" name="license" class="input-radio" value="Yes">  &nbsp; Yes &nbsp; </label>
               <label><input type="radio" name="license" class="input-radio" value="No">  &nbsp; No &nbsp; </label>
               {{-- <select name='license' id='license' class='large gfield_select'>
                  <option value="">--Select--</option>
                  <option value='Yes' >Yes</option>
                  <option value='No' >No</option>
               </select> --}}
            </div>
         </div>
         <div id="field_2_20" class="gfield gfield--width-half">
            <label class='gfield_label gform-field-label' for='team'>Do you currently manage a team of agents?<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_select'>
               <label><input type="radio" name="team_manage" class="input-radio" value="Yes"> &nbsp; Yes &nbsp; </label>
               <label><input type="radio" name="team_manage" class="input-radio" value="No">  &nbsp; No  &nbsp; </label>
               {{-- <select name='team_manage' id='team' class='large gfield_select'>
                  <option value="">--Select--</option>
                  <option value='Yes' >Yes</option>
                  <option value='No' >No</option>
               </select> --}}
            </div>
         </div>
         <div id="field_2_14" class="gfield gfield--width-half"  data-js-reload="field_2_14" >
            <label class='gfield_label gform-field-label' for='how_find'>How did you hear about us?<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_select'>
               <select name='how_find' id='how_find' class='large gfield_select'>
                  <option value="">--Select--</option>
                  <option value='Facebook' >Facebook</option>
                  <option value='Linkedin' >Linkedin</option>
                  {{-- <option value='Ziprecruiter' >Ziprecruiter</option> --}}
                  {{-- <option value='Glassdoor' >Glassdoor</option> --}}
                  <option value='Instagram' >Instagram</option>
                  <option value='Youtube' >Youtube</option>
                  <option value='Tik Tok' >Tik Tok</option>
                  <option value='Email' >Email</option>
                  {{-- <option value='Craigslist' >Craigslist</option> --}}
                  <option value='Friend' >Friend</option>
                  {{-- <option value='Other' >Other</option> --}}
               </select>
            </div>
         </div>
         <div id="field_2_16" class="gfield gfield--type-textarea gfield--input-type-textarea" >
            <label class='gfield_label gform-field-label' for='your_hope'>What are you hoping to gain by working with GML?<span class="gfield_required"><span class="gfield_required gfield_required_asterisk">*</span></span></label>
            <div class='ginput_container ginput_container_textarea'>
               <textarea name='your_hope' id='your_hope' class='textarea medium' rows='10'></textarea>
            </div>
         </div>
      </div>
   </div>
   <div class='gform_footer top_label'>
      <input type='submit' id='gform_submit_button_2' class='gform_button button' value='Submit ➞'/>
   </div>
</form>
</div>
<iframe style='display:none;width:0px;height:0px;' src='about:blank' name='gform_ajax_frame_2' id='gform_ajax_frame_2' title='This iframe contains the logic required to handle Ajax powered Gravity Forms.'></iframe>

                    </div>
                 </div>
              </div>
           </div>
        </div>
     </div>
     <script>
      // check username exists
      function checkUsername(e)
      {
         let errorShow = document.getElementById('errorShow');

         setTimeout(() => {
         jQuery.ajax({
            type: 'GET',
            url: '/check_username/'+e.value,
            success: function(data){
               if(data.success == true){
                  errorShow.innerHTML = 'The username alredy taken.';
               }else{
                  errorShow.innerHTML = '';
               }
               console.log(data.success);
            },
            error: function(data){
               console.log(data);
            }
         });
            
         }, 5000);
      }
     </script>
  </section>
</div>
@endsection