import { createApp } from 'vue'
import ExampleComponent from './components/example-component.vue'

const app = createApp({})
app.component('example', ExampleComponent)
app.mount('#app')

//import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap/dist/js/bootstrap.bundle';
import './app';
import './timepicker';
import './numberRedactor';
import './textAreaResizer';
//import './roomsInput';
import './iconsTooltip';
import './modalSelector';
import './objectSelector';
import './pasteCheckbox';
import './confirmationModal';




