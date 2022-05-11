<?php

namespace Modules\BackEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BackEnd\Entities\Packages;
use Modules\BackEnd\Http\Requests\PackagesRequest;
use Modules\BackEnd\Repositories\PackagesRepository;

class PackageController extends Controller
{
    
    protected $repository;
    public function __construct(Packages $Packages)
    {        
        $this->defaultUrl           =   route('packages');
        $this->createUrl            =   route('packages.create');  
        $this->createMessage        =   'Package is created successfully.';
        $this->createErrorMessage   =   'Package is not created successfully.';
        $this->updateMessage        =   'Package is updated successfully.';
        $this->updateErrorMessage   =   'Package is not updated successfully.';
        $this->deleteMessage        =   'Package is deleted successfully.';
        $this->deleteErrorMessage   =   'Package is not deleted successfully.';  
        $this->page_title           =   "Package";
//        $this->breadcrumb_icon      =  'icon-eye8';
        $this->active               =  'package';
        $this->repository           =   new PackagesRepository($Packages);
        
        $this->middleware('admin_permission:package-list', ['only' => ['index']]);
        $this->middleware('admin_permission:package-create', ['only' => ['create','store']]);
        $this->middleware('admin_permission:package-edit', ['only' => ['edit','update']]);
        $this->middleware('admin_permission:package-delete', ['only' => ['destroy']]); 
      
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        $page_title= $this->page_title ; $active= $this->active;
        $CreateBtn = array('url'=>$this->createUrl,'btn_txt'=>'New Package');
        $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),  array ("title" => 'Package List', "active" => 1,"url" => $this->defaultUrl ),  );
        return view('backend::packages.index', compact('page_title','active','breadcrumb','CreateBtn','request'));
    
        
    }

    /**
     * Show the specified resource.
     * @param Request $request
     * @return Renderable
     */
    public function list_dataTable(Request $request)
    { 
         
        $Packages = $collect =  collect([]);
        if($request->exists('category_id')):
            $Packages =  Packages::select('id','name','status','sets','questions_in_set','is_publish')->where('category_id',$request->category_id)->get();
            foreach ($Packages as $key => $value): 
                $sets = 0; 
                for ($x = 1; $x <= $value->sets; $x++):
                    $PivoBundlePackages = \Modules\BackEnd\Entities\PivoBundlePackages::where('package_id',$value->id)->where('set_number',$x)->count();
                    if($value->questions_in_set == $PivoBundlePackages):
                        $sets+= 1; 
                    endif;  
                endfor;
               if($sets == $value->sets && $value->is_publish == 1):
                    $value->setAttribute('is_publish',1); //published
                elseif($sets == $value->sets && $value->is_publish != 1):
                    $value->setAttribute('is_publish',2);  //ready for publish
                elseif($sets != $value->sets && $value->is_publish == 1):
                    $value->setAttribute('is_publish',3); // published but sets with no.of questions not matching
                elseif($sets != $value->sets && $value->is_publish != 1):
                    $value->setAttribute('is_publish',4); // not published and sets with no.of questions not matching
                endif;    
                 
                $collect->put($key, $value);
            endforeach;
        endif;
        return \DataTables::of($collect)->make(true);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create(Packages $Packages)
    {
         $page_title= $this->page_title ; $active= $this->active;
        $breadcrumb = array( array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),  array ("title" => 'Packages', "url" => $this->defaultUrl ),   array ("title" => 'Create', "active" => 1,"url" => '' ),   ); 
        return view('backend::packages.create', compact('page_title','active','breadcrumb','Packages'));
   
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(PackagesRequest $request)
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
     * @param int $id
     * @return Renderable
     */
    public function publish_package(Packages $package)
    {
        if(\Request::ajax() && $package):
            $error = null;
            try
            { 
                $sets = 0; 
                for ($x = 1; $x <= $package->sets; $x++):
                    $PivoBundlePackages = \Modules\BackEnd\Entities\PivoBundlePackages::where('package_id',$package->id)->where('set_number',$x)->count();
                    if($package->questions_in_set == $PivoBundlePackages):
                        $sets+= 1; 
                    endif;  
                endfor;
               
                if($sets == $package->sets):
                    Packages::find($package->id)->update(['is_publish' => 1]); 
                else: $error = 'Package not published and sets with no.of questions not matching'; endif;
            } catch (Exception $ex) { $error = $ex->getMessage(); }
            if($error == null):      
                \Session::flash('flash-success-message','Package published successfully');
                $msg=array('type'=>'success'); 
            else: 
                \Session::flash('flash-error-message','Package not published successfully.<br/>'.$error);
                $msg=array('type'=>'error'); 
            endif; 
            return response()->json($msg, 200);
        else: abort(404); endif;
         
    }
    
   

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        $Packages = Packages::where('id',$id)->first(); 
        if($Packages): 
            $page_title= $this->page_title ; $active= $this->active;
            $breadcrumb = array(   
                                    array ("title" => 'Dashboard', "url" => URL(admin_prefix) ),
                                    array ("title" => 'Packages', "url" => $this->defaultUrl ),  
                                    array ("title" => 'Edit', "active" => 1,"url" => '' ), //only last add active page array

                               );
            $edit = true;
            return view('backend::packages.edit', compact('page_title','active','breadcrumb','Packages','edit'));
        else: abort(404); endif;
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(PackagesRequest $request, $id)
    {
         
        $Packages = Packages::where('id',$id)->first();
        if($Packages):
            if(!$request->ajax()):
            $update = $this->repository->update($request->all(), $Packages); 
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
        $Packages = Packages::where('id',$id)->first();
        if($Packages):
            if(\Request::ajax()): 
                $error = $msg = null;
                try{   if($Packages):  $Packages->delete(); endif;
                } catch (Exception $ex) {  $error = $ex->getMessage();  }

                if($error == null):      
                    \Session::flash('flash-success-message',$this->deleteMessage);
                    $msg=array('type'=>'success'); 
                else: 
                    \Session::flash('flash-error-message',$this->deleteErrorMessage);
                    $msg=array('type'=>'error'); 
                endif;
            else:
                \Session::flash('flash-error-message',$this->deleteErrorMessage);
                $msg=array('type'=>'error');
            endif;
            return response()->json($msg, 200);
        else: abort(404); endif;
    }
}
