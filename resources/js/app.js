import { createApp } from 'vue'
import components from "./components/UiElements"

const app = createApp({})
components.forEach(component=>{
    app.component(component.name,component)
})
app.mount('#vueApp')


//import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle';
import './timepicker';
import './numberRedactor';
import './textAreaResizer';
//import './roomsInput';
import './iconsTooltip';
import './modalSelector';
import './objectSelector';
import './pasteCheckbox';
import './confirmationModal';


