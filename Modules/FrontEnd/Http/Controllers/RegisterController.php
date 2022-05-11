<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\FrontEnd\Http\Requests\RegisterRequest;
use \Modules\FrontEnd\Entities\Users;
use \Exception; use \Auth;
use App\Helpers\SmsHelper as sms;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title = '  Elearn - Create Your Account';
        return view('frontend::register.index', compact('page_title'));
         
    }

      

    
       /**
     * Check this email id is already exists.
     * @param int Request
     * @return Response
     */
    public function ValidateEmail(Request $request)
    {
        if($request->ajax() && $request->exists('email')): 
            $email = \Modules\FrontEnd\Entities\Users::select('email')->where('email', $request->email)->first();
            if($email):
                return response()->json(['status'=>false,'error' => 'This email address is already exists.'], 200);
            else:
                return response()->json(['status'=>true], 200);
            endif;  
        else:   return response()->json(['message' => 'Not Found.'], 404); endif; 
    }
    
    /**
     * Check this Mobile id is already exists.
     * @param int Request
     * @return Response
     */
    public function ValidateMobile(Request $request)
    {
        if($request->ajax() && $request->exists('mobile')): 
           
            $mobile = str_replace(' ', '',  $request->mobile); 
            $mobile_v = \Modules\FrontEnd\Entities\Users::select('mobile')->where('mobile', $mobile)->first();
           
            if($mobile_v):
                return response()->json(['status'=>false,'error' => 'This mobile number is already exists.'], 200);
            else:
                return response()->json(['status'=>true], 200);
            endif;  
        else:   return response()->json(['message' => 'Not Found.'], 404); endif; 
    }
    
     /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(RegisterRequest $request)
    {
//       dd($request->all());
        $error = null;
        try
        {
            $student_array = [
                                'first_name'    =>  $request->first_name, 
                                'mobile'        =>  str_replace(' ', '',  $request->mobile), 
                                'email'         =>  $request->email, 
                                'password'      =>  bcrypt($request->password),
                                'is_agree'      =>  $request->is_agree,  
                            ]; 
            if($request->exists('last_name')): $student_array['last_name']=$request->last_name;  endif;
            if($request->exists('receiving_emails')): $student_array['receiving_emails']=$request->receiving_emails; endif;
            $user = Users::create($student_array); // create user
            if($user):  
                \Auth::guard(user_guard)->attempt(['email' => $request->email, 'password' => $request->password]); // make user logged in
                $otp = rand(1000, 9999);  
                $sms    =  sms::getlead_otp_sms(Auth::guard(user_guard)->user()->mobile,$otp);
                if($sms): 
                   $array =['otp' =>$otp ,'otp_created_at' => \Illuminate\Support\Carbon::now()];
                   Users::find(Auth::guard(user_guard)->user()->id)->update($array);  //update db 
                endif;  
            else: $error = 'sorry registration not completed. please try again later'; endif;
              
        } catch (Exception $ex) {
//            $error= $ex->getMessage(); 
         $error ='Sorry something went wrong. Please try again later';   
        }
        
        if($error == null): 
            if($request->session()->has('user_package')): 
                $user_package = $request->session()->pull('user_package'); 
                $request->session()->forget('user_package'); 
                return \Redirect::route('package_purchase',\Crypt::encryptString($user_package->id));
            endif; 
            return redirect()->route('register_otp'); 
        else:
            $request->session()->flash('flash-register-error',$error); // redirect back   
            return \Redirect::back(); 
        endif; 
        
    }

    
    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function register_otp()
    {
        $page_title = '  Elearn - Enter OTP';
        return view('frontend::register.otp', compact('page_title'));  
    }

    
    
       
     /**
     * Check this email id is already exists.
     * @param int Request
     * @return Response
     */
    public function otp_resend()
    {
        if(\Request::ajax() ):  
            $otp = rand(1000, 9999); 
            $sms    =  sms::getlead_otp_sms(Auth::guard(user_guard)->user()->mobile,$otp); 
            if($sms): 
               $array =['otp' =>$otp ,'otp_created_at' => \Illuminate\Support\Carbon::now()];
               Users::find(Auth::guard(user_guard)->user()->id)->update($array);  //update db 
               return response()->json(['status'=>true,'resend_msg' =>'<div style="color: #23bfa1;font-weight: 400;font-size: 14px;margin:  0px;padding: 0px;">OTP resend successfullty to '.Auth::guard(user_guard)->user()->mobile .'<div>'], 200);
            else:
                return response()->json(['status'=>FALSE,'resend_msg' =>'<div style="color: #f0643b;font-weight: 400;font-size: 14px;margin:  0px;padding: 0px;">OTP not send successfullty to '.Auth::guard(user_guard)->user()->mobile .'<div>'], 200);
            endif;   
        else: abort(404); endif;
    }
    
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function otp_verification(Request $request)
    {
        
        $request->validate([ 'otp' => 'required|numeric' ]); 
        if(Auth::guard(user_guard)->user()->otp == $request->otp):
            $array =['otp' => null ,'otp_created_at' => null];
            \Modules\FrontEnd\Entities\Users::find(Auth::guard(user_guard)->user()->id)->update($array);  //update db
            Auth::guard(user_guard)->user()->refresh();
            return \Redirect::route('user_dashboard'); 
        else:
            return \Redirect::back()->withErrors(['otp' => 'Invalid OTP. Try again!'])->withInput();
        endif;
       
               
    }
    
    
    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('frontend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
