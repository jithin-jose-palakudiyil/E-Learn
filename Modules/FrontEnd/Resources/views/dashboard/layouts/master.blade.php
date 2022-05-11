@include('frontend::dashboard.layouts.header') 
<!-- ================================
    START DASHBOARD AREA
================================= -->
<section class="dashboard-area">
    <div class="dashboard-sidebar">
        <div class="dashboard-nav-trigger">
            <div class="dashboard-nav-trigger-btn">
                <i class="la la-bars"></i> Dashboard Nav
            </div>
        </div>
        <div class="dashboard-nav-container">
            <div class="humburger-menu">
                <div class="humburger-menu-lines side-menu-close"></div><!-- end humburger-menu-lines -->
            </div><!-- end humburger-menu -->
            <div class="side-menu-wrap">
                <ul class="side-menu-ul">
                    <li class="sidenav__item <?php if(isset($page_active) && $page_active =='dashboard'): echo 'page-active'; endif; ?>"><a href="{{route('user_dashboard')}}"><i class="la la-dashboard"></i> Dashboard</a></li>
                    <li class="sidenav__item <?php if(isset($page_active) && $page_active =='profile'): echo 'page-active'; endif; ?>"><a href="{{route('user_profile')}}"><i class="la la-user"></i>My Profile</a></li>
<!--                     <li class="sidenav__item"><a href="student-quiz.html"><i class="la la-graduation-cap"></i>Start Test</a></li>
                    <li class="sidenav__item"><a href="dashboard-quiz.html"><i class="la la-user"></i>Exam Marks</a></li>
                    <li class="sidenav__item"><a href="dashboard-enrolled-courses.html"><i class="la la-graduation-cap"></i>Enrolled Exams</a></li>
                    <li class="sidenav__item"><a href="dashboard-purchase-history.html"><i class="la la-Purchase-cart"></i>Purchase History</a></li>-->
                 
                    <li class="sidenav__item <?php if(isset($page_active) && $page_active =='settings'): echo 'page-active'; endif; ?>"><a href="{{route('user_settings')}}"><i class="la la-cog"></i>Settings</a></li>
<!--                    <li class="sidenav__item"><a href="index.html"><i class="la la-power-off"></i> Logout</a></li>
                    <li class="sidenav__item"><a href="javascript:void(0)" data-toggle="modal" data-target=".account-delete-modal" ><i class="la la-trash"></i> Delete Account</a></li>-->
                </ul>
            </div><!-- end side-menu-wrap -->
        </div>
    </div><!-- end dashboard-sidebar -->
    
@yield('content')
 
            
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->
</section><!-- end dashboard-area -->
<!-- ================================
    END DASHBOARD AREA
================================= -->
@include('frontend::dashboard.layouts.footer')
 

 
