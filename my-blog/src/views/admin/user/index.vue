<!-- 用户管理 -->
<template>
  <div>
    <!-- 筛选栏 -->
    <div>
      <el-form :inline="true" :model="search" class="demo-form-inline">
        <el-form-item label="用户名称：">
          <el-input v-model="search.name" placeholder="请输入用户名称关键字" size="small" clearable></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSearch" size="small">查询</el-button>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="registerVisible = true" size="small">新增用户</el-button>
        </el-form-item>
      </el-form>

    </div>

    <!-- 用户列表 -->
    <div class="article-list">
      <el-table :data="users" style="width: 100%" border>
        <el-table-column type="index" align="center" width="50"></el-table-column>
        <el-table-column prop="name" label="用户名称" align="center"></el-table-column>
        <el-table-column prop="username" label="账号" align="center"></el-table-column>
        <el-table-column prop="role" label="账号类别" align="center"></el-table-column>
        <el-table-column prop="last_time" label="最后登录时间" sortable align="center" width="180"></el-table-column>
        <el-table-column prop="createdAt" label="创建时间" sortable align="center" width="180"></el-table-column>
        <el-table-column prop="operation" label="操作" align="center" width="160">
          <template slot-scope="scope">
            <el-popover placement="top" width="100" trigger="click" v-model="visible[scope.row.id]">
              <p>
                <i class="el-icon-question"></i>
                <span style="margin-left: 5px;">确定删除吗？</span>
              </p>
              <div style="text-align: right; margin: 0">
                <el-button size="mini" @click="visible.splice(scope.row.id, 1, false);">取消</el-button>
                <el-button type="primary" size="mini" @click="delUser(scope.row.id, 'del')">确定</el-button>
              </div>
              <el-button
                slot="reference"
                type="danger"
                size="small"
                style="margin-left: 10px;"
                @click="visible[scope.row.id] = true"
              >删除</el-button>
            </el-popover>
            <el-button
              type="primary"
              size="small"
              style="margin-left: 10px;"
              @click="showUser(scope.row.id)"
            >编辑</el-button>
          </template>
        </el-table-column>
      </el-table>
    </div>

    <!-- 分页 -->
    <div class="pagination">
      <pagination
        :page="search.page"
        :pagesize="search.pagesize"
        :total="total"
        @handleSizeChange="handleSizeChange"
        @handleCurrentChange="handleCurrentChange"
      />
    </div>

    <!-- 新增用户框 -->
    <el-dialog
      title="用户"
      :visible.sync="registerVisible"
      :width="dialogWidth"
      :before-close="handleClose">
      <el-form :model="registerUser" :rules="registerRules" ref="registerForm" label-width="120px" class="login-form" size="mini">
        <el-form-item label="用户名称：" prop="name">
          <el-input v-model.trim="registerUser.name" placeholder="name" clearable></el-input>
        </el-form-item>
        <el-form-item label="登录账号：" prop="username">
          <el-input v-model.trim="registerUser.username" placeholder="username" clearable></el-input>
        </el-form-item>
        <el-form-item label="登录密码：" prop="password">
          <el-input type="password" v-model.trim="registerUser.password" placeholder="password" clearable></el-input>
        </el-form-item>
        <el-form-item label="确认密码：" prop="confirmpwd">
          <el-input type="password" v-model.trim="registerUser.confirmpwd" placeholder="confirm password" @keyup.enter.native="register('registerForm')" clearable></el-input>
        </el-form-item>
        <el-form-item label="是否博主用户：" prop="role">
          <el-switch
            v-model="registerUser.role"
            active-value="1"
            inactive-value="0">
          </el-switch>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer login-btn">
        <el-button type="primary" class="login-btn" @click="register('registerForm')">确 定</el-button>
        <el-button class="login-btn" @click="registerVisible = false">取 消</el-button>
      </span>
    </el-dialog>

    <!-- 修改用户框 -->
    <el-dialog
      title="修改用户"
      :visible.sync="editVisible"
      :width="dialogWidth"
      :before-close="handleClose">
      <el-form :model="editUser" ref="editForm" label-width="120px" class="login-form" size="mini">
        <el-form-item label="用户名称：" prop="name">
          <el-input v-model.trim="editUser.name" placeholder="name" clearable></el-input>
        </el-form-item>
        <el-form-item label="登录账号：" prop="username">
          <el-input v-model.trim="editUser.username" placeholder="username" disabled clearable></el-input>
        </el-form-item>
        <el-form-item label="旧登录密码：" prop="oldpwd">
          <el-input type="password" v-model.trim="editUser.oldpwd" placeholder="old password" clearable></el-input>
        </el-form-item>
        <el-form-item label="新登录密码：" prop="newpwd">
          <el-input type="password" v-model.trim="editUser.newpwd" placeholder="new password" @keyup.enter.native="register" clearable></el-input>
        </el-form-item>
        <el-form-item label="是否博主用户：" prop="role">
          <el-switch
            v-model="editUser.role"
            active-value="1"
            inactive-value="0">
          </el-switch>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer login-btn">
        <el-button type="primary" class="login-btn" @click="handleEditUser">确 定</el-button>
        <el-button class="login-btn" @click="editVisible = false">取 消</el-button>
      </span>
    </el-dialog>

  </div>
