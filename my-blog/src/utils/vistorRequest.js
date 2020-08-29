import axios from 'axios'
import qs from 'qs'

// 新建一个用于访客数量、点赞、查看数的axios
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

// 请求是否允许携带 cookie，默认不允许
axios.withCredentials = true;

/**
 * get请求
 * @param url
 * @param params
 * @returns {Promise}
 */
const get = (url, params) => {
  return new Promise(async (resolve, reject) => {
    try {
      const res = await axios.get(url, {
        params: params
      })
      resolve(res)
    } catch (err) {
      reject(err)
    }
  })
}

/**
 * post请求
 * @param url
 * @param params
 * @returns {Promise}
 */
const post = (url, params) => {
  params = qs.stringify(params);
  return new Promise(async (resolve, reject) => {
    try {
      const res = await axios.post(url, params)
      resolve(res)
    } catch (err) {
      reject(err)
    }
  })
}

export default {
  get,
  post,
}