@extends('frontend::dashboard.layouts.master') 
 
@section('content')

    <div class="dashboard-content-wrap">
        <div class="container-fluid">
            @include('frontend::dashboard.partials.breadcrumb', ['breadcrumbTitle' => "Settings"])
            <!--<div class="row">-->
<!--                <div class="col-lg-12">
                    <div class="breadcrumb-content dashboard-bread-content d-flex align-items-center justify-content-between">
                        <div class="user-bread-content d-flex align-items-center">
                            <div class="bread-img-wrap">
                                <img src="{{asset('public/images/sample/team9.jpg')}}" alt="">
                            </div>
                            <div class="section-heading">
                          <div class="section-heading">
                                <h2 class="section__title font-size-30">Hello, {{Auth::guard(user_guard)->user()->first_name}} {{Auth::guard(user_guard)->user()->last_name}}</h2></h2>
                              
                            </div>
                        </div>
                      
                    </div>
                </div> end col-lg-12 
            </div> end row 
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="section-block"></div>
                </div>
            </div>
         -->
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="card-box-shared">
                        @if(Session::has('flash-success-message'))
                        <div class="alert bg-success text-white alert-styled-left alert-dismissible" style="background-color: #009688 !important;">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Well done!</span> {!! Session::get('flash-success-message')!!}
                        </div> 
                        @endif

                        @if(Session::has('flash-error-message')) 
                        <div class="alert bg-danger text-white alert-styled-left alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert"><span>×</span></button>
                            <span class="font-weight-semibold">Oh snap!</span> {!! Session::get('flash-error-message') !!}.
                        </div>
                        @endif
                        <div class="card-box-shared-body">
                            <div class="section-tab section-tab-2">
                                <ul class="nav nav-tabs" role="tablist" id="review">
                                    <li role="presentation">
                                        <a href="#profile" role="tab" data-toggle="tab" class="active" aria-selected="true">
                                            Profile
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#password" role="tab" data-toggle="tab" aria-selected="false">
                                             Password
                                        </a>
                                    </li>
<!--                                    <li role="presentation">
                                        <a href="#change-email" role="tab" data-toggle="tab" aria-selected="false">
                                            Change Email
                                        </a>
                                    </li>
                                  
                                    <li role="presentation">
                                        <a href="#account" role="tab" data-toggle="tab" aria-selected="false">
                                            Account
                                        </a>
                                    </li>-->
                                </ul>
                            </div>
                            <div class="dashboard-tab-content mt-5">
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade active show" id="profile">
                                        
                                        <form action="{{route('save_settings')}}" method="post" enctype="multipart/form-data"> 
                                            {!! csrf_field() !!}
                                            <div class="user-form">
                                                <div class="user-profile-action-wrap mb-5">
                                                    <h3 class="widget-title font-size-18 padding-bottom-40px">Profile Settings</h3>
                                                    <div class="user-profile-action d-flex align-items-center">
                                                        <div class="user-pro-img">
                                                            <?php 
                                                                $profile_img = 'public/images/sample/team11.jpg';   
                                                                if(Auth::guard(user_guard)->user()->profile_image != null):
                                                                    $path = 'public/uploads/students/'.Auth::guard(user_guard)->user()->id.'/'.Auth::guard(user_guard)->user()->profile_image; 
                                                                    if(File::exists($path)): 
                                                                        $profile_img = $path;    
                                                                    endif;     
                                                                endif;
                                                            ?>
                                    
                                                            <img src="{{asset($profile_img)}}" alt="user-image" class="img-fluid radius-round border">
                                                        </div>
                                                        <div class="upload-btn-box course-photo-btn">

                                                                <input type="file" name="profile_image" class="filer_input">

                                                            <p>
