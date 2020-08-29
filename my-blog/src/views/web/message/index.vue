<!-- 留言板 -->
<template>
  <div class="main">
    <!-- 主要内容 -->
    <div class="center">
      <!-- 顶部内容 -->
      <div class="top">
        <!-- 顶部文字 -->
        <div class="sub-title">
          <div class="f-tip">
            <span>tips：</span><span>友链申请格式在背后喔~</span>
          </div>
          <p>留言板</p>
          <p>欢迎大家来到我的博客！</p>
          <p>走过路过不要错过！大家一起交流学习，尽情畅谈！</p>
        </div>

        <!-- 申请友链格式 -->
        <div class="friendly">
          <h3 class="friendly_title">友链申请方式</h3> 
          <p>需要申请友链请在下方留言,格式如下</p> 
          <p>网站名称：<font style="color:#409EFF">NGKAKUI's Blog</font></p>
          <p>链接：<font style="color:#409EFF">https://www.ngkakui.cn</font></p>
          <p>Logo链接：<font style="color:#409EFF">https://www.ngkakui.cn/static/img/logo2.jpg</font></p>
        </div>
      </div>

      <!-- 留言框 -->
      <div class="message-box">
        <svg viewBox="0 0 1024 1024" width="35" height="35">
          <path
            d="M94.72 845.963636v-1.629091c0-0.465455-0.232727 1.163636 0 1.629091zM93.090909 833.629091v3.956364a64.698182 64.698182 0 0 1 17.687273-46.545455A58.88 58.88 0 0 0 93.090909 833.629091z"
            fill="#73B4FF"
            p-id="11977"
          />
          <path
            d="M94.72 845.963636a50.269091 50.269091 0 0 0 10.938182 24.669091 58.647273 58.647273 0 0 0 50.269091 21.178182h-4.421818a58.181818 58.181818 0 0 1-56.785455-45.847273zM94.254545 844.334545L93.090909 837.818182zM228.770909 837.818182l-36.770909 37.469091a57.483636 57.483636 0 0 1-36.072727 16.523636h391.214545a58.181818 58.181818 0 0 0 0-116.363636h-189.44L318.370909 814.545455z"
            fill="#87D3FF"
            p-id="11978"
          />
          <path
            d="M839.214545 228.072727l-82.152727-82.385454a46.545455 46.545455 0 0 0-65.861818 0L170.123636 666.763636l-23.272727 89.367273L112.174545 791.272727a57.949091 57.949091 0 0 1 40.261819-16.058182h206.196363l481.512728-481.745454a46.545455 46.545455 0 0 0-0.93091-65.396364z"
            fill="#73B4FF"
            p-id="11979"
          />
          <path
            d="M111.243636 791.272727A64.698182 64.698182 0 0 0 93.090909 837.818182v8.378182a58.181818 58.181818 0 0 0 56.785455 46.545454h6.050909a57.483636 57.483636 0 0 0 36.072727-16.523636L228.770909 837.818182l89.6-23.272727 39.330909-39.33091H151.505455a57.949091 57.949091 0 0 0-40.261819 16.058182z"
            fill="#73B4FF"
            p-id="11980"
          />
          <path
            d="M111.243636 791.272727A64.698182 64.698182 0 0 0 93.090909 837.818182v8.378182a58.181818 58.181818 0 0 0 56.785455 46.545454h6.050909a57.483636 57.483636 0 0 0 36.072727-16.523636L228.770909 837.818182l89.6-23.272727 39.330909-39.33091H151.505455a57.949091 57.949091 0 0 0-40.261819 16.058182z"
            fill="#1474E4"
          />
        </svg>
        <span class="message-font">发表留言</span>
        <el-input type="textarea" :rows="5" placeholder="请畅所欲言!" v-model="message.content"></el-input>
        <div class="message-btn">
          <span class="tip">
            <i class="el-icon-info"></i>
            支持 Markdown 语法
          </span>
          <el-button type="primary" @click="addMessage">留言</el-button>
        </div>        
      </div>

      <!-- 留言列表 -->
      <div class="message-list">
        <div class="message-num">
          <strong>{{messages.length}}</strong> 条留言
        </div>

        <!-- 留言 -->
        <div class="comment" v-for="message in messages" :key="message.id">
          <!-- 留言信息 头像、名称、时间 -->
          <div class="info">
            <div class="avatar">
              <img src="../../../../static/img/avatar.png"/>
            </div>
            <p class="author">
              {{message.name}}
            </p>
            <p class="comment-time">
              {{message.createdAt}}
            </p>
          </div>

          <!-- 留言内容 -->
          <div class="comment-content">
            <comment-view v-if="message.content" :id="message.id" :message="message.content" v-highlight/>
            <div class="comment-btn">
              <!-- <el-button type="primary" icon="el-icon-s-comment" size="mini" @click="replyMessage(message)" circle></el-button> -->
              <el-popover placement="top" width="100" trigger="click" v-model="visible[message.id]">
                <p>
                  <i class="el-icon-question"></i> 
                  <span>确定删除吗？</span>
                </p>
                <div class="btn-group">
                  <el-button size="mini" @click="visible.splice(message.id, 1, false);">取消</el-button>
                  <el-button type="primary" size="mini" @click="deleteMessage(message.id)">确定</el-button>
                </div>
                <el-button
                  icon="el-icon-delete"
                  slot="reference"
                  type="danger"
                  size="mini"
                  @click="visible[message.id] = true"
                  circle
                  v-if="$store.state.user.role == '1'"
                ></el-button>
              </el-popover>
            </div>
          </div>
        </div>

        <!-- 空内容提示 -->
        <div v-if="messages.length == 0" class="comment-empty">
          还没有留言，快来抢沙发！！
        </div>
      </div>

      <!-- 分页 -->
      <div class="pagination">
        <pagination
          :page="search.page"
          :pagesize="search.pagesize"
          :total="total"
          @handleSizeChange="handleSizeChange"
          @handleCurrentChange="handleCurrentChange"/>
      </div>
    </div>

    <!-- 分界线 -->
    <div class="line"></div>

    <!-- 右边栏 -->
    <div class="right">
      <div class="right-title">
        <p>欢迎你!</p>
        <p>
          来自
          <font class="font">{{user.province}}-{{user.city}}</font> 的朋友
        </p>
        <p style="padding: 0 3px;">
          你的IP地址是：
          <font class="font">{{user.ip}}</font>
        </p>
      </div>
      <!-- 天气预报 -->
      <weather />
    </div>
  </div>
