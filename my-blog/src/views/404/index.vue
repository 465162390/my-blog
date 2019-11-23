<!-- 404页面 -->
<template>
  <div>
    <div style="text-align: center; margin-top: 60px">
      <div class="img">
        <img src="../../../static/img/404/404.png">
      </div>
      <div class="title">Sorry, the page you visited does not exist.</div>
      <div class="btn">
        <router-link to="/index"><el-button type="primary" @click="registerVisible = true">Back to Home</el-button></router-link>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: '',
  data () {
    return {
    };
  },

  created() {
  },

  components: {},

  computed: {},

  methods: {}
}

</script>

<style scoped>
.title {
  color: rgba(0,0,0,.45);
  font-size: 16px;
  line-height: 1.6;
  margin: 15px 0;
}
.img {
  margin: 0 auto;
  width: 700px;
  height: 400px;
}
.img img {
  width: 100%;
  height: 100;
}
</style>