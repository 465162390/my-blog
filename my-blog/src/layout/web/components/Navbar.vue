<!-- 顶部导航栏 -->
<template>
  <div>
    <el-row style="box-shadow: 0 2px 5px rgba(0, 0, 0, 0.08);">
      <el-col :xs="0" :sm="4" :md="4" :lg="4" :xl="4" class="hidden-sm-and-down">
        <el-menu style="text-align: center" class="el-menu" mode="horizontal">
          <font class="blog-name">NGKAKUI's BLOG</font>
        </el-menu>
      </el-col>
      
      <el-col :xs="0" :sm="1" :md="1" :lg="1" :xl="1" class="hidden-sm-and-down">
        <el-menu class="el-menu" mode="horizontal">
          <el-divider direction="vertical" class="line"></el-divider>
        </el-menu>
      </el-col>

      <el-col :xs="24" :sm="24" :md="19" :lg="19" :xl="19">
        <el-menu router :default-active="$route.path" class="el-menu" mode="horizontal">

          <!-- 屏幕窗口 < 700px -->
          <div class="mobile">
            <!-- 标题 -->
            <span class="mobile-title">NGKAKUI的博客</span>
            <!-- 菜单按钮 -->
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
                @click="isCollapse = !isCollapse"
                style="vertical-align: text-top">
                <path d="M51.2 56.32h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2C22.92224 158.72 0 135.79776 0 107.52s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z" fill="#515151" p-id="3386"></path>
              </svg>
            </span>

            <!-- 移动端导航栏 -->
            <el-menu :default-active="$route.path" class="el-menu-vertical-demo" :collapse="isCollapse" :router="true">
              <el-menu-item index="/article" @click="isCollapse = true">
                <i class="el-icon-s-home"></i>
                <span slot="title" class="mobile-text">首页</span>
              </el-menu-item>
              <el-menu-item index="/archives" @click="isCollapse = true">
                <i class="el-icon-s-help"></i>
                <span slot="title" class="mobile-text">归档</span>
              </el-menu-item>
              <el-menu-item index="/categories" @click="isCollapse = true">
                <i class="el-icon-menu"></i>
                <span slot="title" class="mobile-text">分类 | 标签</span>
              </el-menu-item>
              <el-menu-item index="/about" @click="isCollapse = true">
                <i class="el-icon-user-solid"></i>
                <span slot="title" class="mobile-text">关于</span>
              </el-menu-item>
              <el-menu-item index="/message" @click="isCollapse = true">
                <i class="el-icon-edit-outline"></i>
                <span slot="title" class="mobile-text">留言板</span>
              </el-menu-item>
              <el-menu-item index>
                <el-input
                  placeholder="搜索文章"
                  prefix-icon="el-icon-search"
                  size="small"
                  v-model="search.title"
                  clearable
                  @blur="fetchArticle"
                  @keyup.enter.native="fetchArticle"
                ></el-input>
              </el-menu-item>
              <el-menu-item index style="margin-top: 2px;" v-if="this.$store.state.user == ''">
                <el-button size="mini" type="primary" @click="loginVisible = true">登录</el-button>
                <el-button size="mini" type="primary" @click="registerVisible = true">注册</el-button>
              </el-menu-item>
              <el-submenu index v-if="this.$store.state.user != ''" style="margin-top: 3px;">
                <template slot="title"><font style="color: #409Eff; vertical-align: baseline">欢迎您，</font>{{this.$store.state.user.name}}</template>
                <el-menu-item v-if="this.$store.state.user.role == '1'" index="/admin">后台管理</el-menu-item>
                <el-menu-item index @click="logout">退出登录</el-menu-item>
              </el-submenu>
            </el-menu>
          </div>

          <el-form class="searchform">
            <el-form-item>
              <el-input
                placeholder="搜索文章"
                prefix-icon="el-icon-search"
                size="small"
                v-model="search.title"
                clearable
                @blur="fetchArticle"
                @keyup.enter.native="fetchArticle"
                class="search-input"
              ></el-input>
            </el-form-item>
          </el-form>

          <span class="btn-group" v-if="this.$store.state.user == ''">
            <el-button size="mini" type="primary" @click="loginVisible = true">登录</el-button>
            <el-button size="mini" type="primary" @click="registerVisible = true">注册</el-button>
          </span>

          <el-submenu class="header-right" index v-if="this.$store.state.user != ''">
            <template slot="title"><font style="color: #409Eff; vertical-align: baseline">欢迎您，</font>{{this.$store.state.user.name}}</template>
            <el-menu-item v-if="this.$store.state.user.role == '1'" index="/admin">后台管理</el-menu-item>
            <el-menu-item index @click="logout">退出登录</el-menu-item>
          </el-submenu>

          <!-- 路由导航栏 -->
          <el-menu-item class="header-right" index="/message">
            <i class="el-icon-edit-outline"></i>留言板
          </el-menu-item>
          <el-menu-item class="header-right" index="/about">
            <i class="el-icon-user-solid"></i>关于
          </el-menu-item>
          <el-menu-item class="header-right" index="/categories">
            <i class="el-icon-menu"></i>分类 | 标签
          </el-menu-item>
          <el-menu-item class="header-right" index="/archives">
            <i class="el-icon-s-help"></i>归档
          </el-menu-item>
          <el-menu-item class="header-right" index="/article">
            <i class="el-icon-s-home"></i>首页
          </el-menu-item>
        </el-menu>
      </el-col>

    </el-row>

    <!-- 登录框 -->
    <login-form :visible="loginVisible" @changeVisible="changeVisible" />

    <!-- 注册框 -->
    <register-form :visible="registerVisible" @changeVisible="changeVisible" type="registerUser" />

  </div>
