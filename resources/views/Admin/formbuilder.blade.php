<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no"
    />
    <title>Form Builder</title>
    <link rel="icon" type="image/x-icon" href="{{url('/')}}/resources/views/Admin/assets/img/favicon.ico" />
    <link href="{{url('/')}}/resources/views/Admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{url('/')}}/resources/views/Admin/assets/js/loader.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="{{url('/')}}/resources/views/Admin/assets/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />

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
  </head>
  <body class="sidebar-noneoverflow">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
      <div class="loader">
        <div class="loader-content">
          <div class="spinner-grow align-self-center"></div>
        </div>
      </div>
    </div>
    <!--  END LOADER -->
    <div class="header-container fixed-top">
      <header class="header navbar navbar-expand-sm">
        <ul class="navbar-nav theme-brand flex-row text-center pl-3">
          <li class="nav-item backbtn">
            <a href="{{url('/')}}/forms">
              <span><img src="{{url('/')}}/resources/views/Admin/assets/img/arrowback.svg" /></span>
            </a>
            Form Builder
          </li>
        </ul>
        @include('Admin.layout.usermenu')
      </header>
    </div>
    <!--  END NAVBAR  -->
    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">
      <input type="hidden" name="title" id="titles" value="{{$title}}">
      <input type="hidden" name="defaultstatus" id="defaultstatus" value="{{$status}}">
      <input type="hidden" name="formid" id="formid" value="">
      <input type="hidden" name="formversionid" id="formversionid" value="">
      <div class="overlay"></div>
      <div class="search-overlay"></div>
      <div id="content" class="main-content ml-0">
        <div class="layout-px-spacing">
          <div class="row layout-top-spacing px-2">
            <div class="col-md-12">
               <form action="{{ route('add.form') }}" method="POST" id="formform" onsubmit="return false">
                @csrf
              </form>
              <div id="builder"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/css/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/app.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/testform.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/audiotag.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/mynewcomp.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/MyBarcodeComponent.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/hmt.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/js/submitform.js"></script>
    <script>
      $(document).ready(function () {
        App.init()
      })


 Formio.use({
  components: {
    checkmatrix: CheckMatrix
  }
});


      Formio.builder(
        document.getElementById("builder"),
        {
          components: [
            {
              type: "textfield",
              key: "firstName",
              label: "First Name"
            },
            {
              type: "textfield",
              key: "lastName",
              label: "Last Name"
            },
            {
              label: "Date",
              format: "yyyy-MM-dd",
              tableView: false,
              datePicker: {
                disableWeekends: false,
                disableWeekdays: false
              },
              enableTime: false,
              timePicker: {
                showMeridian: false
              },
              enableMinDateInput: false,
              enableMaxDateInput: false,
              key: "dateTime",
              type: "datetime",
              input: true,
              widget: {
                type: "calendar",
                displayInTimezone: "viewer",
                locale: "en",
                useLocaleSettings: false,
                allowInput: true,
                mode: "single",
                enableTime: false,
                noCalendar: false,
                format: "yyyy-MM-dd",
                hourIncrement: 1,
                minuteIncrement: 1,
                time_24hr: true,
                minDate: null,
                disableWeekends: false,
                disableWeekdays: false,
                maxDate: null
              }
            },
          ]
        },
        {
          builder: {
            basic: false,
            advanced: false,
            data: false,
            layout: false,
            premium: false,
            customBasic: {
              title: "Text Elements",
              default: true,
              weight: 0,
              components: {
                textfield2: {
                  title: "Text Field",
                  key: "textField2",
                  icon: "text-width",
                  schema: {
                    label: "Text Field",
                    type: "textfield",
                    key: "textField2",
                    input: true
                  }
                },
                textfield: {
                  title: "Text Area",
                  key: "textarea",
                  icon: "file",
                  schema: {
                    label: "Text Area",
                    autoExpand: false,
                    tableView: true,
                    key: "textArea",
                    type: "textarea",
                    input: true
                  }
                },
                content: {
                  title: "Static Text",
                  key: "content",
                  icon: "text-height",
                  schema: {
                    label: "Static Text",
                    refreshOnChange: false,
                    key: "content",
                    type: "content",
                    input: false,
                    tableView: false
                  }
                },
           /*       checkbox:{
                     title: "Checkbox",
                  key: "checkbox",
                  icon: "check-square",
                  schema: {
    "label": "Checkbox",
    "type": "checkbox",
    "key": "checkbox",
    "defaultValue": false,
    "input": true
                  }
}, */
selectboxes:{
                     title: "Selectboxes",
                  key: "selectboxes",
                  icon: "plus-square",
                  schema: {
    "label": "Selectboxes",
    "type": "selectboxes",
    "key": "selectboxes",
    "defaultValue": false,
    "input": true
                  }
},
             /*   submit: {
                  title: "Submit",
                  key: "submit1",
                  icon: "upload",
                  schema: {
                    label: "Submit",
                    type: "button",
                    key: "submit1",
                    input: true
                  }
                }*/
              }
            },
            customAdvanced: {
              title: "Date & Time Elements",
              default: true,
              weight: 0,
              components: {
                time: {
                  title: "Time Capture",
                  key: "time",
                  icon: "clock-o",
                  schema: {
                    label: "Time Capture",
                    tableView: true,
                    key: "time",
                    type: "time",
                    input: true,
                    inputMask: "99:99"
                  }
                },
                dateTime: {
                  title: "Date Capture",
                  key: "dateTime",
                  icon: "calendar",
                  schema: {
                    tableView: false,
                    datePicker: {
                      disableWeekends: false,
                      disableWeekdays: false
                    },
                    enableMinDateInput: false,
                    enableMaxDateInput: false,
                    key: "dateTime",
                    type: "datetime",
                    input: true,
                    widget: {
                      type: "calendar",
                      displayInTimezone: "viewer",
                      locale: "en",
                      useLocaleSettings: false,
                      allowInput: true,
                      mode: "single",
                      enableTime: true,
                      noCalendar: false,
                      format: "yyyy-MM-dd hh:mm a",
                      hourIncrement: 1,
                      minuteIncrement: 1,
                      time_24hr: false,
                      minDate: null,
                      disableWeekends: false,
                      disableWeekdays: false,
                      maxDate: null
                    }
                  }
                }
              }
            },
            customData: {
              title: "Multi Elements",
              default: true,
              weight: 0,
              components: {
                select: {
                  title: "Drop down",
                  key: "select",
                  icon: "chevron-down",
                  schema: {
                    label: "Drop down",
                    widget: "choicesjs",
                    tableView: true,
                    key: "select",
                    type: "select",
                    input: true
                  }
                },
                  address2: {
                    title: "Location Capture",
                  key: "address",
                  icon: "map-marker",
                   schema: {
                  autofocus: false,
                  input: true,
                  tableView: true,
                  label: "Address",
                  key: "address",
                  placeholder: "",
                  multiple: false,
                  protected: false,
                  clearOnHide: true,
                  unique: false,
                  persistent: true,
                  hidden: false,
                  map: {
                  region: "",
                  key: "AIzaSyDnMvJXKTsrCcDRdM03l8TlIdlYZuIXQHs"
                  },
                  validate: {
                  required: false
                  },
                  type: "address",
                  $$hashKey: "object:583",
                  labelPosition: "top",
                  tags: [
                  ],
                  conditional: {
                  show: "",
                  when: null,
                  eq: ""
                  },
                  properties: {
                  }
                  }
                },
               /* address: {
                  title: "Location Capture",
                  key: "address",
                  icon: "map-marker",
                  schema: {
                    label: "Location Capture",
                    tableView: false,
                    provider: "nominatim",
                    key: "address",
                    type: "address",
                    input: true,
                    components: [
                      {
                        label: "Address 1",
                        tableView: false,
                        key: "address1",
                        type: "textfield",
                        input: true,
                        customConditional:
                          "show = _.get(instance, 'parent.manualMode', false);"
                      },
                      {
                        label: "Address 2",
                        tableView: false,
                        key: "address2",
                        type: "textfield",
                        input: true,
                        customConditional:
                          "show = _.get(instance, 'parent.manualMode', false);"
                      },
                      {
                        label: "City",
                        tableView: false,
                        key: "city",
                        type: "textfield",
                        input: true,
                        customConditional:
                          "show = _.get(instance, 'parent.manualMode', false);"
                      },
                      {
                        label: "State",
                        tableView: false,
                        key: "state",
                        type: "textfield",
                        input: true,
                        customConditional:
                          "show = _.get(instance, 'parent.manualMode', false);"
                      },
                      {
                        label: "Country",
                        tableView: false,
                        key: "country",
                        type: "textfield",
                        input: true,
                        customConditional:
                          "show = _.get(instance, 'parent.manualMode', false);"
                      },
                      {
                        label: "Zip Code",
                        tableView: false,
                        key: "zip",
                        type: "textfield",
                        input: true,
                        customConditional:
                          "show = _.get(instance, 'parent.manualMode', false);"
                      }
                    ]
                  }
                },*/
                radio: {
                  title: "Radio",
                  key: "submit1",
                  icon: "dot-circle-o",
                  schema: {
                    //label: "Radio",
                    optionsLabelPosition: "right",
                    inline: false,
                    tableView: false,
                    values: [
                      {
                        label: "1",
                        value: "1",
                        shortcut: "A"
                      },
                      {
                        label: "2",
                        value: "2",
                        shortcut: "B"
                      }
                    ],
                    key: "radio",
                    type: "radio",
                    input: true
                  }
                },
                signature: {
                  title: "Signature",
                  key: "signature",
                  icon: "pencil",
                  schema: {
                    label: "Signature",
                    tableView: false,
                    key: "signature",
                    type: "signature",
                    input: true
                  }
                }
              }
            },
            customLayout: {
              title: "Media Elements",
              default: true,
              weight: 0,
              components: {
                file: {
                  title: "Photo Capture & Upload",
                  key: "file",
                  icon: "camera",
                  schema: {
                    label: "Photo Capture & Upload",
                    refreshOnChange: false,
                    key: "file",
                    type: "file",
                    input: false
                  }
                },
                 MyNewComponent: {
                  title: "Voice Recording",
                  key: "MyNewComponent",
                  icon: "microphone",
                  schema: {
                    label: "Voice Recording",
                    type: "MyNewComponent",
                    key: "MyNewComponent",
                    input: true,
                     numCols: 6,
                    numRows:6
                  }
                },
                MyBarcodeComponent: {
                  title: "QR/Barcode",
                  key: "MyBarcodeComponent",
                  icon: "qrcode",
                  schema: {
                    label: "Scan QR Code",
                    type: "MyBarcodeComponent",
                    key: "MyBarcodeComponent",
                    input: true,
                     numCols: 6,
                    numRows:6
                  }
                }, 
              }
            },
          },
          editForm: {
            textfield: [
              {
               key: "display",
               ignore: false,
                components: [
                  {
                    key: "hideLabel",
                    ignore: true
                  },
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "autofocus",
                    ignore: true
                  },
                  {
                    key: "disabled",
                    ignore: true
                  },
                  {
                    key: "tabindex",
                    ignore: true
                  },
                  {
                    key: "prefix",
                    ignore: true
                  },
                  {
                    key: "suffix",
                    ignore: true
                  },
                  {
                    key: "allowMultipleMasks",
                    ignore: true
                  },
                  {
                    key: "addons",
                    ignore: true
                  },
                  {
                    key: "showCharCount",
                    ignore: true
                  },
                  {
                    key: "showWordCount",
                    ignore: true
                  },
                  {
                    key: "spellcheck",
                    ignore: true
                  },
                  {
                    key: "modalEdit",
                    ignore: true
                  },
                  {
                    key: "inputMask",
                    ignore: false
                  },
                  {
                    key: "displayMask",
                    ignore: true
                  },
                  {
                    key: "mask",
                    ignore: true
                  },
                  {
                    key: "autocomplete",
                    ignore: true
                  },
                  {
                    key: "hidden",
                    ignore: true
                  },

                  {
                    key: "tableView",
                    ignore: true
                  },

                  {
                    key: "widget.type",
                    ignore: true
                  }
                ]
              },
              {
               key: "data",
               ignore: true,
              },
              {
                key: "validation",
                ignore: false,
                components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  },
                  {
                      key: "validate.minLength",
                      ignore: true
                  },
                  {
                      key: "validate.maxLength",
                      ignore: true
                  }
                  
                ]
              },
              {
               key: "api",
               ignore: true,
              },
              {
               key: "conditional",
               ignore: true,
              },
              {
               key: "logic",
               ignore: true,
              },
              {
               key: "layout",
               ignore: true,
              }
            ],
            textarea: [
              {
              key: "display",
              ignore: false,
              components: [
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
              components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            content: [
              {
              key: "display",
              ignore: false,
               components: [
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "refreshOnChange",
                    ignore: true
                  },
                ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "validation",
              ignore: true,
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
           /* button: [
              {
              key: "display",
              ignore: false,
              components: [
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "leftIcon",
                    ignore: true
                  },
                  {
                    key: "rightIcon",
                    ignore: true
                  },
                  {
                    key: "shortcut",
                    ignore: true
                  },
                  {
                    key: "saveOnEnter",
                    ignore: true
                  },
                  {
                    key: "action",
                    ignore: true
                  },
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "validation",
              ignore: true,
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],*/
            time: [
              {
              key: "display",
              ignore: false,
                components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "inputType",
                    ignore: true
                  },
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
               components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            datetime: [
              {
              key: "display",
              ignore: false,
               components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "format",
                    ignore: true
                  },
                  {
                    key: "displayInTimezone",
                    ignore: true
                  },
                  {
                    key: "useLocaleSettings",
                    ignore: true
                  },
                  {
                    key: "allowInput",
                    ignore: true
                  } 
                  
                  
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
               components: [
                  {
                    key: "enableMinDateInput",
                    ignore: true
                  },
                  {
                    key: "enableMaxDateInput",
                    ignore: true
                  },
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            select: [
              {
              key: "display",
              ignore: false,
               components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "widget",
                    ignore: true
                  }
               ]
              },
              {
              key: "data",
              ignore: false,
              components: [
                  {
                    key: "dataType",
                    ignore: true
                  },
                  {
                    key: "idPath",
                    ignore: true
                  },
                  {
                    key: "template",
                    ignore: true
                  },
                  {
                    key: "refreshOn",
                    ignore: true
                  },
                  {
                    key: "refreshOnBlur",
                    ignore: true
                  },
                  {
                    key: "clearOnRefresh",
                    ignore: true
                  },
                  {
                    key: "selectThreshold",
                    ignore: true
                  },
                  {
                    key: "readOnlyValue",
                    ignore: true
                  },
                  {
                    key: "customOptions",
                    ignore: true
                  },
                  {
                    key: "useExactSearch",
                    ignore: true
                  },
                  {
                    key: "dataSrc",
                    ignore: true
                  },
                  {
                    key: "multiple",
                    ignore: true
                  },
                ]
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
              components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  },
                  {
                    key: "validate.onlyAvailableItems",
                    ignore: true
                  }
                  
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            address: [
              {
              key: "display",
              ignore: false,
                components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "enableManualMode",
                    ignore: true
                  },
                  {
                    key: "disableClearIcon",
                    ignore: true
                  },
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "provider",
              ignore: true,
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
               components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            radio: [
              {
              key: "display",
              ignore: false,
               components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "optionsLabelPosition",
                    ignore: true
                  },
               ]
              },
              {
              key: "data",
              ignore: false,
               components: [
                  {
                    key: "dataType",
                    ignore: true
                  },
               ]
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
                components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  },
                  {
                    key: "validate.onlyAvailableItems",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            signature: [
              {
              key: "display",
              ignore: false,
               components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "optionsLabelPosition",
                    ignore: true
                  },
                  {
                    key: "backgroundColor",
                    ignore: true
                  },
                  {
                    key: "penColor",
                    ignore: true
                  },
                  {
                    key: "footer",
                    ignore: true
                  },
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
              components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            file: [
              {
              key: "display",
              ignore: false,
               components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  }
               ]
              },
              {
              key: "data",
              ignore: false,
              },
              {
              key: "file",
              ignore: true,
              components: [
                  {
                    key: "filePattern",
                    ignore: true
                  },
                  {
                    key: "fileTypes",
                    ignore: true
                  },
                ]
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: false,
                components: [
                  {
                    key: "unique",
                    ignore: true
                  },
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            MyNewComponent: [
              {
              key: "display",
              ignore: false,
              components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  }
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "file",
              ignore: true,
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: true,
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "addons",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
            MyBarcodeComponent: [
              {
              key: "display",
              ignore: false,
              components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  }
               ]
              },
              {
              key: "data",
              ignore: true,
              },
              {
              key: "file",
              ignore: true,
              },
              {
              key: "date",
              ignore: true,
              },
              {
              key: "time",
              ignore: true,
              },
              {
              key: "validation",
              ignore: true,
              },
              {
              key: "api",
              ignore: true,
              },
              {
              key: "conditional",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "addons",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
            ],
         /*   checkbox: [
      {
         key: "display",
              ignore: false,
              components: [
                  {
                    key: "labelWidth",
                    ignore: true
                  },
                  {
                    key: "labelMargin",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "shortcut",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  },{
                     key: "inputType",
                     ignore: true
                  }
               ]
      }, {
              key: "data",
              ignore: true,
              }, {
              key: "validation",
              ignore: false,
               components: [
                  {
                    key: "errorLabel",
                    ignore: true
                  },
                  {
                    key: "validate.customMessage",
                    ignore: true
                  },
                  {
                    key: "custom-validation-js",
                    ignore: true
                  },
                  {
                    key: "json-validation-json",
                    ignore: true
                  },
                  {
                    key: "errors",
                    ignore: true
                  }
                ]
              },
              {
              key: "api",
              ignore: true,
              },{
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
              ], */
       selectboxes: [
      {
         key: "display",
              ignore: false,
                components: [
                  {
                    key: "labelPosition",
                    ignore: true
                  },
                  {
                    key: "optionsLabelPosition",
                    ignore: true
                  },
                  {
                    key: "description",
                    ignore: true
                  },
                  {
                    key: "customClass",
                    ignore: true
                  }
               ]
      },
      {
              key: "data",
              ignore: false,
               components: [
                  {
                    key: "defaultValue",
                    ignore: true
                  },
               ]
              },
            {
            key: "validation",
            ignore: false,
            components: [
              {
                key: "unique",
                ignore: true
              },
              {
                key: "errorLabel",
                ignore: true
              },
              {
                key: "validate.customMessage",
                ignore: true
              },
              {
                key: "custom-validation-js",
                ignore: true
              },
              {
                key: "json-validation-json",
                ignore: true
              },
              {
                key: "errors",
                ignore: true
              },
              {
                key: "validate.onlyAvailableItems",
                ignore: true
              },
              {
                  key: "validate.minSelectedCount",
                  ignore: true
              },
              {
                  key: "validate.maxSelectedCount",
                  ignore: true
              },
              {
                  key: "minSelectedCountMessage",
                  ignore: true
              },
              {
                  key: "maxSelectedCountMessage",
                  ignore: true
              }
            ]
            },
            {
              key: "api",
              ignore: true,
              },
              {
              key: "logic",
              ignore: true,
              },
              {
              key: "layout",
              ignore: true,
              }
              ],
          }
        }
      ).then(function(builder) {
        console.log('builder == ', builder);
    builder.on('change', function() {
    console.log('on change');
    submitautoform(builder.schema,'formform');
  });
  /*builder.on('submitDone', function(submission) {
    console.log('on change');
    submitautoform(builder.schema,'formform');
});
  builder.on('saveComponent', function() {
    console.log(builder.schema);
    submitautoform(builder.schema,'formform');
  });*/
});
    </script>

    <script src="{{url('/')}}/resources/views/Admin/assets/js/custom.js"></script>
    <script src="{{url('/')}}/resources/views/Admin/assets/flatpickr/flatpickr.js"></script>
    <script>
      var f1 = flatpickr(document.getElementById("basicFlatpickr1"))


      $('#recordButton').click(function(){
      //  alert('1111');
      });


    </script>
  </body>
</html>
