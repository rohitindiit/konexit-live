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
                     <h1 class="headmain mb-0">Users <span>({{$mydata->total_users}} out of {{$mydata->user_quota}} added)</span></h1>
                     <p  class="subhead  mb-0">List of users within your Organisation</p>
                  </div>
                  <div class="col-xl-5 col-12 px-2 text-right">
                     <!--<button class="btn btn-primary btn2 mr-2" data-toggle="modal" data-target="#importModal">Import CSV</button>-->
                      <a href="{{url('/')}}/organization/userServiceExport" class="btn btn-primary">Export Csv</a>
                     <a href="{{url('/')}}/organization/addusers" class="btn btn-primary">+ Add User</a>
                  </div>
               </div>
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                          
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
                                               <select id="statusFilter" class="form-control">
                                                  <option value="">All</option>
                                                  <option value="1">Active                </option>
                                                  <option value="0">Inactive              </option>
                                               </select>
                                            </div>
                                            <div class="form-group">
                                               <label>Created On</label>
                                               <select id="createdOnFilter" class="form-control">
                                                  <option value="">All Time</option>
                                               </select>
                                            </div>
                                            <div class="btn-bottom text-left mt-3">
                                               <button id="resetFilterBtn" class="btn btn-secondary btn-outline-secondary">Reset</button>
                                               <button id="applyFilterBtn" class="btn btn-primary">Apply</button>
                                            </div>

                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                       <input type="text" placeholder="Search"  class="searchtable" id="searchtop">
                                    </div>
                                 </div>
                              </div>
                              <div class="table-responsive">
                              <!--<table   class="table table-head-custom" id="user_table">-->
                              <table   class="table table-head-custom" >
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                         <th>
                                          <div class="th-content">ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">First Name</div>
                                       </th>
                                       
                                       <th>
                                          <div class="th-content">Last Name </div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                      
                                       <th>
                                          <div class="th-content">Division</div>
                                       </th>
                                        @if(\Session::get('organization')->role!=4)
                                       <th>
                                          <div class="th-content">Status</div>
                                       </th>
                                       @endif
                                        <th>
                                          <div class="th-content">Device</div>
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
                                                     @if($u->token!='')
                                                    <a class="dropdown-item" href="{{url('/')}}/organization/logoutforapp/{{$u->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/logout.svg"/> Disconnect device</a>
                                                    @endif
                                                    <a class="dropdown-item" href="{{url('/')}}/organization/watchuseractivity/{{$u->id}}"><img src="{{url('/')}}/resources/views/organization/assets/img/icon1.svg"/> User Activity</a>
                                                </div>
                                               
                                             </div>
                                          </div>
                                       </td>
                                         @php
                                            $index1 = $formatted_number = sprintf("%03d", $u->id);
                                           
                                         @endphp
                                        <td>
                                          <div class="td-content">APP{{$index1}}</div>
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
                                          <div class="td-content">{{$u->division?$u->division:'Not Assigned'}}</div>
                                       </td>
                                        @if(\Session::get('organization')->role!=4)
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
                                        @endif
                                        <td><div class="td-content"> {{
                                              $u->device_name? $u->device_name:'None';
                                   
                                             }}</td></div>
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
                                    @endforeach
                                    @endif
                                 
                                 </tbody>
                              </table>
                           </div>
                        </div>
                         <div class="d-flex justify-content-center">
                                 {{ $users->links()}}
                                      </div>
                        <div class="d-flex justify-content-center" id="paginationContainer">
                            
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

   
$(document).ready(function() {
  
    function genrateDataTable(created='',status=''){
      otable =   $('#user_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: '{{ route("get_UsersListing") }}',
            data: function(d) {
                d.created = created
                d.status = status;
            },
            error: function(jqXHR, textStatus, error) {
                if (jqXHR && jqXHR.status == 401) {
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
                    Swal.fire('Error', 'Something went wrong! Please try again after some time.', "error");
                }
            }
        },
        ordering: true,
        
        scrollX: true,
        scrollCollapse: true,
        searching: true, // Enable searching
         searchable: true,
        responsive: true,
        language: {
            paginate: {
                previous: '‹', // Custom previous icon
                next: '›' // Custom next icon
            },
            search: '<span>Search:</span> _INPUT_', // Custom search label
            searchPlaceholder: 'Enter search term', // Custom search placeholder
        },
        oLanguage: {
            sEmptyTable: 'No records found!!',
        },
        columns: [
            {
                data: 'action',
                name: 'Action',
                orderable: false,
                render: function(data, type, full, meta) {
                    return `
                        <div class="dropdown actiondrop2 actiondrop">
                            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                Action <img src="{{url('/')}}/resources/views/organization/assets/img/arrow-down2.svg"/>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                <a class="dropdown-item" href="{{url('/')}}/organization/editusers/${full.id}"><img src="{{url('/')}}/resources/views/organization/assets/img/edit.svg"/> Edit</a>
                                <a class="dropdown-item" href="javascript:void(0);"><img src="{{url('/')}}/resources/views/organization/assets/img/delete.svg"/> Delete</a>
                            </div>
                        </div>
                    `;
                }
            },
            {
                data: 'name',
                name: 'First Name',
                searchable: true // Enable searching for this column
            },
            {
                data: 'lname',
                name: 'Last Name',
                searchable: true // Enable searching for this column
            },
            {
                data: 'email',
                name: 'Email',
                searchable: true // Enable searching for this column
            },
            {
                data: 'status',
                name: 'Status',
                searchable: false, // Disable searching for this column
                // Use a select filter for this column
                render: function(data, type, full, meta) {
               
                    var statusText = (full.status=="1") ? 'Active' : 'Inactive';
                    return statusText;
                }
            },
            {
                data: 'last_login',
                name: 'Last Login',
                searchable: true // Enable searching for this column
            },
            {
                data: 'created_at',
                name: 'Date Created',
                searchable: false, // Disable searching for this column
                // Use a date range filter for this column
                render: function(data, type, full, meta) {
              
                    
                    return full.created_at;
                }
            }
        ]
    });
    } 
    
    genrateDataTable('','1');


   
    $("#searchtop").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        
        $("table tbody tr").filter(function() {
          $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
      });
  
    // Event handler for the Apply button
    $('#applyFilterBtn').on('click', function() {
        otable.destroy();
        var statusFilterValue = $('#statusFilter').val();
        var createdOnFilterValue = $('#createdOnFilter').val();
        genrateDataTable(createdOnFilterValue,statusFilterValue);
    });

    // Event handler for the Reset button
    $('#resetFilterBtn').on('click', function() {
        // Reset the filters
        $('#statusFilter').val('');
        $('#createdOnFilter').val('');
        currentStatusFilter = '';
        currentCreatedOnFilter = '';
        // Apply the filters
        oTable.draw();
    });
    
    $('.dropdown-menu').on('click', function(e) {
        e.stopPropagation();
    });
});




</script>

<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"> 
</script>