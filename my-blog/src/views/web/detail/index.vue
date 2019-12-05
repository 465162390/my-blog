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
        </div>
      </div>

      <!-- 文章内容 -->
      <div class="article-main">
        <article-view v-if="article.content" :id="article.id" :article="article.content" v-highlight/>
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
            <span style="vertical-align: 13px;">{{message.name}}</span>
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
    </div>

    <!-- 右边边栏 -->
    <div class="right">
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
import ArticleView from '@/components/ArticleView'
import CommentView from '@/components/CommentView'
import { isNull } from "@/utils/vaildata";
import { Message } from "element-ui"

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
    };
  },

  created() {
    this.onSearch();
  },

  components: {
    ArticleView,
    CommentView,
  },

  computed: {},

  methods: {
    // 文章详情
    onSearch() {
      fetchDetail({id: this.$route.params.id}).then(response => {
        this.article = response.data;
      })
      // 请求最新的10篇文章
      let params = {
        page: 1,
        pagesize: 10
      }
      fetchArticle(params).then(response => {
        this.latestArticles = response.data;
      })
    },

    // 评论
    addComment() {
      console.log(this.comment.content);
      // if (!isNull(this.comment.content)) {
      //   this.$store.state.user.name == undefined ? this.comment.name = "游客" : this.comment.name = this.$store.state.user.name;
      //   this.comment.operation = "add"
      //   handleComment(this.comment).then(response => {
      //     this.article.comments = response.data;
      //     Message({
      //       message: response.message,
      //       type: response.type,
      //       duration: 2000
      //     });
      //   })
      //   this.comment.content = "";
      // } else {
      //   Message({
      //     message: "留言不能为空!",
      //     type: "error",
      //     duration: 2000
      //   });
      // }
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
