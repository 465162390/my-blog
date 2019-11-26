<!-- 顶部导航栏 -->
<template>
  <div>
    <el-menu class="el-menu" mode="horizontal" :router="true">

      <!-- 屏幕宽度 >= 730px -->
      <el-menu-item class="header-left">NGKAKUI的博客</el-menu-item>
      <el-menu-item class="show">
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
      <el-submenu class="header-right show" index="1">
        <template slot="title"><font style="color: #409Eff; vertical-align: baseline">欢迎您，</font>{{this.$store.state.user.name}}</template>
        <el-menu-item index="/index">返回主页</el-menu-item>
        <el-menu-item @click="logout">退出登录</el-menu-item>
      </el-submenu>
      <el-avatar class="avatar show" :size="50" src="../../../../static/img/avatar.png"></el-avatar>

      <!-- 屏幕宽度 < 730px 导航栏按钮 -->
      <el-menu-item class="header-right mobile-btn">
        <span class="mobile-dropdown">
          <svg 
            t="1574488903479" 
            class="icon" 
            viewBox="0 0 1024 1024" 
            version="1.1" 
            xmlns="http://www.w3.org/2000/svg" 
            p-id="3385"
            width="18" 
            height="18"
            @click="showCollapse"
            style="vertical-align: text-top">
              <path d="M51.2 56.32h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2C22.92224 158.72 0 135.79776 0 107.52s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z" fill="#515151" p-id="3386"></path>
          </svg>
        </span>
      </el-menu-item>

    </el-menu>
  </div>
</template>

<script>
import { logout } from "@/api/user";

export default {
  name: "Navbar",
  data() {
    return {};
  },

  created() {},

  components: {},

  computed: {},

  methods: {
    showCollapse() {
      let collapse = !this.$store.state.isCollapse;
      this.$store.commit("changeCollapse", collapse);
    },
    // 退出登录
    logout() {
      logout();
      this.$store.state.user = "";
      this.$router.push("/index");
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
.mobile-btn {
  display: none;
}

@media (max-width: 729px) { 
  .show {
    display: none;
  }
  .header-left {
    cursor: none;
    margin: 0 20px;
  }
  .header-right {
    cursor: none;
    margin-right: 20px;
  }
  .mobile-btn {
    display: block;
  }
  .mobile-dropdown { 
    margin-top: 2px
  }
}
</style>