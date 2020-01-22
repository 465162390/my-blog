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
    const articleViewer = new tui.Editor.factory({
      el: document.querySelector(`#articleView-${this.id}`),
      viewer: true,
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