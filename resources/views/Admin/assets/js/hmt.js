var htmlComponent = Formio.Components.components.htmlelement; // or whatever
class MyNewComponents extends htmlComponent{

  static schema(...extend) {
    return super.schema({
          type: 'MyNewComponents',
          label: "The Default Label",
          any_other_fields: "",
    }, ...extend);
  }

    static get builderInfo() {
      return {
        title: 'Name in the Builder',
        group: 'custom',
        icon: 'picture-o',
        weight: 5,
        schema: this.schema()
      };
    }

    render(element) {
      // Here's where you add your HTML to get put up.
      // 
      let tpl = "<div ref='myref'>Hi there!</div>";
      // Note the use of the 'ref' tag, which is used later to find 
      // parts of your rendered element.
      
      // If you need to render the superclass,
      // you can do that with 
      // tpl+=super.render(element);

      // This wraps your template to give it the standard label and bulider decorations         
      return Formio.Components.components.component.prototype.render.call(this,tpl);

    }
    
    attach(element) {
      // This code is called after rendering, when the DOM has been created.
      // You can find your elements above like this:
      this.loadRefs(element, {myref: 'single'});

      var superattach = super.attach(element);
       // Here do whatever you need to attach event handlers to the dom.
   //   this.refs.myref.on('click',()=>{alert("hi!");});                    

      return superattach;
    }
    
    getvalue() {
      return 3; // the value this element puts into the form
    }
    // OR, depending on which component type you're basing on:
    getValueAt(index,value,flags) {}

    setValue(value) {
      // modify your DOM here to reflect that the value should be 'value'.
    };
    // OR, depending on what component type:
    getValueAt(index) {}

  }
  
  // This sets the form that pops up in the Builder when you create
  // one of these.  It is basically just a standard form, and you
  // can look at the contents of this in the debugger.
  MyNewComponents.editForm = htmlComponent.editForm;


  // Register your component to Formio
  Formio.Components.addComponent('MyNewComponents', MyNewComponents);