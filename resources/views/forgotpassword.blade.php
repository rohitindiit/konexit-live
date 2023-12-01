@include('header')
         <div class="form-form">
            <div class="form-form-wrap">
               <div class="form-container">
                  <div class="form-content">
                     <h1 class="">Forgot Your Password!</h1>
                     <p class="signup-link">Please enter your email detail below to reset your password.</p>
                     <form method="POST" class="text-left" action="{{ route('forgetpassword') }}" id="forgetform" onsubmit="return false">
                        @csrf
                        <div class="form">
                           <div  class="field-wrapper input mb-2 fieldinner">
                              <label>Email</label>
                              <input id="emailaddress" name="email" type="text" class="form-control" placeholder="Enter your email address">
                           </div>
                           <div class="d-sm-flex justify-content-between mt-35">
                              <div class="field-wrapper">
                                 <button type="submit" class="btn btn-primary submit-button1" value="">Reset Your Password</button>
                              </div>
                              <div class="field-wrapper">
                                 <a href="{{url('/')}}"  class="forgot-pass-link">Back To Login</a>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      @include('footer')