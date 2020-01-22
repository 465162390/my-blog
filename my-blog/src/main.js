import Vue from 'vue'
import App from './App'
import router from './router'
import store from '@/store'

// 路由权限配置文件
import '@/permission'

// element-ui 
import 'element-ui/lib/theme-chalk/index.css';
//element 中用于某些条件下隐藏元素
import 'element-ui/lib/theme-chalk/display.css';
// element-ui 组件
import element from '@/element-ui'
Vue.use(element)

// Vue自定义组件
import '@/directive'

let vue = new Vue({
  el: '#app',
  router,
  store,
  components: { App },
  template: '<App/>'
})

// 导出vue实例,外部js需要调用vue实例时可以引入main.js
export default vue