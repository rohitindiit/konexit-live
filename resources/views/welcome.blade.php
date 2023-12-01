@include('header')
         <div class="form-form">
            <div class="form-form-wrap">
               <div class="form-container">
                  <div class="form-content">
                     <h1 class="">Welcome back!</h1>
                     <p class="signup-link">Please enter your login details.</p>
                      
                     @if(Session::has('message'))
                     <input type="hidden" id="sucessmessage" class="hiddenmessage" value="{{Session::get('message')}}">
                     @endif
                      @if(Session::has('message2'))
                      <input type="hidden" id="errormessage" class="hiddenmessage" value="{{Session::get('message2')}}">
                     @endif
                     
                     <form method="POST" class="text-left" action="{{ route('login.custom') }}" id="login" onsubmit="return false">
                        @csrf
                        <div class="form">
                           <div  class="field-wrapper input mb-2">
                              <label>Email</label>
                              <div class="fieldinner">
                                <input id="emailaddress" name="email" type="text" class="form-control" placeholder="Enter your email address">
                              </div>
                               @if ($errors->has('email'))
                                <span class="text-danger error">{{ $errors->first('email') }}</span>
                                @endif
                           </div>
                           <div  class="field-wrapper input mb-2">
                              <label>Password</label>
                              <div class="fieldinner">
                                 <input id="password" name="password" type="password" class="form-control" placeholder="Enter your password">
                                 <span><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/></span>
                              </div>
                               @if ($errors->has('password'))
                                <span class="text-danger error">{{ $errors->first('password') }}</span>
                                @endif
                           </div>
                           <div class="d-sm-flex justify-content-between mt-35">
                              <div class="field-wrapper">
                                 <button type="submit" class="btn btn-primary submit-button" value="">Login</button>
                              </div>
                              <div class="field-wrapper">
                                 <a href="{{url('/')}}/forgotpassword"  class="forgot-pass-link">Forgot Password?</a>
                              </div>
                           </div>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
@include('footer')