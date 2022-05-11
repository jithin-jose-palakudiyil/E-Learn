<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Modules\FrontEnd\Entities\Packages;
use \Auth;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index($package_id)
    {
       
        $package_id = \Crypt::decryptString($package_id);
        $package = Packages::where('id',$package_id)->where('is_publish',1)->where('status',1)->first();
        if($package):
            if(Auth::guard(user_guard)->user()): 
//                dd( Auth::guard(user_guard)->user());
                $page_title = 'Elearn - purchase package';
                return view('frontend::purchase.index', compact('page_title','package'));
            else:  
                session()->put('user_package', $package); 
                return \Redirect::route('front_user_login'); 
            endif;
        else: abort(404); endif;
       
        //return view('frontend::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('frontend::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('frontend::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('frontend::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
