<?php

namespace Modules\BackEnd\Entities;

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
    | get the package set questions with current set and not have another set
    |-------------------------------------------------------------------------- 
    */
    public static function get_package_set_questions($category_id,$package_id,$set_number)
    {
        return \Modules\BackEnd\Entities\Questions::where('category_id',$category_id)->where('status',1)
                ->whereNotIn('id',function($query) use($package_id,$set_number)
                {       
                    $query->select('question_id')
                    ->from(with(new \Modules\BackEnd\Entities\PivoBundlePackages)->getTable() )
                    ->where('package_id', $package_id)
                    ->where('set_number', '!=',$set_number);
                })
                ->get();
    }
    
    /*
    |--------------------------------------------------------------------------
    | get the questions with current set only
    |-------------------------------------------------------------------------- 
    */
    public static function get_current_set_questions($category_id,$package_id,$set_number)
    {
        return \Modules\BackEnd\Entities\Questions::where('category_id',$category_id)->where('status',1)
                ->whereIn('id', function($query) use($package_id,$set_number)
                {       
                    $query->select('question_id')
                    ->from(with(new \Modules\BackEnd\Entities\PivoBundlePackages)->getTable() )
                    ->where('package_id', $package_id)
                    ->where('set_number', '=',$set_number);
                })
                ->get();
    }
}
