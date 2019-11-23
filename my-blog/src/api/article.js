import request from '@/utils/request'

// 新增文章
export function addArticle(params) {
  return request.post('/article/addArticle.php', params)
}

// 查询所有 标签/分类信息
export function fetchOther() {
  return request.post('/article/fetchOther.php')
}

// 前台查询所有文章
export function fetchArticle(params) {
  return request.post('/article/fetchArticle.php', params)
}

// 后台管理查询所有文章
export function articleManage(params) {
  return request.post('/article/articleManage.php', params)
}

// 删除文章
export function delArticle(params) {
  return request.post('/article/delArticle.php', params)
}

// 修改文章是否公开
export function editPublic(params) {
  return request.post('/article/editPublic.php', params)
}

// 查看文章详情
export function fetchDetail(params) {
  return request.post('/article/fetchDetail.php', params)
}

// 修改文章
export function editArticle(params) {
  return request.post('/article/editArticle.php', params)
}

// 新增/删除 文章评论
export function handleComment(params) {
  return request.post('/article/handleComment.php', params)
}

// 查询前5篇热门文章
export function fetchHotArticle(params) {
  return request.post('/article/hotArticle.php', params)
}

