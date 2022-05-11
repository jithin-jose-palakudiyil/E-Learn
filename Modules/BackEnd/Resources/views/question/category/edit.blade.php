@extends('backend::layouts.master')   
@section('content')  
    {!! Form::model($QuestionCategory, ['method' => 'PATCH', 'route' => ['question-category.update', $QuestionCategory->id],'class'=>'form-valide','id'=>'QuestionCategory_form','enctype'=>'multipart/form-data']) !!}     
    @include('backend::question.category.form', compact('QuestionCategory'))
    {!! Form::close() !!} 
@stop
 
             
  