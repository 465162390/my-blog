<!-- 主要内容 -->
<template>
  <div>
    <!-- transition 标签设置路由跳转的过渡效果 -->
    <transition appear name="slide-fade" mode="out-in">
      <router-view :key="Math.random()"/>
    </transition>
    <div class="footer">
      <p>Copyright © {{date}} [ngkakui.cn] All Rights Reserved.</p>
      <p><a target="blank" href="http://www.beian.miit.gov.cn">粤ICP备19145554号-1</a></p>
    </div>
  </div>
</template>

<script>
import { timeFormatter } from '@/utils/vaildata'

export default {
  name: 'AppMain',
  data () {
    return {
      date: timeFormatter("YYYY"),
    };
  },

  created() {},

  components: {},

  computed: {},

  methods: {}
}

</script>
<style scoped>
a {
  text-decoration: none;
  color: #b2bac2
}
.footer {
  clear: both;
  text-align: center;
  margin-top: 15px;
  width: 100%;
  height: 50px;
  color: #b2bac2;
  font-size: 13px;
  margin-bottom: 20px;
}
.footer p {
  margin: 5px;
}

@media(max-width: 450px) {
  .footer { 
    font-size: 12px;
    margin-bottom: 0px;
  }
}

/* 可以设置不同的进入和离开动画 */
/* 设置持续时间和动画函数 */

/* 进入路由、离开完毕 */
.slide-fade-enter, .slide-fade-leave-to {
  transform: translate(100%, 0);
  opacity: 0;
}
/* 进入、离开过程 */
.slide-fade-enter-active, .slide-fade-leave-active {
  transition: all .3s ease;
}
/* 进入完毕、离开路由 */
.slide-fade-enter-to, .slide-fade-leave {
  transform: translate(0%, 0);
  opacity: 1;
}
</style>