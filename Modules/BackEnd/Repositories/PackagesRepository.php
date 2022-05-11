<?php

namespace Modules\BackEnd\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception; use \File;
class PackagesRepository implements RepositoryInterface
{
    // model property on class instances
    protected $model;

    // Constructor to bind model to repo
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    // Get all instances of model
    public function all()
    {
        return $this->model->all();
    }

    // create a new record in the database
    public function create(array $data)
    {
        $response = null; 
        try 
        { 
            
            if(isset($data['_token'])):
                unset($data['_token']);
            endif;  
            
                if(isset($data['package_image'])):
                    $package_image = $this->upload($data['package_image']);  
                    if(isset($package_image['file_name'])): 
                        $data['package_image'] = $package_image['file_name']; 
                    endif; 
                endif;
                
                
            $create = $this->model->create($data); 
//            if($create):
//                $bundle = [];
//                for ($x = 1; $x <= $create->sets; $x++) :
//                    $bundle[$x]['package_id']=$create->id;
//                    $bundle[$x]['bundle_number']=$x;
//                endfor;
//                if(!empty($bundle)):
//                    \Modules\BackEnd\Entities\PivoBundlePackages::insert($bundle);
//                endif;  
//            endif; 
        } catch (Exception $ex) { $response = $ex->getMessage(); }
        return  $response;
    }

    // update record in the database
    public function update(array $data, $record)
    {
        $response = null; 
        
        try
        {
            if(isset($data['_token'])): unset($data['_token']);  endif; 
            if(!isset($data['is_offer'])):
                $data['is_offer'] = 2;
                $data['offer_price'] = null;
            endif;
            if(isset($data['package_image'])):
                $package_image = $this->upload($data['package_image']);  
                if(isset($package_image['file_name'])): 
                    $data['package_image'] = $package_image['file_name']; 
                endif; 
            endif;
                
            if(isset($data['questions_in_set'])): unset($data['questions_in_set']);  endif; 
            if(isset($data['sets'])): unset($data['sets']);  endif; 
            $record->update($data);   
//            $bundle = [];
//            for ($x = 1; $x <= $record->sets; $x++) :
//                $bundle[$x]['package_id']=$record->id;
//                $bundle[$x]['bundle_number']=$x;
//            endfor;
//            if(!empty($bundle)):
//                \Modules\BackEnd\Entities\PivoBundlePackages::where('package_id',$record->id)->delete();
//                \Modules\BackEnd\Entities\PivoBundlePackages::insert($bundle);
//            endif; 
        } catch (Exception $ex) { $response = $ex->getMessage(); } 
        return $response;
    }

    // remove record from the database
    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    // show the record with the given id
    public function show($id)
    {
        return $this->model-findOrFail($id);
    }

    // Get the associated model
    public function getModel()
    {
        return $this->model;
    }

    // Set the associated model
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    // Eager load database relationships
    public function with($relations)
    {
        return $this->model->with($relations);
    }
    
    
        public function upload($file)
    {
        $response = [];
        $path = public_path().'/uploads/package_image/';
        File::isDirectory($path) or File::makeDirectory($path, 0777, true, true);
        $allowedfileExtension = ['jpg','png','jpeg','pdf','JPG','PNG','JPEG','PDF']; 
        $extension = $file->getClientOriginalExtension(); 
        if(in_array($extension,$allowedfileExtension)): 
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);  
              $fileNameToStore = $filename.'_'.date("Ymdhisa").'_'.rand().'.'.$extension;
           
            if($file->move($path,$fileNameToStore)): $response['file_name'] = $fileNameToStore; endif;
        endif;  
        return $response;
    }
   
}