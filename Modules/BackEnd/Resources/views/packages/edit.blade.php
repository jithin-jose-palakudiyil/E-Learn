@extends('backend::layouts.master')   
@section('content')  
    {!! Form::model($Packages, ['method' => 'PATCH', 'route' => ['packages.update', $Packages->id],'class'=>'form-valide','id'=>'packages_form','enctype'=>'multipart/form-data']) !!}     
    @include('backend::packages.form', compact('Packages'))
    {!! Form::close() !!} 
@stop
 
             
  