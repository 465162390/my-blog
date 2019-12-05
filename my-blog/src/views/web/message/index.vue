<!-- 留言板 -->
<template>
  <el-row>
    <el-col class="center" :xs="24" :sm="24" :md="24" :lg="18" :xl="18">
      <!-- <el-image style="width: 50%; height: auto;" src="../../../../static/img/message.jpg"></el-image> -->

      <!-- 顶部文字 -->
      <div class="sub-title">
        <p>留言板</p>
        <p>欢迎大家来到我的博客！</p>
        <p>走过路过不要错过！大家一起交流学习，尽情畅谈！</p>
      </div>

      <!-- 留言输入框 -->
      <div class="input">
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
        <div style="margin-top: 5px; text-align: right">
          <span class="tip">
            <i style="font-size: 18px; vertical-align: text-bottom" class="el-icon-info"></i>
            支持 Markdown 语法
          </span>
          <el-button type="primary" @click="addMessage">留言</el-button>
        </div>
      </div>

      <!-- 留言列表 -->
      <div class="message-list">
        <h3 style="margin: 10px 0 -10px 0">
          <font style="color: royalblue; font-size: 22px; vertical-align: -2px;">{{messages.length}}</font> 条留言
        </h3>
        <el-divider direction="horizontal"></el-divider>

        <div class="comment" v-for="message in messages" :key="message.id">
          <!-- 头像 -->
          <div class="avatar">
            <img src="../../../../static/img/avatar.png"/>
          </div>
          <!-- 留言信息 -->
          <div class="author">
            <span style="vertical-align: 13px;">{{message.name}}</span>
            <span class="comment-time">{{message.createdAt}}</span>

            <comment-view class="comment-content" v-if="message.content" :id="message.id" :message="message.content" v-highlight/>
            <!-- 回复、删除按钮 -->
            <span class="comment-btn">
              <!-- <el-button type="primary" icon="el-icon-s-comment" size="mini" @click="replyMessage(message)" circle></el-button> -->
              <el-popover
                placement="top"
                width="100"
                trigger="click"
                v-model="visible[message.id]">
                <p>
                  <i class="el-icon-question"></i> 
                  <span style="margin-left: 5px;">确定删除吗？</span>
                </p>
                <div style="text-align: right; margin: 0">
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
            </span>
            <el-divider style="margin: 10px 0;" direction="horizontal"></el-divider>
          </div>
        </div>

        <div v-if="messages.length == 0" style="color: rgba(0,0,0,.45); text-align: center">
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
          @handleCurrentChange="handleCurrentChange"
        />
      </div>
    </el-col>

    <el-col :xs="1" :sm="1" :md="1" :lg="1" :xl="1" class="hidden-md-and-down">
      <el-divider direction="vertical" class="line-height"></el-divider>
    </el-col>

    <!-- 右边栏 -->
    <el-col :xs="5" :sm="5" :md="5" :lg="5" :xl="5" class="hidden-md-and-down">
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
        <weather />
      </div>
    </el-col>
  </el-row>
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
  name: "Message",
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

  computed: {},

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
    }
  }
};
</script>
<style src="./index.css" scoped></style>

<style>
.editormd-html-preview code{
  color: red;
}
</style>