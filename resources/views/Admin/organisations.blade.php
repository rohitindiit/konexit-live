@include('Admin.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('Admin.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row mb-3 layout-top-spacing align-items-center">
                  <div class="col-xl-7 col-12 px-2 ">
                     <h1 class="headmain mb-0">Organisations</h1>
                     <!--<p  class="subhead  mb-0">Here are some tips and setup tasks to help you get started</p>-->
                  </div>
                  <div class="col-xl-5 col-12 px-2 text-right">
                     <button class="btn btn-primary btn2 mr-2" data-toggle="modal" data-target="#importModal">Import CSV</button>
                     <a href="{{url('/')}}/addorganisation" class="btn btn-primary btn2">Add Organisation</a>
                  </div>
               </div>
               @csrf
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                           
                              <div class=" py-4 p-3 searchfilter">
                                 <div class="row ">
                                    <div class="col-md-6">
                                       <div class="dropdown filterdrop">
                                          <a class="dropdown-toggle " href="javascript:void(0);" id="dropdownMenuLink104" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span><img src="{{url('/')}}/resources/views/Admin/assets/img/filter.svg"/> Filters</span> <img src="{{url('/')}}/resources/views/Admin/assets/img/arow-down6.svg"/>
                                          </a>
                                          <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink104">
                                             <form action="{{ url('/organisations') }}" method="GET"  id="editorganisationform" >
                                             <h2>Filters</h2>
                                             <div class="form-group">
                                                <label>Search By Name OR Email</label>
                                                <!-- <select class="form-control">
                                                   <option>Acme Corp</option>
                                                   <option>Stark Industries</option>
                                                   <option>Ollivander's Wand</option>
                                                   <option>Wayne Enterprises</option>
                                                   <option>Cyberdyne</option>
                                                   <option>Genco Pura Olive</option>
                                                   <option>Duff Beer</option>
                                                   <option>Wonka Industries</option>
                                                </select> -->
                                                <input type="text" name="search" placeholder="Search"  class="searchtable" id="searchtop">
                                             </div>
                                             <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control" name="status">
                                                   <option value="">All</option>
                                                   <option value="1">Active</option>
                                                   <option value="0">Inactive</option>
                                                </select>
                                             </div>
                                             <div class="btn-bottom text-left mt-3">
                                                <button  class="btn btn-secondary btn-outline-secondary">Reset</button>
                                                <button class="btn btn-primary" type="submit">Apply</button>
                                             </div>
                                             </form>
                                          </div>
                                       </div>
                                    </div>

                                    <!-- <div class="col-md-6 text-right">
                                       <input type="text" placeholder="Search"  class="searchtable" id="searchtop">
                                    </div> -->
                                 </div>
                              </div>
                              <div class="table-responsive">
                              <table class="table"  id="example">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Action</div>
                                       </th>
                                        <th>
                                          <div class="th-content">Id</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Company Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Status</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Logo</div>
                                       </th>
                                       <th>
                                          <div class="th-content">App Quota</div>
                                       </th>
                                        <th>
                                          <div class="th-content">Desktop Quota</div>
                                       </th>
                                        <th>
                                          <div class="th-content">Date Created</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                     @php
                                        $index = 1;
                                    @endphp

                                    @if(isset($organisations) && count($organisations) > 0)
                                       @foreach($organisations as $o)
                                    <tr>
                                       
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation/{{$o->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item deleteclass" data-id="{{$o->id}}" data-table="organizations" data-url="{{url('/delete-organization')}}" href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/{{$o->id}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms/{{$o->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions/{{$o->id}}"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                            @php
                                            $index1 = $formatted_number = sprintf("%03d", $o->id);
                                            $index++;
                                        @endphp
                                          <div class="td-content">KXT{{ $index1 }}
                                       </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$o->name}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$o->email}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" value="1" data-id="{{$o->id}}" data-table="organizations" data-url="{{url('/change-organization-status')}}" data-toggle="modal" data-target="#exampleModal2" class="changestatus"  @if($o->status == '1') checked @endif  >
                                             <span class="slider round"></span>		
                                             <span class="active"></span> 												
                                             <span  class="inactive"></span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img class="profile-img" src="{{$o->profile}}"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$o->total_users.'/'.$o->user_quota}}</div>
                                       </td>
                                         <td>
                                          <div class="td-content">{{App\Models\User::where('role', '!=', 2)->where('parent_id', '=', $o->id)->count().'/'.$o->desktop_quota}}</div>
                                       </td>
                                        <td>
                                            <?php 
                                           
                                                $carbonDate = \Carbon\Carbon::parse($o->created_at);
                                                $formattedDate = $carbonDate->format('d M Y');
                                            
                                            ?>
                                          <div class="td-content">{{$formattedDate}}</div>
                                       </td>
                                    </tr>
                                     @endforeach
                                       @endif
                                   <!--  <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Aidabugg347@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" >
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo2.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">105/169</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Alliegrater@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" checked>
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo3.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">20/50</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Ollivander's Wand</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Cherryblossom99@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" checked>
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo4.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">56/93</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Gekko & Co</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Isabelleringing@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox">
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo5.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">20/50</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Wayne Enterprises</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Eleendover22@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox">
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo6.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">105/169</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Wayne Enterprises</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Eleendover22@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox">
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo6.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">56/93</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/Admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/Admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/Admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Cyberdyne</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Hugh94@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" checked>
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/admin/assets/img/org-logo7.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">20/50</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Genco Pura Olive</div>
                                       </td>
                                       <td>
                                          <div class="td-content">greentheresa@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" checked>
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/admin/assets/img/org-logo8.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">56/93</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/editorganisation"><img src="{{url('/')}}/resources/views/admin/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/admin/assets/img/delete.svg"/> Delete</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/users"><img src="{{url('/')}}/resources/views/admin/assets/img/dashicon1.png"/> Users</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/forms"><img src="{{url('/')}}/resources/views/admin/assets/img/dashicon2.png"/> Forms</a>
                                                   <a class="dropdown-item" href="{{url('/')}}/submissions"><img src="{{url('/')}}/resources/views/admin/assets/img/dashicon3.png"/> Submissions</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">Duff Beer</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Eleendover22@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" checked>
                                             <span class="slider round"></span>		
                                             <span class="active">Active</span> 												
                                             <span  class="inactive">Inactive</span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/admin/assets/img/org-logo9.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">56/93</div>
                                       </td>
                                    </tr> -->
                                 </tbody>
                              </table>


                           </div>
                            
                                      
                            
                        </div>
                        <div class="d-flex justify-content-center">
                                         {!! $organisations->links() !!}
                                      </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Import CSV Modal Start -->
      <div class="modal fade modalform" id="importModal" tabindex="-1" aria-labelledby="importModalLabel" aria-hidden="true">
         <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
               <div class="modal-body">
                  <h5 class="modal-title">Import CSV</h5>
                  <div class="modal-inner">
                     <div class="form-group text-right">
                        <a href="{{ route('download.csvadmin') }}" class="downloadsample">Download sample</a>
                        <div class="uploadcsv mt-2">
                           <label for="uploadcsv">
                              <img src="{{url('/')}}/resources/views/admin/assets/img/csv.png"/>
                              <p>Select csv file</p>
                           </label>
                           <input type="file" id="uploadcsv" name="uploadcsv" style="display:none"/>
                        </div>
                     </div>
                  </div>
                  <button type="button" class="btn btn-secondary btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button>
                  <button type="button" class="btn btn-primary">Submit</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Import CSV Modal Ends -->
    @include('Admin.layout.footer')