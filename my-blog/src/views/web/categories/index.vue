<!-- 分类 -->
<template>
  <div>
    <!-- 标签 -->
    <div class="box">
      <!-- 标题 -->
      <p class="tags-text">
        <svg t="1573195717285" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="9048" width="30" height="30">
          <path d="M788.48 629.418667c0-17.066667-5.802667-31.744-17.749333-44.714667L421.205333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744-21.162667-8.874667-39.936-12.970667-57.002667-12.970667L110.933333 191.146667c-17.066667 0-31.744 6.485333-44.032 18.773333-12.288 12.288-18.773333 26.965333-18.773333 44.032l0 202.752c0 17.066667 4.096 36.522667 12.970667 57.002667 8.874667 21.162667 18.773333 37.546667 31.744 49.834667l349.525333 349.525333c12.288 12.288 26.965333 17.749333 44.032 17.749333 17.066667 0 31.744-5.802667 44.714667-17.749333l239.616-239.616C781.994667 661.162667 788.48 646.485333 788.48 629.418667L788.48 629.418667 788.48 629.418667zM248.490667 392.192c-12.288 12.288-26.965333 18.090667-44.032 18.090667-17.066667 0-31.744-5.802667-44.032-18.090667-12.288-12.288-18.090667-26.965333-18.090667-44.032 0-17.066667 5.802667-31.744 18.090667-44.032 12.288-12.288 26.965333-18.090667 44.032-18.090667 17.066667 0 31.744 5.802667 44.032 18.090667C260.778667 316.416 266.24 331.093333 266.24 348.16 267.264 365.568 260.778667 379.904 248.490667 392.192L248.490667 392.192 248.490667 392.192zM958.122667 584.362667 608.597333 235.861333c-12.288-12.288-29.354667-22.869333-49.834667-31.744C537.6 195.242667 518.826667 191.146667 501.76 191.146667l-109.909333 0c17.066667 0 36.522667 4.096 57.002667 12.970667 21.162667 8.874667 37.546667 18.773333 49.834667 31.744l349.525333 348.501333c12.288 12.970667 18.090667 27.648 18.090667 44.714667s-5.802667 31.744-18.090667 44.032l-229.034667 229.717333c9.898667 9.898667 18.773333 17.066667 25.941333 21.845333 7.168 4.778667 17.066667 6.485333 28.672 6.485333 17.066667 0 31.744-5.802667 44.714667-18.090667l239.616-240.298667c12.288-12.288 17.749333-26.965333 17.749333-44.032S970.069333 597.674667 958.122667 584.362667L958.122667 584.362667 958.122667 584.362667zM958.122667 584.362667" p-id="9049" fill="#515151"></path>
        </svg>
        <span style="vertical-align: top;">标签</span>
      </p>
      <!-- 标签 -->
      <div class="tag-group">
        <router-link :to="'/tags/'+tag.name" v-for="tag in tags" :key="tag.id">
          <el-tag
            style="cursor: pointer;"
            :type="type[Math.floor(Math.random()*5 + 1)]"
            effect="light"
            :hit="true"
            size="medium">
              <el-badge :value="tag.num" class="item">
                {{tag.name}}
              </el-badge>
          </el-tag>
        </router-link>
      </div>
    </div>

    <!-- 分类 -->
    <div class="box">
      <!-- 标题 -->
      <p class="tags-text">
        <svg t="1573198765574" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="19075" width="30" height="30">
          <path d="M128 1024V96C128 42.98 170.98 0 224 0h576c53.02 0 96 42.98 96 96v928L512 800 128 1024z" fill="#515151" p-id="19076"></path>
        </svg>
        <span style="vertical-align: top;">分类</span>
      </p>
      <!-- 分类 -->
      <div class="tag-group">
        <router-link :to="'/categories/'+category.name" v-for="category in categories" :key="category.id">
          <el-tag
            style="cursor: pointer;"
            :type="type[Math.floor(Math.random()*5 + 1)]"
            effect="light"
            :hit="true"
            size="medium">
              <el-badge :value="category.num" class="item">
                {{category.name}}
              </el-badge>
          </el-tag>
        </router-link>
      </div>
    </div>
  </div>
</template>

<script>
import { fetchOther } from '@/api/article'

export default {
  name: 'Categories',
  data () {
    return {
      type: ["", "success", "info", "warning", "danger"],
      tags: [],
      categories: [],
    };
  },

  created() {
    this.fetch();
  },

  components: {},

  computed: {},

  methods: {
    // 请求数据
    fetch() {
      fetchOther().then( response => {
        this.tags = response.data.tags
        this.categories = response.data.categories
      })
    }
  }
}

</script>
<style scoped>
.box {
  background: aliceblue;
  width: 80%;
  margin: 40px auto;
  padding: 5px 30px 20px 30px;
  border-radius: 10px;
  box-shadow: 0 5px 6px rgba(0, 0, 0, 0.2)
}
.tags-text {
  color: #3c4858;
  font-size: 1.5rem;
  font-weight: 400;
  text-align: center;
}
.tag-group {
  width: 75%;
  margin: 0 auto;
  text-align: center;
}
.el-tag {
  margin: 12px;
}
.el-tag >>> .el-badge__content.is-fixed {
  top: -3px;
  right: 2px;
}
.el-badge {
  vertical-align: baseline;
}

@media (max-width: 450px) {
  .box {
    width: 60%;
    margin: 20px auto;
    padding: 5px 10px 10px 10px;
    box-shadow: none;
    -webkit-box-shadow: none;
    background: white;
  }
  .tags-text {
    font-size: 1.1rem;
  }
  .tags-text svg {
    width: 25px;
    height: 25px;
  }
  .el-tag {
    margin: 6px;
  }
}
</style>