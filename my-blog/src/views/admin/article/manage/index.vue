<!-- 管理文章列表 -->
<template>
  <div>
    <!-- 筛选栏 -->
    <div>
      <el-form :inline="true" :model="search" class="demo-form-inline">
        <el-form-item label="文章标题：" >
          <el-input v-model="search.title" placeholder="请输入标题关键字" size="small" clearable></el-input>
        </el-form-item>
        <el-form-item label="标签：">
          <el-select v-model="search.tag" placeholder="文章标签" size="small" clearable>
            <el-option v-for="tag in tags" :key="tag.id" :label="tag.name" :value="tag.id"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item label="分类：">
          <el-select v-model="search.category" placeholder="文章分类" size="small" clearable>
            <el-option v-for="category in categories" :key="category.id" :label="category.name" :value="category.id"></el-option>
          </el-select>
        </el-form-item>
        <el-form-item>
          <el-button type="primary" @click="onSearch" size="small">查询</el-button>
        </el-form-item>
      </el-form>
    </div>

    <!-- 文章列表 -->
    <div class="article-list">
      <el-table :data="articles" style="width: 100%" border>
        <el-table-column type="index" align="center" width="50"></el-table-column>
        <el-table-column prop="title" label="文章标题" align="center" width="300;"></el-table-column>
        <el-table-column prop="tag" label="标签" align="center">
          <template slot-scope="scope">
            <div style="width: 100%; overflow: hidden; text-overflow: ellipsis;">
              <el-tag 
                style="margin:0px 5px;" 
                size="mini"
                effect="light" 
                :hit="true" 
                :type="type[Math.floor(Math.random()*5 + 1)]" 
                v-for="tag in scope.row.tags"
                :key="tag.id">
              {{tag.name}}
              </el-tag>
            </div>
          </template>
        </el-table-column>
        <el-table-column prop="category" label="分类" align="center">
          <template slot-scope="scope">
            <div style="width: 100%; overflow: hidden; text-overflow: ellipsis;">
              <el-tag 
                style="margin-left: 5px;" 
                size="mini"
                effect="dark" 
                :hit="true"
                v-for="tag in scope.row.categories"
                :key="tag.id">
              {{tag.name}}
              </el-tag>
            </div>
          </template>
        </el-table-column>
        <el-table-column prop="viewCount" label="浏览数" sortable align="center" width="100"></el-table-column>
        <el-table-column prop="createdAt" label="发布时间" sortable align="center"></el-table-column>
        <el-table-column prop="updatedAt" label="更新时间" sortable align="center"></el-table-column>
        <el-table-column label="是否公开" align="center" width="80">
          <template slot-scope="scope">
            <el-switch v-model="scope.row.public" @change="editPublic($event, scope.row.id)"></el-switch>
          </template>
        </el-table-column>
        <el-table-column label="操作" align="center" width="220">
          <template slot-scope="scope">
            <router-link :to="'/article/'+ scope.row.id"><el-button type="primary" size="small">查看</el-button></router-link>
            <router-link :to="'/admin/editArticle/'+ scope.row.id"><el-button type="primary" size="small">编辑</el-button></router-link>
            <el-popover
              placement="top"
              width="100"
              trigger="click"
              v-model="visible[scope.row.id]">
              <p>
                <i class="el-icon-question"></i> 
                <span style="margin-left: 5px;">确定删除吗？</span>
              </p>
              <div style="text-align: right; margin: 0">
                <el-button size="mini" @click="visible.splice(scope.row.id, 1, false);">取消</el-button>
                <el-button type="primary" size="mini" @click="articleOpt(scope.row.id, 'del')">确定</el-button>
              </div>
              <el-button slot="reference" type="danger" size="small" @click="visible[scope.row.id] = true">删除</el-button>
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
import { Message } from "element-ui"
import Pagination from "@/components/Pagination";
import { articleManage } from "@/api/article"
import { delArticle } from "@/api/article"
import { fetchOther } from "@/api/article"
import { editPublic } from "@/api/article"

export default {
  name: "ArticleManage",
  data() {
    return {
      search: {
        title: "",
        tag: "",
        category: "",
        page: 1,
        pagesize: 10,
      },
      total: 10,
      tags: [],
      categories: [],
      articles: [],
      type: ["", "success", "info", "warning", "danger"],
      visible: [],
    };
  },

  created() {
    // 查询所有标签/分类信息
    fetchOther().then(response => {
      let {tags, categories} = response.data
      this.tags = tags
      this.categories = categories
    }),
    // 查询所有文章
    this.onSearch();
  },

  components: {
    Pagination,
  },

  computed: {},

  methods: {
    // 查找文章
    onSearch() {
      articleManage(this.search).then(response => {
        this.articles = response.data;
        this.total = response.total;
      })
    },
    articleOpt(id, operation) {
      this.$set(this.visible, id, false);  // 删除操作
      delArticle({id: id}).then(response => {
        Message({
          message: response.message,
          type: response.type,
          duration: 2000
        });
        this.onSearch();
      })
    },
    handleSizeChange(val) {
      this.search.pagesize = val;
      this.onSearch();
    },
    handleCurrentChange(val) {
      this.search.page = val;
      this.onSearch();
    },
    // 修改文章是否公开
    editPublic(state, id) {
      editPublic({state: state, id: id}).then(response => {
        Message({
          message: response.message,
          type: response.type,
          duration: 2000
        });
      })
    }
  }
};
</script>

<style src="./index.css" scoped></style>