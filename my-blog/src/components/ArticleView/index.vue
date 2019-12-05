<!-- 文章内容组件 -->
<template>
  <div :id="'articleView-'+this.id"></div>
</template>

<script>
export default {
  name: "ArticleView",
  data() {
    return {};
  },

  props: {
    // 文章内容
    article: {
      type: String
    },
    id: {
      type: String
    }
  },

  created() {},

  mounted() {
    // this.Viewer (markdown编辑器,在main.js全局引入)
    const articleViewer = new this.Viewer({
      el: document.querySelector(`#articleView-${this.id}`),
      initialValue: this.article,
    });
  },

  components: {},

  computed: {},

  methods: {}
};
</script>

<style scoped>
</style>