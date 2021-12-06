require('./bootstrap');

import Vue from 'vue';
import PreviewButton from './components/PreviewButton.vue';
import Preview from './components/Preview.vue';

Vue.component('PreviewButton', PreviewButton);
Vue.component('Preview', Preview);
window.Event = new Vue();

var app = new Vue({
    el: '#app',
    components: {
        'preview-button': PreviewButton,
        'preview': Preview,
    }
});
