@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="panel panel-flat"> 
    <div class="panel-body">
        <div class="row"> 
            <div class="col-md-6">
                <div class="form-group">
                    <label>Question Category: <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" data-placeholder="Question Category" class="select"  >
                        <option></option> 
                        <?php 
                        $category = Modules\BackEnd\Entities\QuestionCategory::where('status',1)->get();
                        if($category->isNotEmpty()):
                            foreach ($category as $key => $value):
                            $selected = null;
                            if(isset($Questions['category_id'])):
                                if($Questions['category_id'] == $value->id ):
                                  $selected = 'selected=""';  
                                endif;
                            endif;
                            ?>  
                        <option value="{{$value->id}}" {{$selected}} >{{$value->name}}</option> 
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
            <div class="col-md-6">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" id="status" data-placeholder="status" class="select " data-minimum-results-for-search="-1">
                        <option></option> 
                        <option value="1"  @if(isset($Questions['status']) && $Questions['status']==1) selected @endif >Active</option>
                        <option value="2" @if(isset($Questions['status']) && $Questions['status']==2) selected @endif>Disable</option> 
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
             <div class="col-md-12">
                <div class="form-group ">
                    <label for="question">Question <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="question" name="question"  placeholder="Enter Question" value="{{$Questions['question']? $Questions['question']:old('question')}}" >
                    @if($errors->has('question'))
                        <div class="validation-error-label">{{ $errors->first('question') }}</div>
                    @endif
                </div> 
            </div> 
            
        </div>
    </div>
</div> 
<?php
 
if($Questions->hasMany_answer->isNotEmpty()):
    $answer = $Questions->hasMany_answer;
    
    ?>
  <div class="panel panel-flat"> 
    <div class="panel-body">
        <div class="row"> 
            <table class="table datatable-basic answer_options">
                <thead> 
                    <tr>
                        <th>Answer Options <span class="text-danger">*</span></th>
                        <th>Is Correct Answer <span id="error_correct"></span></th>
                        <th class="text-center">Remove</th> 
                    </tr> 
                </thead>
                 <tbody>
                     <?php
                        $i=1;
                        foreach ($answer as $key => $value):  
                        ?>
                      <tr class="table_row" id="table_row_{{$i}}">
                        <td>
                           <div class="form-group "> 
                                <input type="text" class="form-control answer"   name="answer[{{$i}}]"  placeholder="Enter answer" value="{{$value->answer}}" >
                            </div> 
                        </td>
                        <td  style="vertical-align:middle">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="correct" class="control-primary correct" value="{{$i}}" <?php if($value->is_correct == 1): echo 'checked=""'; endif;?> >
                                </label>
                             </div>
                        </td>
                        <td class="text-center rem_btn" >
                        <?php if($i>1): ?>
                             <button type="button" data-row='{{$i}}' class="btn border-warning text-warning-600 btn-flat btn-icon btn-rounded remove_options"><i class="icon-close2"></i></button>
                       <?php endif; ?>
                        </td>
                    </tr>
                        <?php
                        $i++;
                        endforeach;
                     ?>
                    
                    
                </tbody>
            </table> 
        </div>
        <div class="row"> 
           <div class="col-md-12">
               <button type="button" class="btn btn-success pull-right add_options" style="margin-left: 10px">Add More</button> 
     
           </div>
        </div>
    </div>
</div>   
<?php else: ?> 
<div class="panel panel-flat"> 
    <div class="panel-body">
        <div class="row"> 
            <table class="table datatable-basic answer_options">
                <thead> 
                    <tr>
                        <th>Answer Options <span class="text-danger">*</span></th>
                        <th>Is Correct Answer <span id="error_correct"></span></th>
                        <th class="text-center">Remove</th> 
                    </tr> 
                </thead>
                 <tbody>
                     <tr class="table_row" id="table_row_1">
                        <td>
                           <div class="form-group "> 
                                <input type="text" class="form-control answer"   name="answer[1]"  placeholder="Enter answer" value="" >
                            </div> 
                        </td>
                        <td  style="vertical-align:middle">
                            <div class="radio">
                                <label>
                                    <input type="radio" name="correct" class="control-primary correct" value="1" >
                                </label>
                             </div>
                        </td>
                        <td class="text-center rem_btn" > </td>
                    </tr>
                    
                </tbody>
            </table> 
        </div>
        <div class="row"> 
           <div class="col-md-12">
               <button type="button" class="btn btn-success pull-right add_options" style="margin-left: 10px">Add More</button> 
     
           </div>
        </div>
    </div>
</div> 
 <?php endif; ?>
<div class="row"> 
    <div class="col-md-12 ">
        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
    </div>
</div>
@section('js')
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>  
    <script src="{{asset('Modules/BackEnd/Resources/assets/js/questions.js')}}"></script> 
@stop