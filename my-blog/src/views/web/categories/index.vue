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
        <svg t="1575431720264" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="6624" width="27" height="27">
          <path d="M457.386667 152.462222V409.6c0 38.684444-29.582222 68.266667-65.991111 68.266667H147.911111c-36.408889 0-65.991111-29.582222-65.991111-68.266667V152.462222c0-38.684444 29.582222-68.266667 65.991111-68.266666h245.76c34.133333 0 63.715556 31.857778 63.715556 68.266666zM605.297778 477.866667h245.76c36.408889 0 65.991111-29.582222 65.991111-68.266667V152.462222c0-38.684444-29.582222-68.266667-65.991111-68.266666H605.297778c-36.408889 0-65.991111 29.582222-65.991111 68.266666V409.6c2.275556 36.408889 29.582222 68.266667 65.991111 68.266667z m-213.902222 68.266666H147.911111c-36.408889 0-65.991111 31.857778-65.991111 68.266667v254.862222c0 38.684444 29.582222 68.266667 65.991111 68.266667h245.76c36.408889 0 65.991111-29.582222 65.991111-68.266667V614.4c-2.275556-36.408889-31.857778-68.266667-68.266666-68.266667z m466.488888 0H614.4c-36.408889 0-65.991111 31.857778-65.991111 68.266667v254.862222c0 38.684444 29.582222 68.266667 65.991111 68.266667h245.76c36.408889 0 65.991111-29.582222 65.991111-68.266667V614.4c-2.275556-36.408889-31.857778-68.266667-68.266667-68.266667z" fill="#515151" p-id="6625"></path>
        </svg>
        <span style="vertical-align: 5px;">分类</span>
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

    <!-- 友情链接 -->
    <div class="box">
      <!-- 标题 -->
      <p class="tags-text">
        <svg t="1575432127050" class="icon" viewBox="0 0 1024 1024" version="1.1" xmlns="http://www.w3.org/2000/svg" p-id="7637" width="23" height="23">
          <path d="M893.134 893.317c-87.796 87.796-230.145 87.796-317.941 0l-95.381-95.381c-29.006-29.006-47.481-64.181-57.324-101.159 29.572-3.584 58.682-11.326 86.469-23.291 5.89 22.248 16.996 43.412 34.442 60.858l95.381 95.385c52.679 52.675 138.087 52.675 190.766 0 52.675-52.679 52.675-138.087 0-190.766l-95.385-95.381c-41.47-41.47-103.025-49.779-153.128-25.953l89.54 89.54c17.563 17.563 17.563 46.029 0 63.587-17.558 17.563-46.029 17.563-63.587 0L508.4 572.171c-87.288 57.828-206.031 48.318-282.941-28.588l-95.381-95.381c-87.796-87.796-87.796-230.145 0-317.941s230.145-87.796 317.941 0l95.381 95.381c29.006 29.006 47.486 64.181 57.324 101.159-29.572 3.584-58.682 11.326-86.469 23.291-5.89-22.248-16.996-43.412-34.442-60.858l-95.381-95.385c-52.679-52.675-138.087-52.675-190.766 0-52.675 52.679-52.675 138.087 0 190.766l95.381 95.381c41.474 41.47 103.029 49.779 153.132 25.953l-89.54-89.54c-17.563-17.558-17.563-46.029 0-63.587 17.558-17.563 46.025-17.563 63.587 0l98.587 98.587c87.287-57.827 206.036-48.318 282.941 28.588l95.381 95.381c87.794 87.794 87.794 230.144-0.001 317.939z" p-id="7638" fill="#515151"></path>
        </svg>
        <span style="vertical-align: 5px;">友情链接</span>
      </p>
      <!-- 链接 -->
      <div class="tag-group">
        <a :href="link.link" target="_blank" v-for="link in links" :key="link.id">
          <div class="friendly">
            <img :src="link.avatar_link">
            <h3 class="title">{{link.name}}</h3>
          </div>
        </a>
      </div>
    </div>

  </div>
</template>

<script>
import { fetchOther } from '@/api/article'
import { fetchLink } from '@/api/manage'

export default {
  name: 'Categories',
  data () {
    return {
      type: ["", "success", "info", "warning", "danger"],
      tags: [],
      categories: [],
      links: [],
    };
  },

  created() {
    this.fetch();
    this.fetchLinks();
  },

  components: {},

  computed: {},

  methods: {
    // 请求标签和分类
    fetch() {
      fetchOther().then( response => {
        this.tags = response.data.tags
        this.categories = response.data.categories
      })
    },

    // 请求友情链接
    fetchLinks() {
      let params = {
        name: "",
        page: 1,
        pagesize: 100,
      }
      fetchLink(params).then(response => {
        this.links = response.data
      })
    }
  }
}

</script>
<style src="./index.css" scoped></style>