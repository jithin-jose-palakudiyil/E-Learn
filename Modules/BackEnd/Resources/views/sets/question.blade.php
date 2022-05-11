@extends('backend::layouts.master')

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="row"> 
    <div class="col-md-12">
        <h6 class="content-group text-semibold">
            {{$package->name}}
            <small class="display-block">Set - {{$set}}</small>
        </h6>
    </div> 
</div>


 
<?php  if($questions->isNotEmpty()):
    
 
        $PivoBundlePackages = \Modules\BackEnd\Entities\PivoBundlePackages::select('is_negative_mark','negative_mark')->where('package_id',$package->id)->where('set_number',$set)->get();
        $is_negative_mark = $PivoBundlePackages->pluck('is_negative_mark')->unique()->toArray();
        $negative_mark = $PivoBundlePackages->pluck('negative_mark')->unique()->first();
         
    ?> 
<form action="{{route('store_sets_question',[$package->id,$set])}}" method="post" autocomplete="off" id="set_questions">
{{ csrf_field() }}					
    

<div class="panel panel-flat"> 
    <div class="panel-body">
        <div class="row"> 
            <div class="col-md-4"> 
                <div class="form-group pt-15">
                    <label class="display-block text-semibold">Is  negative mark for this Set ?</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"  class="styled" id="is_negative_mark" name="is_negative_mark"  value="1" @if(isset($is_negative_mark[0]) && $is_negative_mark[0]==1) checked @endif >
                             negative mark available
                        </label>
                    </div> 
                </div>
            </div>
            <div class="col-md-4" id="negative_mark_row" <?php if(isset($is_negative_mark[0]) && $is_negative_mark[0]==1):   else: echo 'style="display: none"'; endif; ?>>
                <div class="form-group ">
                    <label for="negative_mark">Negative mark <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="negative_mark" name="negative_mark"  placeholder="Enter negative mark" value="{{$negative_mark? $negative_mark:old('offer_price')}}" >
                </div> 
            </div>
        </div>
    </div>
</div> 
<div class="panel panel-flat"> 
    <div class="panel-body">
        <div class="row"> 
            <div class="form-group">
                <label class="display-block text-semibold">Questions List</label>
                <div id="questions_error"></div>
                <?php foreach ($questions as $key => $value):
                    $checked =  null;
                    if($current_set_questions->contains('id',$value->id)):
                        $checked = 'checked=""'; 
                    endif; 
                    ?> 
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="questions[]" class="styled" value="{{$value->id}}"  {{$checked}}>
                            {{$value->question}}
                        </label>
                    </div>
                <?php endforeach;  ?>  
            </div> 
        </div>
    </div>
</div> 
 <div class="row"> 
    <div class="col-md-12 ">
        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Save</button> 
    </div>
</div>
</form>
<?php else: ?>
<div class="alert alert-danger">
        <ul>
            <li>Sorry, No Questions found</li>
        </ul>
    </div>
<?php endif; ?>
    


@endsection

@section('js')
<script> 
var questions_in_set ={{$package->questions_in_set}};
</script> 
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>  
    <script src="{{asset('Modules/BackEnd/Resources/assets/js/sets.js')}}"></script> 
 
@stop