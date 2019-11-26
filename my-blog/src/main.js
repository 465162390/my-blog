import Vue from 'vue'
import App from './App'
import router from './router'
import ElementUI from 'element-ui'
import $ from 'jquery'
import store from '@/store'
import moment from 'moment'
import axios from 'axios'

// 路由权限配置文件
import '@/permission'
// element-ui 
import 'element-ui/lib/theme-chalk/index.css';
//element 中用于某些条件下隐藏元素
import 'element-ui/lib/theme-chalk/display.css';
// Vue自定义组件
import '@/directive'

Vue.use(ElementUI);
Vue.config.productionTip = false

// 全局注册使用moment.js
Vue.prototype.moment = moment;
moment.locale('zh-cn');

/********/
// 上传图片不能被axios拦截
// 单独注册一个axios只用于上传图片
// 根据生产环境、开发环境自动设置axios的请求地址
let protocol = window.location.protocol; //协议
let host = window.location.host; //主机
let reg = /^localhost+/;
let baseURL;
if(reg.test(host)) {
  // 开发环境
  baseURL = "http://localhost:8084/api";
} else {
  // 生产环境
  baseURL = protocol + "//" + host + "/api";
}

Vue.prototype.axios = axios;
let upload = axios.create({
  baseURL: baseURL,
  headers:{"Content-Type":"multipart/form-data"}
});
Vue.prototype.upload = upload;
/********/

new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})
