<?php 
     $role = \Session::get('organization')->role;
      $all_permisions=[];
     if($role=='4')
     {
         $user_id= \Session::get('organization')->id;
         $permisionObj = \App\Models\User::select('permissions')->where('id','=',$user_id)->first();
      
         if($permisionObj->permissions)
         {
             $all_permisions = json_decode($permisionObj->permissions);
         }
     }else{
         $all_permisions=['dashboard','users','sub_organisations','forms','submissions','settings','bluckedit'];
     }
    
?>
 <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
               <ul class="list-unstyled menu-categories" id="accordionExample">
                  <li style="display:{{in_array('dashboard',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('organization/dashboard')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organization/dashboard"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/dashboard')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon1.svg"/><span>Dashboard</span>
                        </div>
                     </a>
                  </li>
                  
                  <li style="display:{{in_array('users',$all_permisions)?'block':'none'}}"  class="menu {{ (request()->is('organization/user') || request()->is('organization/addusers') || request()->is('organization/editusers*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organization/user"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/user') || request()->is('organization/addusers') || request()->is('organization/editusers*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon2.svg"/><span>Users</span>
                        </div>
                     </a>
                  </li>
                    <li style="display:{{in_array('sub_organisations',$all_permisions)?'block':'none'}}" class="menu">
                     <a href="{{url('/')}}/organization/suborganiser"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/suborganiser') || request()->is('organization/org-permissions*') || request()->is('organization/addsuborgview*')|| request()->is('organization/editsuborgview*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon2.svg"/><span>suborganiser</span>
                        </div>
                     </a>
                  </li>
                  <li style="display:{{in_array('forms',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('organization/forms') || request()->is('organization/formdetails*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organization/forms"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/forms') || request()->is('organization/formdetails*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon3.svg"/><span>Forms</span>
                        </div>
                     </a>
                  </li>
                  <li style="display:{{in_array('submissions',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('organization/submissions') || request()->is('organization/submissionsdetails*') || request()->is('organization/submission_media*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organization/submissions"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/submissions') || request()->is('organization/submissionsdetails*') || request()->is('organization/submission_media*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon4.svg"/><span>Submissions</span>
                        </div>
                     </a>
                  </li>
                   <li style="display:{{in_array('submissions',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('organization/document') || request()->is('organization/document*') || request()->is('organization/assgindoc*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organization/document"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/document') || request()->is('organization/document*') || request()->is('organization/assgindoc*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon4.svg"/><span>Documents</span>
                        </div>
                     </a>
                  </li>
                  <li style="display:{{in_array('settings',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('organization/settings')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organization/settings"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organization/settings')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/icon5.svg"/><span>Settings</span>
                        </div>
                     </a>
                  </li>
               </ul>
               <ul class="list-unstyled menu-categories p-0" id="accordionExample1">
                  <li class="menu ">
                     <a href="{{url('/logout')}}"  class="dropdown-toggle" aria-expanded="false">
                        <div class="logout">
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/organization/assets/img/logout.svg"/><span>Logout</span>
                        </div>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>