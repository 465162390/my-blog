<!-- 主要内容 -->
<template>
  <section>
    <router-view :key="Math.random()"/>
  </section>
</template>

<script>
export default {
  name: 'AppMain',
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
<style scoped>
</style>