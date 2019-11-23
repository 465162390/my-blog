<!-- 文章内容组件 -->
<template>
  <div :id="'articleView'+this.id">
    <textarea style="display: none" name="editormd" v-model="article"></textarea>
  </div>
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

  created() {
    this.$nextTick(() => {
      let editorView = editormd.markdownToHTML("articleView"+this.id, {
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