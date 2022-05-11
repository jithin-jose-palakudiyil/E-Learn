<?php

namespace Modules\BackEnd\Entities;
 
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class AdminUsers extends Authenticatable
{
    use SoftDeletes;
    protected $table = "admin_users"; 
    protected $dates = ['deleted_at'];
    protected $hidden = ['password'];  
    protected $fillable = [];
    protected $guarded = [ ]; 
    public function pivot_permissions()
    {
        return $this->belongsToMany("Modules\BackEnd\Entities\PivotPermissions","pivot_permissions","user_id","permission_id") ;
    }
    
    
    public function get_permissions()
    {
        return $this->belongsToMany("Modules\BackEnd\Entities\Permissions","pivot_permissions",'user_id','permission_id') ;
    }
}
