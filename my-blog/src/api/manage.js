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

// 查询用户详细信息
export function fetchDetail(params) {
  return request.post('/user/fetchDetail.php', params)
}

// 删除用户信息
export function delUser(params) {
  return request.post('/user/delUser.php', params)
}

// 修改用户信息
export function editUser(params) {
  return request.post('/user/editUser.php', params)
}

// 查询友情链接
export function fetchLink(params) {
  return request.post('/link/fetchLink.php', params)
}

// 新增/修改友情链接
export function editLink(params) {
  return request.post('/link/editLink.php', params)
}

// 删除友情链接
export function delLink(params) {
  return request.post('/link/delLink.php', params)
}