@extends('frontend::layouts.master')
@section('content') 

<style>
    #otpField{
   letter-spacing: 25px;
   padding-left: 35px;
   position:relative;
   width:40%;
    margin:0 auto; 
    border: 1px solid #c5c5c5;
    font-weight: 600
}

#otpField:focus{
    border: 1px solid #51be78;
    cursor: none;
}

#otp-icon{
    position: absolute;
    left:62%
}

@media screen and (max-width: 1200px){
    #otpField{
        width:50%
    }

    #otp-icon{
        left:65%;
}

}

@media screen and (min-width: 767px) and (max-width: 992px){
    #otpField{
        width:40%;
        letter-spacing: 35px;
    }

    #otp-icon{
        left:65%;
}

}

@media screen and (min-width: 356px) and (max-width: 490px){
    #otpField{
        width: 75%;
        padding-left: 30px;
        letter-spacing: 31px;
    } 
    #otp-icon{
        left:78%;
}
}

@media screen and (max-width: 355px){
    #otpField{
        width:100%;
        letter-spacing: 35px
    } 
    #otp-icon{
        left:85%;
}
@media screen and (max-width: 320px){
    #otpField{
        letter-spacing: 25px;
        padding-left: 27px
    } 

}

</style>

<section class="sign-up section--padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 mx-auto">
                <div class="card-box-shared">
                    <div class="card-box-shared-title text-center">
                        <p class="text-muted mb-4 mt-3">Please enter the OTP sent to {{Auth::guard(user_guard)->user()->mobile}}.</p>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="contact-form-action">
                            <form action="{{route('otp_verification')}}" method="post" id="otp_form">
                                {!! csrf_field() !!}
                                <div class="row"> 
                                    <div class="col-lg-12 ">
                                        <div class="input-box">
                                             <div class="form-group">
                                                <input id='otpField' maxLength="4" class="form-control" type="text" name="otp" >
                                                <span id="otp-icon" class="la la-key input-icon"></span>
                                                
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-lg-12 " align="center">
                                        <div class="btn-box">
                                            <button class="theme-btn" type="submit">Verify</button>
                                        </div>
                                    </div><!-- end col-md-12 -->
                                   
                                </div><!-- end row -->
                            </form>
                        </div><!-- end contact-form -->
                          <div class="row mt-3" >
                                <div class="col-12 text-center"> 
                                    <p class="text-muted">Not received your code?  <span id="some_div"></span>
                                        <a style="display: none" id="ResendCode" href="javascript:void(0)" class="text-muted ml-1"><b class="font-weight-semibold">Resend code</b></a>
                                    </p>
                                    <div class="text-center" id="otp_message"></div>    
                                </div>  
                            </div>
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
 
@stop 

@section('js')   
<script src="{{asset('public/plugins/validation/validate.min.js')}}"></script>  
<script src="{{asset('public/js/page_v1/register.js')}}" type="text/javascript"></script>
@stop 
