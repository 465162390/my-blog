import request from '@/utils/request'

// 根据ip获取用户地址信息
export function getAddressInfo() {
  return request.post('http://ip-api.com/json/?lang=zh-CN')
}

// 获取用户的ip、地址信息
export function getIpInfo(params) {
  return request.post('/ip/fetchCountry.php',params)
}
