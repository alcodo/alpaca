/**
 * bootstrap-vue.js
 */
import Tabs from 'bootstrap-vue/es/components/tabs';
import Modal from 'bootstrap-vue/es/components/modal';
import Collapse from 'bootstrap-vue/es/components/collapse';
import Tooltip from 'bootstrap-vue/es/directives/tooltip';
import Toggle from 'bootstrap-vue/es/directives/toggle';

Vue.use(Tabs);
Vue.use(Modal);
Vue.use(Collapse);
Vue.use(Tooltip);
Vue.use(Toggle);

/**
 * vue-quill-editor
 */
import VueQuillEditor from 'vue-quill-editor'
Vue.use(VueQuillEditor);

/**
 * Alpaca
 */
import HtmlForm from './components/HtmlForm';
import { registerComponents, vueUse } from 'bootstrap-vue/es/utils';

var components = {
    'html-form': HtmlForm,
};

var VuePlugin = {
    install: function install(Vue) {
        registerComponents(Vue, components);
    }
};

vueUse(VuePlugin);

export default VuePlugin;