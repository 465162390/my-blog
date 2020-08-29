<!-- 绑定本站账号表格 -->
<template>
  <div>
    <el-dialog
      title="绑定账号"
      :visible.sync="bindVisible"
      width="30%"
      :modal-append-to-body='false'
      :before-close="handleClose">
      <el-form :model="bindUser" :rules="bindRules" ref="bindForm" label-width="100px" class="login-form" size="mini">
        <el-form-item label="用户名：" prop="username" required>
          <el-input v-model.trim="bindUser.username" placeholder="username" clearable></el-input>
        </el-form-item>
        <el-form-item label="密码：" prop="password" required>
          <el-input type="password" v-model.trim="bindUser.password" placeholder="password" @keyup.enter.native="bind('bindForm')" clearable></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer login-btn">
        <el-button type="primary" class="login-btn" @click="bind('bindForm')">确 定</el-button>
        <el-button class="login-btn" @click="handleClose">取 消</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import { bindUser } from "@/api/user"
import { Message } from "element-ui"

export default {
  name: 'BindForm',
  data() {
    let checkNull = (rule, value, callback) => {
      if (!value) {
        return callback(new Error('用户名和密码不能为空!'));
      }
      callback()
    };
    return {
      bindVisible: false,
      bindUser: {
        username: "",
        password: "",
        uniqueId: this.$store.state.user.uniqueId,
        accountType: this.$store.state.user.accountType,
      },
      // 绑定账号的检验规则
      bindRules: {
        username: [{validator: checkNull, required: true, trigger: 'blur'}],
        password: [{validator: checkNull, required: true, trigger: 'blur'}],
      },
    };
  },

  props: {
    visible: {
      type: Boolean,
    }
  },

  watch: {
    visible(newVal, oldVal) {
      this.bindVisible = newVal;
    },
  },

  created() {},

  methods: {
    // 绑定本站账号
    bind(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          bindUser(this.bindUser).then( response => {
            if(response.code == 200) {
              this.handleClose();
              this.$refs.bindForm.resetFields();
              if (this.$store.state.user.bind != undefined && this.$store.state.user.bind == "notBind") {
                let user = this.$store.state.user;
                user.bind = "binded";
                user.role = response.role;
                window.sessionStorage.setItem("user", JSON.stringify(user)),
                this.$store.commit("changeInfo", user)
              }
              Message({
                type: response.type,
                message: `本站账号绑定成功!`,
                duration: 2000,
              })
            } else {
              Message({
                type: response.type,
                message: response.message,
                duration: 2000,
              });
            }
          })
        } else {
          console.log("必填项不能为空!")
          return false;
        }
      });
    },

    handleClose() {
      this.bindVisible = false;
      this.$emit("changeVisible", this.bindVisible)
    },
  }

}
</script>

<style scoped>
/* 按钮样式 */
.login-btn {
  display: block;
  margin-left: 0 !important; 
  width: 100%;
}
.login-btn:nth-child(2) {
  margin-top: 10px;
}
.login-form {
  width: 80%;
}
</style>