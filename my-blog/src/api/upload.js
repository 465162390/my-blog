import axios from 'axios'

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

let upload = axios.create({
  baseURL: baseURL,
  headers:{"Content-Type":"multipart/form-data"}
});

export function upload(url , params) {
  return upload.post(url, params)
}
