<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Auth;
use Redirect;
use App\Helpers\SmsHelper as sms;
use \Modules\FrontEnd\Entities\Users;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        if(Auth::guard(user_guard)->user())  {   return Redirect::route('user_dashboard');   }
        else
        {
            $page_title = 'Elearn - Login to Your Account';
            return view('frontend::auth.login', compact('page_title'));
        }
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required',
        ]); 
        $remember = ($request->exists('remember')) ? true : false;
        if (Auth::guard(user_guard)->attempt(['email' => $request->email, 'password' => $request->password], $remember)):
            if(Auth::guard(user_guard)->user()->otp == null && Auth::guard(user_guard)->user()->otp_created_at == null):
                
                if($request->session()->has('user_package')): 
                    $user_package = $request->session()->pull('user_package'); 
                    $request->session()->forget('user_package'); 
                    return \Redirect::route('package_purchase',\Crypt::encryptString($user_package->id));
                endif; 
                return \Redirect::route('user_dashboard'); 
            else:
                $otp = rand(1000, 9999); 
                $sms    =  sms::getlead_otp_sms(Auth::guard(user_guard)->user()->mobile,$otp);
                if($sms): 
                   $array =['otp' =>$otp ,'otp_created_at' => \Illuminate\Support\Carbon::now()];
                   Users::find(Auth::guard(user_guard)->user()->id)->update($array);  //update db 
                   return \Redirect::route('register_otp'); 
                else:
                    return \Redirect::back()->withErrors(['invalid_login' => 'Sorry your account not verified with mobile. Try again!'])->withInput();
                endif; 
            endif; 
        else:
           return \Redirect::back()->withErrors(['invalid_login' => 'Invalid email or password. Try again!'])->withInput();
        endif; 
       
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontend::show');
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
    
    /**
     * logout Admin
     * @return redirect
     */
    public function logout()
    { 
        Auth::guard(user_guard)->logout();
        \Session::flush();
        return redirect()->route('front_user_login');
    }
    
}
