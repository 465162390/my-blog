import Vue from 'vue'
import Router from 'vue-router'
// 引入前台路由
import webRouter from './web'
// 引入后台路由
import adminRouter from './admin'

Vue.use(Router)

// 跳转到当前页面 Vue-router 报错 Navigating to current location ("xxx") is not allowed
// 解决办法一：Vue-router 3.1以上版本才会出现这个问题，回退到3.0的版本也能解决
// 解决办法二：加下面这段代码
const originalPush = Router.prototype.push
Router.prototype.push = function push(location) {
  return originalPush.call(this, location).catch(err => err)
}

export default new Router({
  routes: [
    {
      path: '/',
      name: '往事随风',
      component: () => import('@/views/home'),
    },
    adminRouter,
    webRouter,
    // 404页面的路由必须放在最后
    { 
      path: '*', 
      redirect: '/404', 
      hidden: true
    }
  ],
  mode: 'history',
})