<!--                                                                Max file size is 5MB  And-->
                                                                Suitable files are .jpg, .png &amp; .jpeg</p>
                                                            @if($errors->has('profile_image'))
                                                               <label class="validation-error-label">{{ $errors->first('profile_image') }}</label>
                                                            @endif
                                                            <!--<button class="theme-btn mt-3" type="button">Remove Photo</button>-->
                                                        </div>
                                                    </div><!-- end user-profile-action -->
                                                </div><!-- end user-profile-action-wrap -->
                                                <div class="contact-form-action"> 
                                                    <div class="row">
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">First Name<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="first_name" value="{{Auth::guard(user_guard)->user()->first_name ? Auth::guard(user_guard)->user()->first_name:old('first_name')}}">
                                                                    <span class="la la-user input-icon"></span>
                                                                    @if($errors->has('first_name'))
                                                                        <label class="validation-error-label">{{ $errors->first('first_name') }}</label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Last Name<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="last_name" value="{{Auth::guard(user_guard)->user()->last_name ? Auth::guard(user_guard)->user()->last_name:old('last_name')}}">
                                                                    <span class="la la-user input-icon"></span>
                                                                    @if($errors->has('last_name'))
                                                                        <label class="validation-error-label">{{ $errors->first('last_name') }}</label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 --> 
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Email Address<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text"  disabled="" value="{{Auth::guard(user_guard)->user()->email}}">
                                                                    <span class="la la-envelope input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Phone Number<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" disabled="" value="{{Auth::guard(user_guard)->user()->mobile}}" >
                                                                    <span class="la la-phone input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-6 -->
                                                        <div class="col-lg-12">
                                                            <div class="input-box">
                                                                <label class="label-text">Bio</label>
                                                                <div class="form-group">
                                                                    <textarea class="message-control form-control" name="bio">{{Auth::guard(user_guard)->user()->bio}}</textarea>
                                                                    <span class="la la-pencil input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">save changes</button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row --> 
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- end tab-pane-->
                                    
                                    <div role="tabpanel" class="tab-pane fade" id="password">
                                        <div class="user-form padding-bottom-60px">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18 padding-bottom-40px">Change Password</h3>
                                            </div><!-- end user-profile-action-wrap -->
                                            <div class="contact-form-action">
                                                <form action="{{route('change_settings_password')}}" method="post" enctype="multipart/form-data"> 
                                                    {!! csrf_field() !!}
                                                    <div class="row"> 
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">New Password<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="password" placeholder="New password">
                                                                    <span class="la la-lock input-icon"></span>
                                                                    @if($errors->has('password'))
                                                                        <label class="validation-error-label">{{ $errors->first('password') }}</label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Confirm New Password<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="confirm_password" placeholder="Confirm new password">
                                                                    <span class="la la-lock input-icon"></span>
                                                                    @if($errors->has('confirm_password'))
                                                                        <label class="validation-error-label">{{ $errors->first('confirm_password') }}</label>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div><!-- end col-lg-4 -->
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">Change password</button>
                                                            </div>
                                                        </div><!-- end col-lg-12 -->
                                                    </div><!-- end row -->
                                                </form>
                                            </div>
                                        </div>
<!--                                        <div class="section-block"></div>
                                        <div class="user-form padding-top-60px">
                                            <div class="user-profile-action-wrap padding-bottom-20px">
                                                <h3 class="widget-title font-size-18 padding-bottom-10px">Forgot Password then Recover Password</h3>
                                                <p class="line-height-26">Enter the email of your account to reset password. Then you will receive a link to email
                                                    <br> to reset the password.If you have any issue about reset password <a href="#" class="primary-color-2">contact us</a></p>
                                            </div> end user-profile-action-wrap 
                                            <div class="contact-form-action">
                                                <form method="post">
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="input-box">
                                                                <label class="label-text">Email Address<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" placeholder="Enter email address">
                                                                    <span class="la la-lock input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-6 
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">recover password</button>
                                                            </div>
                                                        </div> end col-lg-12 
                                                    </div> end row 
                                                </form>
                                            </div>
                                        </div>-->
                                        
                                    </div><!-- end tab-pane-->
                                    