</template>

<script>
import Pagination from "@/components/Pagination";
import CommentView from '@/components/CommentView'
import Weather from "@/components/Weather";
import { Message, Loading } from "element-ui"
import { isNull } from "@/utils/vaildata";
import { fetchMessage } from "@/api/message";
import { handleMessage } from "@/api/message";

export default {
  name: 'NewMessage',
  data() {
    return {
      // 获取当前用户的IP地址、地址信息
      user: {
        ip: this.$store.state.ipInfo.ip,
        city: this.$store.state.ipInfo.city,
        province: this.$store.state.ipInfo.province,
        country: this.$store.state.ipInfo.country
      },
      message: {
        content: "",
      },
      messages: [],
      search: {
        page: 1,
        pagesize: 10,
      },
      total: 0,
      visible: [],
    };
  },

  created() {
    // 请求留言列表
    this.onSearch()
  },

  components: {
    Weather,
    Pagination,
    CommentView,
  },

  computed: {
    // 浏览器窗口高度
    clientHeight() {
      return `height:${document.documentElement.clientHeight - 110}px`
    }
  },

  methods: {
    // 查询所有留言
    onSearch() {
      fetchMessage(this.search).then(response => {
        this.messages = response.data;
        this.total = response.total;
      });
    },

    // 留言
    addMessage() {
      if (!isNull(this.message.content)) {
        this.$store.state.user.name == undefined ? this.message.name = "游客" : this.message.name = this.$store.state.user.name;
        this.message.operation = "add";
        handleMessage(this.message).then(response => {
          this.messages = response.data;
          Message({
            message: response.message,
            type: response.type,
            duration: 2000
          });
        })
        this.message.content = "";
      } else {
        Message({
          message: "留言不能为空!",
          type: "error",
          duration: 2000
        });
      }
    },

    // 回复留言
    // replyMessage(message) {
    //   console.log(message);
    // },

    // 删除留言
    deleteMessage(id) {
      let params = {
        operation: "del",
        id: id
      }
      handleMessage(params).then(response => {
        this.messages = response.data;
        Message({
          message: response.message,
          type: response.type,
          duration: 2000
        });
      })
    },

    // 每页条数改变
    handleSizeChange(val) {
      this.pagesize = val;
      this.onSearch();
    },

    // 页数改变
    handleCurrentChange(val) {
      this.page = val;
      this.onSearch();
    },
  }
}
</script>

<style src="./index.css" scoped></style>

<style scoped>
</style>