<!-- 评论/留言markdown语法显示组件 -->
<template>
  <div :id="'commentView-'+this.id"></div>
</template>

<script>
export default {
  name: "CommentView",
  data() {
    return {};
  },

  props: {
    // 文章内容
    message: {
      type: String
    },
    id: {
      type: String
    }
  },

  created() {},

  mounted() {
    // this.Viewer(markdown编辑器,main.js全局引入)
    const commentViewer = new this.Viewer({
      el: document.querySelector(`#commentView-${this.id}`),
      initialValue: this.message,
    });
  },

  components: {},

  computed: {},

  methods: {}
};
</script>
<style scoped>
</style>