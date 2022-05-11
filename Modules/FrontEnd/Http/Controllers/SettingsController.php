<?php

namespace Modules\FrontEnd\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use \Exception; use \Auth;use File;
class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $page_title = '  Elearn -  Profile';
        $page_active = 'settings';
        return view('frontend::dashboard.settings.index', compact('page_title','page_active'));
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
     * update a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function save_settings(Request $request)
    {
        $request->validate(['profile_image', 'nullable|mimes:jpg,png,jpeg,PNG,JPEG','first_name' => 'required|string|min:1','last_name' => 'required|string|min:1' ]);
         
        if(!$request->ajax()):
            $error = null;
            try
            { 
                $data['first_name'] = $request->first_name; $data['last_name'] = $request->last_name; $data['bio'] = $request->bio;
                if( $request->exists('profile_image') ):
                    $profile_iamge = $this->upload($request->profile_image, Auth::guard(user_guard)->user()->id); 
                    if(isset($profile_iamge['file_name'])):  
                        $data['profile_image'] = $profile_iamge['file_name']; 
                    endif; 
                endif;  
                \Modules\FrontEnd\Entities\Users::where('id',Auth::guard(user_guard)->user()->id)->update($data);
            } catch (Exception $ex) { $error = $ex->getMessage(); }
            if($error == null): 
                $request->session()->flash('flash-success-message','settings saved successfully'); 
            else: 
                $request->session()->flash('flash-error-message','settings not saved successfully'.'<br/> '.$error);
            endif;
            return \Redirect::back();
        else: abort(404); endif;
         
    }

    /**
     * upload the specified resource in storage.
     * @param int $id
     * @param file $file
     * @return Renderable
     */
    public function upload($file,$id)
    {
        $response = [];
        if(!empty($file)):
            $file = $file[0];  
            $path = public_path().'/uploads/students/'.$id;
            File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
            $allowedfileExtension = ['jpg','png','jpeg','JPG','PNG','JPEG']; 
            $extension = $file->getClientOriginalExtension(); 
            if(in_array($extension,$allowedfileExtension)): 
                $filenameWithExt = $file->getClientOriginalName();
                $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);  
    //            $fileNameToStore = $filename.'_'.time().'.'.$extension;
                  $fileNameToStore = $filename.'_'.date("Ymdhisa").'_'.rand().'.'.$extension; 
                if($file->move($path,$fileNameToStore)): $response['file_name'] = $fileNameToStore; endif;
            endif;  
        endif;
        return $response;
    }
    
    
    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function change_settings_password(Request $request)
    {
        $request->validate(["password"=>  "required|min:8|same:confirm_password", "confirm_password"  =>  "required|min:8|same:password", ]);
        if(!$request->ajax()):
            $error = null;
            try
            { 
                $data['password'] =  bcrypt($request->password); 
                \Modules\FrontEnd\Entities\Users::where('id',Auth::guard(user_guard)->user()->id)->update($data);
            } catch (Exception $ex) { $error = $ex->getMessage(); }
            if($error == null): 
                $request->session()->flash('flash-success-message','password changed successfully'); 
            else: 
                $request->session()->flash('flash-error-message','password is not changed successfully'.'<br/> '.$error);
            endif;
            return \Redirect::back();
        else: abort(404); endif;    
                   
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
