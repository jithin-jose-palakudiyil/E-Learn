@extends('frontend::dashboard.layouts.master') 
 
@section('content')

     <div class="dashboard-content-wrap">
        <div class="container-fluid">
             @include('frontend::dashboard.partials.breadcrumb', ['breadcrumbTitle' => "Profile"])

            <div class="row mt-5">
                <div class="col-lg-8">
                    <div class="profile-detail pb-5">
                        <ul class="list-items">
                            <li><span class="profile-name">Registration Date:</span><span class="profile-desc">{{Carbon\Carbon::parse(Auth::guard(user_guard)->user()->created_at)->format('r')}}</span></li>
                            <li><span class="profile-name">First Name:</span><span class="profile-desc">{{Auth::guard(user_guard)->user()->first_name}}</span></li>
                            <li><span class="profile-name">Last Name:</span><span class="profile-desc">{{Auth::guard(user_guard)->user()->last_name}}</span></li>
                            <li><span class="profile-name">Email:</span><span class="profile-desc">{{Auth::guard(user_guard)->user()->email}}</span></li>
                            <li><span class="profile-name">Phone Number:</span><span class="profile-desc">{{Auth::guard(user_guard)->user()->mobile}}</span></li>
<!--                            <li>
                                <span class="profile-name">Bio:</span>
                                <span class="profile-desc">Hello! I am a Leo</span>
                            </li>-->
                        </ul>
                    </div>
                </div><!-- end col-lg-8 -->
            </div><!-- end row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-content mt-0 border-top-0 text-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="copy__desc">&copy; 2020 Bharat Elearn. All Rights Reserved. by <a href="https://inventivhub.com">The Inventiv Hub</a></p>
                            </div><!-- end col-lg-12 -->
                        </div><!-- end row -->
                    </div><!-- end copyright-content -->
                </div><!-- end col-lg-12 -->
            </div>
        </div><!-- end container-fluid -->
    </div><!-- end dashboard-content-wrap -->      
 
@stop