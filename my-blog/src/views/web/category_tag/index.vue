<!-- 按 分类/标签 归档文章 -->
<template>
  <el-row>
    <el-col :span="24">
      <div class="archives">
        <!-- 按条件归档 -->
        <div class="search">

          <!-- 分类的图标 -->
          <svg v-if="title=='分类'" t="1573198765574" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="19075" width="30" height="30">
            <path d="M128 1024V96C128 42.98 170.98 0 224 0h576c53.02 0 96 42.98 96 96v928L512 800 128 1024z" fill="#515151" p-id="19076"></path>
          </svg>

          <!-- 标签的图标 -->
          <svg v-if="title=='标签'" t="1573195717285" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9048" width="30" height="30">
            <path d="M788.48 629.418667c0-17.066667-5.802667-31.744-17.749333-44.714667L421.205333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744-21.162667-8.874667-39.936-12.970667-57.002667-12.970667L110.933333 191.146667c-17.066667 0-31.744 6.485333-44.032 18.773333-12.288 12.288-18.773333 26.965333-18.773333 44.032l0 202.752c0 17.066667 4.096 36.522667 12.970667 57.002667 8.874667 21.162667 18.773333 37.546667 31.744 49.834667l349.525333 349.525333c12.288 12.288 26.965333 17.749333 44.032 17.749333 17.066667 0 31.744-5.802667 44.714667-17.749333l239.616-239.616C781.994667 661.162667 788.48 646.485333 788.48 629.418667L788.48 629.418667 788.48 629.418667zM248.490667 392.192c-12.288 12.288-26.965333 18.090667-44.032 18.090667-17.066667 0-31.744-5.802667-44.032-18.090667-12.288-12.288-18.090667-26.965333-18.090667-44.032 0-17.066667 5.802667-31.744 18.090667-44.032 12.288-12.288 26.965333-18.090667 44.032-18.090667 17.066667 0 31.744 5.802667 44.032 18.090667C260.778667 316.416 266.24 331.093333 266.24 348.16 267.264 365.568 260.778667 379.904 248.490667 392.192L248.490667 392.192 248.490667 392.192zM958.122667 584.362667 608.597333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744C537.6 195.242667 518.826667 191.146667 501.76 191.146667l-109.909333 0c17.066667 0 36.522667 4.096 57.002667 12.970667 21.162667 8.874667 37.546667 18.773333 49.834667 31.744l349.525333 348.501333c12.288 12.970667 18.090667 27.648 18.090667 44.714667s-5.802667 31.744-18.090667 44.032l-229.034667 229.717333c9.898667 9.898667 18.773333 17.066667 25.941333 21.845333 7.168 4.778667 17.066667 6.485333 28.672 6.485333 17.066667 0 31.744-5.802667 44.714667-18.090667l239.616-240.298667c12.288-12.288 17.749333-26.965333 17.749333-44.032S970.069333 597.674667 958.122667 584.362667L958.122667 584.362667 958.122667 584.362667zM958.122667 584.362667" p-id="9049" fill="#515151"></path>
          </svg>

          <!-- 标题 -->
          <span style="vertical-align: 7px; margin-left: 10px">
            {{title}} - {{this.$route.params.param}}
          </span>
        </div>
        <el-divider></el-divider>

        <!-- 文章列表 -->
        <el-timeline>
          <el-timeline-item icon="el-icon-time" size="large" type="danger">
            <span class="title">共 {{articles.length}} 篇文章</span>
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
import { otherArchives } from '@/api/archives'

export default {
  name: "Category_Tag",
  data() {
    return {
      type: ["primary ", "success", "info", "warning", "danger"],
      articles: [],
      search: {
        value: this.$route.params.param,
        type: "",
        page: 1,
        pagesize: 10,
      },
      title: "",
      total: 0,
    };
  },

  created() {
    this.$route.path.split("/")[1] == "tags" ? (this.title = "标签", this.search.type = "tag") : (this.title = "分类", this.search.type = "category");
    this.onSearch();
  },

  components: {
    Pagination,
  },

  computed: {},

  methods: {
    // 查找文章
    onSearch() {
      otherArchives(this.search).then(response => {
        this.articles = response.data;
        // this.total = response.total;
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
<style scoped>
.archives {
  margin-left: -35px;
  padding: 20px 30px 20px 0;
}
.title {
  font-size: 20px;
  font-weight: 550;
  position: relative;
  top: -4px;
}
.font {
  margin-left: 3px;
  cursor: pointer;
  font-size: 15px;
  color: #40a9ff;
  vertical-align: 3px;
}
.search {
  text-align: center;
  color: #3c4858;
  font-size: 1.5rem;
  font-weight: 400;
  text-align: center;
}
.pagination {
  float: right;
}
a {
  text-decoration: none
}

@media (max-width: 992px) {
  .archives {
    padding: 0px 0px 30px 35px;
  }
}

@media (max-width: 450px) {
  .title {
    font-size: 17px;
  }
  .font {
    font-size: 13px;
  }
  .el-timeline {
    padding-left: 10px;
  }
  .search {
    font-size: 1.2em;
  }
}
</style>