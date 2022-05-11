<?php

namespace Modules\FrontEnd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable
{
    use SoftDeletes;
    protected $table = "users"; 
    protected $dates = ['deleted_at'];
    protected $hidden = ['password']; 
    protected $fillable = [];
    protected $guarded = [ ]; 
   
}
