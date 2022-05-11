@extends('frontend::layouts.master')
@section('content') 



<style>

.input-box{
    margin-bottom: 35px;
}

#passwordField{
    position: relative;
    backface-visibilty: hidden;
}

#passwordToggleIcon{
    position: absolute; 
    left: 89%;
    cursor: pointer;
}

@media screen and (max-width: 400px){
    #passwordToggleIcon{
    left: 78%;
} 

}

</style>

<!-- ================================
       START LOGIN AREA
================================= -->
<section class="login-area section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-title text-center">
                        <h3 class="widget-title font-size-25">Login to Your Account!</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form action="{{route('front_user_login_action')}}" method="post">
                                {!! csrf_field() !!}  
                           
                             

<!--                                <div class="row">
                                    <div class="col-lg-4 column-td-half">
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
                                    </div>
                                    
                                    -->
                                    <div class="col-lg-12">
                                        <div class="input-box">
                                            <label class="label-text">Email<span style="color: #F12222ED" class="ml-1">*</span></label>
                                            <div class="form-group">
                                                <input class="form-control" type="text" name="email" placeholder="Email address">
                                                <span class="la la-envelope input-icon"></span>
                                            @if($errors->has('email'))
                                                <label class="validation-error-label">{{ $errors->first('email') }}</label>
                                            @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div style="margin-bottom: 0" class="input-box">
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
                                    </div>
                                    <div class="container">
                                         <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="custom-checkbox d-flex justify-content-between">
                                                <input type="checkbox" id="chb1"  name="remember" >
                                                <label for="chb1">Remember Me</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="custom-checkbox d-flex justify-content-between">
                                                <input type="checkbox" id="chb1"  name="remember" >
                                                <a href="#" class="primary-color-2"> Forgot my password?</a>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    </div>
                                   
                                   
                                    <div class="col-lg-12 ">
                                        <div class="btn-box">
                                            <button class="theme-btn" type="submit">login account</button>
                                        </div>
                                    </div>
                                  @if($errors->has('invalid_login'))
                                            <br/><div class="validation-error-label text-center">{{ $errors->first('invalid_login') }}</div>
                                        @endif
                                    <div class="col-lg-12">
                                        <p class="mt-4">Don't have an account? <a href="{{URL('/register')}}" class="primary-color-2">Register</a></p>
                                    </div>
                           </form>
                                    <!-- end col-md-12 -->
                                </div><!-- end row -->
                           
                        </div><!-- end contact-form -->
                    </div>
                </div>
            </div><!-- end col-lg-7 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end login-area -->

@stop

@section('js')
<script src="{{asset('public/js/page_v1/togglePassword.js')}}" type="text/javascript"></script>
<script>
    localStorage.clear();
    if (sessionStorage.getItem("counter")) { sessionStorage.removeItem("counter"); }
</script>
@stop