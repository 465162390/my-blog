<!-- 前台layout布局 -->
<template>
  <div style="white">
    <navbar/>
    <div class="main">
      <el-row>
        <el-col :xs="4" :sm="4" :md="4" :lg="4" :xl="4" class="hidden-sm-and-down"><sidebar class="app-sidebar grid-content bg-purple"></sidebar></el-col>
        <el-col :xs="1" :sm="1" :md="1" :lg="1" :xl="1" class="hidden-sm-and-down"><el-divider direction="vertical" class="line-height"></el-divider></el-col>
        <el-col :xs="24" :sm="24" :md="19" :lg="19" :xl="19"><app-main class="app-main grid-content bg-purple"></app-main></el-col>
      </el-row>
    </div>
  </div>
</template>

<script>
import Navbar from './components/Navbar'
import Sidebar from './components/Sidebar'
import AppMain from './components/AppMain'

export default {
  name: 'Layout',
  data () {
    return {
    };
  },

  created() {},

  components: {
    Navbar,
    Sidebar,
    AppMain
  },

  computed: {},

  methods: {}
}

</script>
<style scoped>
.line-height {
  min-height: calc(100vh - 110px);
}
.main {
  padding: 40px 0 0;
}
.app-sidebar {
  width: 100%;
  /* background-color: white; */
  display: flex;
  flex-direction: column;
  height: calc(100vh - 65px);
  top: 0;
  bottom: 0;
  left: 0;
  text-align: center;
  overflow-y: auto;
}
.app-main {
  padding-left: 3px;
  overflow: auto;
  height: calc(100vh - 110px);
  margin-left: -25px;
}
@media (max-width: 1240px) {
  .app-main {
    padding: 0 28px 10px 15px;
  }
}
@media (max-width: 991px) {
  .main {
    padding: 20px 0 0;
  }
  .app-main {
    margin-left: 0;
    padding: 0 20px;
  }
}
@media (max-width: 450px) {
  .app-main {
    padding: 0 8px;
  }
}

</style>