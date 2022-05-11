@extends('backend::layouts.master')  
@section('content')  
    {!! Form::model($Questions, ['method' => 'POST', 'route' => ['questions.store'],'class'=>'form-valide','id'=>'Question_form','enctype'=>'multipart/form-data']) !!}    
    @include('backend::question.questions.form',compact($Questions)) 
    {!! Form::close() !!} 
@stop
 
             
  