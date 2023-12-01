@include('organization.layout.header')
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
         @include('organization.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
        <div class="row mb-3 layout-top-spacing align-items-center">
                  <div class="col-xl-12 col-12 px-2 d-flex ">
                     <a href="{{url('/organization/user')}}" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">User Activity</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/organization/user')}}">User</a></li>
                              <li class="breadcrumb-item active" aria-current="page">User Activity </li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="row layout-top-spacing">
                     <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-content">
                          
                              <div class=" py-4 p-3 searchfilter">
                                 <div class="row ">
                                   
                                 </div>
                              </div>
                              <div class="table-responsive">
                              <!--<table   class="table table-head-custom" id="user_table">-->
                              <table   class="table table-head-custom" >
                                 <thead>
                                    <tr>
                                     
                                     
                                      
                                       <th>
                                          <div class="th-content">Activity</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Date Time</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    
                                     @forelse($users as $u)
                                    <tr>
                                        <?php 
                                       $dateTime = \Carbon\Carbon::parse($u->created_at);

                                        // Format the date in the desired format
                                        $formattedDate = $dateTime->format('d-m-Y h:i A');
                                       ?>
                                       <td>
                                          <div class="td-content">{{$u->activity}}</div>
                                       </td>
                                       <td>
                                          <div class="td-content">{{$formattedDate}}</div>
                                       </td>
                                     
                                    </tr>
                                    @empty
                                   <tr>
                                        <td>
                                          <div class="td-content">No Activity Yet from app</div>
                                       </td>
                                       
                                       <td>
                                          <div class="td-content"></div>
                                       </td>
                                    </tr>
                                    @endforelse
                                  
                                  
                                 
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
      @include('organization.layout.footer')