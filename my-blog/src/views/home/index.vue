<!-- 博客首页 -->
<template>
  <div class="main">
    <div class="cloud"></div>
    <div class="cloud2"></div>
    <div class="header">
      <span class="title">NGKAKUI &nbsp;&nbsp;BLOG</span>
      <span class="quotes">世间所有的相遇，都是久别重逢</span>
      <p class="btn">
        <router-link to="/article">
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

<style src="./index.css" scoped></style>
