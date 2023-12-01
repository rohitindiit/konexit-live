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
                  <div class="col-xl-12 col-12 px-2 d-flex ">
                     <a href="{{url('/')}}/{{$userdetail->parent_id}}/users" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Users Detail</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/organisations">Organisations</a></li>
                              <li class="breadcrumb-item"><a href="{{url('/')}}/{{$userdetail->parent_id}}/users">Users</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Users Detail</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget">
                        <div class="widget-content">
                           <div class="row align-items-center">
                              <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                                 <div class="formdetail">
                                    <h3 class="m-0">User</h3>
                                     @if(isset($userdetail->profile) && $userdetail->profile != null)
                                    <img class="userimg-detail"  src="{{$userdetail->profile}}"/>
                                    @else
                                    <img class="userimg-detail"  src="{{url('/')}}/resources/views/Admin/assets/img/user.png"/>
                                    @endif
                                 </div>
                              </div>
                              <div class="col-xl-4  col-lg-4 col-md-12 col-sm-12 col-12">
                                 <div class="userhead  pl-5">
                                    <h3>Name</h3>
                                    <h2>{{$userdetail->name.' '.$userdetail->lname}}</h2>
                                 </div>
                              </div>
                              <div class="col-xl-2  col-lg-2 col-md-12 col-sm-12 col-12">
                                 <div class="form-group detailform">
                                    <label>Email</label>
                                    <p>{{$userdetail->email}}</p>
                                 </div>
                              </div>
                              <div class="col-xl-2  col-lg-2 col-md-12 col-sm-12 col-12">
                                 <div class="form-group detailform pl-5">
                                    <label>Status</label>
                                    <p>{{($userdetail->status == '1') ? 'Active' : 'Inactive'}}</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Assigned Forms</h5>
                           <div class="view-action">
                              <a href="{{url('/')}}/forms">View All</a>
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th  width="50%">
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Date</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13358</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13359</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13368</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13368</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Submissions</h5>
                           <div class="view-action">
                              <a href="{{url('/')}}/submissions">View All</a>
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th width="50%">
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submission ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Date</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13358</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13359</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13368</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13368</div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">07:25 am</span></div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      @include('footer')