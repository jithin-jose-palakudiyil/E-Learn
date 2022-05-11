@extends('frontend::layouts.master')
@section('content') 


<style>

.input-box{
    margin-bottom: 35px;
}

#passwordField, #passwordConfirmField{
    position: relative;
    backface-visibilty: hidden;
}

#passwordToggleIcon, #passwordConfirmToggleIcon{
    position: absolute; 
    left: 92%;
    cursor: pointer;
}

@media screen and (max-width: 430px){
    #passwordToggleIcon, #passwordConfirmToggleIcon{
    left: 82%;
}  
}

</style>

<section class="sign-up section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-title text-center">
                        <h3 class="widget-title font-size-25">Create an Account and <br> Start Learning!</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form action="{{route('save_front_user_account')}}" method="post" id="register_form">
                                {!! csrf_field() !!}
                                <div class="row">
<!--                                    <div class="col-lg-4 column-td-half">
                                        <div class="form-group">
                                            <button class="theme-btn w-100" type="submit">
                                                <i class="fa fa-google mr-2"></i>Google
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 column-td-half">
                                        <div class="form-group">
                                            <button class="theme-btn w-100" type="submit">
                                                <i class="fa fa-facebook mr-2"></i>Facebook
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 column-td-half">
                                        <div class="form-group">
                                            <button class="theme-btn w-100" type="submit">
                                                <i class="fa fa-twitter mr-2"></i>Twitter
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="account-assist mt-3 margin-bottom-35px text-center">
                                            <p class="account__desc">or</p>
                                        </div>
                                    </div>-->
                                    <div class="col-lg-12 ">
                                        <div class="input-box">
                                            <label class="label-text">First Name<span style="color: #F12222ED" class="ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="first_name" placeholder="First name" value="{{old('first_name')}}">
                                                <span class="la la-user input-icon"></span>
                                                @if($errors->has('first_name'))
                                                    <label class="validation-error-label">{{ $errors->first('first_name') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12 ">
                                        <div class="input-box">
                                            <label class="label-text">Last Name</label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="last_name" placeholder="Last name" value="{{old('last_name')}}">
                                                <span class="la la-user input-icon"></span>
                                                @if($errors->has('last_name'))
                                                    <label class="validation-error-label">{{ $errors->first('last_name') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">Mobile<span style="color: #F12222ED" class="ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="mobile" id="mobile" placeholder="Mobile" value="{{old('mobile')}}">
                                                <!--<span class="la la-phone input-icon"></span>-->
                                                <div id="mob_error">
                                                    
                                                @if($errors->has('mobile'))
                                                    <label class="validation-error-label">{{ $errors->first('mobile') }}</label>
                                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">Email Address<span style="color: #F12222ED" class="ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="email" placeholder="Email address" value="{{old('email')}}">
                                                <span class="la la-envelope input-icon"></span>
                                                @if($errors->has('email'))
                                                    <label class="validation-error-label">{{ $errors->first('email') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">Password<span style="color: #F12222ED" class="ml-1">*</span></label>
                                            <div class="form-group">
                                                <input id="passwordField" class="form-control" type="password" name="password" placeholder="Password">
                                                <span class="la la-lock input-icon"></span>
                                                <span id="passwordToggleIcon" class="la la-eye input-icon"></span>
                                                @if($errors->has('password'))
                                                    <label class="validation-error-label">{{ $errors->first('password') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div style="margin-bottom: 0" class="input-box">
                                            <label class="label-text">Confirm Password<span style="color: #F12222ED" class="ml-1">*</span></label>
                                            <div class="form-group">
                                                <input id="passwordConfirmField" class="form-control" type="password" name="confirm_password" placeholder="Confirm password">
                                                <span class="la la-lock input-icon"></span>
                                                <span id="passwordConfirmToggleIcon" class="la la-eye input-icon"></span>
                                                @if($errors->has('confirm_password'))
                                                    <label class="validation-error-label">{{ $errors->first('confirm_password') }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" id="chb1" name="receiving_emails" value="1">
                                                <label for="chb1"><span class="line-height-24 d-block">Yes! I want to get the most out of Bharat Elearn by receiving emails with exclusive deals, personal recommendations and learning tips!</span></label>
                                            </div>
                                              <div class="custom-checkbox">
                                                  <input type="checkbox" id="chb2" name="is_agree" value="1">
                                                <label for="chb2">By signing up, you agree to our <a href="#">Terms of Use</a> and
                                                    <a href="#">Privacy Policy</a>.
                                                </label>
                                                <div id="is_agree_error">
                                                @if($errors->has('is_agree'))
                                                    <div class="validation-error-label">{{ $errors->first('is_agree') }}</div>
                                                @endif
                                                </div>
                                            </div>

                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12 ">
                                        <div class="btn-box">
                                            <button class="theme-btn" type="submit">register account</button>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                    <div class="col-lg-12">
                                        <p class="mt-4">Already have an account? <a href="{{URL('/login')}}" class="primary-color-2">Log in</a></p>
                                    </div><!-- end col-md-12 -->
                                </div><!-- end row -->
                            </form>
                        </div><!-- end contact-form -->
                    </div>
                </div>
            </div><!-- end col-md-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end sign-up -->
<!-- ================================
       START SIGN UP AREA
================================= -->

@stop

@section('css') 
<link href="{{asset('public/plugins/intlTelInput/intlTelInput.css')}}" rel="stylesheet" type="text/css">
 
<style> 
            .intl-tel-input { width: 100%; position: relative; display: block; }
            #mobile{padding-left: 74px; }
            
        </style>
<!--<link href="{{asset('public/student_assets/libs/custombox/custombox.min.css')}}" rel="stylesheet">-->
 @stop 

@section('js')   
<script src="{{asset('public/plugins/validation/validate.min.js')}}"></script> 
<script src="{{asset('public/plugins/intlTelInput/intlTelInput.min.js')}}"></script>  
<script src="{{asset('public/js/page_v1/register.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/page_v1/togglePassword.js')}}" type="text/javascript"></script>
@stop 
