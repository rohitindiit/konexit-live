@include('organization.layout.header')
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('organization.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row mb-3 layout-top-spacing align-items-center">
                  <div class="col-xl-7 col-12 px-2 ">
                     <h1 class="headmain mb-0">Inactive Users <span>({{count($inactive)}} out of {{$mydata->total_users}} added)</span></h1>
                     <p  class="subhead  mb-0">List of inactive users today within your Organisation</p>
                  </div>
                  <div class="col-xl-5 col-12 px-2 text-right">
                     <!--<button class="btn btn-primary btn2 mr-2" data-toggle="modal" data-target="#importModal">Import CSV</button>-->
                     <!--<a href="{{url('/')}}/organization/addusers" class="btn btn-primary">+ Add User</a>-->
                  </div>
               </div>
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                           <div class="table-responsive">
                              <div class=" py-4 p-3 searchfilter">
                                 <div class="row ">
                                    <div class="col-md-6">
                                       <div class="dropdown filterdrop">
                                          <a class="dropdown-toggle " href="javascript:void(0);" id="dropdownMenuLink104" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                          <span><img src="{{url('/')}}/resources/views/organization/assets/img/filter.svg"/> Filters</span> <img src="{{url('/')}}/resources/views/organization/assets/img/arow-down6.svg"/>
                                          </a>
                                          <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink104">
                                             <h2>Filters</h2>
                                             <div class="form-group">
                                                <label>Status</label>
                                                <select class="form-control">
                                                   <option>Active</option>
                                                   <option>Inactive</option>
                                                </select>
                                             </div>
                                             <div class="form-group">
                                                <label>Created On</label>
                                                <select class="form-control">
                                                   <option>All Time</option>
                                                </select>
                                             </div>
                                             <div class="btn-bottom text-left mt-3">
                                                <button  class="btn btn-secondary btn-outline-secondary">Reset</button>
                                                <button class="btn btn-primary">Apply</button>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                       <input type="text" placeholder="Search"  class="searchtable" id="searchtop">
                                    </div>
                                 </div>
                              </div>
                              <table   class="table table-head-custom">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                       <th>
                                          <div class="th-content">First Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Last Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                       
                                       <th>
                                          <div class="th-content">Status</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Last Login</div>
                                       </th>
                                         <th>
                                          <div class="th-content">Last Activity</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Date Created</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                      @if(isset($users) && count($users) > 0)
                                       @foreach($users as $u)
                                       @if(in_array($u->id,$inactive))
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop2 actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/organization/editusers/{{$u->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/edit.svg"/> Edit</a>
                                                   <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/> Delete</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$u->name}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$u->lname}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$u->email}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content switchstatus">
                                             <label class="switch s-success">
                                             <input type="checkbox" data-id="{{$u->id}}" data-table="users" data-url="{{url('/change-users-status/'.$u->parent_id)}}" data-toggle="modal" data-target="#exampleModal2" class="changestatus"  @if($u->status == '1') checked @endif>
                                             <span class="slider round"></span>		
                                             <span class="active"></span> 												
                                             <span  class="inactive"></span> 												
                                             </label>
                                          </div>
                                       </td>
                                       <td><div class="td-content"> <?php
                                              if($u->last_login)
                                              {
                                                   $datetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s.u', $u->last_login);
                                                      echo $formattedDateTime = $datetime->format('j M Y h:i A');
                                              }else{
                                                  echo "No Info";
                                              }
                                                     
                                              ?></td></div>
                                                <td>
                                           <?php $activity = \App\Models\UserActivity::where('user_id','=',$u->id)->latest()->first();
                                           if($activity)
                                           {
                                                 $dateTime = \Carbon\Carbon::parse($activity->created_at);

                                                // Format the date in the desired format
                                                $formattedDate = $dateTime->format('d M Y h:i A');
                                           }
                                          
                                           ?>
                                            <div class="td-content">{{$activity?$formattedDate:'N/A'}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{date('j M Y', strtotime($u->created_at))}}</div>
                                       </td>
                                    </tr>
                                    @endif
                                    @endforeach
                                    @endif
                                
                                 </tbody>
                              </table>
                           </div>
                        </div>
                        <div class="d-flex justify-content-center" id="paginationContainer">
                             {!! $users->links() !!}
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
                   <form method="POST" action="{{ route('process.csv') }}" enctype="multipart/form-data">
              @csrf
                  <h5 class="modal-title">Import CSV</h5>
                  <div class="modal-inner">
                     <div class="form-group text-right">
                        <a href="{{ route('download.csv') }}" class="downloadsample">Download sample</a>
                        <div class="uploadcsv mt-2">
                           <label for="uploadcsv">
                              <img src="{{url('/')}}/resources/views/organization/assets/img/csv.png"/>
                              <p id="selectedFileName">Select csv file</p>
                           </label>
                           <input type="file" id="uploadcsv" name="csv_file" accept=".csv" style="display:none" onchange="updateFileName(event)"/>
                        </div>
                     </div>
                  </div>
                  <button type="button" class="btn btn-secondary btn-outline-secondary mr-2" data-dismiss="modal" onclick="clearFile()">Cancel</button>
                  <button type="submit" class="btn btn-primary">Submit</button>
                   </form>
               </div>
              
            </div>
         </div>
      </div>
      @include('organization.layout.footer')
      <script>
    function updateFileName(event) {
        const fileInput = event.target;
        const label = document.getElementById('selectedFileName');

        if (fileInput.files.length > 0) {
            label.innerText = fileInput.files[0].name;
        } else {
            label.innerText = 'Select csv file';
        }
    }
    
     function clearFile() {
        const fileInput = document.getElementById('uploadcsv');
        const label = document.getElementById('selectedFileName');

        fileInput.value = ''; // Clear the file input value
        label.innerText = 'Select csv file'; // Reset the label text
    }
