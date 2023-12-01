 <ul class="navbar-item flex-row search-ul">
               <li class="nav-item align-self-center search-animated">
                  <img class="toggle-search" src="{{url('/')}}/resources/views/Admin/assets/img/search.svg"/>
                  <form class="form-inline search-full form-inline search" role="search">
                     <div class="search-bar">
                        <input type="text" class="form-control search-form-control  ml-lg-auto" placeholder="Search...">
                        <img class="icon-search" src="{{url('/')}}/resources/views/Admin/assets/img/search.svg"/>
                     </div>
                  </form>
               </li>
            </ul>
            <ul class="navbar-item flex-row navbar-dropdown">
               <li class="nav-item dropdown user-profile-dropdown  order-lg-0 order-1">
                  <a href="javascript:void(0);" class="nav-link dropdown-toggle user" id="userProfileDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <span class="userimg  mr-2"><img src="{{\Config::get('site_vars.profile.profile')}}" class="img-fluid profileclass" alt="avatar"></span>  <span class="profilename">{{\Config::get('site_vars.profile.name')}} <img class="ml-1" src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down.svg"/>
                  <br>
                 <?php  $val = \Session::get('organization')->id; 
                       $newval =  "KXT".sprintf("%03d",$val);?>
                  {{$newval}}
                  </span>
                  </a>
                  <div class="dropdown-menu position-absolute" aria-labelledby="userProfileDropdown">
                     <div class="user-profile-section">
                        <div class="media mx-auto">
                           <img src="{{\Config::get('site_vars.profile.profile')}}" class="img-fluid mr-2 profileclass" alt="avatar">
                           <div class="media-body">
                              <h5 class="profilename">{{\Config::get('site_vars.profile.name')}}</h5>
                              <?php  $id = \Session::get('organization')->id; 
                              $user = App\Models\User::where('id', $id)->select('name', 'lname')->first();
                       ?>
                       
                           </div>
                        </div>
                     </div>
                     <div class="dropdown-item">
                          <a href="#">
                              <span>
                               @if( \Session::get('organization')->role=="4")
                                {{$user->name}} {{$user->lname}}
                               @endif
                               </span>
                           </a>
                    <div>
                     <div class="dropdown-item">
                        <a href="{{url('/')}}/organization/settings">
                        <span>My Profile</span>
                        </a>
                     </div>
                     <div class="dropdown-item">
                        <a href="{{url('/logout')}}">
                        <span>Log Out</span>
                        </a>
                     </div>
                  </div>
               </li>
            </ul>