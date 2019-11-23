<!-- 主要内容 -->
<template>
  <div>
    <router-view :key="Math.random()"/>
  </div>
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