@extends('frontend::layouts.master') 
 
@section('content')
<!--================================
         START SLIDER AREA
=================================-->
<section class="slider-area">
    <div class="single-slide-item single-slide-item-2 slide-bg4">
        <div id="perticles-js-2"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2 class="section__title">Find the Best <br> Online Test</h2>
                        <p class="section__desc">
                            Choose from over 200,000 online Exams with new additions <br>
                            published by our experts every month
                        </p>
                    </div>
                    <?php  if($packages->isNotEmpty() && $question_category->isNotEmpty()):  ?> 
                    <div class="hero-search-form">
                        <div class="contact-form-action">
                            <form  method="get" action="">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="input-box">
                                            <div class="form-group mb-0">
                                                <div class="input-group">
                                                    <div class="input-group">
                                                        <select class="selectSearch" name="question_category">
                                                            <option data-display="Select your exam here">Select your exam here</option>
                                                            <?php foreach ($question_category as $key => $value) :  ?>
                                                                 <option value="{{$value->slug}}">{{$value->name}}</option>
                                                            <?php endforeach; ?> 
                                                        </select>
                                                        <div style="margin-left: 3px;" class="input-group-append">
                                                            <button class="btn btn-success" type="submit">Go</button>
                                                        </div>
                                                        <span class="la la-search search-icon"></span> 
                                                    </div>
                                                </div>  
                                            </div>
                                        </div> 
                                    </div>  
                                </div>
                            </form>
                        </div> 
                    </div>
                    <?php endif; ?>             
                </div> 
                <div class="our-post-content">
                    <span class="hw-circle"></span>
                    <span class="hw-circle"></span>
                    <span class="hw-circle"></span>
                    <div class="how-we-work-wrap">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="our-post-item">
                                        <i class="la la-mouse-pointer icon-element"></i>
                                        <div class="our__text">
                                            <h4 class="widget-title">10000+ Exams</h4>
                                            <p>Explore a variety of fresh topics</p>
                                        </div><!-- our__text -->
                                    </div><!-- our-post-item -->
                                </div><!-- col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="our-post-item">
                                        <i class="la la-users icon-element"></i>
                                        <div class="our__text">
                                            <h4 class="widget-title">Get ready for a career</h4>
                                            <p>Find the test for you</p>
                                        </div><!-- our__text -->
                                    </div><!-- our-post-item -->
                                </div><!-- col-lg-4 -->
                                <div class="col-lg-4">
                                    <div class="our-post-item">
                                        <i class="la la-graduation-cap icon-element"></i>
                                        <div class="our__text">
                                            <h4 class="widget-title">Be Industrial Leader</h4>
                                            <p>Learn on your schedule</p>
                                        </div><!-- our__text -->
                                    </div><!-- our-post-item -->
                                </div><!-- col-lg-4 -->
                            </div><!-- row -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================================
        END SLIDER AREA
=================================-->

<!--======================================
        START COURSE AREA
======================================-->
<?php  if($packages->isNotEmpty() && $question_category->isNotEmpty()): ?>             
<section class="course-area">
    <div class="course-wrapper section-bg padding-top-40px padding-bottom-40px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-tab">
                        <ul class="nav nav-tabs justify-content-center text-center" role="tablist" id="review">
                            <?php  $i=1; foreach ($question_category as $key => $value) :  ?> 
                            <li role="{{$value->slug}}_{{$i}}">
                                <a href="#{{$value->slug}}" role="tab" data-toggle="tab" class="theme-btn radius-rounded @if($i==1) active  @endif" aria-selected="true">
                                    {{$value->name}}
                                </a>
                            </li>
                            <?php $i++; endforeach; ?>  
                        </ul>
                    </div> 
                </div> 
            </div> 
        </div> 
    </div> 
    <div style="margin-bottom: 483px;" class="card-content-wrapper padding-top-40px padding-bottom-115px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="tab-content">
                        <?php  
                            $j=1; foreach ($question_category as $key => $value) : 
                            $package_list  =$packages->where('category_id',$value->id);
                            if($package_list->isNotEmpty()):
                               
                        ?>
                          <div role="{{$value->slug}}_{{$i}}" class="tab-pane fade  show @if($j==1) active  @endif" id="{{$value->slug}}">
                            <div class="row">
                                <?php  $k=1; foreach ($package_list as $package_key => $package_value) :    ?> 
                                <div class="col-lg-4 column-td-half">
                                    <div class="CardContainer">
                                        <div class="card">
                                            <div class="frontSide">
                                                <div class="card-item card-preview">
                                                    <div class="card-image">
                                                        <a href="#" style="padding: 0px 1px 0px 1px" class="card__img"><img src="{{asset('public/images/sample/img11.jpg')}}" alt=""></a>
                                                        <div class="card-badge">
                                                            <span class="badge-label"></span>
                                                        </div>
                                                    </div><!-- end card-image -->
                                                    <div class="card-content">
                                                        <p class="card__label">
                                                            <span class="card__label-text">{{$package_value->name}}</span>
                                                            <a href="#" class="card__collection-icon" data-toggle="tooltip" data-placement="top" title="Add to Wishlist"><span class="la la-heart-o"></span></a>
                                                        </p>
                                                        <h3 class="card__title">
                                                            <a href="#">{{$value->name}} - {{$package_value->sets}} Mockup Test</a>
                                                        </h3>
