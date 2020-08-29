// 前台路由
import Layout from '@/Layout/web'

export default {
  path: '/article',
  component: Layout,
  children: [
    {
      path: '/article',
      name: '首页',
      component: () => import('@/views/web/home/index'),
    },
    {
      path: '/about',
      name: '关于',
      component: () => import('@/views/web/about/index'),
    },
    {
      path: '/archives',
      name: '归档',
      component: () => import('@/views/web/archives/index'),
    },
    {
      path: '/categories',
      name: '分类、标签',
      component: () => import('@/views/web/categories/index'),
    },
    {
      path: '/message',
      name: '留言板',
      component: () => import('@/views/web/message/index'),
    },
    {
      path: '/article/:id',
      name: '文章详情',
      component: () => import('@/views/web/detail/index'),
    },
    {
      path: '/tags/:param',
      name: '标签归档',
      component: () => import('@/views/web/category_tag/index'),
    },
    {
      path: '/categories/:param',
      name: '分类归档',
      component: () => import('@/views/web/category_tag/index'),
    },
    {
      path: '/404',
      name: '404',
      component: () => import('@/views/404'),
    },
  ]
}

