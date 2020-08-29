<!-- 后台layout布局 -->
<template>
  <div style="background:#f0f2f5;">
    <navbar class="navbar" />
    <div class="container">
      <sidebar :class="sideClass"></sidebar>
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
    return {};
  },

  created() {},

  components: {
    Navbar,
    Sidebar,
    AppMain,
  },

  computed: {
    isCollapse() {
      return this.$store.state.isCollapse
    },
    sideClass() {
      let collapse
      this.isCollapse == true ? collapse = "app-sidebar-hidden" : collapse = "app-sidebar" 
      return collapse
    },
    mainClass() {
      let collapse
      this.isCollapse == true ? collapse = "app-main-hidden" : collapse = "app-main"
      return collapse 
    }
  },
  methods: {}
}

</script>
<style src="./index.css" scoped></style>

<style>
.pagination {
  margin-top: 18px;
  float: right;
  margin-bottom: 15px;
}
</style>