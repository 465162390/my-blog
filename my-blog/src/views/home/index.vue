<!-- 博客首页 -->
<template>
  <div class="main">
    <div class="cloud"></div>
    <div class="cloud2"></div>
    <div class="header">
      <span class="title">NGKAKUI &nbsp;&nbsp;BLOG</span>
      <span class="quotes">世间所有的相遇，都是久别重逢</span>
      <p class="btn">
        <router-link to="/index">
          <el-button type="primary" plain round><span style="font-size: 25px">Enter</span></el-button>
        </router-link>
      </p>
    </div>
  </div>
</template>

<script>
import { Loading } from 'element-ui'

export default {
  name: '',
  data () {
    return {
      loading: Loading.service({}),
    };
  },

  created() {
    this.loading.close()
  },

  components: {},

  computed: {},

  methods: {

  }
}

</script>

<style scoped>
.main {
  background: url("/static/img/bg.jpg") no-repeat;
  background-size: 100% 100%;
  width: 100%;
  /* height: calc(100vh); */
  height: 100%;
  position: absolute;
}
.header {
  text-align: center;
  width: 100%;
  height: 120px;
  position: relative;
  top: 20%;
}
.title {
  display: block;
  font-size: 80px;
  font-weight: 600;
  color: dodgerblue;
  letter-spacing: 3px;
  font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
}
.quotes {
  margin: 30px 0; 
  display: block;
  font-size: 30px;
  letter-spacing: 10px;
}
.el-button.is-round {
  width: 120px;
  height: 50px;
}
.el-button span {
  font-size: 20px;
}

/** 云特效 **/
@keyframes posterDrop2 {
  from { background-position: 0 0; }
  to { background-position: 500% 0; }
}
.cloud {
  background: url("/static/img/cloud.png") repeat-x 0px 0px;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-size: cover;
  animation: posterDrop2 200s linear infinite;
}

@keyframes posterDrop1 {
  from { background-position: 0 0; }
  to { background-position: 800% 0; }
}
.cloud2 {
  background: url("/static/img/cloud2.png") repeat-x 0px 0px;
  position: absolute;
  width: 100%;
  height: 100%;
  top: 0;
  left: 0;
  background-size: cover;
  animation: posterDrop1 250s linear infinite;
}
/** 云特效 **/

@media (max-width: 600px) {
  .title {
    font-size: 75px;
  }
  .quotes {
    letter-spacing: 0px;
  }
  .cloud {
    background: url("/static/img/cloud.png") repeat-x 0px 0px;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-size: cover;
    animation: posterDrop2 500s linear infinite;
  }
  .cloud2 {
    background: url("/static/img/cloud2.png") repeat-x 0px 0px;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-size: cover;
    animation: posterDrop1 600s linear infinite;
  }
}
@media (max-width: 450px) {
  .title {
    font-size: 65px;
  }
  .quotes {
    font-size: 25px;
  }
}
@media (max-width: 370px) {
  .title {
    font-size: 53px;
  }
  .quotes {
    font-size: 20px;
  }
}
@media (max-width: 300px) {
  .title {
    font-size: 46px;
  }
  .quotes {
    font-size: 16px;
  }
}
</style>