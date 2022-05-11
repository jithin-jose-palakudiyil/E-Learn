<?php

namespace Modules\BackEnd\Http\Requests; 
use Illuminate\Foundation\Http\FormRequest; 

class PackagesRequest extends FormRequest
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
      
        
        $rules =    [   
                        'category_id'       =>   "required|numeric",
                        'name'              =>   "required", 
                        'validity'          =>   "required",
                        'price'             =>   "required",
                        "status"            =>   "required|numeric", 
                        'offer_price'       =>  'required_with:is_offer',
                        'package_image'     =>   'max:5000|mimes:jpg,jpeg,png' 
                    ];
        if($this->method() == 'POST'): 
            $rules [ 'sets']=    [    "required" ];  
            $rules [ 'questions_in_set']=    [    "required", ];  
        endif;
            
        return $rules;
		
    }
    public function messages()
    {
       return [ 
            "status.numeric"   => 'The status field is required.',
            "category_id.required"   => 'The Question Category field is required.',
        ];
    }    
}
