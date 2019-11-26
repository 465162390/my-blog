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
<style src="./index.css" scoped></style>