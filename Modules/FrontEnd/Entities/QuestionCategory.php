<?php

namespace Modules\FrontEnd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionCategory extends Model
{
    use SoftDeletes;
    protected $table = "question_category"; 
    protected $dates = ['deleted_at'];  
    protected $fillable = [];
    protected $guarded = [ ]; 
}
