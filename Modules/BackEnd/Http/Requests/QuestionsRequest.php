<?php

namespace Modules\BackEnd\Http\Requests; 
use Illuminate\Foundation\Http\FormRequest; 

class QuestionsRequest extends FormRequest
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
                    'category_id'   =>   "required|max:255",
                    'question'      =>   "required|max:255",
                    'answer'        =>   "required|array|min:1",
                    'correct'       =>   "required|max:255",
                    "status"        =>  "required|numeric",  
                    
                ];
		
    }
    public function messages()
    {
       return [ 
            "status.numeric"   => 'The status field is required.',
            "category_id.required"   => 'The Question Category field is required.',
        ];
    }    
}
