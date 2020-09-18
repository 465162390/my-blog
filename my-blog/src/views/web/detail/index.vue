<!-- 文章详情页 -->
<template>
  <div>
    <!-- 主内容 -->
    <div class="center">
    
      <!-- 文章头部 -->
      <div class="article-header">
        <h1 class="article-title">
          {{article.title}}
        </h1>
        <div class="article-desc">
          <!-- 提交时间 -->
          <span class="post-time">
            <i class="el-icon-receiving"></i>
            <font>&nbsp;Posted on&nbsp;&nbsp;{{article.createdAt}}</font>
          </span>
          <el-divider direction="vertical"></el-divider>
          <!-- 标签 -->
          <span class="tag">
            <svg style="vertical-align: -2px;" viewBox="0 0 1024 1024" width="16" height="16">
              <path
                d="M788.48 629.418667c0-17.066667-5.802667-31.744-17.749333-44.714667L421.205333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744-21.162667-8.874667-39.936-12.970667-57.002667-12.970667L110.933333 191.146667c-17.066667 0-31.744 6.485333-44.032 18.773333-12.288 12.288-18.773333 26.965333-18.773333 44.032l0 202.752c0 17.066667 4.096 36.522667 12.970667 57.002667 8.874667 21.162667 18.773333 37.546667 31.744 49.834667l349.525333 349.525333c12.288 12.288 26.965333 17.749333 44.032 17.749333 17.066667 0 31.744-5.802667 44.714667-17.749333l239.616-239.616C781.994667 661.162667 788.48 646.485333 788.48 629.418667L788.48 629.418667 788.48 629.418667zM248.490667 392.192c-12.288 12.288-26.965333 18.090667-44.032 18.090667-17.066667 0-31.744-5.802667-44.032-18.090667-12.288-12.288-18.090667-26.965333-18.090667-44.032 0-17.066667 5.802667-31.744 18.090667-44.032 12.288-12.288 26.965333-18.090667 44.032-18.090667 17.066667 0 31.744 5.802667 44.032 18.090667C260.778667 316.416 266.24 331.093333 266.24 348.16 267.264 365.568 260.778667 379.904 248.490667 392.192L248.490667 392.192 248.490667 392.192zM958.122667 584.362667 608.597333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744C537.6 195.242667 518.826667 191.146667 501.76 191.146667l-109.909333 0c17.066667 0 36.522667 4.096 57.002667 12.970667 21.162667 8.874667 37.546667 18.773333 49.834667 31.744l349.525333 348.501333c12.288 12.970667 18.090667 27.648 18.090667 44.714667s-5.802667 31.744-18.090667 44.032l-229.034667 229.717333c9.898667 9.898667 18.773333 17.066667 25.941333 21.845333 7.168 4.778667 17.066667 6.485333 28.672 6.485333 17.066667 0 31.744-5.802667 44.714667-18.090667l239.616-240.298667c12.288-12.288 17.749333-26.965333 17.749333-44.032S970.069333 597.674667 958.122667 584.362667L958.122667 584.362667 958.122667 584.362667zM958.122667 584.362667"
                fill="#7dc5eb"
              />
            </svg>
            <el-tag
              style="margin:0 3px"
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
              style="margin:0 3px"
              size="mini"
              effect="dark"
              :hit="true"
              v-for="categorie in article.categories"
              :key="categorie.id"
            >{{categorie.name}}</el-tag>
          </span>
          <el-divider direction="vertical"></el-divider>
          <!-- 评论 -->
          <span v-if="article.comments">
            <i class="el-icon-chat-square"></i>
            <font style="font-size: 14px;">{{article.comments.length}}</font>
          </span>
          &nbsp;
          <!-- 浏览数 -->
          <span>
            <i class="el-icon-view"></i>
            <font style="font-size: 14px;">{{article.viewCount}}</font>
          </span>
          &nbsp;
          <!-- 点赞 -->
          <span>
            <el-button plain size="mini" @click="addLike" :disabled='disabled' :title="disabled ? '你不久前已经点赞过了!' : '给我点个赞吧!'">
              <svg style="vertical-align: -2px;" t="1584951439123" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2679" width="18" height="18">
                <path d="M928 452q-7.008-30.016-26.016-53.504t-40.992-36.512q-32-18.016-71.008-18.016h-91.008q14.016-42.016 18.016-95.008v-3.008q0-56-16-96-15.008-38.016-44.992-60.992-28-20-64-23.008-28.992-2.016-59.008 7.008-42.016 14.016-60.992 56-10.016 22.016-16 64.992l-0.992 0.992v4.992q-2.016 12-4 20.992-18.016 82.016-74.016 140.992-30.016 32-62.016 50.016-22.016 14.016-48.992 14.016H160.992q-28.992 0-48.992 20t-20 48.992v336.992q0 28 20 48.512t48 20.512h148q28.992 0 86.016 18.016h0.992q38.016 12 61.504 18.496t74.496 13.504 108.992 7.008h2.016q116 0 168.992-60 26.016-28 32.992-64 2.016-10.016 2.016-12.992 36-27.008 44.992-66.016 8-32-3.008-64.992 30.016-28.992 35.008-64.992 4.992-32-10.016-64.992 12-24 16.992-48 4.992-30.016-2.016-60z m-80.992 130.016q12 16 8.992 34.016-3.008 19.008-28.992 36-12 8-14.496 21.504t5.504 25.504q11.008 24 7.008 40.992-4 19.008-28.992 34.016-19.008 11.008-16.992 32.992 0.992 2.016 0.512 7.488t-4.992 17.504-14.496 22.016q-32.992 36-119.008 36h-0.992q-52.992 0-99.008-6.016t-68.512-12-56.512-16.992q-58.016-19.008-91.008-22.016V483.008q12.992-4.992 24.992-12 40-24 76-63.008 68.992-72 91.008-172l6.016-30.016q4.992-36 11.008-49.504t20-17.504q36.992-12 62.016 6.016 32.992 24 34.016 100-4 52-20 88.992-12 28 4.992 52.992t46.016 24.992h108.992q20.992 0 36.992 10.016 28 15.008 35.008 47.008 8 32.992-16.992 72.992-12.992 20.992 2.016 40zM160 495.008q0-0.992 0.992-0.992h96v339.008h-96q-0.992 0-0.992-0.992V495.04z" p-id="2680" :fill="disabled ? '#409EFF' : '#707070'"></path>
              </svg>
              <font style="font-size: 14px; color: #555555">{{article.aLike}}</font>
            </el-button>
          </span>
        </div>
      </div>

      <!-- 文章内容 -->
      <div class="article-main">
        <article-view v-if="article.content" :id="article.id" :article="article.content" v-highlight v-directory v-img-viewer/>
      </div>

      <!-- 点赞温馨提示、分享 -->
      <div style="text-align: center; padding-top: 10px;">
        <el-divider></el-divider>
        <div style="margin-top: 10px;">
          <span>全文完，<font class="tips">对你有帮助？请给我个赞吧！</font></span>
          <!-- 点赞按钮 -->
          <span>
            <el-button plain size="small" @click="addLike" :disabled='disabled' :title="disabled ? '你不久前已经点赞过了!' : '给我点个赞吧!'">
              <svg style="vertical-align: -4px;" t="1584951439123" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="2679" width="20" height="20">
                <path d="M928 452q-7.008-30.016-26.016-53.504t-40.992-36.512q-32-18.016-71.008-18.016h-91.008q14.016-42.016 18.016-95.008v-3.008q0-56-16-96-15.008-38.016-44.992-60.992-28-20-64-23.008-28.992-2.016-59.008 7.008-42.016 14.016-60.992 56-10.016 22.016-16 64.992l-0.992 0.992v4.992q-2.016 12-4 20.992-18.016 82.016-74.016 140.992-30.016 32-62.016 50.016-22.016 14.016-48.992 14.016H160.992q-28.992 0-48.992 20t-20 48.992v336.992q0 28 20 48.512t48 20.512h148q28.992 0 86.016 18.016h0.992q38.016 12 61.504 18.496t74.496 13.504 108.992 7.008h2.016q116 0 168.992-60 26.016-28 32.992-64 2.016-10.016 2.016-12.992 36-27.008 44.992-66.016 8-32-3.008-64.992 30.016-28.992 35.008-64.992 4.992-32-10.016-64.992 12-24 16.992-48 4.992-30.016-2.016-60z m-80.992 130.016q12 16 8.992 34.016-3.008 19.008-28.992 36-12 8-14.496 21.504t5.504 25.504q11.008 24 7.008 40.992-4 19.008-28.992 34.016-19.008 11.008-16.992 32.992 0.992 2.016 0.512 7.488t-4.992 17.504-14.496 22.016q-32.992 36-119.008 36h-0.992q-52.992 0-99.008-6.016t-68.512-12-56.512-16.992q-58.016-19.008-91.008-22.016V483.008q12.992-4.992 24.992-12 40-24 76-63.008 68.992-72 91.008-172l6.016-30.016q4.992-36 11.008-49.504t20-17.504q36.992-12 62.016 6.016 32.992 24 34.016 100-4 52-20 88.992-12 28 4.992 52.992t46.016 24.992h108.992q20.992 0 36.992 10.016 28 15.008 35.008 47.008 8 32.992-16.992 72.992-12.992 20.992 2.016 40zM160 495.008q0-0.992 0.992-0.992h96v339.008h-96q-0.992 0-0.992-0.992V495.04z" p-id="2680" :fill="disabled ? '#409EFF' : '#707070'"></path>
              </svg>
              <font style="font-size: 14px; color: #555555">{{article.aLike}}</font>
            </el-button>
          </span>
          <!-- 分享按钮 -->
          <span>
            <el-popover
              placement="bottom"
              title="分享出去吧~"
              width="200"
              trigger="click">
              <div>
                <share :href="this.href"></share>
              </div>
              <el-button slot="reference" size="small">
                <svg style="vertical-align: -4px;" t="1588749494837" class="icon" viewBox="0 0 1204 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="1161" width="20" height="20">
                  <path d="M903.529412 899.282824H120.470588V326.023529h180.404706s44.212706-62.855529 133.933177-121.856H60.235294c-33.249882 0-60.235294 27.105882-60.235294 60.928v695.115295c0 33.490824 26.985412 60.928 60.235294 60.928h903.529412c33.249882 0 60.235294-27.105882 60.235294-60.928V612.472471l-120.470588 100.171294v186.639059z m-100.382118-490.947765v203.836235L1204.705882 307.501176 803.147294 0v190.433882C317.500235 190.433882 301.176471 714.571294 301.176471 714.571294c137.426824-228.080941 238.441412-306.236235 501.970823-306.236235z" p-id="1162" fill="#409EFF"></path>
                </svg>
                <font style="font-size: 15px; color: #555555">分享</font>
              </el-button>
            </el-popover>
          </span>

        </div>
      </div>

      <!-- 发表评论框 -->
      <div class="article-comments">
        <div class="comments-header">
          <span class="comments-count" v-if="article.comments">{{article.comments.length}}</span>条评论
          <el-divider></el-divider>
          <el-input type="textarea" :rows="4" placeholder="说点什么..." v-model.trim="comment.content"></el-input>
          <div style="margin-top: 5px; text-align: right">
            <span class="tip">
              <i style="font-size: 18px; vertical-align: text-bottom" class="el-icon-info"></i>
              支持 Markdown 语法
            </span>
            <el-button type="primary" @click="addComment">发表评论</el-button>
          </div>
        </div>
      </div>

      <!-- 评论列表 -->
      <div class="comments-list">
        <div class="comment" v-for="message in article.comments" :key="message.id">
          <!-- 头像 -->
          <div class="avatar">
            <img src="../../../../static/img/avatar.png"/>
          </div>
          <!-- 评论信息 -->
          <div class="author">
            <span style="vertical-align: 13px; color: #409EFF">{{message.name}}</span>
            <span class="comment-time">{{message.createdAt}}</span>
            
            <!-- 评论内容的富文本框 -->
            <comment-view class="comment-content" v-if="message.content" :id="message.id" :message="message.content" v-highlight/>

            <!-- 删除按钮 -->
            <span class="comment-btn" v-if="$store.state.user.role == '1'">
              <el-popover
                placement="top"
                width="100"
                trigger="click"
                v-model="visible[message.id]">
                <p>
                  <i class="el-icon-question"></i> 
                  <span style="margin-left: 5px;">确定删除该留言吗？</span>
                </p>
                <div style="text-align: right; margin: 0">
                  <el-button size="mini" @click="visible.splice(message.id, 1, false)">取消</el-button>
                  <el-button type="primary" size="mini" @click="deleteComment(message.id)">确定</el-button>
                </div>
                <el-button slot="reference" type="danger" icon="el-icon-delete" size="mini" @click="visible[message.id] = true" circle></el-button>
              </el-popover>
            </span>

            <el-divider style="margin: 10px 0;" direction="horizontal"></el-divider>
          </div>
        </div>
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

      <!-- 右边抽屉 -->
      <right-drawer class="right-drawer" :directorys="directorys" :latestArticles="latestArticles" :drawer="rightDrawer" @goAnchor="goAnchor" @changeDrawer="changeDrawer" />
    </div>

    <!-- 右边边栏 -->
    <div class="right">
      <!-- 时钟 -->
      <!-- <clock/> -->
      <div v-if="directorys && directorys.length != 0">
        <el-divider content-position="center" >
          <font style="font-size: 15px;">目录锚点</font>
        </el-divider>
        <ul class="anchor">
          <li v-for="(directory, index) in directorys" :key="index">
            <a href="javascript:void(0)" @click="goAnchor(directory)">
              {{directory}}
            </a>
          </li>
        </ul>
      </div>

      <el-divider content-position="center">
        <font style="font-size: 12px; color: red;">[new]&nbsp;</font><font style="font-size: 15px;">最新文章</font>
      </el-divider>
      <ul class="title">
        <li v-for="article in latestArticles" :key="article.id">
          <router-link :to="'/article/'+ article.id">
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
              <font style="margin-left: 5px; vertical-align: 3px;">{{article.title}}</font>
            </span>
          </router-link>
        </li>
      </ul>
    </div>

  </div>
