<!-- 主要内容 -->
<template>
  <section>
    <router-view :key="Math.random()"/>
    <div class="footer">
      <p>Copyright © {{date}} [NGKAKUI] All Rights Reserved.</p>
      <p>粤ICP备19145554号-1</p>
    </div>
  </section>
</template>

<script>
export default {
  name: 'AppMain',
  data () {
    return {
      date: this.moment().format("YYYY"),
      show: true,
    };
  },

  created() {},

  components: {},

  computed: {},

  methods: {}
}

</script>
<style scoped>
.footer {
  clear: both;
  text-align: center;
  margin-top: 15px;
  width: 100%;
  height: 50px;
  color: #b2bac2;
  font-size: 13px;
}
.footer p {
  margin: 5px;
}

@media(max-width: 450px) {
  .footer { 
    font-size: 12px;
  }
}
</style>