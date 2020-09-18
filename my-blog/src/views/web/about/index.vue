<!-- 关于 -->
<template>
  <div>
    <el-row>
      <el-col :span="24">
        <el-avatar style="vertical-align: middle;" :size="50" src="../../../../static/img/logo2.jpg"></el-avatar>
        <span class="sub-title">前端搬运工、打杂人员，只是一个刚入门的渣渣</span>
      </el-col>
      <!-- 博客简介 -->
      <el-col :span="24" style="font-size: 14px; color: #555">
        <el-divider content-position="left">博客简介</el-divider>
        <p>本博客使用的技术为： Vue.js + Element-UI + PHP + MySql</p>
        <p>源码地址为 <a href="https://gitlab.com/465162390/my-blog" target="blank">gitlab</a>，
        <a href="https://github.com/465162390/my-blog" target="blank">github</a> 仅供参考！</p>
      </el-col>
      <!-- 个人简介 -->
      <el-col :span="24">
        <el-divider content-position="left">个人简介</el-divider>
        <ul class="about-list">
          <li>姓名：&nbsp;伍家驹</li>
          <!-- <li>出生年月：&nbsp;1997.1</li> -->
          <li>籍贯：&nbsp;广东省江门市</li>
          <li>现居住地：&nbsp;广东省珠海市</li>
          <li>
            联系方式：&nbsp;
            <svg viewBox="0 0 1024 1024" width="16" height="16"><path d="M234.668159 365.659027c0 0-41.244356 17.509792-29.996175 116.235304 0 0-78.739319 71.239508-97.486288 179.977048 0 0-10.012028 183.725418 89.9875 22.496363 0 0 22.497387 61.229526 63.741743 116.235304 0 0-73.752748 25.007557-67.491137 89.9875 0 0-2.512217 72.478731 157.479661 67.490114 0 0 112.484887-8.735965 146.230456-56.241932l14.998599 0L512.132518 65.695235C512.132518 65.695235 243.404124 56.95927 234.668159 365.659027z" p-id="1635" fill="#1296db"></path><path d="M789.331841 365.659027c0 0 41.24538 17.509792 29.996175 116.235304 0 0 78.740342 71.239508 97.488335 179.977048 0 0 9.974166 183.725418-89.988524 22.496363 0 0-22.496363 61.229526-63.741743 116.235304 0 0 73.716932 25.007557 67.49216 89.9875 0 0 2.475378 72.478731-157.480684 67.490114 0 0-112.485911-8.735965-146.230456-56.241932l-14.997576 0L511.869528 65.695235C511.868505 65.695235 780.559037 56.95927 789.331841 365.659027z" fill="#1296db"></path></svg>
              &nbsp;465162390
            <el-divider direction="vertical" class="line"></el-divider>
            <svg viewBox="0 0 1024 1024" width="16" height="16"><path d="M512 537.6l512-156.444444V312.888889c0-62.577778-51.2-113.777778-113.777778-113.777778H113.777778c-62.577778 0-113.777778 51.2-113.777778 113.777778v68.266667l512 156.444444z" fill="#4B9AFC" p-id="2732"></path><path d="M537.6 620.088889l-5.688889 14.222222-19.911111-5.688889-22.755556 5.688889-5.688888-14.222222-483.555556-147.911111V824.888889c0 62.577778 51.2 113.777778 113.777778 113.777778h796.444444c62.577778 0 113.777778-51.2 113.777778-113.777778V472.177778l-486.4 147.911111z" fill="#4B9AFC"></path></svg>
              &nbsp;465162390@qq.com
          </li>
          <li>学历专业：&nbsp;专科&nbsp;&nbsp;软件技术</li>
          <li>毕业院校：&nbsp;广东科学技术职业学院</li>
          <li>技能：
            <ul>
              <li>HTML、CSS：能熟练开发页面 &nbsp;&nbsp;&nbsp; <el-rate :value="3" disabled class="star"></el-rate></li>
              <li>vue.js框架：熟练掌握使用  &nbsp;&nbsp;&nbsp; <el-rate :value="3" disabled class="star"></el-rate></li>
              <li>JQ、JavaScript：熟练掌握使用  &nbsp;&nbsp;&nbsp; <el-rate :value="3" disabled class="star"></el-rate></li>
              <!-- <li>node、nginx：掌握基本使用方法  &nbsp;&nbsp;&nbsp; <el-rate :value="2" disabled class="star"></el-rate></li> -->
              <li>PHP、MySql：掌握基本语法  &nbsp;&nbsp;&nbsp; <el-rate :value="2" disabled class="star"></el-rate></li>
            </ul>
          </li>
          <li>其它：
            <ul>
              <li>常用开发工具：VsCode、WebStorm、git</li>
              <li>掌握git的基本使用方法</li>
              <li>良好的代码习惯，注释规范</li>
            </ul>
          </li>
          <li>兴趣爱好：
            <ul>
              <li>偶尔打打游戏</li>
              <li>户外活动</li>
              <li>欢迎加好友一起探讨学习！</li>
            </ul>
          </li>
        </ul>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: 'About',
  data () {
    return {
    };
  },

  created() {},

  components: {},

  computed: {},

  methods: {}
}

</script>
<style src="./index.css" scoped></style>

<style>
.el-icon-star-on {
  font-size: 24px;
}
</style>