<!--                                                        <p class="card__author">
                                                            <a href="teacher-detail.html">bharat elearn</a>
                                                        </p>-->
                                                      
                                                        <div class="card-action">
                                                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                                                <li>
                                                                    <span class="meta__date">
                                                                         <i class="la la-list"></i> {{$package_value->sets}} Mockup Test  
                                                                    </span>
                                                                </li>
                                                                <li>
                                                                    <span class="meta__date">
                                                                        <i class="la la-clock-o"></i> {{$package_value->validity}} days Validity
                                                                    </span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                             <div class="backSide">
                                                <div class="card-item">
                                                    <div class="card-content">
<!--                                                        <p class="card__author">
                                                            By <a href="teacher-detail.html">Bharat Elearn</a>
                                                        </p>-->
                                                        <h3 class="card__title">
                                                            <a href="#">{{$value->name}} -  {{$package_value->sets}} Mockup Test</a>
                                                        </h3>
                                                        <p class="card__label">
                                                            <span class="card__label-text mr-1">{{$package_value->name}}</span>
                                                            
                                                        </p>
                                                    
                                                        <div class="card-para mb-3">
                                                            <p class="font-size-14 line-height-24">
                                                                By subscribing this pack you can access mockup test upto 1. you can access the same test as many as you want.
                                                            </p>
                                                        </div>
                                                        <ul class="list-items mb-3 font-size-14">
                                                            <li>1 Mock Tests Each For Principles & Practices Of Banking, Accounting & Finance For Bankers And Legal & Regulatory Aspects Of Banking</li>
                                                            <li>Review Answers Yourself</li>
                                                         
                                                        </ul>
                                                        <div class="card-action">
                                                            <ul class="card-duration d-flex justify-content-between align-items-center">
                                                                <li><span class="meta__date"><i class="la la-play-circle"></i> {{$package_value->sets}}  Mockup Test </span></li>
                                                                <li><span class="meta__date"><i class="la la-clock-o"></i>  {{$package_value->validity}} Days Validity </span></li>
                                                            </ul>
                                                        </div><!-- end card-action -->
                                                        <div class="btn-box w-100 text-center mb-3"> 
                                                            <a href="{{route('package_purchase',[\Crypt::encryptString($package_value->id)])}}" class="theme-btn d-block">TRY NOW</a>
                                                        </div>
                                                   
                                                    </div><!-- end card-content -->
                                                </div><!-- end card-item -->

                                             </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $k++; endforeach; ?>  
                            </div> 
                        </div>
                        <?php $j++; endif; endforeach; ?> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> 
 
<div class="row">
    <div class="col-lg-12">
        <div class="btn-box mt-4 text-center">
            <a style="margin-bottom: 25px;" href="#" class="theme-btn">browse all Exams</a>
        </div> 
    </div> 
</div> 
<?php  endif;  ?>   
<!--======================================
        END COURSE AREA
======================================-->



<div class="section-block"></div>

