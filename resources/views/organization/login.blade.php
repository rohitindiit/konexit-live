<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
      <title>Login</title>
      <link rel="icon" type="image/x-icon" href="{{url('/')}}/resources/views/organization/assets/img/favicon.ico"/>
      <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
      <link href="{{url('/')}}/resources/views/organization/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
      <link href="{{url('/')}}/resources/views/organization/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
   </head>
   <body class="form">
      <div class="form-container justify-content-end">
         <div class="form-image">
            <div class="l-image">
               <img src="{{url('/')}}/resources/views/organization/assets/img/logo.png"/>
            </div>
         </div>
         <div class="form-form">
            <div class="form-form-wrap">
               <div class="form-container">
                  <div class="form-content">
                     <h1 class="">Welcome back!</h1>
                     <p class="signup-link">Please enter your login details.</p>
                     <form class="text-left" action="{{url('/')}}/organization/dashboard">
                        <div class="form">
                           <div  class="field-wrapper input mb-2">
                              <label>Email</label>
                              <input id="emailaddress" name="emailaddress" type="text" class="form-control" placeholder="Enter your email address">
                           </div>
                           <div  class="field-wrapper input mb-2">
                              <label>Password</label>
                              <div class="fieldinner">
                                 <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                                 <span><img src="{{url('/')}}/resources/views/organization/assets/img/view.svg"/></span>
                              </div>
                           </div>
                           <div class="d-sm-flex justify-content-between mt-35">
                              <div class="field-wrapper">
                                 <button type="submit" class="btn btn-primary" value="">Login</button>
                              </div>
                              <div class="field-wrapper">
                                 <a href="forgotpassword.html"  class="forgot-pass-link">Forgot Password?</a>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <script src="{{url('/')}}/resources/views/organization/assets/js/libs/jquery-3.1.1.min.js"></script>
      <script src="{{url('/')}}/resources/views/organization/assets/bootstrap/js/popper.min.js"></script>
      <script src="{{url('/')}}/resources/views/organization/assets/bootstrap/js/bootstrap.min.js"></script>
   </body>
</html>