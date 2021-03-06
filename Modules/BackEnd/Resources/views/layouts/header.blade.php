<!DOCTYPE html>
<html style="overflow-x: hidden; padding: 0px; margin: 0px; height: 100%; width: 100%" lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title><?php  if (isset($page_title)){ echo $page_title; }  ?></title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="{{asset('Modules/BackEnd/Resources/assets/global_assets/css/icons/icomoon/styles.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('Modules/BackEnd/Resources/assets/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('Modules/BackEnd/Resources/assets/assets/css/core.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('Modules/BackEnd/Resources/assets/assets/css/components.min.css')}}" rel="stylesheet" type="text/css">
	<link href="{{asset('Modules/BackEnd/Resources/assets/assets/css/colors.min.css')}}" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/loaders/pace.min.js')}}"></script>
	<script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/core/libraries/jquery.min.js')}}"></script>
	<script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/core/libraries/bootstrap.min.js')}}"></script>
	<script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/loaders/blockui.min.js')}}"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/plugins/ui/nicescroll.min.js')}}"></script>
	<script src="{{asset('Modules/BackEnd/Resources/assets/assets/js/app.js')}}"></script>
	<script src="{{asset('Modules/BackEnd/Resources/assets/global_assets/js/demo_pages/layout_fixed_custom.js')}}"></script>
	<!-- /theme JS files -->
       
        <!-- custom stylesheets -->
        @yield('css') 
        <!-- /custom stylesheets -->
        
        <!-- custom style -->
        @stack('style')
        <!-- custom style -->
        
        <!-- custom js top -->
         @yield('jstop') 
        <!-- /custom js top -->
        <script type="application/javascript">
            var base_url = "{{url('/')}}";
            var admin_prefix = "{{admin_prefix}}";
        </script>

</head>