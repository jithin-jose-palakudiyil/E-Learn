@extends('backend::layouts.master') 
 
@section('content') 
 
 
<!-- Basic datatable -->
<div class="panel panel-flat">
    <table class="table datatable-basic"    data-url="{{route('question_category_list')}}" id="question_category_list">
        <thead> 
            <tr>
            <th>Name</th>
            <th>Slug</th>
            <th>Status</th>
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
    <script src="{{asset('Modules/BackEnd/Resources/assets/js/question_category.js')}}"></script>    
@stop
