<!-- 侧边栏 -->
<template>
  <div>
      <!-- 个人简介 -->
      <div>
        <img src="../../../../static/img/logo2.jpg" />
        <div class="name">
          <h3 class="title">NGKAKUI</h3>
        </div>
        <h5 class="sub-title">前端搬运工、打杂人员</h5>
        <ul class="pages">
          <li>
            <svg class="icon" viewBox="0 0 1024 1024" width="22" height="22">
              <path
                d="M511.542857 14.057143C228.914286 13.942857 0 242.742857 0 525.142857 0 748.457143 143.2 938.285714 342.628571 1008c26.857143 6.742857 22.742857-12.342857 22.742858-25.371429v-88.571428c-155.085714 18.171429-161.371429-84.457143-171.771429-101.6C172.571429 756.571429 122.857143 747.428571 137.714286 730.285714c35.314286-18.171429 71.314286 4.571429 113.028571 66.171429 30.171429 44.685714 89.028571 37.142857 118.857143 29.714286 6.514286-26.857143 20.457143-50.857143 39.657143-69.485715-160.685714-28.8-227.657143-126.857143-227.657143-243.428571 0-56.571429 18.628571-108.571429 55.2-150.514286-23.314286-69.142857 2.171429-128.342857 5.6-137.142857 66.4-5.942857 135.428571 47.542857 140.8 51.771429 37.714286-10.171429 80.8-15.542857 129.028571-15.542858 48.457143 0 91.657143 5.6 129.714286 15.885715 12.914286-9.828571 76.914286-55.771429 138.628572-50.171429 3.314286 8.8 28.228571 66.628571 6.285714 134.857143 37.028571 42.057143 55.885714 94.514286 55.885714 151.2 0 116.8-67.428571 214.971429-228.571428 243.314286a145.714286 145.714286 0 0 1 43.542857 104v128.571428c0.914286 10.285714 0 20.457143 17.142857 20.457143 202.4-68.228571 348.114286-259.428571 348.114286-484.685714 0-282.514286-229.028571-511.2-511.428572-511.2z"
              />
            </svg>
            <a class="font" href="#">github</a>
          </li>
          <li>
            <svg class="icon" viewBox="0 0 1024 1024" width="22" height="22">
              <path
                d="M1022.08 579.712l-57.258667-176.426667-113.664-349.397333a19.413333 19.413333 0 0 0-36.992 0L700.501333 403.2H323.498667L209.877333 53.888C204.074667 35.84 178.56 35.84 172.8 53.76L59.136 403.157333 1.877333 579.712a39.424 39.424 0 0 0 14.122667 43.648L512 983.637333l496-360.234666a39.253333 39.253333 0 0 0 14.08-43.690667"
                fill="#e0620d"
              />
            </svg>
            <a class="font" href="https://gitlab.com/465162390">gitlab</a>
          </li>
        </ul>
      </div>

      <!-- 热门文章 -->
      <div>
        <el-divider content-position="left">
          <font style="font-size: 12px; color: red;">[hot]&nbsp;&nbsp;</font><font style="font-size: 15px;">热门文章</font>
        </el-divider>
        <ul class="article-list">
          <li v-for="article in hotArticles" :key="article.id">
            <router-link :to="'/article/'+ article.id">
              <span>
                <svg v-if="article.public=='false'" style="vertical-align: text-top;" t="1582184110620" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1161" width="16" height="16">
                  <path d="M829.6 960.6h-634c-35.9 0-65.8-23.9-65.8-65.8V434.2c0-35.9 29.9-65.8 65.8-65.8h634c35.9 0 65.8 29.9 65.8 65.8v460.5c6 41.9-23.9 65.9-65.8 65.9z m-634-532.3c-5.9 0-5.9 5.9 0 0l-6 466.5c0 6 0 6 6 6h634c6 0 6 0 6-6V434.2c0-6 0-6-6-6h-634z" p-id="1162" fill="#2c2c2c"></path>
                  <path d="M590.4 589.8c0-41.9-41.9-77.8-77.8-77.8-41.9 0-71.8 41.9-71.8 77.8 0 29.9 17.9 59.8 47.8 65.8v107.7c0 12 6 17.9 17.9 17.9h23.9c12 0 17.9-6 17.9-17.9V655.5c24.1-5.9 42.1-35.8 42.1-65.7zM763.8 392.4H704v-89.7c0-101.7-83.7-179.4-179.4-179.4-101.7 0-179.4 83.7-179.4 179.4v89.7h-59.8v-89.7c0-131.6 107.7-239.2 239.2-239.2s239.2 107.7 239.2 239.2v89.7z" p-id="1163" fill="#515151"></path>
                </svg>
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
                <font style="margin-left: 5px; vertical-align: 3px;">{{article.title}}</font>
              </span>
            </router-link>
          </li>
        </ul>
      </div>

      <!-- 标签 -->
      <div>
        <el-divider content-position="left">
          <font style="font-size: 15px;">标签</font>
        </el-divider>
        <div class="tag-list">
          <router-link :to="'/tags/'+tag.name" v-for="tag in tags" :key="tag.id">
            <el-tag
              style="cursor: pointer;"
              :type="type[Math.floor(Math.random()*5 + 1)]"
              effect="light"
              :hit="true"
            >{{tag.name}}</el-tag>
          </router-link>
        </div>
      </div>
  </div>
