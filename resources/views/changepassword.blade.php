@include('header')

         <div class="form-form">
            <div class="form-form-wrap">
               <div class="form-container">
                  <div class="form-content">
                     <h1 class="">Change Password</h1>
                     <p class="signup-link">Please enter your new password details.</p>
                     <form method="POST" class="text-left" action="{{ route('passwordchange') }}" id="changepassword" onsubmit="return false">
                        @csrf
                        <div class="form">
                  <?php

                     $link = $_SERVER['REQUEST_URI'];
                    $link_array = explode('/',$link);
                      $page = end($link_array);
                  ?>
                  <input type="hidden" name="requesturl" value="{{$page}}">

                           <div  class="field-wrapper input mb-2">
                              <label>New Password</label>
                              <div class="fieldinner">
                                <input id="newpassword" name="newpassword" type="password" class="form-control" placeholder="Enter your new password">
                                  <span><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/></span>
                              </div>
                               @if ($errors->has('email'))
                                <span class="text-danger error">{{ $errors->first('email') }}</span>
                                @endif
                           </div>
                           <div  class="field-wrapper input mb-2">
                              <label>Confirm Password</label>
                              <div class="fieldinner">
                                 <input id="password" name="confirmpassword" type="password" class="form-control" placeholder="Enter your confirm password">
                                 <span><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/></span>
                              </div>
                               @if ($errors->has('password'))
                                <span class="text-danger error">{{ $errors->first('password') }}</span>
                                @endif
                           </div>
                           <div class="d-sm-flex justify-content-between mt-35">
                              <div class="field-wrapper">
                                 <button type="submit" class="btn btn-primary submit-button3" value="">Submit</button>
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