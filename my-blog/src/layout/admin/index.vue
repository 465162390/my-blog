<!-- 后台layout布局 -->
<template>
  <div style="background:#f0f2f5;">
    <navbar @showCollapse="showCollapse" />
    <div class="container">
      <sidebar :class="sideClass" :isCollapse="isCollapse"></sidebar>
      <app-main :class="mainClass"></app-main>
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
      isCollapse: false,
      sideClass: "app-sidebar",
      mainClass: "app-main"
    };
  },

  created() {},

  components: {
    Navbar,
    Sidebar,
    AppMain
  },

  computed: {},

  methods: {
    // 侧边栏收展
    showCollapse(collapse) {
      this.isCollapse = collapse
      if(collapse == true) {
        this.sideClass = "app-sidebar-hidden"
        this.mainClass = "app-main-hidden"
      } else {
        this.sideClass = "app-sidebar"
        this.mainClass = "app-main"
      }
    }
  }
}

</script>
<style scoped>
.container {
  display: flex;
  flex-direction: row;
  flex: 1;  
  width: 100%
}

.app-sidebar {
  width: 240px;
  height: calc(100vh - 65px);
  margin-top: -4px;
}
.app-sidebar-hidden {
  transition: .5s;
  width: 65px;
  height: calc(100vh - 65px);
  margin-top: -4px;
}

.app-main {
  padding: 20px;
  margin: 15px;
  width: calc(100% - 240px);
  background: white;
  overflow: auto;
  height: calc(100vh - 100px);
}
.app-main-hidden {
  padding: 20px;
  margin: 15px;
  width: calc(100% - 65px);
  background: white;
  overflow: auto;
  height: calc(100vh - 100px);
}
</style>