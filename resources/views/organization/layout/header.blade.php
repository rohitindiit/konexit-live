<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>Konexit | organization @if($page != 'undefined' && $page != null) {{$page}} @endif</title>
      <link rel="icon" type="image/x-icon" href="{{url('/')}}/resources/views/organization/assets/img/favicon.ico"/>
      <link href="{{url('/')}}/resources/views/organization/assets/css/loader.css" rel="stylesheet" type="text/css" />
      <script src="{{url('/')}}/resources/views/organization/assets/js/loader.js"></script>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link href="{{url('/')}}/resources/views/organization/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="{{url('/')}}/resources/views/organization/assets/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
      <link href="{{url('/')}}/resources/views/organization/assets/css/plugins.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/views/organization/assets/css/widgets/modules-widgets.css">
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/views/Admin/assets/css/custom-css.css" />
      <link rel="stylesheet" type="text/css" href="{{url('/')}}/resources/views/Admin/assets/css/custom.css" />
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGkrWW6F88zP1dHFVVwknfHv-o-NBal1U"></script>
      <script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
     <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
   </head>
   <body class="sidebar-noneoverflow">
      <!-- BEGIN LOADER -->
      <div id="load_screen">
         <div class="loader">
            <div class="loader-content">
               <div class="spinner-grow align-self-center"></div>
            </div>
         </div>
      </div>
      <!--  END LOADER -->
      <div class="header-container fixed-top">
         <header class="header navbar navbar-expand-sm">
            <ul class="navbar-nav theme-brand flex-row  text-center">
               <li class="nav-item theme-logo">
                  <a href="{{url('/')}}/organization/dashboard">
                  <img src="{{url('/')}}/resources/views/organization/assets/img/logo.png" class="navbar-logo" alt="logo">
                  </a>
               </li>
               <li class="nav-item toggle-sidebar">
                  <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                  <img src="{{url('/')}}/resources/views/organization/assets/img/toggle.svg"/>
                  </a>
               </li>
            </ul>
            @include('organization.layout.usermenu')
         </header>
      </div>
      
      
    @if(Session::has('success'))
                     <input type="hidden" id="sucessmessage" class="hiddenmessage" value="{{ session('success') }}">
                     @endif
                      @if($errors->has('error'))
                      <input type="hidden" id="errormessage" class="hiddenmessage" value="{{ $errors->first('error') }}">
                     @endif
                     
                      @if(Session::has('error'))
                      <input type="hidden" id="errormessage" class="hiddenmessage" value="{{ session('error') }}">
                     @endif
                     
               <!--  END NAVBAR  -->
      
                <!-- Display success message -->
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @if(session()->has('failed'))
                    <div class="alert alert-success">
                        {{ session()->get('failed') }}
                    </div>
                @endif
            <!-- Display error message -->
                @if($errors->has('error'))
                    <div class="alert alert-danger">
                        {{ $errors->first('error') }}
                    </div>
                @endif


      <!--  END NAVBAR  -->