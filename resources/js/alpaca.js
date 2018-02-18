/**
 * bootstrap-vue.js
 */
import Tabs from 'bootstrap-vue/es/components/tabs';
import Modal from 'bootstrap-vue/es/components/modal';
import Tooltip from 'bootstrap-vue/es/directives/tooltip';

Vue.use(Tabs);
Vue.use(Modal);
Vue.use(Tooltip);

/**
 * vue-quill-editor
 */
import VueQuillEditor from 'vue-quill-editor'

// require styles
// import 'quill/dist/quill.core.css'
// import 'quill/dist/quill.snow.css'
// import 'quill/dist/quill.bubble.css'

Vue.use(VueQuillEditor, /* { default global options } */)