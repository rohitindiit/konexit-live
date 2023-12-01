
var htmlComponent = Formio.Components.components.htmlelement; // or whatever

class MyBarcodeComponent extends FieldComponent{
  constructor(component, options, data) {
    super(component, options, data);
    this.checks = [];
  }

  static schema() {
    return FieldComponent.schema({
      type: 'MyBarcodeComponent',
    });
  }


    static get builderInfo() {
      return {
        title: 'Name in the Builder',
        group: 'custom',
        icon: 'picture-o',
        weight: 5,
        schema: MyBarcodeComponent.schema()
      };
    }


     static get builderInfo() {
        return {
          title: 'My Component',
          icon: 'terminal',
          group: 'basic',
          documentation: '/userguide/#textfield',
          weight: 0,
          schema: MyBarcodeComponent.schema()
        };
    }

    init() {
        super.init();
    }

      get inputInfo() {
        const info = super.inputInfo;
        return info;
    }

     render(content) {
        return super.render(' <img width="100px" class="imagesrc" src="https://konexit.s3.us-east-2.amazonaws.com/projectuse/qr-code.png"/> <!--span class="btn btn-primary btn-sm formcomponent inline-block" data-type="MyBarcodeComponent" data-key="MyBarcodeComponent" data-group="customLayout"><i style="margin-right: 5px;" class="fa fa-qrcode"></i>QR/Barcode</span-->');
    }


     detach() {
        return super.detach();
    }
 
    destroy() {
        return super.destroy();
    }


     normalizeValue(value, flags = {}) {
        return super.normalizeValue(value, flags);
    }
    
    getValue() {
        return super.getValue();
    }

     getValueAt(index) {
        return super.getValueAt(index);
    }
    

    setValueAt(index, value, flags = {}) {
        return super.setValueAt(index, value, flags);
    }


    updateValue(value, flags = {}) {
        return super.updateValue(...args);
    }

   /* attach(element) {
      // This code is called after rendering, when the DOM has been created.
      // You can find your elements above like this:
      this.loadRefs(element, {myref: 'single'});

      var superattach = super.attach(element);
       // Here do whatever you need to attach event handlers to the dom.
      this.refs.myref.on('click',()=>{alert("hi!");});                    

      return superattach;
    }*/
    
    // OR, depending on which component type you're basing on:
   /* getValueAt(index,value,flags) {}*/

    setValue(value) {
      // modify your DOM here to reflect that the value should be 'value'.
    };
    // OR, depending on what component type:
   /* getValueAt(index) {}*/

  }

  
  // This sets the form that pops up in the Builder when you create
  // one of these.  It is basically just a standard form, and you
  // can look at the contents of this in the debugger.
//  MyNewComponent.editForm = htmlComponent.editForm;

Formio.use({
  components: {
    MyBarcodeComponent: MyBarcodeComponent
  }
});

Formio.createForm(document.getElementById('formio'), {
  components: [
    {
      type: 'MyBarcodeComponent',
      numRows: 6,
      numCols: 6,
      key: 'MyBarcodeComponent',
      label: 'MyBarcodeComponent Matrix'
    }
  ]
});

  // Register your component to Formio
 // Formio.Components.addComponent('MyNewComponent', MyNewComponent);