<!--======================================
        START BENEFIT AREA
======================================-->
<section class="benefit-area benefit-area2 padding-top-120px padding-bottom-120px overflow-hidden">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="img-box img-box-2">
                    <img src="{{asset('public/images/sample/img13.jpg')}}" alt="">
                    <img src="{{asset('public/images/sample/img14.jpg')}}" alt="">
                    <img src="{{asset('public/images/sample/img12.jpg')}}" alt="">
                    <img src="{{asset('public/images/sample/img11.jpg')}}" alt="">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="benefit-heading padding-top-120px">
                    <div class="section-heading">
                        <h5 class="section__meta">get start with Bharat Elearn</h5>
                        <h2 class="section__title">General Knowledge<br> & Current Affairs</h2>
                        <span class="section-divider"></span>
                        <p class="section__desc">
                            Sed consequat justo non mauris pretium at tempor justo sodales. Quisque tincidunt laoreet malesuada. Cum sociis natoque penatibus et magnis dis parturient montes
                        </p>
                    </div><!-- end section-heading -->
                    <div class="row">
                        <div class="col-lg-4 column-td-half">
                            <div class="info-icon-box">
                                <span class="la la-mouse-pointer icon-element icon-bg-1"></span>
                                <h4 class="widget-title">100,000 GK Q/A</h4>
                            </div><!-- end info-icon-box -->
                        </div><!-- end col-lg-4 -->
                        <div class="col-lg-4 column-td-half">
                            <div class="info-icon-box">
                                <span class="la la-bolt icon-element icon-bg-2"></span>
                                <h4 class="widget-title">Current Affairs </h4>
                            </div><!-- end info-icon-box -->
                        </div><!-- end col-lg-4 -->
                        <div class="col-lg-4 column-td-half">
                            <div class="info-icon-box">
                                <span class="la la-users icon-element icon-bg-3"></span>
                                <h4 class="widget-title">Easy learning</h4>
                            </div><!-- end info-icon-box -->
                        </div><!-- end col-lg-4 -->
                    </div><!-- end row -->
                    <div class="btn-box">
                        <a href="a#" class="theme-btn">Explore More</a>
                    </div>
                </div><!-- end benefit-heading -->
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end benefit-area -->
<!--======================================
        END BENEFIT AREA
======================================-->





<div class="section-block"></div>


<!--================================
         START TESTIMONIAL AREA
