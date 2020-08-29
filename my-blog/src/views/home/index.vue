<!-- 博客首页 -->
<template>
  <div class="main">
    <div class="cloud"></div>
    <!-- <div class="cloud2"></div> -->
    <div class="header">
      <span class="title"><strong>NGKAKUI</strong>&nbsp;&nbsp;<strong>BLOG</strong></span>
      <span class="quotes">世间所有的相遇，都是久别重逢</span>
      <p class="btn">
        <router-link to="/article">
          <el-button type="primary" plain round><span style="font-size: 25px">Enter</span></el-button>
        </router-link>
      </p>
    </div>
    <div class="footer">
      <p>博客总访问人数：{{this.$store.state.vistorNum.toLocaleString()}}</p>
      <p>Copyright © {{date}} [ngkakui.cn] All Rights Reserved.</p>
      <p><a target="blank" href="http://www.beian.miit.gov.cn">粤ICP备19145554号-1</a></p>
    </div>
  </div>
</template>

<script>
import { Loading } from 'element-ui'
import { addVistor } from '@/api/blogData'
import { timeFormatter } from '@/utils/vaildata'

export default {
  name: 'Home',
  data () {
    return {
      date: timeFormatter("YYYY"),
      loading: Loading.service({}),
    };
  },

  created() {
    this.loading.close();
    addVistor().then(response => {
      this.$store.commit("changeVistorNum", response.num);
      sessionStorage.setItem("vistorNum", response.num);
    })
    this.clearStorage();
  },

  components: {},

  computed: {},

  methods: {
    // 清理已经过期的文章点赞记录
    clearStorage() {
      for( let i=0; i<localStorage.length; i++) {
        let key = localStorage.key(i)
        let time = new Date().getTime();
        if( key.indexOf("articleLike") >= 0 && localStorage.getItem(key) < time ) {
          // 将localStorage中过期的点赞记录删除
          // 将Vuex中articleId中的过期的记录也删除
          // 然后将Vuex中的记录重新写到localStorage中，覆盖原来的记录
          localStorage.removeItem(key);
          let likeId = this.$store.state.articleId;
          likeId.splice(likeId.indexOf(key), 1);
          likeId.length == 0 ? localStorage.removeItem("likeId")
           : localStorage.setItem("likeId", JSON.stringify(likeId));
        }
      }
    }
  }
}

</script>

<style src="./index.css" scoped></style>
