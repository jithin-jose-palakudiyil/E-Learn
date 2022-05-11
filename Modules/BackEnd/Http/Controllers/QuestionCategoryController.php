<?php

namespace Modules\BackEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\BackEnd\Entities\QuestionCategory;
use \Modules\BackEnd\Http\Requests\QuestionCategoryRequest;
use \Modules\BackEnd\Repositories\QuestionCategoryRepository;
class QuestionCategoryController extends Controller
{
    
    protected $repository;
    public function __construct(QuestionCategory $QuestionCategory)
    {        
        $this->defaultUrl           =   route('question-category');
        $this->createUrl            =   route('question-category.create');  
        $this->createMessage        =   'Category is created successfully.';
        $this->createErrorMessage   =   'Category is not created successfully.';
        $this->updateMessage        =   'Category is updated successfully.';
        $this->updateErrorMessage   =   'Category is not updated successfully.';
        $this->deleteMessage        =   'Category is deleted successfully.';
        $this->deleteErrorMessage   =   'Category is not deleted successfully.';  
        $this->page_title           =   "Question Category";
//        $this->breadcrumb_icon      =  'icon-eye8';
        $this->active               =  'question-category';
        $this->repository           =   new QuestionCategoryRepository($QuestionCategory);
        
        $this->middleware('admin_permission:question-category-list', ['only' => ['index']]);
        $this->middleware('admin_permission:question-category-create', ['only' => ['create','store']]);
        $this->middleware('admin_permission:question-category-edit', ['only' => ['edit','update']]);
        $this->middleware('admin_permission:question-category-delete', ['only' => ['destroy']]); 
      
    }
    
     /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index()
    {
        $page_title= $this->page_title ; $active= $this->active;
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Category');
        $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),  array ("title" => 'Question Category', "active" => 1,"url" => $this->defaultUrl ),  );
        return view('backend::question.category.index', compact('page_title','active','breadcrumb','CreateBtn'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(QuestionCategory $QuestionCategory)
    {
        $page_title= $this->page_title ; $active= $this->active;
        $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),  array ("title" => 'Question Category', "url" => $this->defaultUrl ),   array ("title" => 'Create', "active" => 1,"url" => '' ),   ); 
        return view('backend::question.category.create', compact('page_title','active','breadcrumb','QuestionCategory'));
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(QuestionCategoryRequest $request)
    {
        
        if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage);
                return \Redirect::to($this->defaultUrl); 
            else: 
                $request->session()->flash('flash-error-message',$this->createErrorMessage.'<br/> '.$store);
                return \Redirect::back();
            endif;
        else:
            return response()->json(['message' => 'Page not found!'], 404);
        endif;
    }

    
    /**
     * Show the specified resource.
     * @param Request $request
     * @return Renderable
     */
    public function list_dataTable(Request $request)
    { 
        return \DataTables::of(QuestionCategory::get())->make(true);
    }
     
    /**
     * Show the form for editing the specified resource.
     * @param Object $QuestionCategory
     * @return Renderable
     */
    public function edit(QuestionCategory $QuestionCategory)
    {
        $page_title= $this->page_title ; $active= $this->active;
        $breadcrumb = array(   
                                array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                array ("title" => 'Question Category', "url" => $this->defaultUrl ),  
                                array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array
                                
                           );
         return view('backend::question.category.edit', compact('page_title','active','breadcrumb','QuestionCategory'));
    
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param Object $QuestionCategory
     * @return Renderable
     */
    public function update(QuestionCategoryRequest $request, QuestionCategory $QuestionCategory)
    {
         if(!$request->ajax()):
            $update = $this->repository->update($request->all(), $QuestionCategory); 
            if($update == null): 
                $request->session()->flash('flash-success-message',$this->updateMessage);
                return \Redirect::to($this->defaultUrl);
            else: 
                $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$update);
                return \Redirect::back();
            endif;
        else:
            return response()->json(['message' => 'Page not found!'], 404);
        endif;
    }

    /**
     * Remove the specified resource from storage.
     * @param Object $QuestionCategory
     * @return Renderable
     */
    public function destroy(QuestionCategory $QuestionCategory)
    {
         if(\Request::ajax()): 
            $error = $msg = null;
            try{   if($QuestionCategory):  $QuestionCategory->delete(); endif;
            } catch (Exception $ex) {  $error = $ex->getMessage();  }

            if($error == null):      
                \Session::flash('flash-success-message',$this->deleteMessage);
                $msg=array('type'=>'success'); 
            else: 
                \Session::flash('flash-success-message',$this->deleteErrorMessage);
                $msg=array('type'=>'error'); 
            endif;
        else:
            \Session::flash('flash-success-message',$this->deleteErrorMessage);
            $msg=array('type'=>'error');
        endif; 
        return response()->json($msg, 200);
    }
}