=================================-->
<section class="testimonial-area section-bg padding-top-120px padding-bottom-110px">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="section-heading">
                    <h5 class="section__meta">testimonials</h5>
                    <h2 class="section__title">From the Bharat Elearn community</h2>
                    <span class="section-divider"></span>
                    <p class="section__desc">
                        Donec vitae orci sed dolor rutrum auctor. Duis arcu tortor, suscipit eget, imperdiet nec
                    </p>
                </div><!-- end section-heading -->
                <div class="btn-box">
                    <a href="#" class="theme-btn">explore all</a>
                </div>
            </div><!-- end col-lg-4 -->
            <div class="col-lg-8">
                <div class="testimonial-subtitle pb-3">
                    <h3 class="widget-title font-weight-medium">30+ million people are already learning on Bharat Elearn</h3>
                </div>
                <div class="testimonial-carousel-2">
                    <div class="testimonial-item testimonial-item-layout-2">
                        <div class="testimonial__desc">
                            <p class="testimonial__desc-desc">
                                My children and I LOVE Bharat Elearn! The Exams are fantastic and the
                                instructors are so fun and knowledgeable.
                                I only wish we found it sooner.
                            </p>
                        </div><!-- end testimonial__desc -->
                        <div class="testimonial-header">
                            <img src="{{asset('public/images/sample/testi-img.jpg')}}" alt="small-avatar">
                            <div class="testimonial__name">
                                <h3 class="testimonial__name-title">Kamran Adi</h3>
                                <span class="testimonial__name-meta">student</span>
                                <ul class="review-stars d-inline-block">
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star-o"></span></li>
                                </ul>
                            </div>
                        </div><!-- end testimonial-header -->
                    </div><!-- end testimonial-item -->
                    <div class="testimonial-item testimonial-item-layout-2">
                        <div class="testimonial__desc">
                            <p class="testimonial__desc-desc">
                                My children and I LOVE Bharat Elearn! The Exams are fantastic and the
                                instructors are so fun and knowledgeable.
                                I only wish we found it sooner.
                            </p>
                        </div><!-- end testimonial__desc -->
                        <div class="testimonial-header">
                            <img src="{{asset('public/images/sample/testi-img2.jpg')}}" alt="small-avatar">
                            <div class="testimonial__name">
                                <h3 class="testimonial__name-title">Kevin Martin</h3>
                                <span class="testimonial__name-meta">student</span>
                                <ul class="review-stars d-inline-block">
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star-o"></span></li>
                                </ul>
                            </div>
                        </div><!-- end testimonial-header -->
                    </div><!-- end testimonial-item -->
                    <div class="testimonial-item testimonial-item-layout-2">
                        <div class="testimonial__desc">
                            <p class="testimonial__desc-desc">
                                My children and I LOVE Bharat Elearn! The Exams are fantastic and the
                                instructors are so fun and knowledgeable.
                                I only wish we found it sooner.
                            </p>
                        </div><!-- end testimonial__desc -->
                        <div class="testimonial-header">
                            <img src="{{asset('public/images/sample/testi-img3.jpg')}}" alt="small-avatar">
                            <div class="testimonial__name">
                                <h3 class="testimonial__name-title">Jane Alphonse</h3>
                                <span class="testimonial__name-meta">student</span>
                                <ul class="review-stars d-inline-block">
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star-o"></span></li>
                                </ul>
                            </div>
                        </div><!-- end testimonial-header -->
                    </div><!-- end testimonial-item -->
                    <div class="testimonial-item testimonial-item-layout-2">
                        <div class="testimonial__desc">
                            <p class="testimonial__desc-desc">
                                My children and I LOVE Bharat Elearn! The Exams are fantastic and the
                                instructors are so fun and knowledgeable.
                                I only wish we found it sooner.
                            </p>
                        </div><!-- end testimonial__desc -->
                        <div class="testimonial-header">
                            <img src="{{asset('public/images/sample/testi-img4.jpg')}}" alt="small-avatar">
                            <div class="testimonial__name">
                                <h3 class="testimonial__name-title">Dan Greene</h3>
                                <span class="testimonial__name-meta">student</span>
                                <ul class="review-stars d-inline-block">
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star"></span></li>
                                    <li><span class="la la-star-o"></span></li>
                                </ul>
                            </div>
                        </div><!-- end testimonial-header -->
                    </div><!-- end testimonial-item -->
                </div><!-- end testimonial-carousel-2 -->
            </div><!-- end col-lg-8 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end testimonial-area -->
<!--================================
        END TESTIMONIAL AREA
=================================-->





<!--======================================
        START GET-START AREA
======================================-->
<section class="get-start-area get-start-area2 padding-top-120px padding-bottom-110px overflow-hidden">
    <div class="box-icons">
        <div class="box-one"></div>
        <div class="box-two"></div>
        <div class="box-three"></div>
        <div class="box-four"></div>
    </div><!-- end box-icons -->
    <div class="container">
        <div class="row">
            <div class="col-lg-10">
                <div class="get-start-content">
                    <div class="section-heading">
                        <h5 class="section__meta section__metalight">start online test</h5>
                        <h2 class="section__title text-white">Accelerate your future. Learn <br> anytime, anywhere</h2>
                        <span class="section-divider section-divider-light"></span>
                    </div><!-- end section-heading -->
                    <div class="btn-box margin-top-20px">
                        <a href="#" class="theme-btn theme-btn-hover-light">get started</a>
                    </div>
                </div><!-- end get-start-content -->
            </div><!-- end col-lg-10 -->
            <div class="col-lg-2">
                <div class="promo-video-btn d-flex h-100 align-items-center justify-content-end">
                    <a class="mfp-iframe video-play-btn watch-video-btn" href="https://www.youtube.com/watch?v=xjQo-Dmb74Y" title="Watch Video">
                        <i class="la la-play"></i>
                    </a>
                </div><!-- end promo-video-btn -->
            </div><!-- end col-lg-2 -->
        </div><!-- end row -->
    </div><!-- end container -->
    <div class="box-icons2">
        <div class="box-one"></div>
        <div class="box-two"></div>
        <div class="box-three"></div>
        <div class="box-four"></div>
        <div class="box-five"></div>
    </div><!-- end box-icons2 -->
