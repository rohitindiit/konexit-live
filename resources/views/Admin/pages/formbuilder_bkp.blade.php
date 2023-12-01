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
    <link rel="icon" type="image/x-icon" href="{{url('/')}}/resources/views/admin/assets/img/favicon.ico" />
    <link href="{{url('/')}}/resources/views/admin/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{url('/')}}/resources/views/admin/assets/js/loader.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
      rel="stylesheet"
    />
    <link
      href="{{url('/')}}/resources/views/admin/assets/bootstrap/css/bootstrap.min.css"
      rel="stylesheet"
      type="text/css"
    />

    <link
      rel="stylesheet"
      type="text/css"
      href="{{url('/')}}/resources/views/admin/assets/css/widgets/modules-widgets.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="{{url('/')}}/resources/views/admin/assets/flatpickr/flatpickr.css"
    />
    <link
      rel="stylesheet"
      type="text/css"
      href="https://cdn.form.io/formiojs/formio.full.min.css"
    />
    <link href="{{url('/')}}/resources/views/admin/assets/css/plugins.css" rel="stylesheet" type="text/css" />
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
              <span><img src="{{url('/')}}/resources/views/admin/assets/img/arrowback.svg" /></span>
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
      <div class="overlay"></div>
      <div class="search-overlay"></div>
      <div id="content" class="main-content ml-0">
        <div class="layout-px-spacing">
          <div class="row layout-top-spacing px-2">
            <div class="col-md-12">
              <div id="builder"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script src="{{url('/')}}/resources/views/admin/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.form.io/formiojs/formio.full.min.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/css/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/js/app.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/js/testform.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/js/audiotag.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/js/mynewcomp.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/js/MyBarcodeComponent.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/js/hmt.js"></script>
    
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
              type: "well",
              key: "well",
              label: "well Name"
            },
            {
              type: "url",
              key: "url",
              label: "url Name"
            },
             {
              type: "resource",
              key: "resource",
              label: "resource Name"
            },
            {
              type: "panel",
              key: "panel",
              label: "panel Name"
            },
             {
              type: "form",
              key: "form",
              label: "form Name"
            },
            {
              type: "content",
              key: "content",
              label: "content Name"
            },
             {
              type: 'checkmatrix',
              numRows: 6,
              numCols: 6,
              key: 'checkmatrix',
              label: 'Check Matrix'
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
                submit: {
                  title: "Submit",
                  key: "submit1",
                  icon: "upload",
                  schema: {
                    label: "Submit",
                    type: "button",
                    key: "submit1",
                    input: true
                  }
                }
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
                    title: "Location Capture2",
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
                  key: "dfdfgdgdgdgdgfdfgdfgdgdfg"
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
                address: {
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
                },
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
                 textfield4: {
                  title: "Voice Recorder",
                  key: "textarea",
                  icon: "microphone",
                  schema: {
                    label: "Voice Recorder",
                    autoExpand: false,
                    tableView: true,
                    key: "textArea",
                    type: "textarea",
                    input: true
                  }
                },
                textfield3: {
                  title: "QR/Barcode",
                  key: "textfield",
                  icon: "qrcode",
                  schema: {
                    label: "QR/Barcode",
                    type: "textfield",
                    key: "textfield",
                    input: true
                  }
                },
                 checkmatrix: {
                  title: "check/Barcode",
                  key: "checkmatrix",
                  icon: "qrcode",
                  schema: {
                    label: "Check Matrix",
                    type: "checkmatrix",
                    key: "checkmatrix",
                    input: true,
                    numCols: 6,
                    numRows:6
                  }
                },
                audiotag: {
                  title: "audio/Barcode",
                  key: "audiotag",
                  icon: "qrcode",
                  schema: {
                    label: "Audio Tag",
                    type: "audiotag",
                    key: "audiotag",
                    input: false,
                     numCols: 6,
                    numRows:6,
                    content:'<button class="starts">Start</button>'
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
                MyNewComponents: {
                  title: "Voice Recording2",
                  key: "MyNewComponents",
                  icon: "microphone",
                  schema: {
                    label: "Voice Recording",
                    type: "MyNewComponents",
                    key: "MyNewComponents",
                    input: true,
                     numCols: 6,
                    numRows:6
                  }
                },
                favoriteThings: {
                  title: "Voice Recording",
                  key: "favoriteThings",
                  icon: "microphone",
                  schema: {
                    title: "favoriteThings",
                    type: "button",
                    label: "Favorite Things",
                    key: "favoriteThings",
                    placeholder: "These are a few of your favorite things...",
                    data: {
                      values: [
                        {
                          value: "raindropsOnRoses",
                          label: "Raindrops on roses"
                        },
                        {
                          value: "whiskersOnKittens",
                          label: "Whiskers on Kittens"
                        },
                        {
                          value: "brightCopperKettles",
                          label: "Bright Copper Kettles"
                        },
                        {
                          value: "warmWoolenMittens",
                          label: "Warm Woolen Mittens"
                        }
                      ]
                    },
                    dataSrc: "values",
                    template: "<button>start</button> <button>stop</button>",
                    multiple: true,
                    input: true
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
              },
              {
               key: "data",
               ignore: true,
              },
              {
                key: "validation",
                ignore: false,
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
          }
        }
      ).then(function(builder) {
  builder.on('saveComponent', function() {
    console.log(builder.schema);
  });
});
    </script>

    <script src="{{url('/')}}/resources/views/admin/assets/js/custom.js"></script>
    <script src="{{url('/')}}/resources/views/admin/assets/flatpickr/flatpickr.js"></script>
    <script>
      var f1 = flatpickr(document.getElementById("basicFlatpickr1"))


      $('#recordButton').click(function(){
        alert('1111');
      });
    </script>
  </body>
</html>
