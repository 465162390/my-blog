<!-- 归档 -->
<template>
  <el-row>
    <el-col :span="24">
      <div class="archives">
        <!-- 按条件归档 -->
        <div class="search">
          <!-- 时间 -->
          <el-date-picker style="width: 150px;" v-model="search.time" type="month" value-format="yyyy-MM" placeholder="月份归档" @change="onSearch"></el-date-picker>

          <!-- 标签 -->
          <!-- <el-select style="margin-left: 20px;" v-model="value" placeholder="请选择标签">
            <el-option v-for="tag in tags" :key="tag.id" :label="tag.name" :value="tag.name">
              <el-tag style="float: left;" size="mini" effect="light" :hit="true" :key="tag.id">{{tag.name}}</el-tag>
            </el-option>
          </el-select> -->
        </div>

        <el-divider></el-divider>

        <!-- 文章列表 -->
        <el-timeline>
          <el-timeline-item icon="el-icon-time" size="large" type="danger">
            <span class="title">{{search.time.substr(0,4)}}年{{search.time.substr(5,2)}}月 / 共 {{articles.length}} 篇文章</span>
          </el-timeline-item>
          <el-timeline-item v-for="article in articles" :key="article.id" :timestamp="article.createdAt" placement="top" :type="type[Math.floor(Math.random()*5 + 1)]">
            <el-card>
              <span><svg viewBox="0 0 1024 1024" width="20" height="20"><path d="M856 952H168V104h545.94L856 246.06z m-640-48h592V265.94L694.06 152H216z" fill="#d81e06"></path><path d="M656 103.79V304h200zM704 256V152l104 104zM283.19 488h457.63v48H283.19zM283.19 323h288v48h-288zM283.19 653h457.63v48H283.19z" fill="#d81e06"></path></svg></span>
              <router-link :to="'/article/'+ article.id"><span class="font">{{article.title}}</span></router-link>
            </el-card>
          </el-timeline-item>
        </el-timeline>

        <div class="pagination">
          <pagination :page="search.page" :pagesize="search.pagesize" :total="total" @handleSizeChange="handleSizeChange" @handleCurrentChange="handleCurrentChange"/>
        </div>
      </div>
    </el-col>
  </el-row>
</template>

<script>
import Pagination from '@/components/Pagination'
import { fetch } from '@/api/archives'
import { timeFormatter } from '@/utils/vaildata'

export default {
  name: "Archives",
  data() {
    return {
      value: "",
      tags: [
        {
          id: 1,
          name: "JavaScript"
        },
        {
          id: 2,
          name: "Vue.js"
        },
        {
          id: 3,
          name: "HTML"
        },
        {
          id: 4,
          name: "CSS"
        },
        {
          id: 5,
          name: "作用域"
        },
        {
          id: 6,
          name: "闭包"
        },
      ],
      type: ["primary ", "success", "info", "warning", "danger"],
      articles: [],
      search: {
        time: timeFormatter("YYYY-MM"),
        page: 1,
        pagesize: 10,
      },
      total: 0,
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
    // 查找文章
    onSearch() {
      fetch(this.search).then(response => {
        this.articles = response.data;
        this.total = response.total;
      })
    },

    handleSizeChange(val) {
      this.pagesize = val;
      console.log(val);
    },
    
    handleCurrentChange(val) {
      this.page = val;
      console.log(val);
    }
  }
};
</script>

<style src="./index.css" scoped></style>