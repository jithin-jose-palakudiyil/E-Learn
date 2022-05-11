@extends('backend::layouts.master')   
@section('content')  
    {!! Form::model($Questions, ['method' => 'PATCH', 'route' => ['questions.update', $Questions->id],'class'=>'form-valide','id'=>'Question_form','enctype'=>'multipart/form-data']) !!}     
    @include('backend::question.questions.form', compact('Questions'))
    {!! Form::close() !!} 
@stop
 
             
  