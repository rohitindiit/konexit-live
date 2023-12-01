<?php 
      $role = \Session::get('admin')->role;
     
      $all_permisions=[];
     if($role=='3')
     {
         $user_id= \Session::get('admin')->id;
         $permisionObj = \App\Models\User::select('permissions')->where('id','=',$user_id)->first();
      
         if($permisionObj->permissions)
         {
             $all_permisions = json_decode($permisionObj->permissions);
         }
     }else{
         $all_permisions=['dashboard','organisations','subAdmin','forms','submissions','settings'];
     }
    
?>
<div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
               <ul class="list-unstyled menu-categories" id="accordionExample">
                  <li style="display:{{in_array('dashboard',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('dashboard')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/dashboard"  class="dropdown-toggle" aria-expanded="{{ (request()->is('dashboard')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon1.svg"/><span>Dashboard</span>
                        </div>
                     </a>
                  </li>
                  <!--<li class="menu {{ ( Route::is('perent_users') ) ? 'active' : '' }}">-->
                  <!--   <a href="{{route('all.users')}}"  class="dropdown-toggle" aria-expanded="{{ request()->is('perent_users')  ? 'true' : 'false' }}">-->
                  <!--      <div>-->
                  <!--         <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon6.svg"/><span>Users</span>-->
                  <!--      </div>-->
                  <!--   </a>-->
                  <!--</li>-->
                  <li style="display:{{in_array('organisations',$all_permisions)?'block':'none'}}"  class="menu {{ (request()->is('organisations') || request()->is('addorganisation') || request()->is('editorganisation*') || Route::is('adminorganization.users') || Route::is('organization.adduser') || request()->is('*/adduser') || request()->is('*/edituser/*') || request()->is('*/userdetails/*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/organisations"  class="dropdown-toggle" aria-expanded="{{ (request()->is('organisations') || request()->is('addorganisation') || request()->is('editorganisation*') || request()->is('users') || request()->is('*/adduser') || request()->is('*/edituser/*') || request()->is('*/userdetails/*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon6.svg"/><span>Organisations</span>
                        </div>
                     </a>
                  </li>
                  <li style="display:{{in_array('subAdmin',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('subadmin') || request()->is('add_desktop_user') || request()->is('admin-permissions*') || request()->is('editsubadmin*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/subadmin"  class="dropdown-toggle" aria-expanded="{{ (request()->is('subadmin') || request()->is('addsubadmin') || request()->is('editsubadmin*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon6.svg"/><span>Subadmin</span>
                        </div>
                     </a>
                  </li>
                  
                  <li style="display:{{in_array('forms',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('forms') || request()->is('formbuilder') || request()->is('formdetails*') || request()->is('formedit')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/forms"  class="dropdown-toggle" aria-expanded="{{ (request()->is('forms') || request()->is('formbuilder') || request()->is('formdetails*') || request()->is('formedit')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon3.svg"/><span>Forms</span>
                        </div>
                     </a>
                  </li>
                  <li style="display:{{in_array('submissions',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('submissions') || request()->is('submissionsdetails*') || request()->is('submission_media*')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/submissions"  class="dropdown-toggle" aria-expanded="{{ (request()->is('submissions') || request()->is('submissionsdetails*') || request()->is('submission_media*')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon4.svg"/><span>Submissions</span>
                        </div>
                     </a>
                  </li>
                  <li style="display:{{in_array('settings',$all_permisions)?'block':'none'}}" class="menu {{ (request()->is('profile')) ? 'active' : '' }}">
                     <a href="{{url('/')}}/profile"  class="dropdown-toggle" aria-expanded="{{ (request()->is('profile')) ? 'true' : 'false' }}">
                        <div>
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/icon5.svg"/><span>Settings</span>
                        </div>
                     </a>
                  </li>
               </ul>
               <ul class="list-unstyled menu-categories p-0" id="accordionExample1">
                  <li class="menu ">
                     <a href="{{url('/logout')}}"  class="dropdown-toggle" aria-expanded="false">
                        <div class="logout">
                           <img class="icon-sidebar" src="{{url('/')}}/resources/views/Admin/assets/img/logout.svg"/><span>Logout</span>
                        </div>
                     </a>
                  </li>
               </ul>
            </nav>
         </div>




        <!--    <div class="sidebar-wrapper sidebar-theme">
            <nav id="sidebar">
               <ul class="list-unstyled menu-categories" id="accordionExample">
                  <li class="menu">
                     <a href="{{url('/')}}/dashboard"  class="dropdown-toggle" aria-expanded="false">
                        <div>
                           <img class="icon-sidebar" src="assets/img/icon1.svg"/><span>Dashboard</span>
                        </div>
                     </a>
                  </li>
                  <li class="menu">
                     <a href="{{url('/')}}/organisations"  class="dropdown-toggle" aria-expanded="false">
                        <div>
                           <img class="icon-sidebar" src="assets/img/icon6.svg"/><span>Organisations</span>
                        </div>
                     </a>
                  </li>
                  <li class="menu">
                     <a href="{{url('/')}}/forms"  class="dropdown-toggle" aria-expanded="false">
                        <div>
                           <img class="icon-sidebar" src="assets/img/icon3.svg"/><span>Forms</span>
                        </div>
                     </a>
                  </li>
                  <li class="menu">
                     <a href="{{url('/')}}/submissions"  class="dropdown-toggle" aria-expanded="false">
                        <div>
                           <img class="icon-sidebar" src="assets/img/icon4.svg"/><span>Submissions</span>
                        </div>
                     </a>
                  </li>
                  <li class="menu active">
                     <a href="{{url('/')}}/profile"  class="dropdown-toggle" aria-expanded="true">
                        <div>
                           <img class="icon-sidebar" src="assets/img/icon5.svg"/><span>Settings</span>
                        </div>
                     </a>
                  </li>
               </ul>
               <ul class="list-unstyled menu-categories p-0" id="accordionExample1">
                  <li class="menu ">
                     <a href="{{url('/')}}"  class="dropdown-toggle" aria-expanded="false">
                        <div class="logout">
                           <img class="icon-sidebar" src="assets/img/logout.svg"/><span>Logout</span>
                        </div>
                     </a>
                  </li>
               </ul>
            </nav>
         </div> -->