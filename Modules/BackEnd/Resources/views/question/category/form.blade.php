<div class="panel panel-flat"> 
    <div class="panel-body">
        <div class="row"> 
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter name" value="{{$QuestionCategory['name']? $QuestionCategory['name']:old('name')}}" >
                    @if($errors->has('name'))
                        <div class="validation-error-label">{{ $errors->first('name') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="slug">Slug <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="slug" name="slug"  placeholder="Enter Slug" value="{{$QuestionCategory['slug']? $QuestionCategory['slug']:old('slug')}}" >
                    @if($errors->has('slug'))
                        <div class="validation-error-label">{{ $errors->first('slug') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" id="status" data-placeholder="status" class="select " data-minimum-results-for-search="-1">
                        <option></option> 
                        <option value="1"  @if(isset($QuestionCategory['status']) && $QuestionCategory['status']==1) selected @endif >Active</option>
                        <option value="2" @if(isset($QuestionCategory['status']) && $QuestionCategory['status']==2) selected @endif>Disable</option> 
                    </select>
                    <div id="status_err">
                        @if($errors->has('status'))
                            <div class="validation-error-label">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
        </div>
        <div class="row"> 
            <div class="col-md-12 ">
                <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
            </div>
        </div>
    </div>
</div> 
@section('js')
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>  
    <script src="{{asset('Modules/BackEnd/Resources/assets/js/question_category.js')}}"></script> 
@stop