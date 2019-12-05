<!-- 侧边栏 -->
<template>
  <div>
    <!-- 屏幕宽度 >= 730px -->
    <el-menu :default-active="$route.path" class="el-menu-vertical-demo menu" :collapse="collapse" background-color="#272727" text-color="white" :router="true">
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
      <el-menu-item index="/admin/linkManage">
        <i class="el-icon-share"></i>
        <span slot="title">友情链接管理</span>
      </el-menu-item>
    </el-menu>

    <!-- 屏幕宽度 < 730px -->
    <el-menu :default-active="$route.path" class="el-menu-vertical-demo mobile-menu" :collapse="collapse" background-color="#272727" text-color="white" :router="true">
      <el-submenu index="/admin/article">
        <template slot="title">
          <i class="el-icon-location"></i>
          <span slot="title">文章</span>
        </template>
        <el-menu-item index="/admin/articleManage" @click="changeCollapse">文章管理</el-menu-item>
        <el-menu-item index="/admin/addArticle" @click="changeCollapse">新增文章</el-menu-item>
      </el-submenu>
      <el-menu-item index="/admin/tagManage" @click="changeCollapse">
        <i class="el-icon-menu"></i>
        <span slot="title">标签管理</span>
      </el-menu-item>
      <el-menu-item index="/admin/categoryManage" @click="changeCollapse">
        <i class="el-icon-setting"></i>
        <span slot="title">分类管理</span>
      </el-menu-item>
      <el-menu-item index="/admin/userManage" @click="changeCollapse">
        <i class="el-icon-user"></i>
        <span slot="title">用户管理</span>
      </el-menu-item>
      <el-menu-item index="/admin/linkManage" @click="changeCollapse">
        <i class="el-icon-share"></i>
        <span slot="title">友情链接管理</span>
      </el-menu-item>
      <el-submenu class="header-right show" index="1">
        <template slot="title"><font style="color: #409Eff; vertical-align: baseline">欢迎您，</font>{{this.$store.state.user.name}}</template>
        <el-menu-item index="/article">返回主页</el-menu-item>
        <el-menu-item @click="logout">退出登录</el-menu-item>
      </el-submenu>
    </el-menu>

  </div>
</template>

<script>
import { logout } from "@/api/user";

export default {
  name: "Sidebar",
  data() {
    return {};
  },

  created() {},

  components: {},

  computed: {
    collapse() {
      return this.$store.state.isCollapse;
    }
  },

  methods: {
    // 退出登录
    logout() {
      logout();
      this.$store.state.user = "";
      this.$router.push("/index");
    },

    changeCollapse() {
      this.$store.commit("changeCollapse", true);
    }
  },
};
</script>
<style scoped>
.el-menu-vertical-demo {
  height: 100%;
}
.el-menu-vertical-demo:not(.el-menu--collapse) {
  width: 100%;
}
.mobile-menu {
  display: none
}

@media (max-width: 729px){ 
  .menu {
    display: none;
  }
  .mobile-menu {
    display: block;
  }
}
</style>