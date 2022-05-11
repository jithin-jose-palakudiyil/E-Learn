<?php

namespace Modules\BackEnd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Questions extends Model
{
    use SoftDeletes;
    protected $table = "questions"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = [];
    protected $guarded = [ ]; 
    
   /*
    |--------------------------------------------------------------------------
    | has many answer for question
    |-------------------------------------------------------------------------- 
    */
    public function hasMany_answer()
    {
        return $this->hasMany("Modules\BackEnd\Entities\QuestionCategory","questions_id","id");
    }
    
    
}
