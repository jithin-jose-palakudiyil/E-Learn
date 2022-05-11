<?php

namespace Modules\BackEnd\Repositories;

use Illuminate\Database\Eloquent\Model;
use Exception;
class QuestionRepository implements RepositoryInterface
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
        try {  
            
            $question_master = ['question'=>$data['question'],'category_id'=>$data['category_id'],'status'=>$data['status']];
            $question = $this->model->create($question_master); 
            $answer = [];
            foreach ($data['answer'] as $key => $value) :
                $answer[$key]['answer']=$value;
                if($data['correct']==$key):
                    $answer[$key]['is_correct']=1;
                else:
                    $answer[$key]['is_correct']=2;
                endif;
                 $answer[$key]['questions_id']=$question->id; 
            endforeach;
            \Modules\BackEnd\Entities\PivotQuestions::insert($answer);
           
        } catch (Exception $ex) { $response = $ex->getMessage(); }
        return  $response;
    }

    // update record in the database
    public function update(array $data, $record)
    {
        $response = null; 
         
        try{ 
            $question_master = ['question'=>$data['question'],'category_id'=>$data['category_id'],'status'=>$data['status']];
            $record->update($question_master); 
            $answer = [];
            foreach ($data['answer'] as $key => $value) :
                $answer[$key]['answer']=$value;
                if($data['correct']==$key):
                    $answer[$key]['is_correct']=1;
                else:
                    $answer[$key]['is_correct']=2;
                endif;
                $answer[$key]['questions_id']=$record->id; 
            endforeach; 
            \Modules\BackEnd\Entities\PivotQuestions::where('questions_id',$record->id)->delete();
            \Modules\BackEnd\Entities\PivotQuestions::insert($answer);
           
             
            } 
        catch (Exception $ex) { $response = $ex->getMessage(); } 
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
   
}