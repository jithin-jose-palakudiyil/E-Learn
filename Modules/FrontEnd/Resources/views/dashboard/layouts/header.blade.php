<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="author" content="TechyDevs">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title><?php  if (isset($page_title)){ echo $page_title; }else{ echo 'Bharat Elearn - Test yourself';}  ?></title>

    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Mukta:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Favicon -->
    <link rel="icon" sizes="16x16" href="images/favicon.png">

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('public/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/line-awesome.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/animate.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/owl.theme.default.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/fancybox.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/jquery.filer.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/tooltipster.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/jqvmap.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <!-- end inject -->
    
    <!-- custom stylesheets -->
    @yield('css') 
    <!-- /custom stylesheets -->

    <!-- custom style -->
    @stack('style')
    <!-- custom style -->

    <script src="{{asset('public/js/jquery-3.4.1.min.js')}}"></script>

    <!-- custom js top -->
     @yield('js_top') 
    <!-- /custom js top -->


    <script type="application/javascript">
        var base_url = "{{url('/')}}"; 
    </script>
        
</head>
<body>

<!-- start cssload-loader -->
<div class="preloader">
    <div class="loader">
        <svg class="spinner" viewBox="0 0 50 50">
            <circle class="path" cx="25" cy="25" r="20" fill="none" stroke-width="5"></circle>
        </svg>
    </div>
</div>
<!-- end cssload-loader -->

<!--======================================
        START HEADER AREA
    ======================================-->
<header class="header-menu-area dashboard-header">
    <div class="header-menu-content dashboard-menu-content">
        <div class="container-fluid">
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{route('user_dashboard')}}" class="logo"><img src="{{asset('public/images/sample/logo.png')}}" alt="logo"></a>
                            <div class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div>
                        </div>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            
<!--                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="index.html">Home</a>
                                        
                                    </li>
                                    <li>
                                        <a href="#">Exams</a>
                                        <ul class="dropdown-menu-item">
                                            <li>
                                                <a href="course-grid.html">JAIIB <i class="la la-angle-right"></i></a>
                                                
                                            </li>
                                            <li>
                                                <a href="course-grid.html">CAIIB <i class="la la-angle-right"></i></a>
                                                
                                            </li>
                                            <li>
                                                <a href="course-grid.html">SPECIFIED PERSON<i class="la la-angle-right"></i></a>
                                                
                                            </li>
                                            <li>
                                                <a href="course-grid.html">IBPS CLERK<i class="la la-angle-right"></i></a>
                                               
                                            </li>
                                            <li>
                                                <a href="course-grid.html">IBPS OFFICER<i class="la la-angle-right"></i></a>
                                              
                                            </li>
                                           
                                        </ul>
                                    </li>
                                   
                                    <li>
                                        <a href="pricing-table.html">Packages</a>
                                      
                                    </li>
                                    <li>
                                        <a href="faq.html">faq</a>
                                        
                                    </li>
                                    <li>
                                        <a href="blog-grid.html">blog</a>
                                        
                                    </li>
                                    <li><a href="contact.html">support</a></li>
                                </ul> end ul 
                            </nav> -->
                            <div class="logo-right-button d-flex align-items-center">
                                <div class="header-action-button d-flex align-items-center">
                                   
                                       <div class="user-action-wrap">
                                        <div class="notification-item user-action-item">
                                            <div class="dropdown">
                                                  <?php 
                                    $profile_img = 'public/images/sample/team11.jpg';   
                                    if(Auth::guard(user_guard)->user()->profile_image != null):
                                        $path = 'public/uploads/students/'.Auth::guard(user_guard)->user()->id.'/'.Auth::guard(user_guard)->user()->profile_image; 
                                        if(File::exists($path)): 
                                            $profile_img = $path;    
                                        endif;     
                                    endif;
                                ?>
                                                <button class="notification-btn dot-status online-status dropdown-toggle" type="button" id="userDropdownMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <img src="{{asset($profile_img)}}" alt="{{Auth::guard(user_guard)->user()->first_name}} {{Auth::guard(user_guard)->user()->last_name}}">
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="userDropdownMenu">
                                                    <div class="mess-dropdown">
                                                        <div class="mess__title d-flex align-items-center">
                                                            <div class="image">
                                                                <a href="#">
                                                                    <img src="{{asset($profile_img)}}" alt="{{Auth::guard(user_guard)->user()->first_name}} {{Auth::guard(user_guard)->user()->last_name}}">
                                                                </a>
                                                            </div>
                                                            <div class="content">
                                                                <h4 class="widget-title font-size-16">
                                                                    <a href="#" class="text-white">
                                                                        Leo
                                                                    </a>
                                                                </h4>
                                                                <span class="email">{{Auth::guard(user_guard)->user()->email}}</span>
                                                            </div>
                                                        </div><!-- end mess__title -->
                                                        <div class="mess__body">
                                                            <ul class="list-items">
