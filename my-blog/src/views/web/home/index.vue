<!-- 首页 -->
<template>
  <div>
    <!-- 中间主要内容 -->
    <div class="center" v-if="articles.length != 0">
      <!-- 文章列表 -->
      <div class="article-list">
        <ul>
          <li class="article-list-item" v-for="article in articles" :key="article.id" v-highlight>
            <router-link :to="'/article/'+ article.id">
              <!-- 文章标题 -->
              <div class="article-title">
                <el-divider content-position="left">
                  <span class="title">{{article.title}}</span>
                  <span class="post-time">{{article.createdAt.substr(0,10)}}</span>
                </el-divider>
              </div>

              <!-- 文章内容 -->
              <div class="article-content">
                <article-view class="article-view" :id="article.id" :article="article.content" />
              </div>
            </router-link>

            <!-- 文章脚部 -->
            <div class="article-footer">
              <!-- 评论 -->
              <span>
                <i class="el-icon-chat-square"></i>
                <font style="font-size: 14px;">{{article.comments.length}}</font>
              </span>
              <!-- 浏览数 -->
              <span>
                <i class="el-icon-view"></i>
                <font style="font-size: 14px;">{{article.viewCount}}</font>
              </span>
              <el-divider direction="vertical"></el-divider>
              <!-- 标签 -->
              <span>
                <svg style="vertical-align: -2px;" viewBox="0 0 1024 1024" width="16" height="16">
                  <path
                    d="M788.48 629.418667c0-17.066667-5.802667-31.744-17.749333-44.714667L421.205333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744-21.162667-8.874667-39.936-12.970667-57.002667-12.970667L110.933333 191.146667c-17.066667 0-31.744 6.485333-44.032 18.773333-12.288 12.288-18.773333 26.965333-18.773333 44.032l0 202.752c0 17.066667 4.096 36.522667 12.970667 57.002667 8.874667 21.162667 18.773333 37.546667 31.744 49.834667l349.525333 349.525333c12.288 12.288 26.965333 17.749333 44.032 17.749333 17.066667 0 31.744-5.802667 44.714667-17.749333l239.616-239.616C781.994667 661.162667 788.48 646.485333 788.48 629.418667L788.48 629.418667 788.48 629.418667zM248.490667 392.192c-12.288 12.288-26.965333 18.090667-44.032 18.090667-17.066667 0-31.744-5.802667-44.032-18.090667-12.288-12.288-18.090667-26.965333-18.090667-44.032 0-17.066667 5.802667-31.744 18.090667-44.032 12.288-12.288 26.965333-18.090667 44.032-18.090667 17.066667 0 31.744 5.802667 44.032 18.090667C260.778667 316.416 266.24 331.093333 266.24 348.16 267.264 365.568 260.778667 379.904 248.490667 392.192L248.490667 392.192 248.490667 392.192zM958.122667 584.362667 608.597333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744C537.6 195.242667 518.826667 191.146667 501.76 191.146667l-109.909333 0c17.066667 0 36.522667 4.096 57.002667 12.970667 21.162667 8.874667 37.546667 18.773333 49.834667 31.744l349.525333 348.501333c12.288 12.970667 18.090667 27.648 18.090667 44.714667s-5.802667 31.744-18.090667 44.032l-229.034667 229.717333c9.898667 9.898667 18.773333 17.066667 25.941333 21.845333 7.168 4.778667 17.066667 6.485333 28.672 6.485333 17.066667 0 31.744-5.802667 44.714667-18.090667l239.616-240.298667c12.288-12.288 17.749333-26.965333 17.749333-44.032S970.069333 597.674667 958.122667 584.362667L958.122667 584.362667 958.122667 584.362667zM958.122667 584.362667"
                    fill="#7dc5eb"
                  />
                </svg>
                <el-tag
                  style="margin-left: 5px;"
                  size="mini"
                  effect="light"
                  :hit="true"
                  :type="type[Math.floor(Math.random()*5 + 1)]"
                  v-for="tag in article.tags"
                  :key="tag.id"
                >{{tag.name}}</el-tag>
              </span>
              <el-divider direction="vertical"></el-divider>
              <!-- 分类 -->
              <span>
                <i class="el-icon-folder"></i>
                <el-tag
                  style="margin-left: 5px;"
                  size="mini"
                  effect="dark"
                  :hit="true"
                  v-for="categorie in article.categories"
                  :key="categorie.id"
                >{{categorie.name}}</el-tag>
              </span>
            </div>
          </li>
        </ul>
      </div>
      <!-- 分页 -->
      <div class="article-pagination">
        <pagination
          :page="search.page"
          :pagesize="search.pagesize"
          :total="total"
          @handleSizeChange="handleSizeChange"
          @handleCurrentChange="handleCurrentChange"
        />
      </div>
    </div>

    <!-- 右边文章列表 -->
    <div class="right" v-if="articles.length != 0">
      <el-divider content-position="center">
        <font style="font-size: 16px;">文章列表</font>
      </el-divider>
      <ul class="title">
        <li v-for="title in titles" :key="title.id">
          <router-link :to="'/article/'+ title.id">
            <span>
              <svg viewBox="0 0 1024 1024" width="15" height="15">
                <path
                  d="M855.04 21.504H471.04c-214.016 0-388.096 174.08-388.096 388.096v504.32c0 50.176 40.96 91.136 91.136 91.136h384c214.016 0 388.096-174.08 388.096-388.096V112.128c0-50.176-40.96-90.624-91.136-90.624z m29.696 594.944c0 180.224-146.432 326.656-326.656 326.656H174.08c-16.384 0-29.696-13.312-29.696-29.696V409.088c0-180.224 146.432-326.656 326.656-326.656h384c16.384 0 29.696 13.312 29.696 29.696v504.32z"
                  fill="#1296db"
                  p-id="2265"
                />
                <path
                  d="M314.88 415.744h144.896c16.896 0 30.72-13.824 30.72-30.72s-13.824-30.72-30.72-30.72H314.88c-16.896 0-30.72 13.824-30.72 30.72s13.824 30.72 30.72 30.72zM659.456 610.304H314.88c-16.896 0-30.72 13.824-30.72 30.72s13.824 30.72 30.72 30.72h344.576c16.896 0 30.72-13.824 30.72-30.72s-13.824-30.72-30.72-30.72z"
                  fill="#1296db"
                />
              </svg>
              <font style="margin-left: 5px; vertical-align: 3px;">{{title.name}}</font>
            </span>
          </router-link>
        </li>
      </ul>
    </div>

    <!-- 没有文章 -->
    <div v-if="showEmpty" class="empty">
      <svg
        t="1573189019339"
        class="icon"
        viewBox="0 0 1024 1024"
        version="1.1"
        xmlns="http://www.w3.org/2000/svg"
        p-id="8128"
        width="60"
        height="60"
      >
        <path
          d="M856 952H168V104h545.94L856 246.06z m-640-48h592V265.94L694.06 152H216z"
          p-id="8129"
          fill="#8a8a8a"
        />
        <path
          d="M656 103.79V304h200zM704 256V152l104 104zM283.19 488h457.63v48H283.19zM283.19 323h288v48h-288zM283.19 653h457.63v48H283.19z"
          p-id="8130"
          fill="#8a8a8a"
        />
      </svg>
      <p>
        不存在标题中含有
        <span class="empty-text">{{this.$route.query.title}}</span>的文章!
      </p>
    </div>

    <!-- 左边抽屉按钮 -->
    <div class="drawer leftD" @click="leftDrawer = true">
      <svg 
        t="1574488903479" 
        class="icon" 
        viewBox="0 0 1024 1024" 
        version="1.1" 
        xmlns="http://www.w3.org/2000/svg" 
        p-id="3385" 
        width="16" 
        height="16">
        <path d="M51.2 56.32h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2C22.92224 158.72 0 135.79776 0 107.52s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z" fill="#515151" p-id="3386"></path>
      </svg>
    </div>

    <!-- 右边抽屉按钮 -->
    <div class="drawer rightD" @click="rightDrawer = true">
      <svg 
        t="1574488903479" 
        class="icon" 
        viewBox="0 0 1024 1024" 
        version="1.1" 
        xmlns="http://www.w3.org/2000/svg" 
        p-id="3385" 
        width="16" 
        height="16">
        <path d="M51.2 56.32h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2C22.92224 158.72 0 135.79776 0 107.52s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z m0 399.36h921.6c28.27776 0 51.2 22.92224 51.2 51.2s-22.92224 51.2-51.2 51.2H51.2c-28.27776 0-51.2-22.92224-51.2-51.2s22.92224-51.2 51.2-51.2z" fill="#515151" p-id="3386"></path>
      </svg>
    </div>

    <!-- 左边抽屉 个人简介 -->
    <left-drawer :drawer="leftDrawer" @changeDrawer="changeDrawer"/>

    <!-- 右边抽屉 文章列表 -->
    <right-drawer :drawer="rightDrawer" @changeDrawer="changeDrawer" :titles="titles"/>
  </div>
