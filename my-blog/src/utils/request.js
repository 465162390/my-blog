import axios from 'axios'
import { Message, Loading } from 'element-ui'
import { type } from 'os'
import qs from 'qs'

// 根据生产环境、开发环境自动设置axios的请求地址
let protocol = window.location.protocol; //协议
let host = window.location.host; //主机
let reg = /^localhost+/;
if(reg.test(host)) {
  // 开发环境
  axios.defaults.baseURL = "http://localhost:8084/api";
} else {
  // 生产环境
  axios.defaults.baseURL = protocol + "//" + host + "/api";
}

// axios.defaults.timeout = 5000  // 请求超过时间
// axios.defaults.headers['Content-Type'] = 'application/x-www-form-urlencoded';

// 页面loading状态
let loading;

// 请求拦截
axios.interceptors.request.use(
  loading = Loading.service({}),
  config => {
    // if (store.getters.token) {
    //   config.headers['Authorization'] = `Bearer ${store.getters.token}`
    // }
    return config
  },error => {
  loading.close()
  Message({
    message: error.message,
    type: 'error',
    duration: 2000
  })
  console.log(error) // for debug
  return Promise.reject(error)
})

// 响应拦截
axios.interceptors.response.use( response => {
  loading.close()
  if(response.data.code == 200) {
    response.data.type = "success";
  } else {
    response.data.type = "error";
  }
  return response.data
},error => {
  console.log('err' + error) // for debug
  Message({
    message: error.message,
    type: 'error',
    duration: 2000
  })
  // return Promise.reject(error)
})

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

/**
 * put请求
 * @param url
 * @param params
 * @returns {Promise}
 */
const put = (url, params) => {
  return new Promise(async (resolve, reject) => {
    try {
      const res = await axios.put(url, params)
      resolve(res)
    } catch (err) {
      reject(err)
    }
  })
}

/**
 * delete请求
 * @param url
 * @param params
 * @returns {Promise}
 */
const del = (url, params) => {
  return new Promise(async (resolve, reject) => {
    try {
      const res = await axios.delete(url, {
        data: params
      })
      resolve(res)
    } catch (err) {
      reject(err)
    }
  })
}

export default {
  get,
  post,
  put,
  del,
}