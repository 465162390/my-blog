<!-- 友情链接管理 -->
<template>
  <div>
    <!-- 筛选栏 -->
    <div>
      <el-form :inline="true" :model="search" class="demo-form-inline">
        <el-form-item label="链接名称：">
          <el-input v-model="search.name" placeholder="请输入连接名称关键字" size="small" clearable></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSearch" size="small">查询</el-button>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="registerVisible = true" size="small">新增友情链接</el-button>
        </el-form-item>
      </el-form>
    </div>

    <!-- 链接列表 -->
    <div class="article-list">
      <el-table :data="categories" style="width: 100%" border>
        <el-table-column type="index" align="center" width="50"></el-table-column>
        <el-table-column prop="name" label="链接名称" align="center"></el-table-column>
        <el-table-column prop="avatar_link" label="网站logo地址" align="center"></el-table-column>
        <el-table-column prop="link" label="链接地址" align="center"></el-table-column>
        <el-table-column prop="operation" label="操作" align="center" width="200">
          <template slot-scope="scope">
            <el-popover placement="top" width="100" trigger="click" v-model="visible[scope.row.id]">
              <p>
                <i class="el-icon-question"></i>
                <span style="margin-left: 5px;">确定删除吗？</span>
              </p>
              <div style="text-align: right; margin: 0">
                <el-button size="mini" @click="visible.splice(scope.row.id, 1, false);">取消</el-button>
                <el-button type="primary" size="mini" @click="delLinks(scope.row.id, 'del')">确定</el-button>
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
              @click="showLink(scope.row)"
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

    <!-- 新增/修改框 -->
    <el-dialog
      title="友情链接"
      :visible.sync="registerVisible"
      width="30%"
      :before-close="handleClose">
      <el-form :model="registerLink" ref="registerForm" label-width="120px" class="login-form" size="mini">
        <el-form-item label="链接名称：" prop="name" required>
          <el-input v-model.trim="registerLink.name" placeholder="name" clearable></el-input>
        </el-form-item>
        <el-form-item label="logo地址：" prop="avatar_link" required>
          <el-input v-model.trim="registerLink.avatar_link" placeholder="logo" clearable></el-input>
        </el-form-item>
        <el-form-item label="链接地址：" prop="link" required>
          <el-input v-model.trim="registerLink.link" placeholder="username" clearable></el-input>
        </el-form-item>
      </el-form>
      <span slot="footer" class="dialog-footer login-btn">
        <el-button type="primary" class="login-btn" @click="register">确 定</el-button>
        <el-button class="login-btn" @click="registerVisible = false">取 消</el-button>
      </span>
    </el-dialog>
  </div>
</template>

<script>
import Pagination from "@/components/Pagination";
import { fetchLink } from '@/api/manage'
import { delLink } from '@/api/manage'
import { editLink } from '@/api/manage'
import { Message } from "element-ui";

export default {
  name: "LinkManage",
  data() {
    return {
      categories: [],
      search: {
        name: "",
        page: 1,
        pagesize: 10,
      },
      visible: [],
      total: 0,
      registerVisible: false,
      registerLink: {
        name: "",
        link: "",
        avatar_link: "",
      }
    };
  },

  created() {
    this.onSearch();
  },

  components: {
    Pagination
  },

  computed: {},

  methods: {
    // 请求友情链接数据
    onSearch() {
      this.search.type = "category";
      fetchLink(this.search).then(response => {
        this.categories = response.data;
        this.total = response.total;
      })
    },

    // 删除友情链接
    delLinks(id) {
      this.$set(this.visible, id, false); // 删除操作
      delLink({id: id}).then(response => {
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

    // 新增链接
    register() {
      this.registerLink.id == undefined ? this.registerLink.operation = "create" : this.registerLink.operation = "edit";
      editLink(this.registerLink).then( response => {
        response.code == 200 ? (this.registerVisible = false, this.$refs.registerForm.resetFields(), this.onSearch()) : "";
        Message({
          type: response.type,
          message: response.message,
          duration: 2000,
        })
        this.registerLink = {};
        this.registerVisible = false;
      })
    },

    handleClose(visible) {
      this.registerLink = {};
      this.registerVisible = false;
    },

    showLink(link) {
      this.registerLink = link;
      this.registerVisible = true;
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