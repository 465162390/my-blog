<!-- 标签管理 -->
<template>
  <div>
    <!-- 筛选栏 -->
    <div>
      <el-form :inline="true" :model="search" class="demo-form-inline">
        <el-form-item label="标签名称：">
          <el-input v-model="search.name" placeholder="请输入标签关键字" size="small" clearable></el-input>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSearch" size="small">查询</el-button>
        </el-form-item>
      </el-form>
    </div>

    <!-- 标签列表 -->
    <div class="article-list">
      <el-table :data="tags" style="width: 100%" border>
        <el-table-column type="index" align="center" width="50"></el-table-column>
        <el-table-column prop="name" label="标签名称" align="center"></el-table-column>
        <el-table-column prop="num" label="文章数量" sortable align="center"></el-table-column>
        <el-table-column prop="operation" label="操作" align="center" width="100">
          <template slot-scope="scope">
            <el-popover placement="top" width="100" trigger="click" v-model="visible[scope.row.id]">
              <p>
                <i class="el-icon-question"></i>
                <span style="margin-left: 5px;">确定删除吗？</span>
              </p>
              <div style="text-align: right; margin: 0">
                <el-button size="mini" @click="visible.splice(scope.row.id, 1, false);">取消</el-button>
                <el-button type="primary" size="mini" @click="delTag(scope.row.id, 'del')">确定</el-button>
              </div>
              <el-button
                slot="reference"
                type="danger"
                size="small"
                style="margin-left: 10px;"
                @click="visible[scope.row.id] = true"
              >删除</el-button>
            </el-popover>
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

  </div>
</template>

<script>
import Pagination from "@/components/Pagination"
import { fetchOther } from '@/api/manage'
import { delOther } from '@/api/manage'
import { Message } from "element-ui"


export default {
  name: "TagManage",
  data() {
    return {
      tags: [],
      search: {
        name: "",
        page: 1,
        pagesize: 10,
      },
      total: 0,
      visible: [],
    };
  },

  created() {
    this.onSearch();
  },

  components: {
    Pagination,
  },

  computed: {},

  methods: {
    onSearch() {
      this.search.type = "tag";
      fetchOther(this.search).then(response => {
        this.tags = response.data;
        this.total = response.total;
      })
    },
    
    delTag(id) {
      this.$set(this.visible, id, false);  // 删除操作
      let params = {
        type: "tag",
        id: id,
      }

      delOther(params).then(response => {
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
  }
};
</script>

<style scoped>
</style>