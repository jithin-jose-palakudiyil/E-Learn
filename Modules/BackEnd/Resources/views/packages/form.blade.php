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
            <div class="col-md-4">
                <div class="form-group">
                    <label>Question Category: <span class="text-danger">*</span></label>
                    <select name="category_id" id="category_id" data-placeholder="Question Category" class="select"  >
                        <option></option> 
                        <?php 
                        $category = Modules\BackEnd\Entities\QuestionCategory::where('status',1)->get();
                        if($category->isNotEmpty()):
                            foreach ($category as $key => $value):
                            $selected = null;
                            if(isset($Packages['category_id'])):
                                if($Packages['category_id'] == $value->id ):
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
           
            <div class="col-md-4">
                <div class="form-group">
                    <label>Status: <span class="text-danger">*</span></label>
                    <select name="status" id="status" data-placeholder="status" class="select " data-minimum-results-for-search="-1">
                        <option></option> 
                        <option value="1"  @if(isset($Packages['status']) && $Packages['status']==1) selected @endif >Active</option>
                        <option value="2" @if(isset($Packages['status']) && $Packages['status']==2) selected @endif>Disable</option> 
                    </select>
                    <div id="status_err">
                        @if($errors->has('status'))
                            <div class="validation-error-label">{{ $errors->first('status') }}</div>
                        @endif
                    </div>
                </div>
            </div> 
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="sets">Sets (No.Of Exams ) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="sets" name="sets"  placeholder="Enter Sets (No.Of Exams )" value="{{$Packages['sets']? $Packages['sets']:old('sets')}}" <?php if(isset($edit) && $edit): echo 'disabled=""'; endif; ?> >
                    @if($errors->has('sets'))
                        <div class="validation-error-label">{{ $errors->first('sets') }}</div>
                    @endif
                </div> 
            </div>  
        </div>
        <div class="row">
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="questions_in_set">No.Of Questions in a Sets  <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="questions_in_set" name="questions_in_set"  placeholder="Enter No.Of Questions in a Sets" value="{{$Packages['questions_in_set']? $Packages['questions_in_set']:old('questions_in_set')}}" <?php if(isset($edit) && $edit): echo 'disabled=""'; endif; ?>  >
                    @if($errors->has('questions_in_set'))
                        <div class="validation-error-label">{{ $errors->first('questions_in_set') }}</div>
                    @endif
                </div> 
            </div> 
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="validity">Validity (in days) <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="validity" name="validity"  placeholder="Enter Validity" value="{{$Packages['validity']? $Packages['validity']:old('validity')}}" >
                    @if($errors->has('validity'))
                        <div class="validation-error-label">{{ $errors->first('validity') }}</div>
                    @endif
                </div> 
            </div> 
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="name">Package name  <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="name" name="name"  placeholder="Enter package name" value="{{$Packages['name']? $Packages['name']:old('name')}}" >
                    @if($errors->has('name'))
                        <div class="validation-error-label">{{ $errors->first('name') }}</div>
                    @endif
                </div> 
            </div>
        </div>
        <div class="row"> 
             <div class="col-md-4">
                    <label>Package Image: <span class="text-danger">*</span></label>
                    <input type="file" name="package_image" id="package_image" class="form-control">
                    <div id="package_image_error">
                        @if($errors->has('package_image'))
                            <div class="validation-error-label">{{ $errors->first('package_image') }}</div>
                        @endif
                    </div>
            </div>
            <div class="col-md-4">
                <div class="form-group ">
                    <label for="price">Price <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="price" name="price"  placeholder="Enter Price" value="{{$Packages['price']? $Packages['price']:old('price')}}" >
                    @if($errors->has('price'))
                        <div class="validation-error-label">{{ $errors->first('price') }}</div>
                    @endif
                </div> 
            </div>
            <div class="col-md-4"> 
                <div class="form-group pt-15">
                    <label class="display-block text-semibold">Is offer?</label>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox"  class="styled" id="is_offer" name="is_offer"  value="1" @if(isset($Packages['is_offer']) && $Packages['is_offer']==1) checked @endif >
                            offer available
                        </label>
                    </div> 
                </div>
            </div> 
            <div class="col-md-4"  id="offer_price_row" <?php if(isset($Packages['is_offer']) && $Packages['is_offer']==1):   else: echo 'style="display: none"'; endif; ?> >
                <div class="form-group ">
                    <label for="offer_price"> Offer price<span class="text-danger">*</span></label>
                    <input type="text" class="form-control" id="offer_price" name="offer_price"  placeholder="Enter offer Price" value="{{$Packages['offer_price']? $Packages['offer_price']:old('offer_price')}}" >
                    @if($errors->has('offer_price'))
                        <div class="validation-error-label">{{ $errors->first('offer_price') }}</div>
                    @endif
                </div> 
            </div> 
        </div>
    </div>
</div> 
 
<div class="row"> 
    <div class="col-md-12 ">
        <button type="submit" class="btn btn-primary pull-right" style="margin-left: 10px">Submit</button> 
    </div>
</div>
@section('js')
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/selects/select2.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/styling/uniform.min.js')}}"></script>
    <script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/forms/validation/validate.min.js')}}"></script>  
    <script src="{{asset('public/plugins/validation/jquery.validate.file.js')}}"></script> 
     
    <script src="{{asset('Modules/BackEnd/Resources/assets/js/packages.js')}}"></script> 
    <?php if(isset($Packages['is_offer']) && $Packages['is_offer']==1): ?> 
    <script> 
        $(document).ready(function()
        {
     $('#offer_price').rules("add", {required:true, normalizer: function(value) { return $.trim(value);  },number:true } );
      });
    </script> 
    <?php endif; ?>
     <?php if(isset($edit) && $edit ): ?>
        <script> 
           $(document).ready(function()
           {
                $('#package_image').rules("remove", 'required' );
            });
       </script> 
     <?php endif; ?>
    
@stop