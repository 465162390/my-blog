/** 归档api **/
import request from '@/utils/request'

// 归档文章
export function fetch(params) {
  return request.post('/archives/archives.php', params)
}

// 根据 标签/分类 归档文章
export function otherArchives(params) {
  return request.post('/archives/otherArchives.php', params)
}