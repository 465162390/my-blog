<!-- 评论/留言markdown语法显示组件 -->
<template>
  <div :id="'commentView'+this.id">
    <textarea style="display: none" name="ceditormd" v-model="message"></textarea>
  </div>
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

  created() {
    this.$nextTick(() => {
      let commentView = editormd.markdownToHTML("commentView"+this.id, {
        htmlDecode: "style,script,iframe",
        emoji: true,
        taskList: true,
        tex: true, // 默认不解析
        flowChart: true, // 默认不解析
        sequenceDiagram: true // 默认不解析
      });
    });
  },

  mounted() {},

  components: {},

  computed: {},

  methods: {}
};
</script>
<style scoped>
</style>