</template>

<script>
import { fetchDetail } from '@/api/article'
import { fetchArticle } from '@/api/article'
import { handleComment } from '@/api/article'
import { addLike } from '@/api/article'
import ArticleView from '@/components/ArticleView'
import Clock from '@/components/Clock'
import CommentView from '@/components/CommentView'
import RightDrawer from './components/RightDrawer'
import { isNull } from "@/utils/vaildata";
import { Message } from "element-ui"
import { titleFormat } from '@/utils/vaildata'
import Share from './components/Share'

export default {
  name: '',
  data () {
    return {
      type: ["", "success", "info", "warning", "danger"],
      loading: false,
      article: {},
      comment: {
        articleId: this.$route.params.id,
        content: "",
      },
      // 删除评论popver的隐藏/显示
      visible: [],
      latestArticles:[],
      directorys: [],
      rightDrawer: false,
      href: window.location.href,      
    };
  },

  created() {
    this.onSearch();
  },

  components: {
    ArticleView,
    CommentView,
    Clock,
    RightDrawer,
    Share,
  },

  computed: {
    // 点赞按钮状态
    disabled() {
      // 当前时间戳
      let key = "articleLike_" + this.article.id
      if( this.$store.state.articleId.indexOf(key) >= 0 ) {
        let time = new Date().getTime();
        return localStorage.getItem(key) > time;
      } else {
        return false
      }
    },
  },

  methods: {
    // 文章详情
    onSearch() {
      // 如果浏览者为博主用户，则传递到后端，不增加浏览量
      let role;
      this.$store.state.user.role == undefined ? role = "null" : role = this.$store.state.user.role;
      fetchDetail({id: this.$route.params.id, role: role}).then(response => {
        this.article = response.data;
        // 创建文章目录
        this.directorys = this.article.content.match(/(\#+)(.*)/g) && this.createDirectory(this.article.content.match(/(\#+)(.*)/g))
      })
      
      // 请求最新的10篇文章
      let params = {
        page: 1,
        pagesize: 10
      }
      this.$store.state.user.role != undefined ? params.role = this.$store.state.user.role 
        : params.role = "0" 
      fetchArticle(params).then(response => {
        this.latestArticles = response.data;
      })
    },

    // 删除目录中的非目录元素
    createDirectory(directory) {
      let newDirectory = [];
      for(let i=0; i<directory.length; i++) {
        let reg = /(\#+)(.*)/;
        if( directory[i].match(/\#docs/g) == null && directory[i].match(/\# /g) != null ) {
          let arr = directory[i].match(reg);
          directory[i] = arr[2].trim();
          newDirectory.push(directory[i]);
        }
      }
      return newDirectory;
    },

    // 评论
    addComment() {
      if (!isNull(this.comment.content)) {
        this.$store.state.user.name == undefined ? this.comment.name = "游客" : this.comment.name = this.$store.state.user.name;
        this.comment.operation = "add"
        handleComment(this.comment).then(response => {
          this.article.comments = response.data;
          Message({
            message: response.message,
            type: response.type,
            duration: 2000
          });
        })
        this.comment.content = "";
      } else {
        Message({
          message: "留言不能为空!",
          type: "error",
          duration: 2000
        });
      }
    },

    // 删除留言
    deleteComment(id) {
      this.visible.splice(id, 1, false);
      let params = {
        id: id,
        articleId: this.$route.params.id,
        operation: "del",
      }
      handleComment(params).then(response => {
        this.article.comments = response.data;
        Message({
          message: response.message,
          type: response.type,
          duration: 2000
        });
      })
    },

    // 目录锚点定位
    goAnchor(select) {
      select = "id" + select
      let selector = titleFormat(select);
      this.$el.querySelector(`#${selector}`).scrollIntoView({behavior:"smooth",block: "start", inline: "nearest"})
    },

    // 改变抽屉状态
    changeDrawer(params) {
      this.rightDrawer = params;
    },

    // 文章点赞
    addLike() {
      addLike({id: this.article.id}).then(response => {
        this.article.aLike = response.like;
        // 点赞成功后，将点赞时间保存到localStorage中，24小时内不能再点赞
        let key = "articleLike_" + this.article.id;
        let time = new Date().getTime() + 24*60*60*1000;  
        localStorage.setItem(key,time);
        
        // 将已点赞文章id 保存到localStorage、Vuex中
        let likeId = this.$store.state.articleId
        likeId.indexOf(key) >= 0 ? likeId.splice(likeId.indexOf(key), 1) : "";
        likeId.push(key);
        localStorage.setItem("likeId", JSON.stringify(likeId));
        this.$store.commit("changeLike",likeId);
      })
    },

  }
}

</script>

<style src="./index.css" scoped></style>

<style>
.article-main code {
  padding: 2px 4px;
  word-wrap: break-word;
  color: #ff502c;
  background: #fff5f5;
  border-radius: 3px;
  font-size: 13px;
  font-family: consolas,Menlo,PingFang SC,Microsoft YaHei,monospace; 
}
.article-main pre code {
  overflow: auto;
  font-size: 13px;
  color: #4d4d4c;
  font-family: consolas,Menlo,PingFang SC,Microsoft YaHei,monospace;
}
.article-main a {
  text-decoration: none;
}
.article-main ul li {
  list-style: circle;
}
</style>
