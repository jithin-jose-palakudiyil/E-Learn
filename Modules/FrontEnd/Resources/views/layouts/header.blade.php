<!DOCTYPE html>
<html style="overflow-x: hidden; padding: 0px; margin: 0px; height: 100%; width: 100%;" lang="en">
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
    <link rel="stylesheet" href="{{asset('public/css/tooltipster.bundle.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/style.css')}}">
    <link rel="stylesheet" href="{{asset('public/css/nice-select.css')}}">
    <!-- end inject -->
    
        <!-- custom stylesheets -->
        @yield('css') 
        <!-- /custom stylesheets -->
        
        <!-- custom style -->
        @stack('style')
        <!-- custom style -->
        
        <script src="{{asset('public/js/jquery-3.4.1.min.js')}}"></script>
        
        <!-- custom js top -->
         @yield('jstop') 
        <!-- /custom js top -->
        
        
        <script type="application/javascript">
            var base_url = "{{url('/')}}"; 
        </script>
        
</head>
<body style="overflow-x: hidden; padding: 0px; margin: 0px; height: 100%; width: 100%;">

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
<header class="header-menu-area">
    <?php if(!isset($headertop_disable)):  ?> 
    <div class="header-top">
        <div class="container-fluid">
            
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="header-widget">
                        <ul class="header-action-list">
                            <li><a href="#"><span class="la la-phone mr-2"></span>123-456-789</a> </li>
                            <li><a href="#"><span class="la la-envelope-o mr-2"></span>contact@bharatelearn.com</a></li>
                        </ul>
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
                <div class="col-lg-6">
                    <div class="header-widget d-flex align-items-center justify-content-end">
                        <div class="header-right-info">
                            <ul class="header-social-profile">
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div><!-- end header-right-info -->
<!--                        <div class="header-right-info">
                            <div class="shop-cart">
                                <ul>
                                    <li>
                                        <p class="shop-cart-btn d-flex align-items-center">
                                            <i class="la la-Purchase-cart"></i>
                                            <span class="product-count ml-1">2</span>
                                        </p>
                                        <ul class="cart-dropdown-menu">
                                            <li>
                                                <a href="" class="cart-link">
                                                    <img src="{{asset('public/images/sample/small-img.jpg')}}" alt="product">
                                                </a>
                                                <p class="cart-info">
                                                    <a href="">
                                                        JAIIB TEST
                                                    </a>
                                                    <span class="cart__author">Bharat elearn</span>
                                                    <span class="cart__price">
                                                           ₹349 <span class="before-price">₹549</span>
                                                        </span>
                                                </p>
                                            </li>
                                            <li>
                                                <a href="" class="cart-link">
                                                    <img src="{{asset('public/images/sample/small-img.jpg')}}" alt="product">
                                                </a>
                                                <p class="cart-info">
                                                    <a href="">
                                                        JAIIB TEST
                                                    </a>
                                                    <span class="cart__author">Bharat elearn</span>
                                                    <span class="cart__price">
                                                           ₹349 <span class="before-price">₹549</span>
                                                    </span>
                                                </p>
                                            </li>
                                            <li>
                                                <p class="cart-total">Total: ₹698<span class="before-price">₹1098.00</span></p>
                                            </li>
                                            <li>
                                                <a class="theme-btn w-100 text-center" href="">go to Cart</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div> end shop-cart 
                        </div>-->
                        <!-- end header-right-info -->
                        <div class="header-right-info">
                            <ul class="header-action-list">
                                <li><a href="{{URL('/login')}}">Login</a></li>
                                <li>or</li>
                                <li><a href="{{URL('/register')}}">Register</a></li>
                            </ul>
                        </div><!-- end header-right-info -->
                    </div><!-- end header-widget -->
                </div><!-- end col-lg-6 -->
            </div>
            
            <!-- end row -->
        </div><!-- end container-fluid -->
    </div>
    <!-- end header-top -->
      <?php endif; ?>
    
    <div class="header-menu-content">
        <div style="position: relative" class="container-fluid">
        <div style="position: absolute; right: 29px; top: 36px;" class="menu-toggler">
                                <i class="la la-bars"></i>
                                <i class="la la-times"></i>
                            </div>
            <div class="main-menu-content">
                <div class="row align-items-center">
                    <div class="col-lg-2">
                        <div class="logo-box">
                            <a href="{{URL('/')}}" class="logo"><img src="{{asset('public/images/sample/logo.png')}}" alt="logo"></a>
                        </div>
                    </div><!-- end col-lg-2 -->
                    <div class="col-lg-10">
                        <div class="menu-wrapper">
                            
<!--                            <div class="contact-form-action">
                                <form method="post">
                                    <div class="input-box">
                                        <div class="form-group">
                                            <input class="form-control" type="text" name="search" placeholder="Search for anything">
                                            <span class="la la-search search-icon"></span>
                                        </div>
                                    </div> end input-box 
                                </form>
                            </div>-->
                            <!-- end contact-form-action -->
                            <nav class="main-menu">
                                <ul>
                                    <li>
                                        <a href="{{URL('/')}}">Home</a>
                                        
                                    </li>
                                    <li>
                                        <a href="#">Exams</a>
                                        <ul class="dropdown-menu-item">
                                            <li>
                                                <a href="">JAIIB <i class="la la-angle-right"></i></a>
                                                
                                            </li>
                                            <li>
                                                <a href="">CAIIB <i class="la la-angle-right"></i></a>
                                                
                                            </li>
                                            <li>
                                                <a href="">SPECIFIED PERSON<i class="la la-angle-right"></i></a>
                                                
                                            </li>
                                            <li>
                                                <a href="">IBPS CLERK<i class="la la-angle-right"></i></a>
                                               
                                            </li>
                                            <li>
                                                <a href="">IBPS OFFICER<i class="la la-angle-right"></i></a>
                                              
                                            </li>
                                           
                                        </ul>
                                    </li>
                                   
                                    <li>
                                        <a href="">Packages</a>
                                      
                                    </li>
                                    <li>
                                        <a href="">faq</a>
                                        
                                    </li>
                                    <li>
                                        <a href="">blog</a>
                                        
                                    </li>
                                    <li><a href="">support</a></li>

                                    <li><a href="">support</a></li>
                                </ul><!-- end ul -->
                            </nav><!-- end main-menu -->
                            <div class="logo-right-button">
                                <a href="{{URL('/login')}}" class="theme-btn">Lets Start</a>
                            </div><!-- end logo-right-button -->
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


