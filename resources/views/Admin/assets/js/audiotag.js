
const HTMLComponent = Formio.Components.components.htmlelement;
const Input = Formio.Components.components.input;
class Audiotag extends HTMLComponent{
   static schema(...extend) {
        return HTMLComponent.schema({
			label: 'Audiotag',
			type: 'audiotag',
			tag: 'h1'
        });
    }
    
    /**
     * This is the Form Builder information on how this component should show
     * up within the form builder. The "title" is the label that will be given
     * to the button to drag-and-drop on the buidler. The "icon" is the font awesome
     * icon that will show next to it, the "group" is the component group where
     * this component will show up, and the weight is the position within that
     * group where it will be shown. The "schema" field is used as the default
     * JSON schema of the component when it is dragged onto the form.
     */
    static get builderInfo() {
    return {
      title: 'Audiotag',
      group: 'layout',
      icon: 'code',
      weight: 2,
      documentation: '/userguide/#html-element-component',
      schema: Audiotag.schema()
    };
  }


    
  /* 
    constructor(component, options, data) {
        super(component, options, data);
    }
    
   
    init() {
        super.init();
    }
    
  
    get inputInfo() {
        const info = super.inputInfo;
        return info;
    }
    
   
    render(content) {
        return super.render('<div ref="customRef">This is a custom component!</div>');
    }
    
  
    attach(element) {
      
        this.loadRefs(element, {
          customRef: 'single',
        });
        
      
        this.addEventListener(this.refs.customRef, 'click', () => {
            console.log('Custom Ref has been clicked!!!');        
        });
        return super.attach(element);
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
    

    setValue(value, flags = {}) {
        return super.setValue(value, flags);
    }
    
  
    setValueAt(index, value, flags = {}) {
        return super.setValueAt(index, value, flags);
    }
    
   
    updateValue(value, flags = {}) {
        return super.updateValue(value);
    }*/
}



  Audiotag.editForm = (...args) => {
  const editForm = HTMLComponent.editForm(...args);
  const tagComponent = Formio.Utils.getComponent(editForm.components, 'tag');
  tagComponent.type = 'select';
  tagComponent.dataSrc = 'values';
  tagComponent.data = {
    values: [
      {label: 'H1', value: 'h1'},
      {label: 'H2', value: 'h2'},
      {label: 'H3', value: 'h3'},
      {label: 'H4', value: 'h4'},
      {label: 'H5', value: 'h5'}
    ]
  };
  return editForm;
};

Formio.use({
  components: {
    audiotag: Audiotag
  }
});

Formio.createForm(document.getElementById('formio'), {
  components: [
    {
      type: 'audiotag',
      numRows: 6,
      numCols: 6,
      key: 'audiotag',
      label: 'Check Matrix'
    }
  ]
});