</script>

<script>
    $(document).ready(function(){
        
        $(document).ready(function() {
            var oTable = $('#user_table').DataTable({
        	    	// "sDom": "<'row'<'col-sm-12'tr>>" +
        	        //         "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        		    processing: true,
        		    serverSide: true,
        		    ajax: { 
        		    	url: '{{ route("get_UsersListing") }}', 
        		    	data : function (d) {
        		            d.name = $('input[name=name]').val();
        		            d.status = $('input[name=status]').val();
        		        },
        		        error : function (jqXHR, textStatus, error) {
        				    if (jqXHR && jqXHR.status == 401) {
        				      // Session expired - do something here
        				        Swal.fire({
        					        title: "Session Expired!",
        					        text: "You need to relogin!",
        					        icon: "warning",
        					        showCancelButton: false,
        					        confirmButtonText: "Login"
        					    }).then(function(result) {
        					        if (result.value) {
        					            location.reload();
        					        }
        					    });
        				    } else {
        				      // Some other error - do something here
        				      Swal.fire('Error','Something went wrong! Please try again after some time.', "error");
        				    }
        				}
        	        },
        		    ordering: true,
        		    button: false,
        		    scrollX: true,
        		    scrollCollapse: true,
        		    // stateSave: true,
        			searching : false,
                    responsive: true,
        		    language: {
        		            },
        		    oLanguage: {
        	            sEmptyTable: 'No records found!!',
        	        },
        		    columns: [    
        		                {
        		                    data: 'action',
        		                    name: 'Action',
        	                        orderable: false
        		                },
        		                {
        		                    data: 'name',
        		                    name: 'First Name'
        		                }, 
        		                {
        		                    data: 'lname',
        		                    name: 'Last Name'
        		                },
        		                {
        		                    data: 'email',
        		                    name: 'Email'
        		                },
        		                {
        		                    data: 'status',
        		                    name: 'Status'
        		                },
                                {
        		                    data: 'last_login',
        		                    name: 'Last Login'
        		                },
        		                {
        		                    data: 'created_at',
        		                    name: 'Date Created'
        		                },
        		                
        		            ]
        	    });
        
        	    $('#search-tableForm').on('submit', function(e) {
        	         oTable.order([5,'desc']).draw();
        	        e.preventDefault();
        	    });
             //for filters
             oTable.order([5,'desc']).draw();
             });
            });

</script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"> 
</script>