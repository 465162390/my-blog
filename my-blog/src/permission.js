/** 配置路由权限 **/
/** 进入后台路由需要登录，并且为博主用户 **/
import router from './router'
import store from './store'
import { Message } from 'element-ui'

// 配置白名单，不用登录的路由
const whiteList = ['/']

// 路由全局前置守卫，判断是否登录跳转到相应页面
router.beforeEach((to, from, next) => {
  const user = store.state.user;

  if (to.meta.requireAuth) {  // 判断该路由是否需要登录权限
    if(user.role == "1") {
      next();
    } else {
      next({
        path: '/'
      })
      Message({
        type: "error",
        message: "你没有权限访问该页面!",
        duration: 2000,
      })
    }
  } else {
    next();
  }
});



