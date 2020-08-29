<!-- Card组件 -->
<template>
  <div>
    <el-card style="width: 100%">
      <div slot="header">
        <span>{{name}}数据</span>
      </div>

      <div style="text-align: center">
        <div v-for="card in cards" :key="card.name" class="card">
          <el-card>
            <div slot="header">
              <span>{{card.name}}</span>
            </div>
            <div>
              <span class="number">{{card.num}}</span>
            </div>
          </el-card>
        </div>
      </div>

    </el-card>
  </div>
</template>

<script>
export default {
  name: 'Card',
  data() {
    return {};
  },

  props: {
    name: {
      type: String,
    },
    cards: {
      type: Array,
    },
  },

  computed: {},

  created() {},

  mounted() {},

  methods: {}

}
</script>

<style scoped>
.card {
  width: 240px;
  display: inline-block;
  margin: 0 15px;
}
.number {
  font-size: 2rem;
  font-weight: bold;
  color: rgb(37, 129, 209);
}
@media (max-width: 420px) {
  .card {
    width: 100%;
    margin: 0;
  }
}
</style>