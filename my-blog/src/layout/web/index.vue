<!-- 前台layout布局 -->
<template>
  <div>
    <navbar class="navbar" />
    <div class="main">
      <sidebar class="app-sidebar"></sidebar>
      <app-main class="app-main"></app-main>
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
    AppMain,
  },

  computed: {},

  methods: {}
}

</script>
<style src="./index.css" scoped></style>