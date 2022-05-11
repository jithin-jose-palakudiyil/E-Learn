@extends('backend::layouts.master')

@section('content')

<?php 

if($package_id): 
    ?>
    <div class="col-md-12">
        <h6 class="content-group text-semibold">
            {{$package_id->name}} 
            <small class="display-block" >Max questions in a set : <b>{{$package_id->questions_in_set}} </b></small>
        </h6>
    </div>
    <?php
    $array = ['success','primary','orange','pink','danger'];
    $i=0;
    for ($x = 1; $x <= $package_id->sets; $x++) :   
        $class = 'btn bg-'.$array[$i].'-400';
       $PivoBundlePackages = \Modules\BackEnd\Entities\PivoBundlePackages::where('package_id',$package_id->id)->where('set_number',$x)->get();
         
    ?>
    <div class="col-md-3">
        <div class="panel">
            <div class="panel-body text-center">
                <div class="icon-object border-{{$array[$i]}} text-{{$array[$i]}}">{{$x}}</div>
                <h5 class="text-semibold">Sets</h5>
                <p class="mb-15">No.Of Question in  this Sets : {{$PivoBundlePackages->count()}}</p>
                <a href="{{route('assign_question_index',[$package_id->id,$x])}}" class="{{$class}}">Add Question</a> 
            </div>
        </div>
    </div>
    <?php
    if($i==4):
        $i=-1;
    endif;
    $i++;
    endfor;
else: echo 'Sorry No bundle Found'; endif;
?>
  
@endsection
