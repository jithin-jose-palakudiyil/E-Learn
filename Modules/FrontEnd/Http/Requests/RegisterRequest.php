<?php

namespace Modules\FrontEnd\Http\Requests; 
use Illuminate\Foundation\Http\FormRequest; 

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {  
      
        return 
                [   
                    'first_name'            =>   "required|max:255",
                    "email"                 =>  "required|max:255|unique:users,email", 
                    "password"              =>  "required|min:8|same:confirm_password",
                    "confirm_password"      =>  "required|min:8|same:password",
                    "is_agree"              =>  "required",
                    'mobile'                =>  [ 
                                                    function ($attribute, $value, $fail) 
                                                    {
                                                        if($value):
                                                            $Mobile = str_replace(' ', '', $value);  
                                                            $mobileregex = "/^[6-9][0-9]{9}$/" ; 
                                                            if(preg_match($mobileregex, $Mobile) === 1):
                                                                $mobile_v = \Modules\FrontEnd\Entities\Users::select('mobile')->where('mobile', $Mobile)->first();
                                                                if($mobile_v):
                                                                    $fail('This mobile number is already exists.'); 
                                                                endif;  
                                                            else:
                                                                $fail('Please enter a valid mobile number.'); 
                                                            endif;
                                                        else:
                                                            $fail('This field is required.');   
                                                        endif;


                                                    }
                                                ],
                    
                
                     
                ];
		
    }
    public function messages()
    {
       return [ 
            "is_agree.required"   => 'The field is required.' 
        ];
    }    
}
