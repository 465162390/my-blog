<!--  -->
<template>
  <div>
    <el-menu class="el-menu" mode="horizontal" :router="true">

      <el-menu-item class="header-left">NGKAKUI的博客</el-menu-item>

      <el-menu-item>
        <el-divider direction="vertical" class="line"></el-divider>
        <!-- 侧边栏收缩按钮 -->
        <el-button @click="showCollapse">
          <svg viewBox="0 0 1024 1024" width="16" height="16">
            <path d="M896 0l128 0 0 128-128 0L896 0 896 0z" p-id="11584" fill="#1296db" />
            <path d="M0 0l704 0 0 128L0 128 0 0 0 0z" p-id="11585" fill="#1296db" />
            <path d="M896 448l128 0 0 128-128 0L896 448 896 448z" p-id="11586" fill="#1296db" />
            <path d="M0 448l704 0 0 128L0 576 0 448 0 448z" p-id="11587" fill="#1296db" />
            <path d="M896 896l128 0 0 128-128 0L896 896 896 896z" fill="#1296db" />
            <path d="M0 896l704 0 0 128L0 1024 0 896 0 896z" fill="#1296db" />
          </svg>
        </el-button>
      </el-menu-item>

      <el-submenu class="header-right" index="1">
        <template slot="title"><font style="color: #409Eff; vertical-align: baseline">欢迎您，</font>{{this.$store.state.user.name}}</template>
        <el-menu-item index="/index">返回主页</el-menu-item>
        <el-menu-item @click="logout">退出登录</el-menu-item>
      </el-submenu>

      <el-avatar class="avatar" :size="50" src="../../../../static/img/avatar.png"></el-avatar>
    </el-menu>
  </div>
</template>

<script>
import { logout } from "@/api/user";

export default {
  name: "Navbar",
  data() {
    return {
      isCollapse: false
    };
  },

  created() {},

  components: {},

  computed: {},

  methods: {
    showCollapse() {
      this.isCollapse = !this.isCollapse;
      this.$emit("showCollapse", this.isCollapse);
    },
    // 退出登录
    logout() {
      logout();
      this.$store.state.user = "";
      this.$router.push("/");
    }
  }
};
</script>
<style scoped>
.el-menu {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
  z-index: 99;
  padding: 0;
  position: relative;
  max-width: 100%;
  height: 65px;
  line-height: 65px;
}
.header-right {
  float: right !important;
}
.el-menu-item {
  height: 65px;
}
.avatar {
  float: right;
  margin-top: 8px;
}
.header-left {
  font-size: 16px;
  margin: 0 68px;
  color: currentColor;
}
.line {
  height: 30px;
}
.el-submenu {
  margin: 5px 0;
}
</style>