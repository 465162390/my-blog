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
        <el-table-column prop="name" label="用户名称" sortable align="center"></el-table-column>
        <el-table-column prop="username" label="账号" sortable align="center"></el-table-column>
        <el-table-column prop="role" label="账号类别" sortable align="center"></el-table-column>
        <el-table-column prop="createdAt" label="创建时间" sortable align="center"></el-table-column>
        <el-table-column prop="operation" label="操作" align="center" width="220">
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
              @click="fetchUser(scope.row.id)"
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
      width="30%"
      :before-close="handleClose">
      <el-form :model="registerUser" ref="registerForm" label-width="120px" class="login-form" size="mini">
        <el-form-item label="名称：" prop="name" required>
          <el-input v-model.trim="registerUser.name" placeholder="name" clearable></el-input>
        </el-form-item>
        <el-form-item label="用户名：" prop="username" required>
          <el-input v-model.trim="registerUser.username" placeholder="username" clearable></el-input>
        </el-form-item>
        <el-form-item label="登录密码：" prop="password" required>
          <el-input type="password" v-model.trim="registerUser.password" placeholder="password" clearable></el-input>
        </el-form-item>
        <el-form-item label="确认密码：" prop="confirmpwd" required>
          <el-input type="password" v-model.trim="registerUser.confirmpwd" placeholder="confirm password" @keyup.enter.native="register" clearable></el-input>
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
        <el-button type="primary" class="login-btn" @click="register">确 定</el-button>
        <el-button class="login-btn" @click="registerVisible = false">取 消</el-button>
      </span>
    </el-dialog>

    <!-- 修改用户框 -->
    <el-dialog
      title="修改用户"
      :visible.sync="editVisible"
      width="30%"
      :before-close="handleClose">
      <el-form :model="editUser" ref="editForm" label-width="120px" class="login-form" size="mini">
        <el-form-item label="名称：" prop="name">
          <el-input v-model.trim="editUser.name" placeholder="name" clearable></el-input>
        </el-form-item>
        <el-form-item label="用户名：" prop="username">
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
import { delUser } from '@/api/manage'
import { Message } from "element-ui"
import { register } from "@/api/user";
import { fetchDetail } from "@/api/manage";
import { editUser } from "@/api/manage";

export default {
  name: "UserManage",
  data() {
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
      editUser: {},
    };
  },

  created() {
    this.onSearch();
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
    register() {
      if(this.registerUser.password == this.registerUser.confirmpwd) {
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
        Message({
          type: "error",
          message: "两次密码输入不正确，请重新输入!",
          duration: 2000,
        })
      }
    },
    // 请求用户
    fetchUser(id) {
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
    }
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
.el-input.is-disabled .el-input__inner {
  color: currentColor;
}
</style>