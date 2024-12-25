@extends('layouts.homepage')
@section('style')
@endsection
@section('content')
<div data-elementor-type="wp-page" data-elementor-id="139" class="elementor elementor-139" data-elementor-post-type="page">
  <section class="elementor-section elementor-top-section elementor-element elementor-element-2b5fe252 elementor-section-content-middle mainpagehero elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="2b5fe252" data-element_type="section" data-settings="{&quot;background_background&quot;:&quot;classic&quot;,&quot;animation&quot;:&quot;none&quot;}">
    <div class="elementor-background-overlay"></div>
    <div class="elementor-container elementor-column-gap-no">
      <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-679e27f0" data-id="679e27f0" data-element_type="column">
        <div class="elementor-widget-wrap elementor-element-populated">
          <div class="elementor-element elementor-element-3633d3d1 elementor-hidden-mobile elementor-widget elementor-widget-heading" data-id="3633d3d1" data-element_type="widget" data-widget_type="heading.default">
            <div class="elementor-widget-container">
              <style>/*! elementor - v3.22.0 - 26-06-2024 */
                .elementor-heading-title{padding:0;margin:0;line-height:1}.elementor-widget-heading .elementor-heading-title[class*=elementor-size-]>a{color:inherit;font-size:inherit;line-height:inherit}.elementor-widget-heading .elementor-heading-title.elementor-size-small{font-size:15px}.elementor-widget-heading .elementor-heading-title.elementor-size-medium{font-size:19px}.elementor-widget-heading .elementor-heading-title.elementor-size-large{font-size:29px}.elementor-widget-heading .elementor-heading-title.elementor-size-xl{font-size:39px}.elementor-widget-heading .elementor-heading-title.elementor-size-xxl{font-size:59px}
              </style>
              <div style="text-align: center;color:#fff">
                <div style="color:#fff">Your Insurance Agent</div>
              <h3 class="elementor-heading-title elementor-size-default">{{strtoupper($agent->name)}}</h3><br>
              </div>
              <h1 class="elementor-heading-title elementor-size-default">Preserve & Protect what matters most!</h1>
            </div>
          </div>
          <div class="elementor-element elementor-element-73aa0aed elementor-headline--style-rotate elementor-hidden-mobile elementor-widget elementor-widget-animated-headline" data-id="73aa0aed" data-element_type="widget" data-settings="{&quot;headline_style&quot;:&quot;rotate&quot;,&quot;animation_type&quot;:&quot;blinds&quot;,&quot;rotating_text&quot;:&quot;Mortgage Protection.\nFinal Expense.\nIndexed Universal Life.\nFixed Indexed Annuities.&quot;,&quot;loop&quot;:&quot;yes&quot;,&quot;rotate_iteration_delay&quot;:2500}" data-widget_type="animated-headline.default">
            <div class="elementor-widget-container">
              <link rel="stylesheet" href="/home/wp-content/plugins/elementor-pro/assets/css/widget-animated-headline.min.css">
              <h2 class="elementor-headline elementor-headline-animation-type-blinds elementor-headline-letters">
                <span class="elementor-headline-dynamic-wrapper elementor-headline-text-wrapper">
                <span class="elementor-headline-dynamic-text elementor-headline-text-active">
                Whole &nbsp; Life</span>
                <span class="elementor-headline-dynamic-text">Final &nbsp;  Expense</span>
                <span class="elementor-headline-dynamic-text">Fixed  &nbsp;Indexed  &nbsp; Annuities</span>
                <span class="elementor-headline-dynamic-text">Mortgage  &nbsp;Protection</span>
                <span class="elementor-headline-dynamic-text">Universal  &nbsp;Life</span>
                <span class="elementor-headline-dynamic-text">Children &nbsp; Life  &nbsp; Insurance</span>
                </span>
              </h2>
            </div>
          </div>
          <div class="elementor-element elementor-element-f13123a elementor-hidden-desktop elementor-hidden-tablet elementor-headline--style-highlight elementor-invisible elementor-widget elementor-widget-animated-headline" data-id="f13123a" data-element_type="widget" data-settings="{&quot;highlight_animation_duration&quot;:0,&quot;marker&quot;:&quot;underline&quot;,&quot;_animation&quot;:&quot;zoomIn&quot;,&quot;headline_style&quot;:&quot;highlight&quot;}" data-widget_type="animated-headline.default">
            <div class="elementor-widget-container">
              <h1 class="elementor-headline">
                <span class="elementor-headline-plain-text elementor-headline-text-wrapper">Protect what<br></span>
                <span class="elementor-headline-dynamic-wrapper elementor-headline-text-wrapper">
                </span>
                <span class="elementor-headline-plain-text elementor-headline-text-wrapper">matters most.</span>
              </h1>
            </div>
          </div>
          <div class="elementor-element elementor-element-320ccfb8 elementor-invisible elementor-widget elementor-widget-heading" data-id="320ccfb8" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="heading.default">
            <div class="elementor-widget-container">
              <p class="elementor-heading-title elementor-size-default">Guardian My Life collaborates with independent insurance agents and partners with the industry's leading carriers. Reach out to us today to discover more about our comprehensive solutions, including Whole Life, Final Expense, Mortgage Protection, Final Expense, Universal Life, Children Life Insurance, and Fixed Indexed Annuities.</p>
            </div>
          </div>
          <div class="elementor-element elementor-element-75555e3b elementor-align-right elementor-widget__width-auto elementor-mobile-align-justify elementor-tablet-align-center elementor-invisible elementor-widget elementor-widget-button" data-id="75555e3b" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
            <div class="elementor-widget-container">
              <div class="elementor-button-wrapper">
                <a class="elementor-button elementor-button-link elementor-size-md" href="{{route('home.client.apply')}}">
                  <span class="elementor-button-content-wrapper">
                    <span class="elementor-button-icon">
                      <svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-right" viewBox="0 0 256 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                      </svg>
                    </span>
                    <span class="elementor-button-text">Request a Custom Quote</span>
                  </span>
                </a>
              </div>
            </div>
          </div>
          <div class="elementor-element elementor-element-2543a97 elementor-align-right elementor-widget__width-auto elementor-mobile-align-justify elementor-tablet-align-center elementor-invisible elementor-widget elementor-widget-button" data-id="2543a97" data-element_type="widget" data-settings="{&quot;_animation&quot;:&quot;fadeInUp&quot;}" data-widget_type="button.default">
            <div class="elementor-widget-container">
              <div class="elementor-button-wrapper">
                <a class="elementor-button elementor-button-link elementor-size-md" href="{{route('home.agent.apply')}}">
                  <span class="elementor-button-content-wrapper">
                    <span class="elementor-button-icon">
                      <svg aria-hidden="true" class="e-font-icon-svg e-fas-angle-right" viewBox="0 0 256 512" xmlns="http://www.w3.org/2000/svg">
                        <path d="M224.3 273l-136 136c-9.4 9.4-24.6 9.4-33.9 0l-22.6-22.6c-9.4-9.4-9.4-24.6 0-33.9l96.4-96.4-96.4-96.4c-9.4-9.4-9.4-24.6 0-33.9L54.3 103c9.4-9.4 24.6-9.4 33.9 0l136 136c9.5 9.4 9.5 24.6.1 34z"></path>
                      </svg>
                    </span>
                    <span class="elementor-button-text">Become a GML Agent</span>
                  </span>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection