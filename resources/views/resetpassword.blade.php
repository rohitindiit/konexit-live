@include('header')
         <div class="form-form">
            <div class="form-form-wrap">
               <div class="form-container">
                  <div class="form-content">
                     <h1 class="">Enter OTP!</h1>
                     <p class="signup-link">Please enter otp sent to your email.</p>
                     <form method="POST" class="text-left" action="{{ route('verifyotp') }}" id="verifyotpform" onsubmit="return false" data-group-name="digits" autocomplete="off">
                        @csrf

                         <?php

 $link = $_SERVER['REQUEST_URI'];
    $link_array = explode('/',$link);
   $page = end($link_array);
                         ?>
<input type="hidden" name="requesturl" value="{{$page}}">

                        <div class="form">
                           <div  class="field-wrapper input mb-2 fieldinner  digit-group">

                              <input type="text" id="digit-1" class="inputcl" name="digit1" data-next="digit-2"  />
                              <input type="text" id="digit-2" class="inputcl" name="digit2" data-next="digit-3" data-previous="digit-1"  />
                              <input type="text" id="digit-3" class="inputcl" name="digit3" data-next="digit-4" data-previous="digit-2"  />
                              <input type="text" id="digit-4" class="inputcl" name="digit4" data-next="digit-5" data-previous="digit-3"  />
                           </div>
                           <em id="digit4-error" class="error help-block" style="display:none;">Please enter a otp</em>
                           <div class="d-sm-flex justify-content-between mt-35">
                              <div class="field-wrapper">
                                 <button type="submit" class="btn btn-primary submit-button2" value="">Confirm</button>
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