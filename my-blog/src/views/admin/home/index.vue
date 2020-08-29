<!-- 数据展示页 -->
<template>
  <div>
    <!-- 今日新增数据 -->
    <div>
      <card name="今日新增" :cards="daily" />
    </div>

    <!-- 总数据 -->
    <div style="margin-top: 20px">
      <card name="总" :cards="total" />
    </div>

  </div>
</template>

<script>
import { Loading } from 'element-ui'
import { fetchData } from '@/api/blogData'
import Card from './components/Card'

export default {
  name: "Home",
  data() {
    return {
      loading: Loading.service({}),
      daily: [],
      total: [],
    };
  },

  created() {
    this.loading.close()
    this.blogData();
  },

  mounted() {},

  components: {
    Card,
  },

  computed: {},

  methods: {
    blogData() {
      fetchData().then(( { daily, total } )=> {
        this.daily = daily;
        this.total = total;
      })
    },
  }

};
</script>

<style src="./index.css" scoped></style>