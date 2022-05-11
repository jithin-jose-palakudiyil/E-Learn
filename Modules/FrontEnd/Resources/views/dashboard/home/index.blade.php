@extends('frontend::dashboard.layouts.master') 
 
@section('content')

    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @include('frontend::dashboard.partials.breadcrumb', ['breadcrumbTitle' => "Dashboard"])
            <div class="row mt-5">
                <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-1 flex-shrink-0">
                            <i class="la la-mouse-pointer"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">Enrolled Exams</h4>
                            <span class="info__count">11</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-2 flex-shrink-0">
                            <i class="la la-file-text-o"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">Active Exams</h4>
                            <span class="info__count">5</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-4 -->
                <div class="col-lg-4 column-lmd-2-half column-md-2-full">
                    <div class="icon-box d-flex align-items-center">
                        <div class="icon-element icon-element-bg-3 flex-shrink-0">
                            <i class="la la-graduation-cap"></i>
                        </div><!-- end icon-element-->
                        <div class="info-content">
                            <h4 class="info__title mb-2">Completed Exams</h4>
                            <span class="info__count">6</span>
                        </div><!-- end info-content -->
                    </div>
                </div><!-- end col-lg-4 -->
               
                        </div><!-- end mess-dropdown -->
                    </div><!-- end dashboard-shared -->
                </div><!-- end col-lg-5 -->
           <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-content mt-0 pt-0 pb-4 border-top-0 text-center">
                        <div class="row">
                            <div class="col-lg-12">
                                <p class="copy__desc">&copy; 2020 Bharat Elearn. All Rights Reserved. by <a href="https://inventivhub.com">The Inventiv Hub</a></p>
                            </div><!-- end col-lg-12 -->
                        </div><!-- end row -->
                    </div><!-- end copyright-content -->
                </div><!-- end col-lg-12 -->
            </div>

@stop