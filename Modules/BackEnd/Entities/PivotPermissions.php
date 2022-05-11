<?php

namespace Modules\BackEnd\Entities;

use Illuminate\Database\Eloquent\Model;

class PivotPermissions extends Model
{
    protected $table = "pivot_permissions";  
    protected $fillable = ['permission_id','user_id'];
}
