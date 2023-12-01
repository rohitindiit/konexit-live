@include('Admin.layout.header')

<link
      rel="stylesheet"
      type="text/css"
      href="{{url('/')}}/resources/views/Admin/assets/css/widgets/modules-widgets.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{url('/')}}/resources/views/Admin/assets/flatpickr/flatpickr.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.form.io/formiojs/formio.full.min.css"
    />
    <link href="{{url('/')}}/resources/views/Admin/assets/css/plugins.css" rel="stylesheet" type="text/css" />

 <style>
      
      .formusers #builder2 .formio-component-form
      {
          margin-bottom: 15px;
      }

      .modbuilder .modal-dialog
      {
         max-width: 300px 
      }
      .modbuilder .modal-body
      {
        background-color: #fff;
      }

      .modalform .modal-content {
       border-radius: 0;
        background-position: center center;
        background-repeat: no-repeat;
        background-size: 100% 100%;
        height: 552px;
        padding: 63px 21px 58px 17px;
        background-color: transparent;
        border: none;

      }
      .modalform .formio-component.formio-component-label-hidden
      {
         padding: 1px;
        border-radius: 0;
        border: none;
        background-color: #fff;
        height: 300px;
        overflow-y: auto;
      }
      ::-webkit-scrollbar {
        display: none;
     }
    </style>
      <!--  BEGIN MAIN CONTAINER  -->
      <div class="main-container" id="container">
         <div class="overlay"></div>
         <div class="search-overlay"></div>
         <!--  BEGIN SIDEBAR  -->
          @include('Admin.layout.sidebar')
         <div id="content" class="main-content">
            <div class="layout-px-spacing">
               <div class="row layout-top-spacing">
                  <div class="col-xl-12 col-12 px-2 mb-3 d-flex ">
                     <a href="{{url('/')}}/forms" class="mr-3 mt-1"><img src="{{url('/')}}/resources/views/Admin/assets/img/backarrow.svg"/></a>
                     <div>
                        <h1 class="headmain mb-1">Form Details</h1>
                        <nav aria-label="breadcrumb">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a href="{{url('/')}}/forms">Forms</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Form Details</li>
                           </ol>
                        </nav>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget">
                        <div class="widget-content">
                           <div class="row">
                              <div class="col-xl-5 col-lg-6 col-md-12 col-sm-12 col-12">
                                 <div class="formdetail">
                                    <h3 class="m-0">Form</h3>
                                    <img src="{{url('/')}}/resources/views/Admin/assets/img/formsdetail.png"/>
                                 </div>
                              </div>
                              <div class="col-xl-6 offset-xl-1 offset-lg-1 col-lg-6 col-md-12 col-sm-12 col-12">
                                 <div class="row">
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <div class="form-group detailform">
                                          <label>Form ID</label>
                                          <p>{{$forms->formid}}</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <div class="form-group detailform">
                                          <label>Status</label>
                                          <p><span class="status statuscompleted"></span> Completed</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12">
                                       <div class="form-group detailform">
                                          <label>Form Name</label>
                                          <p>{{$forms->form_title}}</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <div class="form-group detailform">
                                          <label>Date</label>
                                          <p>{{$forms->created_at->format('j F Y'); }}</p>
                                       </div>
                                    </div>
                                    <div class="col-xl-4 col-lg-4 col-md-6">
                                       <div class="form-group detailform">
                                         <!--  <label>User</label>
                                          <p>John Delahay</p> -->
                                          <a href="javascript:void(0)"  data-toggle="modal" data-target="#addformModal" class="btn btn-primary btn2">Mobile View</a>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Assigned Organisations</h5>
                           <div class="view-action">
                              <a href="{{url('/')}}/organisations">View All</a>
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Organisation</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Email</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Logo</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Users</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="td-content">Wonka Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Johndelahay22@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo1.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">298</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Aidabugg347@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo2.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">298</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Alliegrater@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo3.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">298</div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">Ollivander's Wand</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Cherryblossom99@gmail.com</div>
                                       </td>
                                       <td>
                                          <div class="td-content"><img src="{{url('/')}}/resources/views/Admin/assets/img/org-logo4.png"/></div>
                                       </td>
                                       <td>
                                          <div class="td-content">298</div>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                      <div class="widget  mb-3">
                        <div class="widget-heading p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Submission Count</h5>
                          
                             <select class="task-action submissionChanges" id="orgnisationCount" >
                                  <option value="current_week">Current Week</option>
                                  <option value="last_week">Last Week</option>
                                  <option value="this_month">Current Month</option>
                                  <option value="last_month">Last Month</option>
                                  <option value="31_days">Date Range</option>
                                  <option value="by_year">By Year</option>
                           </select>
                        </div>
                        <div class="widget-content" id="subcountchart">
                           <div id="submissionYearly" class="orchart" ></div>
                        
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3 d-flex justify-content-between">
                           <h5 class="mb-0">Submission Count By Organisations<span>(Last 30 days)</span></h5>
                           <div class="view-action">
                              <a href="{{url('/')}}/organisations">View All</a>
                           </div>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive px-3 table-count-org">
                              <table class="table">
                                 <tr>
                                    <td>
                                       <div class="td-content">Wonka Industries</div>
                                    </td>
                                    <td>
                                       <div class="td-content"><span class="badgetable ml-auto">2</span></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="td-content">Acme Corp</div>
                                    </td>
                                    <td>
                                       <div class="td-content"><span class="badgetable ml-auto">3</span></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="td-content">Stark Industries</div>
                                    </td>
                                    <td>
                                       <div class="td-content"><span class="badgetable ml-auto">41</span></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="td-content">Acme Corp</div>
                                    </td>
                                    <td>
                                       <div class="td-content"><span class="badgetable ml-auto">23</span></div>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>
                                       <div class="td-content">Wonka Industries</div>
                                    </td>
                                    <td>
                                       <div class="td-content"><span class="badgetable ml-auto">2</span></div>
                                    </td>
                                 </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mb-3 px-2">
                     <div class="widget widget-table-two p-0">
                        <div class="widget-heading mb-0 p-3">
                           <h5 class="mb-0">Recent Submissions</h5>
                        </div>
                        <div class="widget-content">
                           <div class="table-responsive">
                              <table class="table">
                                 <thead>
                                    <tr>
                                       <th>
                                          <div class="th-content">Actions</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submitted on</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Form Name</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submitted by</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Organisation</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Submission ID</div>
                                       </th>
                                       <th>
                                          <div class="th-content">Download</div>
                                       </th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink1">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink1">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio1"/>	
                                                         <label  for="radio1">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn" id="radio2"/>	
                                                         <label  for="radio2">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink2">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio3"/>	
                                                         <label  for="radio3">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn2" id="radio4"/>	
                                                         <label  for="radio4">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
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
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink3" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink3">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio5"/>	
                                                         <label  for="radio5">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn3" id="radio6"/>	
                                                         <label  for="radio6">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink4" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink4">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio7"/>	
                                                         <label  for="radio7">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn4" id="radio8"/>	
                                                         <label  for="radio8">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
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
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink21" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink21">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio21"/>	
                                                         <label  for="radio21">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn5" id="radio22"/>	
                                                         <label  for="radio22">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink22" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink22">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio23"/>	
                                                         <label  for="radio23">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn6" id="radio24"/>	
                                                         <label  for="radio24">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
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
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink23" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink23">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio25"/>	
                                                         <label  for="radio25">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn7" id="radio26"/>	
                                                         <label  for="radio26">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink24" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink24">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio27"/>	
                                                         <label  for="radio27">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn8" id="radio28"/>	
                                                         <label  for="radio28">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
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
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink11" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink11">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio11"/>	
                                                         <label  for="radio11">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn9" id="radio12"/>	
                                                         <label  for="radio12">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink12" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink12">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn10" id="radio13"/>	
                                                         <label  for="radio13">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn10" id="radio14"/>	
                                                         <label  for="radio14">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
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
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Acme Corp</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink13" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink13">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn11" id="radio15"/>	
                                                         <label  for="radio15">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn11" id="radio16"/>	
                                                         <label  for="radio16">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown actiondrop">
                                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                Action <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down2.svg"/>
                                                </a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                   <a class="dropdown-item" href="{{url('/')}}/submissionsdetails"><img src="{{url('/')}}/resources/views/Admin/assets/img/view.svg"/> View</a>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                       <td>
                                          <div class="td-content">08 Sep 2022<span class="timeframe">11:30am</span></div>
                                       </td>
                                       <td>
                                          <div class="td-content">HGV vehicle check and defect report (SC)</div>
                                       </td>
                                       <td>
                                          <div class="td-content">John Delahay</div>
                                       </td>
                                       <td>
                                          <div class="td-content">Stark Industries</div>
                                       </td>
                                       <td>
                                          <div class="td-content">13326</div>
                                       </td>
                                       <td>
                                          <div class="td-content">
                                             <div class="dropdown downloaddrop">
                                                <a class="dropdown-toggle download" href="javascript:void(0);" id="dropdownMenuLink14" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Download <img src="{{url('/')}}/resources/views/Admin/assets/img/arrow-down3.svg"/>
                                                </a>
                                                <div class="dropdown-menu position-absolute" aria-labelledby="dropdownMenuLink14">
                                                   <h2>Choose Format</h2>
                                                   <div class="radiobtn">
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn12" id="radio17"/>	
                                                         <label  for="radio17">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/pdf.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                      <div class="radioinner">
                                                         <input type="radio" name="radiobtn12" id="radio18"/>	
                                                         <label  for="radio18">
                                                         <img src="{{url('/')}}/resources/views/Admin/assets/img/csv.svg"/>
                                                         <span class="checkmark"></span>
                                                         </label>														   
                                                      </div>
                                                   </div>
                                                   <button class="btn btn-primary mt-3">Download</button>
                                                </div>
                                             </div>
                                          </div>
                                       </td>
                                    </tr>
                                 </tbody>
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



   <div class="modal fade modalform modbuilder" id="addformModal" tabindex="-1" aria-labelledby="addformModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content" style="background-image: url({{url('/resources/views/Admin/assets/img/mobile.png');}} ); ">
             <div class="modal-body">
                <h5 class="modal-title mb-3 text-center">{{$forms->form_title}}</h5>
                <div class="modal-inner formusers">
                       <div id="builder2"></div>
                </div>
            <!--     <button type="button" class="btn btn-secondary btn-outline-secondary mr-2" data-dismiss="modal">Cancel</button> -->
             </div>
          </div>
       </div>
    </div>
        
       @include('Admin.layout.footer')
        <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
         <script src="{{url('/')}}/resources/views/Admin/assets/js/testform.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/audiotag.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/mynewcomp.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/MyBarcodeComponent.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/hmt.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/submitform.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/custom.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/flatpickr/flatpickr.js"></script>
    <script>
      var f1 = flatpickr(document.getElementById("basicFlatpickr1"))
   </script>
    <script>
      $(document).ready(function () {
        App.init()
      })

      Formio.createForm(
        document.getElementById("builder2"), "{{url('/getform/'.$forms->id)}}").then(function(builder) {
          });
          
    // submission count table
      
