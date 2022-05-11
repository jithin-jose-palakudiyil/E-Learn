@extends('frontend::layouts.master')
@section('content') 


<!-- ================================
    START CHECKOUT AREA
================================= -->
<section class="checkout-area padding-top-120px padding-bottom-70px">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Billing Details</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="user-form">
                            <div class="contact-form-action"> 
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">First Name<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="text" value="{{Auth::guard(user_guard)->user()->first_name}}" disabled="">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Last Name<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="text" value="{{Auth::guard(user_guard)->user()->last_name}}" disabled="">
                                                    <span class="la la-user input-icon"></span>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Your Email<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="text" value="{{Auth::guard(user_guard)->user()->email}}" disabled="">
                                                    <span class="la la-envelope input-icon"></span>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                        <div class="col-lg-6">
                                            <div class="input-box">
                                                <label class="label-text">Phone Number<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <input class="form-control" type="text" name="text" value="{{Auth::guard(user_guard)->user()->mobile}}" disabled="">
                                                    <span class="la la-phone input-icon"></span>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-6 -->
                                  
                                       
                                        <div class="col-lg-12">
                                            <div class="input-box">
                                                <label class="label-text">Address<span class="primary-color-2 ml-1">*</span></label>
                                                <div class="form-group">
                                                    <textarea class="form-control"  name="address" placeholder="Address" style="resize: none"></textarea>
                                                    <span class="la la-pencil input-icon"></span>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                                       
                                    </div> 
                            </div>
                        </div>
                    </div><!-- end card-box-shared-body -->
                </div><!-- end card-box-shared -->
               
            </div><!-- end col-lg-7 -->
            <div class="col-lg-5">
                <div class="card-box-shared">
                    <div class="card-box-shared-title">
                        <h3 class="widget-title font-size-18">Order Summary</h3>
                    </div>
                    <div class="card-box-shared-body">
                        <div class="Purchase-cart-content">
                            <ul class="list-items">
                             
                                <?php  
                                    $price =$package->price;
                                    if($package->is_offer == 1 && $package->offer_price):
                                        $price =$package->offer_price; 
                                    endif;
                                ?>
                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">Price:</span>
                                    <span class="primary-color-3">₹{{$price}}</span>
                                </li>
<!--                                <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                    <span class="primary-color">Coupon discounts:</span>
                                    <span class="primary-color-3">-$181.99</span>
                                </li>-->
                                <li class="d-flex align-items-center justify-content-between font-size-18 font-weight-bold">
                                    <span class="primary-color">Total:</span>
                                    <span class="primary-color-3">₹{{$price}}</span>
                                </li>
                            </ul>
                            <div class="btn-box mt-2">
                                <p class="font-size-14 mb-2 line-height-22">Bharat Elearn is required by law to collect applicable transaction taxes for purchases made in certain tax jurisdictions.</p>
                                <!--<p class="font-size-14 line-height-22 mb-2">By completing your purchase you agree to these <a href="#" class="primary-color-2">Terms of Service.</a></p>-->
                                   <div class="input-box">
                                                <div class="form-group">
                                                    <div class="custom-checkbox">
                                                        <input type="checkbox" id="chb1">
                                                        <label for="chb1">I agree to the <a href="#" class="primary-color-2">Terms of Service</a> and <a href="#" class="primary-color-2">Privacy Policy</a></label>
                                                    </div>
                                                </div>
                                              
                                                 
                                            </div>
                                <a href="#" class="theme-btn d-block text-center">Proceed</a>
                            </div>
                            <div class="col-lg-12" style="padding-top: 15px;">
                                            <div class="input-box">
                                              
                                                <div class="secure-connection">
                                                    <p class="d-flex align-items-center">
                                                        <i class="fa fa-lock font-size-30"></i>
                                                        <span class="ml-2">Secure Connection</span>
                                                    </p>
                                                    <p class="font-size-14">Your information is safe with us!</p>
                                                </div>
                                            </div>
                                        </div><!-- end col-lg-12 -->
                        </div>
                    </div><!-- end card-box-shared-body -->
                </div><!-- end card-box-shared -->
        
            </div><!-- end col-lg-5 -->
        </div><!-- end row -->
    </div><!-- end container -->
</section><!-- end checkout-area -->
<!-- ================================
    END CHECKOUT AREA
================================= -->

@stop

@section('css') 
@stop 

@section('js')   
<!--<script src="{{asset('public/plugins/validation/validate.min.js')}}"></script> 
<script src="{{asset('public/plugins/intlTelInput/intlTelInput.min.js')}}"></script>  
<script src="{{asset('public/js/page_v1/register.js')}}" type="text/javascript"></script>
<script src="{{asset('public/js/page_v1/togglePassword.js')}}" type="text/javascript"></script>-->
@stop 
