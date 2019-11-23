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
