import request from '@/utils/request'

// 查询所有留言信息
export function fetchMessage(params) {
  return request.post('/message/fetchMessage.php', params)
}

// 新增/删除 留言
export function handleMessage(params) {
  return request.post('/message/handleMessage.php', params)
}