</template>

<script>
import { fetchHotArticle } from "@/api/article";
import { fetchOther } from "@/api/article";

export default {
  name: "sidebar",
  data() {
    return {
      tags: [],
      type: ["", "success", "info", "warning", "danger"],
      hotArticles: [],
    };
  },

  created() {
    // 请求热门文章
    this.fetchArticle()
    // 请求标签
    this.fetchtags()
  },

  methods: {
    // 请求热门文章
    fetchArticle() {
      let role
      this.$store.state.user.role != undefined ? role = this.$store.state.user.role 
        : role = "0" 
      fetchHotArticle({role: role}).then(response => {
        this.hotArticles = response.data;
        this.$store.commit("changeHotArticles", response.data);
      })
    },

    // 请求标签
    fetchtags() {
      fetchOther().then(response => {
        this.tags = response.data.tags;
        this.$store.commit("changeTags", response.data.tags);
      })
    }
  }
};
</script>

<style scoped>
img {
  margin: 0 auto;
  height: 150px;
  width: 150px;
  padding: 5px;
  border: dashed 2px #00b894;
  border-radius: 50%;
  margin-bottom: 0px;
}
.name {
  width: 115px;
  height: 34px;
  box-sizing: border-box;
  border-bottom: solid 7px #0984e3;
  border-radius: 50%;
  margin: 5px auto 12px auto;
}
.title {
  margin-top: 5px;
  margin-bottom: 13px;
}
.sub-title {
  font-size: 13px;
  margin: 3px;
  color: rgba(0, 0, 0, 0.65);
  margin-bottom: 10px;
}
.font {
  margin-top: 0px;
  font-size: 13px;
  display: block;
  color: black;
}
ul {
  list-style-type: none;
  padding: 0 5px;
}
a {
  text-decoration: none;
}
.pages {
  padding: 0;
  line-height: 24px;
  display: flex;
  justify-content: center;
  margin-top: 0px;
}
.pages li {
  padding: 0 10px;
  cursor: pointer;
}
.article-list {
  text-align: left;
}
.article-list li span {
  padding: 2px 5px; 
  display: block;
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  font-size: 14px;
  line-height: 25px;
  color: #8590a6;
  cursor: pointer;
  transition: 0.5s;
  margin: 3px 0;
}
.article-list li span:hover {
  background-color: rgba(0, 0, 0, 0.05);
  color: #3742fa;
  border-radius: 6px;
  box-shadow: 3px 4px #DCC6E0;
}
.tag-list {
  overflow: hidden;
}
.el-tag {
  font-size: 12px;
  margin: 5px;
  transition: 0.5s;
}
.el-tag:hover {
  transform: scale(1.2);
}
</style>