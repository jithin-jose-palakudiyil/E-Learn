<?php

namespace Modules\BackEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BackEnd\Entities\Packages;
use Modules\BackEnd\Entities\PivoBundlePackages;
use \Exception;

class SetsController extends Controller
{
    protected $repository;
    public function __construct()
    {         
        $this->page_title           =   "Sets";
        $this->active               =  'package';
        
        $this->middleware('admin_permission:sets-list', ['only' => ['index']]);
        $this->middleware('admin_permission:sets-assign', ['only' => ['assign_question_index','store']]);

    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Packages $package_id)
    {
        if($package_id): 
                $page_title= $this->page_title ; $active= $this->active;
                $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                    array ("title" => 'Package', "url" => route('packages').'?category_id='.$package_id->category_id ),
                    array ("title" => 'Sets', "active" => 1,"url" =>'' ),
                    );
                return view('backend::sets.index', compact('page_title','active','breadcrumb','package_id'));
        else:abort(404);endif;
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function assign_question_index(Packages $package,$set)
    {
        if($package && ($package->sets > 0 && $set > 0) &&  $package->sets >= $set ):
            $page_title= $this->page_title ; $active= $this->active;
            $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                array ("title" => 'Package', "url" => route('packages').'?category_id='.$package->category_id ),
                array ("title" => 'Sets', "url" => route('sets_list',$package->id)),
                array ("title" => 'Assign Question', "active" => 1,"url" =>'' ),
                );
            $questions = \Modules\BackEnd\Entities\Packages::get_package_set_questions($package->category_id, $package->id, $set);
            $current_set_questions = \Modules\BackEnd\Entities\Packages::get_current_set_questions($package->category_id, $package->id, $set);
            return view('backend::sets.question', compact('page_title','active','breadcrumb','package','set','questions','current_set_questions')); 
       else:abort(404);endif;
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request,Packages $package,$set)
    {
      if($package && ($package->sets > 0 && $set > 0) &&  $package->sets >= $set ):
           $request->validate(['questions' =>  "required|array|min:1",'negative_mark' =>'required_with:is_negative_mark']);
        $error = null;
        
        try{
            PivoBundlePackages::where('package_id',$package->id)->where('set_number',$set)->delete();
            $questions = [];
            foreach ($request->questions as $key => $value):
                $questions[$key]['package_id'] = $package->id;
                $questions[$key]['set_number'] = $set;
                $questions[$key]['question_id'] = $value;
                if($request->exists('is_negative_mark') && $request->exists('negative_mark')):
                    $questions[$key]['is_negative_mark'] = $request->is_negative_mark;
                    $questions[$key]['negative_mark'] = $request->negative_mark;
                endif; 
            endforeach;
            PivoBundlePackages::insert($questions); 
            $sets = 0; 
            for ($x = 1; $x <= $package->sets; $x++):
                $PivoBundlePackages = PivoBundlePackages::where('package_id',$package->id)->where('set_number',$x)->count();
                if($package->questions_in_set == $PivoBundlePackages):
                    $sets+= 1; 
                endif;  
            endfor;  
            if($sets != $package->sets):
                Packages::find($package->id)->update(['is_publish' => 2]);
            endif;
                 
        } catch (Exception $ex) { $error = $ex->getMessage(); }
          if($error == null): 
                $request->session()->flash('flash-success-message','Questions successfully assigned to set.'); 
                $url = route('sets_list',$package->id);
                return \Redirect::to($url); 
            else: 
                $request->session()->flash('flash-error-message','Questions is not successfully assigned to set.'.'<br/> '.$error);
                return \Redirect::back();
            endif;
      else:abort(404);endif;
    }
 
}
