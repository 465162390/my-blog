// 后台路由
import Layout from '@/Layout/admin'

export default {
  path: '/admin',
  redirect: '/admin/articleManage',
  component: Layout,
  children: [
    {
      path: '/admin/articleManage',
      name: '文章管理',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/article/manage'),
    },
    {
      path: '/admin/addArticle',
      name: '新增文章',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/article/edit'),
    },
    {
      path: '/admin/tagManage',
      name: '标签管理',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/tag'),
    },
    {
      path: '/admin/categoryManage',
      name: '分类管理',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/category'),
    },
    {
      path: '/admin/userManage',
      name: '用户管理',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/user'),
    },
    {
      path: '/admin/editArticle/:id',
      name: '修改文章',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/article/edit'),
    },
    {
      path: '/admin/linkManage',
      name: '友情链接管理',
      meta: {
        requireAuth: true,  // 添加该字段，表示进入这个路由是需要登录的
      },
      component: () => import('@/views/admin/link'),
    },
  ]
}

