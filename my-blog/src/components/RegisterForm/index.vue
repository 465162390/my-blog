<!-- 注册的Dialog -->
<template>
  <div>
    <el-dialog
      title="注册"
      :visible.sync="registerVisible"
      width="30%"
      :modal-append-to-body='false'
      :before-close="handleClose">
      <el-form :model="registerUser" :rules="registerRules" ref="registerForm" label-width="100px" class="login-form" size="mini">
        <el-form-item label="名称：" prop="name">
          <el-input v-model.trim="registerUser.name" placeholder="name" clearable></el-input>
        </el-form-item>
        <el-form-item label="用户名：" prop="username">
          <el-input v-model.trim="registerUser.username" placeholder="username" clearable></el-input>
        </el-form-item>
        <el-form-item label="密码：" prop="password">
          <el-input type="password" v-model.trim="registerUser.password" placeholder="password" clearable></el-input>
        </el-form-item>
        <el-form-item label="确认密码：" prop="confirmpwd">
          <el-input type="password" v-model.trim="registerUser.confirmpwd" placeholder="confirm password" @keyup.enter.native="register('registerForm')" clearable></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer login-btn">
        <el-button type="primary" class="login-btn" @click="register('registerForm')">确 定</el-button>
        <el-button class="login-btn" @click="handleClose">取 消</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import { Message } from "element-ui"
import { register } from "@/api/user";

export default {
  name: 'RegisterForm',
  data() {
    // 注册属性检验方法
    let checkNull = (rule, value, callback) => {
      if (!value) {
        return callback(new Error('名称或用户名不能为空!'));
      }
      callback()
    };
    let validatePass = (rule, value, callback) => {
      if (!value) {
        callback(new Error('请输入密码!'));
      } else {
          if (this.registerUser.confirmpwd !== '') {
            this.$refs.registerForm.validateField('confirmpwd');
          }
          callback();
      }
    };
    let validateCfmPass = (rule, value, callback) => {
      if (!value) {
        callback(new Error('请再次输入密码!'));
      } else if (value != this.registerUser.password) {
        callback(new Error('两次输入密码不一致!'));
      } else {
        callback();
      }
    };
    return {
      registerVisible: false,
      registerUser: {
        name: "",
        username: "",
        password: "",
        confirmpwd: "",
        role: "0",
      },
      // 注册检验规则
      registerRules: {
        name: [{validator: checkNull, required: true, trigger: 'blur'}],
        username: [{validator: checkNull, required: true, trigger: 'blur'}],
        password: [{validator: validatePass, required: true, trigger: 'blur'}],
        confirmpwd: [{validator: validateCfmPass, required: true, trigger: 'blur'}],
      },
    };
  },

  props: {
    visible: {
      type: Boolean,
    },
    type: {
      type: String,
    }
  },

  watch: {
    visible(newVal, oldVal) {
      this.registerVisible = newVal;
    },
  },

  created() {},

  methods: {
    // 注册用户
    register(formName) {
      this.$refs[formName].validate((valid) => {
        // 判断是否为第三方登录注册
        if ( this.type == "bindUser") {
          this.registerUser.uniqueId = this.$store.state.user.uniqueId;
          this.registerUser.accountType = this.$store.state.user.accountType;
          this.registerUser.type = "bindUser";
        } else {
          this.registerUser.type = "registerUser";
        }
        if (valid) {
          delete this.registerUser.confirmpwd;
          register(this.registerUser).then(response => {
            // 清空输入框
            if (response.code == 200) {
              this.handleClose();
              this.$refs.registerForm.resetFields();
              if (this.$store.state.user.bind != undefined && this.$store.state.user.bind == "notBind") {
                let user = this.$store.state.user;
                user.bind = "binded";
                window.sessionStorage.setItem("user", JSON.stringify(user)),
                this.$store.commit("changeInfo", user)
              }
            }
            Message({
              type: response.type,
              message: response.message,
              duration: 2000,
            })
          })
        } else {
          console.log("必填项不能为空!")
          return false;
        }
      });
    },

    handleClose() {
      this.registerVisible = false;
      this.$emit("changeVisible", this.registerVisible)
    },
  }

}
</script>

<style scoped>
/** 登录框按钮 **/
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

<style>
/** 登录框 **/
.el-dialog__header {
  padding: 20px 20px 20px;
  border-bottom: 1px solid #e8e8e8;
}
.el-dialog__body {
  border-bottom: 1px solid #e8e8e8;
}

@media (max-width: 1300px) {
  .el-dialog {
    width: 35% !important;
  }
}

@media (max-width: 1000px) { 
  .el-dialog {
    width: 55% !important;
  }
}

@media (max-width: 768px) {
  .el-dialog {
    width: 65% !important;
  }
  .el-dialog__body {
    padding: 20px 0px;
  }
}

@media (max-width: 450px) {
  .el-dialog {
    width: 95% !important;
  }
  .el-dialog__body {
    padding: 20px 0px;
  }
}
</style>