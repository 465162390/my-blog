<!-- 归档 -->
<template>
  <el-row>
    <el-col :span="24">
      <div class="archives">
        <!-- 按条件归档 -->
        <div class="search">
          <!-- 时间 -->
          <el-date-picker style="width: 150px;" v-model="search.time" type="month" value-format="yyyy-MM" placeholder="月份归档" @change="onSearch"></el-date-picker>

        </div>

        <el-divider></el-divider>

        <!-- 文章列表 -->
        <el-timeline>
          <el-timeline-item icon="el-icon-time" size="large" type="danger">
            <span class="title">{{search.time.substr(0,4)}}年{{search.time.substr(5,2)}}月 / 共 {{articles.length}} 篇文章</span>
          </el-timeline-item>
          <el-timeline-item v-for="article in articles" :key="article.id" :timestamp="article.createdAt" placement="top" :type="type[Math.floor(Math.random()*5 + 1)]">
            <el-card>
              <span>
                <svg v-if="article.public==false" style="vertical-align: -1px;" t="1582184110620" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1161" width="20" height="20">
                  <path d="M829.6 960.6h-634c-35.9 0-65.8-23.9-65.8-65.8V434.2c0-35.9 29.9-65.8 65.8-65.8h634c35.9 0 65.8 29.9 65.8 65.8v460.5c6 41.9-23.9 65.9-65.8 65.9z m-634-532.3c-5.9 0-5.9 5.9 0 0l-6 466.5c0 6 0 6 6 6h634c6 0 6 0 6-6V434.2c0-6 0-6-6-6h-634z" p-id="1162" fill="#2c2c2c"></path>
                  <path d="M590.4 589.8c0-41.9-41.9-77.8-77.8-77.8-41.9 0-71.8 41.9-71.8 77.8 0 29.9 17.9 59.8 47.8 65.8v107.7c0 12 6 17.9 17.9 17.9h23.9c12 0 17.9-6 17.9-17.9V655.5c24.1-5.9 42.1-35.8 42.1-65.7zM763.8 392.4H704v-89.7c0-101.7-83.7-179.4-179.4-179.4-101.7 0-179.4 83.7-179.4 179.4v89.7h-59.8v-89.7c0-131.6 107.7-239.2 239.2-239.2s239.2 107.7 239.2 239.2v89.7z" p-id="1163" fill="#515151"></path>
                </svg>
                <svg viewBox="0 0 1024 1024" width="20" height="20">
                  <path d="M856 952H168V104h545.94L856 246.06z m-640-48h592V265.94L694.06 152H216z" fill="#d81e06"></path>
                  <path d="M656 103.79V304h200zM704 256V152l104 104zM283.19 488h457.63v48H283.19zM283.19 323h288v48h-288zM283.19 653h457.63v48H283.19z" fill="#d81e06"></path>
                </svg>
              </span>
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
      this.$store.state.user.role != undefined ? this.search.role = this.$store.state.user.role 
        : this.search.role = "0"
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