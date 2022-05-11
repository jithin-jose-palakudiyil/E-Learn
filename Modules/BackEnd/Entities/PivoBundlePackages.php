<?php

namespace Modules\BackEnd\Entities;

use Illuminate\Database\Eloquent\Model;

class PivoBundlePackages extends Model
{
    protected $table = "pivo_bundle_packages";  
    protected $fillable = ['package_id','bundle_number','question_id','is_negative_mark','negative_mark'];
}
