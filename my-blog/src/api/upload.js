import request from '@/utils/request'

// 上传图片
export function upload(params) {
  return request.instance('/img/upload.php', params)
}