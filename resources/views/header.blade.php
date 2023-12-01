<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
      <title>@if($page != 'undefined' && $page != null) {{$page}} @endif</title>
      <link rel="icon" type="image/x-icon" href="{{url('/')}}/resources/views/Admin/assets/img/favicon.ico"/>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link href="{{url('/')}}/resources/views/Admin/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="{{url('/')}}/resources/views/Admin/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/views/Admin/assets/css/custom-css.css" />
       <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/css/custome.css" />



       <!--  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script> -->



   </head>
   <body class="form">
      <div class="form-container justify-content-end">
         <div class="form-image">
            <div class="l-image">
               <img src="{{url('/')}}/resources/views/Admin/assets/img/logo.png"/>
            </div>
         </div>

      @if(Session::has('error'))  
      <div class="alert alert-danger">
      {{ Session::get('error')}} 
      </div>
      @endif

      @if(Session::has('success'))   
      <div class="alert alert-success">
      {{ Session::get('success')}} 
      </div>
      @endif
    