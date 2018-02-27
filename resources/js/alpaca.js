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
 * https://github.com/Alex-D/Trumbowyg
 * https://github.com/ankurk91/vue-trumbowyg
 */
$.trumbowyg.svgPath = '/assets/icons/icons.svg';
import VueTrumbowyg from 'vue-trumbowyg';

Vue.use(VueTrumbowyg);

/**
 * http://dimsemenov.com/plugins/magnific-popup/
 */
import MagnificPopup from 'magnific-popup';
$(function () {
    $('.is-popup').magnificPopup({type: 'image'});
});

/**
 * https://github.com/apertureless/vue-chartjs
 */
// import VueCharts from 'vue-chartjs';
// import { Bar, Line } from 'vue-chartjs'

/**
 * Alpaca
 */
import PieChart from './components/PieChart';
import LineChart from './components/LineChart';
import HorizontalBarChart from './components/HorizontalBarChart';
import HtmlForm from './components/HtmlForm';
import {registerComponents, vueUse} from 'bootstrap-vue/es/utils';

var components = {
    'html-form': HtmlForm,
    'line-chart': LineChart,
    'pie-chart': PieChart,
    'horizontal-bar-chart': HorizontalBarChart,
};

var VuePlugin = {
    install: function install(Vue) {
        registerComponents(Vue, components);
    }
};

vueUse(VuePlugin);

export default VuePlugin;