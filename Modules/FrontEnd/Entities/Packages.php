<?php

namespace Modules\FrontEnd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Packages extends Model
{
    use SoftDeletes;
    protected $table = "packages"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = [];
    protected $guarded = []; 
    
  
    /*
    |--------------------------------------------------------------------------
    | has many answer for question
    |-------------------------------------------------------------------------- 
    */
    public function question_category()
    {
        return $this->hasMany("Modules\FrontEnd\Entities\QuestionCategory","id","category_id");
    }
    
}
