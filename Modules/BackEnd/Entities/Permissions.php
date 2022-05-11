<?php

namespace Modules\BackEnd\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Permissions extends Model
{
    use SoftDeletes;
    protected $table = "permissions";  
    protected $fillable = [];
    protected $guarded = [ ]; 
}
