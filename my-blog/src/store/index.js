import Vue from 'vue'
import Vuex from 'vuex'

Vue.use(Vuex)

const store = new Vuex.Store({
  state: {
    // 用户ip、地址信息
    ipInfo: JSON.parse(window.sessionStorage.getItem("ipInfo")) !== null ? JSON.parse(window.sessionStorage.getItem("ipInfo")) : "",

    // 登录账号信息
    user: JSON.parse(window.sessionStorage.getItem("user")) !== null ? JSON.parse(window.sessionStorage.getItem("user")) : "",

    // 热门文章title
    hotArticles: [],

    // 标签/分类
    tags: [],

    // 后台侧边栏的收展
    isCollapse: true,

  },

  mutations: {
    // 用户ip信息
    setIp(state, params) {
      state.ipInfo = params;
    },
    // 登录的账号信息
    changeInfo(state, params) {  //这里的state对应上面状态state
      state.user = params;
    },
    // 热门文章
    changeHotArticles(state, params) {
      state.hotArticles = params;
    },
    // 标签/分类
    changeTags(state, params) {
      state.tags = params;
    },
    // 侧边栏收展
    changeCollapse(state, params) {
      state.isCollapse = params;
    }
  }

})

export default store