<!--                                    <div role="tabpanel" class="tab-pane fade" id="change-email">
                                        <div class="user-form">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18 padding-bottom-40px">Change email</h3>
                                            </div> end user-profile-action-wrap 
                                            <div class="contact-form-action">
                                                <form method="post">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">Old Email<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" placeholder="Old email">
                                                                    <span class="la la-envelope input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-4 
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">New Email<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" placeholder="New email">
                                                                    <span class="la la-envelope input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-4 
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">Confirm New Email<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" placeholder="Confirm new email">
                                                                    <span class="la la-envelope input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-4 
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">save changes</button>
                                                            </div>
                                                        </div> end col-lg-12 
                                                    </div> end row 
                                                </form>
                                            </div>
                                        </div>
                                    </div> end tab-pane
                                    <div role="tabpanel" class="tab-pane fade" id="withdraw">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">Select a Withdraw Method</h3>
                                        </div> end user-profile-action-wrap 
                                        <div class="withdraw-method-wrap">
                                            <div class="row">
                                                <div class="col-lg-2 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="radio-1" class="radio-trigger">
                                                            <input type="radio" id="radio-1" name="radio">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                Bank Transfer
                                                                <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div> end col-lg-2 
                                                 <div class="col-lg-2 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="radio-2" class="radio-trigger">
                                                            <input type="radio" id="radio-2" name="radio">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                E-Check
                                                                <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div> end col-lg-2 
                                                <div class="col-lg-2 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="radio-3" class="radio-trigger">
                                                            <input type="radio" id="radio-3" name="radio">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                Payoneer
                                                                <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div> end col-lg-2 
                                                <div class="col-lg-2 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="radio-4" class="radio-trigger">
                                                            <input type="radio" id="radio-4" name="radio">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                PayPal
                                                                <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div> end col-lg-2 
                                                 <div class="col-lg-2 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="radio-5" class="radio-trigger">
                                                            <input type="radio" id="radio-5" name="radio">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                Skrill
                                                                <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div> end col-lg-2 
                                                <div class="col-lg-2 column-td-half">
                                                    <div class="payment-option">
                                                        <label for="radio-6" class="radio-trigger">
                                                            <input type="radio" id="radio-6" name="radio">
                                                            <span class="checkmark"></span>
                                                            <span class="widget-title font-size-18">
                                                                Stripe
                                                                <span class="d-block primary-color-3 font-weight-medium font-size-13 line-height-18">Min withdraw $50.00</span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                </div> end col-lg-2 
                                            </div> end row 
                                        </div>
                                        <div class="user-form padding-top-50px">
                                            <div class="user-profile-action-wrap">
                                                <h3 class="widget-title font-size-18 padding-bottom-40px">Account info</h3>
                                            </div> end user-profile-action-wrap 
                                            <div class="contact-form-action">
                                                <form method="post">
                                                    <div class="row">
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">Account Name<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" value="Leo">
                                                                    <span class="la la-user input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-4 
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">Account Number<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" value="3275476222500">
                                                                    <span class="la la-pencil input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-4 
                                                        <div class="col-lg-4 col-sm-4">
                                                            <div class="input-box">
                                                                <label class="label-text">Bank Name<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" value="South State Bank">
                                                                    <span class="la la-bank input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-4 
                                                         <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">IBAN<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" value="3030">
                                                                    <span class="la la-pencil input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-6 
                                                         <div class="col-lg-6 col-sm-6">
                                                            <div class="input-box">
                                                                <label class="label-text">BIC/SWIFT<span class="primary-color-2 ml-1">*</span></label>
                                                                <div class="form-group">
                                                                    <input class="form-control" type="text" name="text" value="CDDHDBBL">
                                                                    <span class="la la-pencil input-icon"></span>
                                                                </div>
                                                            </div>
                                                        </div> end col-lg-6 
                                                        <div class="col-lg-12">
                                                            <div class="btn-box">
                                                                <button class="theme-btn" type="submit">save withdraw account</button>
                                                            </div>
                                                        </div> end col-lg-12 
                                                    </div> end row 
                                                </form>
                                            </div>
                                        </div>
                                    </div> end tab-pane
                                    <div role="tabpanel" class="tab-pane fade" id="account">
                                        <div class="user-profile-action-wrap">
                                            <h3 class="widget-title font-size-18 padding-bottom-40px">My Account</h3>
                                        </div> end user-profile-action-wrap 
                                       <div class="user-account-wrap padding-bottom-40px">
                                           <div class="row">
                                               <div class="col-lg-4">
                                                   <div class="deactivate-account d-flex align-items-center">
                                                       <div class="payment-option">
                                                           <label for="radio-7" class="radio-trigger mb-0">
                                                               <input type="radio" id="radio-7" name="radio">
                                                               <span class="checkmark"></span>
                                                               <span class="widget-title font-size-18">Deactivate Account</span>
                                                           </label>
                                                       </div>
                                                       <div class="btn-box ml-3">
                                                           <button class="theme-btn line-height-40 font-size-14">Deactivate</button>
                                                       </div>
                                                   </div>
                                               </div>
                                           </div>
                                       </div>
                                        <div class="section-block"></div>
                                        <div class="user-profile-action-wrap padding-top-40px">
                                            <div class="delete-account-wrap">
                                                <h3 class="widget-title font-size-18 pb-2 text-danger">Delete Account Permanently</h3>
                                                <p><span class="text-warning">Warning:</span> Once you delete your account, there is no going back. Please be certain.</p>
                                                <div class="btn-box mt-4">
                                                    <button class="theme-btn line-height-40 font-size-14" data-toggle="modal" data-target=".account-delete-modal">Delete My Account</button>
                                                </div>
                                            </div>
                                        </div> end user-profile-action-wrap 
                                    </div> end tab-pane-->
                                </div><!-- end tab-content -->
                            </div><!-- end dashboard-tab-content -->
                        </div>
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
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
        </div><!-- end container-fluid -->
        </div>
    <!--</div>-->
 
@stop