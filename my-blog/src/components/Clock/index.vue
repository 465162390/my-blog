<!-- 时钟插件 -->
<template>
  <div class="clock">
    <p class="date">{{date}}</p>
    <p class="time">{{time}}</p>
  </div>
</template>

<script>
export default {
  name: '',
  data () {
    return {
      date: "",
      time: "",
      week: ["星期日", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"]
    };
  },

  created() {
    this.updateTime();
  },

  components: {},

  computed: {},

  mounted() {
    this.timer = setInterval(()=> {
      this.updateTime();
    }, 1000)
  },

  methods: {
    updateTime() {
      let cd = new Date();
      this.time = this.zeroPadding(cd.getHours(), 2) + ':' + this.zeroPadding(cd.getMinutes(), 2) + ':' + this.zeroPadding(cd.getSeconds(), 2);
      this.date = this.zeroPadding(cd.getFullYear(), 4) + '-' + this.zeroPadding(cd.getMonth()+1, 2) + '-' + this.zeroPadding(cd.getDate(), 2) + ' ' + this.week[cd.getDay()];
    },

    // 格式化 日期/时间 显示
    zeroPadding(num, digit) {
      let zero = '';
      for(let i = 0; i < digit; i++) {
          zero += '0';
      }
      return (zero + num).slice(-digit);
    },
  },

  // vue实例销毁之前,清除定时器
  destroyed () {
    if (this.timer) { 
      clearInterval(this.timer)
    }
  }
}

</script>
<style scoped>
p {
  margin: 0;
  padding: 0;
}
.clock {
  margin: 25px 0 50px 0; 
  font-family: 'Share Tech Mono', monospace;
  font-weight: bold;
  color: rgba(0, 0, 0, 0.6);
  border: 2px dashed rgb(213, 213, 213);
  border-radius: 10px;
  text-align: center;
  width: 100%;
  -webkit-transition: all 0.2s linear;
  transition: all 0.2s linear;
}
.clock:hover {
  -webkit-transform: translate(0, -2px);
  transform: translate(0, -2px);
  -webkit-box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
  box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.1);
}
.time {
  letter-spacing: 0.05em;
  font-size: 50px;
  padding: 5px 0;
}
.date {
  padding: 10px 0;
  letter-spacing: 0.1em;
  font-size: 22px;
}
</style>