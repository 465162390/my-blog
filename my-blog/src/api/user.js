import request from '@/utils/request'
import store from '@/store'

// 登录
export function login(params) {
  return request.post('/login/login.php', params)
}

// 注册
export function register(params) {
  return request.post('/login/register.php', params)
}

// 登出
export function logout() {
  store.commit("changeInfo", {});
  window.sessionStorage.removeItem("user");
}

// 微博用户登录
export function weiboLogin(params) {
  return request.post('/login/weiboLogin.php', params)
}

// qq用户登录
export function qqLogin(params) {
  return request.post('/login/qqLogin.php', params)
}

// github用户登录
export function githubLogin(params) {
  return request.post('/login/githubLogin.php', params)
}

// 绑定本站账号
export function bindUser(params) {
  return request.post('/login/bindUser.php', params)
}
