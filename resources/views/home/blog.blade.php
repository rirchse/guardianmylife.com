@extends('layouts.homepage')
@section('style')
<link rel='stylesheet' id='elementor-post-361-css' href='/home/wp-content/uploads/elementor/css/post-361bfc4.css?ver=1720647533' media='all' />
<link rel='stylesheet' id='gform_basic-css' href='/home/wp-content/plugins/gravityforms/assets/css/dist/basic.minfae6.css?ver=2.8.14' media='all' />
<link rel='stylesheet' id='gform_theme-css' href='/home/wp-content/plugins/gravityforms/assets/css/dist/theme.minfae6.css?ver=2.8.14' media='all' />
<style>
   .input-radio{transform: scale(1.5); margin-right:15px }
   .blog-list{margin-top:50px; list-style: none;}
   .blog-list li title{font-size:20px; font-weight: bold}
   .blog-list a{color:#000; font-size: 20px}
   .blog-list li{padding:15px; border-bottom:1px solid #ddd}
   .blog-list li img{padding-top: 0; float: left; max-width: 250px; padding: 0 15px 0;}
   .title{font-size: 22px; font-weight: bold}
   .btn {border:1px solid #ddd; clear:top; background:#eee}

</style>
@endsection
@section('content')
<div data-elementor-type="wp-page" data-elementor-id="361" class="elementor elementor-361" data-elementor-post-type="page">
  <section class="elementor-section elementor-top-section elementor-element elementor-element-422c8197 elementor-section-content-middle elementor-section-boxed elementor-section-height-default elementor-section-height-default" style="background-image:url('/home/images/blog.jpg')">
     <div class="elementor-background-overlay"></div>
     <div class="elementor-container elementor-column-gap-no">
        <div class="elementor-column elementor-col-100 elementor-top-column elementor-element elementor-element-27944c13" data-id="27944c13" data-element_type="column">
           <div class="elementor-widget-wrap elementor-element-populated">
              <div class="elementor-element elementor-element-056bbe6 elementor-widget__width-initial elementor-hidden-mobile elementor-widget elementor-widget-heading" data-id="056bbe6" data-element_type="widget" data-widget_type="heading.default">
                 <div class="elementor-widget-container" style="color: #fff">
                    <h1 class="elementor-heading-title elementor-size-default">Our Blog</h1>
                 </div>
              </div>
              <div class="elementor-element elementor-element-aeb1780 elementor-widget elementor-widget-text-editor" >
                 <div class="elementor-widget-container">
                    <p style="text-align: center;color:#fff"></p>
                 </div>
              </div>
           </div>
        </div>
     </div>
  </section>
  <section class="elementor-section elementor-top-section elementor-element elementor-element-44281a33 elementor-section-boxed elementor-section-height-default elementor-section-height-default" data-id="44281a33" data-element_type="section">
     <div class="elementor-container">
      <ul class="blog-list">
         @foreach($blogs as $key => $blog)
         <li>
            <a href="{{route('home.blog.show', $blog->id)}}">
            <img src="{{$blog->image? $blog->image :'/img/blog-image.jpg'}}" alt="">
            <p class="title">{{$blog->title}} </p>
            <small>{!! substr($blog->details, 0, 250) !!}...</small><br>
               <p class="btn">Read More...</p>
            </a>
         </li>
         @endforeach
      </ul>
     </div>
     <div class="col-md-12 paginate">
      {{$blogs->links()}}
    </div>
  </section>
</div>
@endsection