</template>

<script>
import Pagination from "@/components/Pagination";
import LeftDrawer from "@/components/LeftDrawer";
import RightDrawer from "@/components/RightDrawer";
import ArticleView from "@/components/ArticleView";
import { getIpInfo } from "@/api/ipInfo";
// import { getAddressInfo } from "@/api/ipInfo";
import { fetchArticle } from "@/api/article";

export default {
  name: "Home",
  data() {
    return {
      type: ["", "success", "info", "warning", "danger"],
      articles: [],
      search: {
        page: 1,
        pagesize: 10
      },
      showEmpty: false,
      total: 30,
      titles: [],
      leftDrawer: false,
      rightDrawer: false
    };
  },

  created() {
    // 获取用户ip地址信息
    getIpInfo().then(response => {
      let { city, province, ip } = response;
      let ipInfo = {
        city: city,
        province: province,
        ip: ip,
      }
      this.$store.commit("setIp", ipInfo);
      window.sessionStorage.setItem("ipInfo", JSON.stringify(ipInfo));
    });

    // 获取所有文章信息
    this.onSearch();
  },

  components: {
    Pagination,
    ArticleView,
    LeftDrawer,
    RightDrawer
  },

  computed: {},

  methods: {
    // 获取文章
    onSearch() {
      if (JSON.stringify(this.$route.query) != "{}") {
        this.search.page = parseInt(this.$route.query.page);
        this.search.pagesize = parseInt(this.$route.query.pagesize);
        this.search.title = this.$route.query.title;
      }
      fetchArticle(this.search).then(response => {
        response.data.length == 0 ? this.showEmpty = true : this.showEmpty = false;
        this.total = response.total;
        this.articles = response.data;
        // 文章列表
        this.titles = [];
        response.data.map(value => {
          let obj = {
            id: value.id,
            name: value.title
          };
          this.titles.push(obj);
        });
      });
    },

    handleSizeChange(val) {
      this.search.pagesize = val;
      this.onSearch();
    },

    handleCurrentChange(val) {
      this.search.page = val;
      this.onSearch();
    },

    // 改变抽屉状态
    changeDrawer(params) {
      params.location == "left" ? this.leftDrawer = params.visible : this.rightDrawer = params.visible;
    }
  }
};
</script>

<style src="./index.css" scoped></style>

<style>
.article-content a {
  text-decoration: none;
}
.article-content ul li {
  list-style: circle;
}
*:focus {
  outline: 0px;
}
</style>