<!--                                                                <li class="mb-0">
                                                                    <a href="my-Exams.html" class="d-block">
                                                                        <i class="la la-file-video-o"></i> My Exams
                                                                    </a>
                                                                </li>
                                                                <li class="mb-0">
                                                                    <a href="Purchase-cart.html" class="d-block">
                                                                        <i class="la la-Purchase-cart"></i> My cart
                                                                    </a>
                                                                </li>-->
<!--                                                                <li class="mb-0">
                                                                    <a href="my-Exams.html" class="d-block">
                                                                        <i class="la la-bookmark"></i> My wishlist
                                                                    </a>
                                                                </li>-->
<!--                                                                <li class="mb-0">
                                                                    <div class="section-block mt-2 mb-2"></div>
                                                                </li>-->
                                                               
                                                               
<!--                                                                <li class="mb-0">
                                                                    <a href="dashboard-settings.html" class="d-block">
                                                                        <i class="la la-gear"></i> Settings
                                                                    </a>
                                                                </li>-->
<!--                                                                <li class="mb-0">
                                                                    <a href="dashboard-purchase-history.html" class="d-block">
                                                                        <i class="la la-cart-plus"></i> Purchase history
                                                                    </a>
                                                                </li>-->
<!--                                                                <li class="mb-0">
                                                                    <div class="section-block mt-2 mb-2"></div>
                                                                </li>-->
                                                              
<!--                                                                <li class="mb-0">
                                                                    <a href="dashboard-settings.html" class="d-block">
                                                                        <i class="la la-edit"></i> Edit Profile
                                                                    </a>
                                                                </li>-->
<!--                                                                <li class="mb-0">
                                                                    <div class="section-block mt-2 mb-2"></div>
                                                                </li>-->
<!--                                                                <li class="mb-0">
                                                                    <a href="#" class="d-block">
                                                                        <i class="la la-question"></i> Help
                                                                    </a>
                                                                </li>-->
                                                                <li class="mb-0">
                                                                    <a href="{{route('front_user_logout')}}" class="d-block">
                                                                        <i class="la la-power-off"></i> Logout
                                                                    </a>
                                                                </li>
                                                                <li class="mb-0">
                                                                    <div class="section-block mt-2 mb-2"></div>
                                                                </li>
                                                                <li>
                                                                    <div class="business-content">
                                                                        <a href="#">
                                                                            <span class="widget-title font-size-18 d-block">Upgrade Package</span>
                                                                            <span class="line-height-24 d-block primary-color-3 font-size-14">Unlock all the feature</span>
                                                                        </a>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div><!-- end mess__body -->
                                                    </div><!-- end mess-dropdown -->
                                                </div><!-- end dropdown-menu -->
                                            </div><!-- end dropdown -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end logo-right-button -->
                            <div class="user-nav-container">
                                <div class="humburger-menu">
                                    <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
                                </div><!-- end humburger-menu -->
                             
                               
                            </div>
                        </div><!-- end menu-wrapper -->
                    </div><!-- end col-lg-10 -->
                </div><!-- end row -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end header-menu-content -->
</header><!-- end header-menu-area -->
<!--======================================
        END HEADER AREA
======================================-->
