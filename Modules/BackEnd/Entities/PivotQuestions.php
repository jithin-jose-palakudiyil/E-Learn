<?php

namespace Modules\BackEnd\Entities;

use Illuminate\Database\Eloquent\Model;

class PivotQuestions extends Model
{
    protected $table = "pivot_questions";  
    protected $fillable = ['questions_id','answer','is_correct'];
}
