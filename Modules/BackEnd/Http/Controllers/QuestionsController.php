<?php

namespace Modules\BackEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BackEnd\Entities\Questions;
use Modules\BackEnd\Repositories\QuestionRepository;
use Modules\BackEnd\Http\Requests\QuestionsRequest;

class QuestionsController extends Controller
{
    protected $repository;
    public function __construct(Questions $Questions)
    {        
        $this->defaultUrl           =   route('questions');
        $this->createUrl            =   route('questions.create');  
        $this->createMessage        =   'Questions is created successfully.';
        $this->createErrorMessage   =   'Questions is not created successfully.';
        $this->updateMessage        =   'Questions is updated successfully.';
        $this->updateErrorMessage   =   'Questions is not updated successfully.';
        $this->deleteMessage        =   'Questions is deleted successfully.';
        $this->deleteErrorMessage   =   'Questions is not deleted successfully.';  
        $this->page_title           =   "Questions";
//        $this->breadcrumb_icon      =  'icon-eye8';
        $this->active               =  'questions';
        $this->repository           =   new QuestionRepository($Questions);
        
        $this->middleware('admin_permission:questions-list', ['only' => ['index']]);
        $this->middleware('admin_permission:questions-create', ['only' => ['create','store']]);
        $this->middleware('admin_permission:questions-edit', ['only' => ['edit','update']]);
        $this->middleware('admin_permission:questions-delete', ['only' => ['destroy']]); 
      
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
 
        $page_title= $this->page_title ; $active= $this->active;
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Question');
        $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),  array ("title" => 'Questions List', "active" => 1,"url" => $this->defaultUrl ),  );
        return view('backend::question.questions.index', compact('page_title','active','breadcrumb','CreateBtn','request'));
    
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Questions $Questions)
    {
        $page_title= $this->page_title ; $active= $this->active;
        $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),  array ("title" => 'Questions', "url" => $this->defaultUrl ),   array ("title" => 'Create', "active" => 1,"url" => '' ),   ); 
        return view('backend::question.questions.create', compact('page_title','active','breadcrumb','Questions'));
   
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(QuestionsRequest $request)
    { 
        
          if(!$request->ajax()):
            $store  =   $this->repository->create($request->all()); 
            if($store == null): 
                $request->session()->flash('flash-success-message',$this->createMessage); 
                $url = $this->defaultUrl.'?category_id='.$request->category_id;
                return \Redirect::to($url); 
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
        $questions = collect([]);
        if($request->exists('category_id')):
           $questions =  Questions::where('category_id',$request->category_id)->get();
        endif;
        return \DataTables::of($questions)->make(true);
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $Questions = Questions::with('hasMany_answer')->where('id',$id)->first(); 
        if($Questions): 
            $page_title= $this->page_title ; $active= $this->active;
            $breadcrumb = array(   
                                    array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                    array ("title" => 'Question', "url" => $this->defaultUrl ),  
                                    array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array

                               );
            return view('backend::question.questions.edit', compact('page_title','active','breadcrumb','Questions'));
        else: abort(404); endif;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(QuestionsRequest $request, $id)
    {
        $Questions = Questions::with('hasMany_answer')->where('id',$id)->first();
        if($Questions):
            if(!$request->ajax()):
            $update = $this->repository->update($request->all(), $Questions); 
            if($update == null): 
                $request->session()->flash('flash-success-message',$this->updateMessage);
                $url = $this->defaultUrl.'?category_id='.$request->category_id;
                return \Redirect::to($url); 
            else: 
                $request->session()->flash('flash-error-message',$this->updateErrorMessage.'<br/> '.$update);
                return \Redirect::back();
            endif;
        else:
            return response()->json(['message' => 'Page not found!'], 404);
        endif;
        else: abort(404); endif;
         
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        $Questions = Questions::where('id',$id)->first();
        if($Questions):
            if(\Request::ajax()): 
                $error = $msg = null;
                try{   if($Questions):  $Questions->delete(); endif;
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
        else: abort(404); endif;
    }
}
