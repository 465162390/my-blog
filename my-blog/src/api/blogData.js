/** 博客数据api **/
import request from '@/utils/request'
import vistorRequest from '@/utils/vistorRequest'

// 新增访客数量
export function addVistor() {
  return vistorRequest.get('/blogData/addVistor.php')
}

// 获取当前的博客记录
export function fetchData() {
  return request.get('/blogData/fetchData.php')
}