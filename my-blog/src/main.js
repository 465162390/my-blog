import Vue from 'vue'
import App from './App'
import router from './router'
import $ from 'jquery'
import store from '@/store'

// 路由权限配置文件
import '@/permission'

// element-ui 
import 'element-ui/lib/theme-chalk/index.css';

//element 中用于某些条件下隐藏元素
import 'element-ui/lib/theme-chalk/display.css';

// Vue自定义组件
import '@/directive'

// 全局引入 tui-editor 编辑器
import Editor from 'tui-editor';
import Viewer from 'tui-editor/dist/tui-editor-Viewer';
Vue.prototype.Editor = Editor
Vue.prototype.Viewer = Viewer

// ElementUI
import ElementUI from 'element-ui'
Vue.use(ElementUI);
Vue.config.productionTip = false

// 全局注册使用moment.js
import moment from 'moment'
Vue.prototype.moment = moment;
moment.locale('zh-cn');

new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