</section><!-- end get-start-area -->
<!--======================================
        END GET-START AREA
======================================-->

<!--======================================
        START REGISTER AREA
======================================-->
<section class="register-area register-area2 section-padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="register-heading">
                    <div class="section-heading">
                        <h5 class="section__meta">Institution Partnership Program</h5>
                        <h2 class="section__title">Become a parter with Bharat Elearn</h2>
                        <span class="section-divider"></span>
                        <p class="section__desc mb-2">
                            Education is the process of acquiring the body of knowledge and skills
                            that people are expected have in your society.
                            A education develops a critical thought process in addition to learning.
                            Bimply dummy text of the printing and typesetting istryrem
                            Ipsum has been the industry’s standard dummy text ever since the 1500s,
                            when an unknown printer.when an unknown printer
                            took a galley of type and scramble
                        </p>
                        <p class="section__desc">
                            tryrem Ipsum has been the industry’s standard dummy text ever since the 1500s,
                            when an unknown printer.
                        </p>
                    </div><!-- end section-heading -->
                    <div class="btn-box">
                        <a href="#" class="theme-btn">Know more</a>
                    </div>
                </div><!-- end register-heading -->
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="register-form">
                    <div class="contact-form-action">
                        <h3 class="widget-title">Institution Joining Form</h3>
                        <form method="post">
                            <div class="input-box">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" placeholder="Your Name">
                                    <span class="la la-user input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <div class="form-group">
                                    <input class="form-control" type="email" name="email" placeholder="Email Address">
                                    <span class="la la-envelope-o input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="phone" placeholder="Phone Number">
                                    <span class="la la-phone input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="input-box">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="subject" placeholder="Institution Name">
                                    <span class="la la-book input-icon"></span>
                                </div>
                            </div><!-- end input-box -->
                            <div class="btn-box">
                                <button class="theme-btn" type="submit">apply now</button>
                            </div><!-- end btn-box -->
                        </form>
                    </div><!-- end contact-form-action -->
                </div>
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end register-area -->
<!--======================================
        END REGISTER AREA
======================================-->





<div class="section-block"></div>



<!--======================================
        START SUBSCRIBER AREA
======================================-->
<section class="subscriber-area padding-top-80px padding-bottom-75px text-center">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading">
                    <h5 class="section__meta section__metalight">newsletter</h5>
                    <h2 class="section__title text-white">Subscribe our newsletter</h2>
                    <span class="section-divider section-divider-light"></span>
                    <p class="section__desc text-color-rgba">
                        There are many variations of passages of Lorem Ipsum available, but the majority <br>
                        have suffered alteration in some form
                    </p>
                </div><!-- end section-heading -->
            </div><!-- end col-lg-12 -->
            <div class="col-lg-6 mx-auto text-left">
                <div class="subscriber-form">
                    <div class="contact-form-action">
                        <form method="post">
                            <div class="input-box">
                                <label class="form-label text-white">Your email address</label>
                                <div class="form-group d-flex align-items-center">
                                    <input class="form-control" type="email" name="email" placeholder="Enter your email" required>
                                    <span class="la la-envelope-o input-icon"></span>
                                    <button class="theme-btn theme-btn-hover-light" type="submit">Subscribe</button>
                                </div>
                                <p class="text-color-rgba font-size-14 mt-1">
                                    <i class="la la-lock mr-1"></i>Your information is safe with us! unsubscribe anytime.
                                </p>
                            </div>
                        </form>
                    </div><!-- end contact-form-action -->
                </div><!-- end subscriber-form-->
            </div><!-- end col-lg-6 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end subscriber-area -->
<!--======================================
        END SUBSCRIBER AREA
======================================-->

@stop
@section('js') 
<script src="{{asset('public/js/particles.min.js')}}"></script>
<script src="{{asset('public/js/particlesRun2.js')}}"></script>
@stop