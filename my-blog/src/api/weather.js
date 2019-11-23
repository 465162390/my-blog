import request from '@/utils/request'

// 获取实况天气信息
export function getNow(params) {
  return request.get('https://free-api.heweather.net/s6/weather/now', params)
}

// 获取未来3天天气预报信息
export function getForecast(params) {
  return request.get('https://free-api.heweather.net/s6/weather/forecast', params)
}

// 获取生活指数信息
export function getLiveStyle(params) {
  return request.get('https://free-api.heweather.net/s6/weather/lifestyle', params)
}

// 获取空气质量信息
export function getAir(params) {
  return request.get('https://free-api.heweather.net/s6/air/now', params)
}
