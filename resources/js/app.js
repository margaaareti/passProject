import { createApp } from 'vue'
import ButtonComponent from './components/button-component.vue'

const app = createApp({})
app.component('button-component', ButtonComponent)
app.mount('#newapp')

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

console.log(['foo']);



// const vue = createApp()
//
// const components = import.meta.glob('./pages/**/*.vue')
//
// Object.entries(components).forEach(([ path, module ]) => {
//     const Array = path.replace(/\.\/pages\//, '').split('/')
//
//     const name = Array.join('-').toLowerCase().replace(/\.vue$/, '')
//
//     vue.component(name, defineAsyncComponent(module))
// })
//
// vue.mount("#app")

