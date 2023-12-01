
var htmlComponent = Formio.Components.components.htmlelement; // or whatever

class MyNewComponent extends FieldComponent{
  constructor(component, options, data) {
    super(component, options, data);
    this.checks = [];
  }

  static schema() {
    return FieldComponent.schema({
      type: 'MyNewComponent',
    });
  }


    static get builderInfo() {
      return {
        title: 'Name in the Builder',
        group: 'custom',
        icon: 'picture-o',
        weight: 5,
        schema: MyNewComponent.schema()
      };
    }


     static get builderInfo() {
        return {
          title: 'My Component',
          icon: 'terminal',
          group: 'basic',
          documentation: '/userguide/#textfield',
          weight: 0,
          schema: MyNewComponent.schema()
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
        return super.render('<p><button id="btnStart" class="btn btn-success btn-block mb-2"><i style="margin-right: 5px;" class="fa fa-play"></i> START RECORDING</button><button id="btnStop" class="btn btn-danger btn-block"><i style="margin-right: 5px;" class="fa fa-stop" aria-hidden="true"></i>STOP RECORDING</button></p>');
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
    MyNewComponent: MyNewComponent
  }
});

Formio.createForm(document.getElementById('formio'), {
  components: [
    {
      type: 'MyNewComponent',
      numRows: 6,
      numCols: 6,
      key: 'MyNewComponent',
      label: 'MyNewComponent Matrix'
    }
  ]
});

  // Register your component to Formio
 // Formio.Components.addComponent('MyNewComponent', MyNewComponent);