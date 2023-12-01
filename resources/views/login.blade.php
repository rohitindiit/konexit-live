@include('header')
         <div class="form-form">
            <div class="form-form-wrap">
               <div class="form-container">
                  <div class="form-content">
                     <h1 class="">Welcome back!</h1>
                     <p class="signup-link">Please enter your login details.</p>
                     <form class="text-left" action="dashboard.html">
                        <div class="form">
                           <div  class="field-wrapper input mb-2">
                              <label>Email</label>
                              <input id="emailaddress" name="emailaddress" type="text" class="form-control" placeholder="Enter your email address">
                           </div>
                           <div  class="field-wrapper input mb-2">
                              <label>Password</label>
                              <div class="fieldinner">
                                 <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                                 <span><img src="{{url('/assets/img/view.svg')}}"/></span>
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
@include('footer')