</template>

<script>
import { fetchArticle } from "@/api/article"
import { logout } from "@/api/user"
import { Message } from "element-ui"
import RegisterForm from "@/components/RegisterForm"
import LoginForm from "@/components/LoginForm"

export default {
  name: "Navbar",
  data() {
    return {
      loginVisible: false,
      registerVisible: false,
      search: {
        title: "",
        page: 1,
        pagesize: 10,
      },
      isCollapse: true,
    };
  },

  methods: {
    // 退出登录
    logout() {
      logout();
      this.$store.state.user = "";
    },

    // 根据标题关键字查询文章
    fetchArticle() {
      this.isCollapse = true
      if(this.$route.path != "/article") {
        this.search.title != "" ? this.$router.push({path:'/article',query: this.search}) : "";
      } else {
        this.$router.push({path:'/article',query: this.search})
      }
    },

    // 改变注册框的visible值
    changeVisible(visible) {
      this.registerVisible = visible;
      this.loginVisible = visible;
    }
  },

  created() {},

  components: {
    RegisterForm,
    LoginForm,
  },
};
</script>

<style scoped>
.el-menu {
  z-index: 99;
  padding: 0;
  position: relative;
  max-width: 100%;
  height: 65px;
  line-height: 65px;
}
*:focus {
  outline: 0px;
}
.header-right {
  float: right !important;
}
.el-menu--horizontal > .el-menu-item {
  height: 65px;
}
i {
  margin-bottom: 4px;
}
.is-active {
  color: #409eff !important;
}
.line {
  height: 30px;
}
a {
  text-decoration: none;
}
form {
  display: inline-block;
  margin-left: 15px;
}
.btn-group {
  float: right;
  margin: -5px 20px 0 10px;
}
.mobile {
  display: none;
  width: 100%;
}
.mobile-title {
  margin-left: 15px;  
  font-size: 21px;
}
.mobile-dropdown { 
  margin-right: 40px;
  float: right;
  margin-top: 2px
}
.mobile-text {
  font-size: 14px;
  vertical-align: baseline;
}
.blog-name {
  padding-top: 5px;
  border-top: solid 7px #0984e3;
  border-radius: 50%;
}

/** 移动端导航栏样式 **/
.el-menu-vertical-demo:not(.el-menu--collapse) {
  display: block;
  width: 100%;
  min-height: 260px;
  transition: .05s;
}
.el-menu--collapse {
  display: none;
}

@media (max-width: 1199px) {
  .searchform {
    display: none;
  }
}

@media (max-width: 730px) {
  .btn-group {
    display: none
  }
  .header-right {
    display: none;
  }
  .mobile {
    display: block;
  }
  .mobile-title {
    font-size: 20px;
  }
}

@media (max-width: 450px) {
  .mobile-title {
    font-size: 17px;
  }
  .el-dialog {
    width: 95% ;
  }
  .el-dialog__body {
    padding: 20px 0px;
  }
}
</style>