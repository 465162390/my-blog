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
    const commentViewer = new tui.Editor.factory({
      el: document.querySelector(`#commentView-${this.id}`),
      viewer: true,
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