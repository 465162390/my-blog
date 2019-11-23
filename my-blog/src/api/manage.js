import request from '@/utils/request'

// 查询所有 标签/分类信息
export function fetchOther(params) {
  return request.post('/category_tag/fetch.php', params)
}

// 删除 标签/分类 的信息
export function delOther(params) {
  return request.post('/category_tag/del.php', params)
}

// 查询所有用户信息
export function fetchUser(params) {
  return request.post('/user/fetchUser.php', params)
}

// 删除用户信息
export function delUser(params) {
  return request.post('/user/delUser.php', params)
}

// 查询用户详情信息
export function fetchDetail(params) {
  return request.post('/user/fetchDetail.php', params)
}

// 修改用户信息
export function editUser(params) {
  return request.post('/user/editUser.php', params)
}