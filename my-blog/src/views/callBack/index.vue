<!-- 第三方登录回调页面 -->
<template>
  <div>
    正在跳转.....
  </div>
</template>

<script>
import { Loading } from 'element-ui'
import { weiboLogin, qqLogin, githubLogin } from '@/api/user'
import { Message } from 'element-ui'

export default {
  name: 'CallBack',
  data() {
    return {
      authorized: "",
    };
  },

  created() {
    let loading = Loading.service({})
    loading.close();
    // 获取第三方用户信息
    this.getUserInfo();
  },

  mounted() {},

  methods: {
    async getUserInfo() {
      let code = this.$route.query.code, 
        access_token = this.getUrlValue(this.$route.hash)['access_token'];

      // 根据url地址判断是什么平台账号并且判断用户是否授权成功
      switch(this.$route.params.pathMatch) {
        case "/weibo":
          code == undefined ? this.authorized = "notAuthorized" 
           : ( this.authorized = "authorized", this.weiboAccountLogin())
        break;
        case "/qq":
          JSON.stringify(this.$route.query) != "{}" && this.$route.query.usercancel != 0 ? this.authorized = "notAuthorized" 
           : ( this.authorized = "authorized", this.qqAccountLogin())
        break;
        case "/github":
          code == undefined ? this.authorized = "notAuthorized" : await this.githubAccountLogin()
        break;
      }
      this.authorized == "authorized" ? 
       Message({ type: "success", message: "授权成功, 跳转到首页, 请稍后!", duration: 1000 }) : 
       Message({ type: "error", message: "授权失败, 请重新登录!", duration: 1000 })
      this.$router.push("/article");
    },

    // qq账号登录
    qqAccountLogin() {
      // 获取用户授权的access_token
      let access_token = this.getUrlValue(this.$route.hash)['access_token'];
      qqLogin({access_token: access_token}).then( response => {
        let { userData } = response;
        window.sessionStorage.setItem("user", JSON.stringify(userData));
        this.$store.commit("changeInfo", userData)
      })
    },

    // 微博账号登录
    weiboAccountLogin() {
      // 获取用户登录授权后返回的code,并请求账号信息
      let code = this.$route.query.code
      weiboLogin({code: code}).then( response => {
        let { userData } = response;
        window.sessionStorage.setItem("user", JSON.stringify(userData));
        this.$store.commit("changeInfo", userData)
      })
    },

    // github账号登录
    async githubAccountLogin() {
      let code = this.$route.query.code;
      await githubLogin({code:code}).then( response => {
        if( response.code == 200 ) {
          let { userData } = response;
          window.sessionStorage.setItem("user", JSON.stringify(userData));
          this.$store.commit("changeInfo", userData)
          this.authorized = "authorized"
        } else {
          this.authorized = "notAuthorized"
        }
      })
    },

    // 从url的hash中获取到所需的值
    getUrlValue(hash) {
      var values = {};
      hash.replace(/[?#&]+([^=&]+)=([^&]*)/gi,
        function (m, key, value) {
          values[key] = value;
        }
      );
      return values;
    }
  }

}
</script>

<style scoped>
</style>