$("#orgnisationCount").change(function(){
         gettingValue = $(this).val(); 
         
         
         // yearly count 
         if(gettingValue=='by_year'){
                if($('#orgnisationCount').hasClass("added"))
                {
                  $('#orgnisationCount').data('daterangepicker').remove();
                  $('#orgnisationCount').removeAttr('data-daterangepicker-initialized');
                   $('#orgnisationCount').removeClass('added');
                }
             $.ajax({
                          url: '{{route('admin.single.submission.countChartForms')}}',
                          method: 'POST',
                          data: {id:"{{$forms->id}}",'duration':'yearly','_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                           
                            seriesArray= [{
                                    name: 'Pending',
                                        data: record.pending.reverse()
                                    },
                                	{
                                        name: 'Need action',
                                        data: record.needaction.reverse()
                                    },
                                	{
                                        name: 'Completed',
                                        data: record.completed.reverse()
                                }];
                                
                            seriesLabel = record.years.reverse(),
                            submissionChartGraph(seriesArray,seriesLabel);
                                            
                          },
                          error: function(xhr, status, error) {
                          
                            console.log(error);
                          }
                        });
         }
         
         //monthly count
         if(gettingValue=='this_month' || gettingValue=='last_month'){
                if($('#orgnisationCount').hasClass("added"))
                {
                  $('#orgnisationCount').data('daterangepicker').remove();
                  $('#orgnisationCount').removeAttr('data-daterangepicker-initialized');
                   $('#orgnisationCount').removeClass('added');
                }
              monthYear=[];
              monthPending=[];
              monthNeedaction=[];
              monthCompleted=[];
                  $.ajax({
                          url: '{{route('admin.single.submission.countChartForms')}}',
                          method: 'POST',
                          data: {id:"{{$forms->id}}",'duration':gettingValue,'_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                         
                         $.each(record.status, function (key,val) {
                          monthYear.push(key);
                          monthPending.push(val.pending);
                           monthCompleted.push(val.completed);
                           monthNeedaction.push(val.needaction);
                        });
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: monthPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:monthNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: monthCompleted
                                }];
                                
                            seriesLabel =monthYear,
                            submissionChartGraph(seriesArray,seriesLabel);
                                            
                          },
                          error: function(xhr, status, error) {
                          
                            console.log(error);
                          }
                        });
         }
         
         // weekly count 
         if(gettingValue=='last_week' || gettingValue=='current_week'){
              if($('#orgnisationCount').hasClass("added"))
                {
                  $('#orgnisationCount').data('daterangepicker').remove();
                  $('#orgnisationCount').removeAttr('data-daterangepicker-initialized');
                   $('#orgnisationCount').removeClass('added');
                }
             weekDays=[];
             weekPending=[];
             weekNeedaction=[];
             weekCompleted=[];
             $.ajax({
                      url: '{{route('admin.single.submission.countChartForms')}}',
                      method: 'POST',
                      data: {id:"{{$forms->id}}",'duration':gettingValue,'_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                      
                        $.each(record.allday, function (key,val) {
                          weekDays.push(key);
                          weekPending.push(parseInt(val.pending));
                           weekCompleted.push(parseInt(val.complete));
                           weekNeedaction.push(parseInt(val.needaction));
                         }); 
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: weekPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:weekNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: weekCompleted
                                }];
                                
                        seriesLabel = weekDays,
                        submissionChartGraph(seriesArray,seriesLabel);
                                        
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                    });
         }
         
         //31 count
         if(gettingValue=='31_days'){
             
               $('#orgnisationCount').daterangepicker({
                   maxSpan: {
                                days: 31
                            }
               });
                
               $('#orgnisationCount').addClass('added');
               $('#orgnisationCount').on('apply.daterangepicker', function(ev, picker) {
                   var dateRangePicker = $("#orgnisationCount").data('daterangepicker');
                   // Retrieve the selected start and end dates
                    var startDate = dateRangePicker.startDate.format('YYYY-MM-DD');
                    var endDate = dateRangePicker.endDate.format('YYYY-MM-DD');
                    
                  monthYear=[];
                  monthPending=[];
                  monthNeedaction=[];
                  monthCompleted=[];
                  $.ajax({
                          url: '{{route('admin.single.submission.countChartForms')}}',
                          method: 'POST',
                          data: {id:"{{$forms->id}}",'duration':'range','start_date':startDate,'end_date':endDate,'_token':"{{csrf_token()}}"},
                          success: function(response) {
                            record = JSON.parse(response);
                          
                         $.each(record.status, function (key,val) {
                          monthYear.push(key);
                          monthPending.push(val.pending);
                           monthCompleted.push(val.completed);
                           monthNeedaction.push(val.needaction);
                        });
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: monthPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:monthNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: monthCompleted
                                }];
                                
                            seriesLabel =monthYear,
                            submissionChartGraph(seriesArray,seriesLabel);
                                            
                          },
                          error: function(xhr, status, error) {
                          
                            console.log(error);
                          }
                        });
               });
           
         }
      });
      
      //on ready for all chart
       $(document).ready(function(){
          // submission count form
        
             weekDays=[];
             weekPending=[];
             weekNeedaction=[];
             weekCompleted=[];
              
             $.ajax({
                      url: '{{route('admin.single.submission.countChartForms')}}',
                      method: 'POST',
                      data: {id:"{$forms->id}}",'duration':'current_week','_token':"{{csrf_token()}}"},
                      success: function(response) {
                        record = JSON.parse(response);
                      
                        $.each(record.allday, function (key,val) {
                          weekDays.push(key);
                          weekPending.push(parseInt(val.pending));
                           weekCompleted.push(parseInt(val.complete));
                           weekNeedaction.push(parseInt(val.needaction));
                         }); 
                         
                            seriesArray= [{
                                    name: 'Pending',
                                        data: weekPending
                                    },
                                	{
                                        name: 'Need action',
                                        data:weekNeedaction
                                    },
                                	{
                                        name: 'Completed',
                                        data: weekCompleted
                                }];
                                
                        seriesLabel = weekDays,
                        submissionChartGraph(seriesArray,seriesLabel);
                                        
                      },
                      error: function(xhr, status, error) {
                      
                        console.log(error);
                      }
                    });
      
      });
      
      function submissionChartGraph(seriesArray,seriesLabel)
      {
            var chartElement = document.querySelector("#submissionYearly");
            if (chartElement) {
              while (chartElement.firstChild) {
                chartElement.firstChild.remove();
              }
            }
            
            var options1 = {
              chart: {
                fontFamily: 'Nunito, sans-serif',
                height: 365,
                type: 'area',
                zoom: {
                  enabled: false
                },
                dropShadow: {
                  enabled: true,
                  opacity: 0.2,
                  blur: 10,
                  left: -7,
                  top: 22
                },
                toolbar: {
                  show: false
                },
                events: {
                  mounted: function(ctx, config) {
                    const seriesData = ctx.getSeries();
                    seriesData.forEach(function(series, index) {
                      const highest = Math.max(...series.data);
                      const highestIndex = series.data.indexOf(highest);
            
                      ctx.addPointAnnotation({
                        x: new Date(ctx.w.globals.seriesX[index][highestIndex]).getTime(),
                        y: highest,
                        label: {
                          style: {
                            cssClass: 'd-none'
                          }
                        },
                        customSVG: {
                          SVG: '<svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="' + series.color + '" stroke="#fff" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-circle"><circle cx="12" cy="12" r="10"></circle></svg>',
                          cssClass: undefined,
                          offsetX: -8,
                          offsetY: 5
                        }
                      });
                    });
                  },
                }
              },
              colors: ['#FEC147', '#E22028', '#48D131'],
              dataLabels: {
                enabled: false
              },
              stroke: {
                show: true,
                curve: 'smooth',
                width: 2,
                lineCap: 'square'
              },
              series: seriesArray,
              labels: seriesLabel,
              xaxis: {
                axisBorder: {
                  show: false
                },
                axisTicks: {
                  show: false
                },
                crosshairs: {
                  show: true
                },
                labels: {
                  style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-xaxis-title',
                  },
                }
              },
              yaxis: {
                labels: {
                  style: {
                    fontSize: '12px',
                    fontFamily: 'Nunito, sans-serif',
                    cssClass: 'apexcharts-yaxis-title',
                  },
                }
              },
              grid: {
                borderColor: '#e0e6ed',
                strokeDashArray: 5,
                xaxis: {
                  lines: {
                    show: true
                  }
                },
                yaxis: {
                  lines: {
                    show: true,
                  }
                },
                padding: {
                  top: 0,
                  right: 0,
                  bottom: 0,
                  left: -10
                },
              },
              legend: {
                position: 'top',
                horizontalAlign: 'right',
                offsetY: -50,
                fontSize: '16px',
                fontFamily: 'Nunito, sans-serif',
                markers: {
                  width: 10,
                  height: 10,
                  strokeWidth: 0,
                  strokeColor: '#fff',
                  fillColors: undefined,
                  radius: 12,
                  onClick: undefined,
                  offsetX: 0,
                  offsetY: 0
                },
                itemMargin: {
                  horizontal: 0,
                  vertical: 20
                }
              },
              tooltip: {
                theme: 'dark',
                marker: {
                  show: true,
                },
                x: {
                  show: false,
                }
              },
              fill: {
                type: "gradient",
                gradient: {
                  type: "vertical",
                  shadeIntensity: 1,
                  inverseColors: !1,
                  opacityFrom: .28,
                  opacityTo: .05,
                  stops: [45, 100]
                }
              },
              responsive: [{
                breakpoint: 1920,
                options: {
                  chart: {
                    height: '227px',
                    width: '100%',
                  },
                  legend: {
                    offsetY: -30,
                  },
                },
              }]
            };
            
            var chart1 = new ApexCharts(
              document.querySelector("#submissionYearly"),
              options1
            );
            chart1.render();

      }
          
          
    </script>