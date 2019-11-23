<!--  -->
<template>
  <div>
    <el-menu :default-active="$route.path" class="el-menu-vertical-demo" :collapse="isCollapse" background-color="#272727" text-color="white" :router="true">
      <el-submenu index="/admin/article">
        <template slot="title">
          <i class="el-icon-location"></i>
          <span slot="title">文章</span>
        </template>
        <el-menu-item index="/admin/articleManage">文章管理</el-menu-item>
        <el-menu-item index="/admin/addArticle">新增文章</el-menu-item>
      </el-submenu>

      <el-menu-item index="/admin/tagManage">
        <i class="el-icon-menu"></i>
        <span slot="title">标签管理</span>
      </el-menu-item>

      <el-menu-item index="/admin/categoryManage">
        <i class="el-icon-setting"></i>
        <span slot="title">分类管理</span>
      </el-menu-item>

      <el-menu-item index="/admin/userManage">
        <i class="el-icon-user"></i>
        <span slot="title">用户管理</span>
      </el-menu-item>

    </el-menu>
  </div>
</template>

<script>
export default {
  name: "Sidebar",
  data() {
    return {};
  },
  props: {
    isCollapse: {
      type: Boolean,
    }
  },

  created() {},

  components: {},

  computed: {},

  methods: {},
};
</script>
<style scoped>
/* .el-menu-vertical-demo > .el-menu-item {
  float: left;
} */
.el-menu-vertical-demo {
  height: 100%;
}
.el-menu-vertical-demo:not(.el-menu--collapse) {
  width: 100%;
}
</style>