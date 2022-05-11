@extends('backend::layouts.master') 
 
@section('content') 
 
<div class="panel panel-flat" >
     <div class="panel-body">
        <div class="row"> 
            <div class="col-md-6">
                <div class="form-group">
                    <label>Question Category:</label>
                    <select name="category_id" id="category_id" data-placeholder="Question Category" class="select"  >
                        <option></option> 
                        <?php 
                        $category = Modules\BackEnd\Entities\QuestionCategory::where('status',1)->get();
                        if($category->isNotEmpty()):
                            foreach ($category as $key => $value):
                            ?>  
                        <option value="{{$value->id}}">{{$value->name}}</option> 
                            <?php
                            endforeach;
                        endif;
                        ?>
                     </select>
                    <div id="category_id_err">
                        @if($errors->has('category_id'))
                            <div class="validation-error-label">{{ $errors->first('category_id') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
</div> 
</div>
<!-- Basic datatable -->
<div class="panel panel-flat" style="display: none" id="packages_datatable">
    <table class="table datatable-basic"    data-url="{{route('packages_list')}}" id="packages_list">
        <thead> 
            <tr>
            <th>Name</th> 
            <th>Status</th>
            <th>Is Publish</th> 
            <th class="text-center">Actions</th>
            </tr> 
        </thead>
        <tbody></tbody>
    </table>
</div>                                
<!-- Basic datatable -->                          
@stop

@section('js') 
<style>
    .btn-light {
    color: #000 !important;
    margin-right: 10px !important;
}
</style>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/tables/datatables/datatables.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>   
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/notifications/noty.min.js')}}"></script> 
    <script src="{{asset('Modules/BackEnd/Resources/assets/js/packages.js')}}"></script>  
    <?php 
        if($request->exists('category_id')):
        ?>
    <script>
        $(document).ready(function()
        { 
            $('#category_id').val('<?php echo $request->category_id; ?>');
            $('#category_id').select2().trigger('change');
        });
    </script>
        <?php
        endif;
    ?>
@stop