</template>

<script>
import Pagination from "@/components/Pagination"
import { fetchUser } from '@/api/manage'
import { fetchDetail } from '@/api/manage'
import { delUser } from '@/api/manage'
import { Message } from "element-ui"
import { register } from "@/api/user";
import { editUser } from "@/api/manage";

export default {
  name: "UserManage",
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
      users: [],
      search: {
        name: "",
        page: 1,
        pagesize: 10,
      },
      total: 0,
      visible: [],
      registerVisible: false,
      editVisible: false,
      // 注册
      registerUser: {
        name: "",
        username: "",
        password: "",
        confirmpwd: "",
        role: "",
      },
      // 注册检验规则
      registerRules: {
        name: [{validator: checkNull, required: true, trigger: 'blur'}],
        username: [{validator: checkNull, required: true, trigger: 'blur'}],
        password: [{validator: validatePass, required: true, trigger: 'blur'}],
        confirmpwd: [{validator: validateCfmPass, required: true, trigger: 'blur'}],
      },
      editUser: {},
      dialogWidth: '',
    };
  },

  created() {
    this.onSearch();
    this.setDialogWidth()
  },

  mounted() {
    window.onresize = () => {
      return (() => {
        this.setDialogWidth()
      })()
    }
  },

  components: {
    Pagination,
  },

  methods: {
    onSearch() {
      fetchUser(this.search).then(response => {
        this.users = response.data;
        this.total = response.total;
      })
    },

    // 删除用户
    delUser(id) {
      delUser({id: id}).then(response => {
        Message({
          message: response.message,
          type: response.type,
          duration: 2000
        });
        this.onSearch();
      })
    },

    handleSizeChange(val) {
      this.search.pagesize = val
      this.onSearch();
    },

    handleCurrentChange(val) {
      this.search.page = val
      this.onSearch();
    },

    // 注册用户
    register(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          delete this.registerUser.confirmpwd;
          register(this.registerUser).then(response => {
            // 清空输入框
            response.code == 200 ? (this.registerVisible = false, this.$refs.registerForm.resetFields(), this.onSearch()) : "";
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

    // 用户
    showUser(id) {
      fetchDetail({id: id}).then(response => {
        this.editUser = response.data
        this.editVisible = true;
      })
    },

    // 修改用户
    handleEditUser() {
      editUser(this.editUser).then(response => {
        // 修改成功时清空输入框，重新请求用户数据
        response.code == 200 ? (this.editVisible = false, this.$refs.editForm.resetFields(), this.onSearch()) : "";
        Message({
          type: response.type,
          message: response.message,
          duration: 2000,
        })
      })
    },

    handleClose(visible) {
      this.registerVisible = false;
      this.editVisible = false;
    },

    // modal对话框响应式
    setDialogWidth() {
      // 获取当前浏览器窗口宽度
      let val = document.body.clientWidth
      let b = true;
      switch (b) {
        case val <= 500:
          this.dialogWidth = '99%'
        break;
        case val <= 650:
          this.dialogWidth = '85%'
        break;
        case val <= 900:
          this.dialogWidth = '65%'
        break;
        case val <= 1200:
          this.dialogWidth = '50%'
        break;
        case val <= 1500:
          this.dialogWidth = '40%'
        break;
        default: 
          this.dialogWidth = '35%'
        break;
      }
    },
  }
};
</script>

<style scoped>
/** 登录框按钮 **/
.login-btn {
  display: block;
  margin-left: 0; 
  width: 100%;
}
.login-btn:nth-child(2) {
  margin-top: 10px;
}
.login-form {
  width: 100%;
  margin: 0 auto;
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
.el-input.is-disabled .el-input__inner {
  color: currentColor;
}
</style>