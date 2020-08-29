<!-- 分享 -->
<template>
  <div>
    <!-- <div style="margin-bottom: 10px;text-align: center">
      <el-button plain size="small" type="primary">QQ空间</el-button>
      <el-button plain size="small" type="primary">新浪微博</el-button>
    </div> -->
    <div>
      <span class="qrcode" ref="qrcode"></span>
      <p style="text-align: center">
        <span>可用微信扫一扫~</span><br>
        <span>可将二维码发给好友~</span>
      </p>
    </div>
  </div>
</template>

<script>
import QRCode from 'qrcodejs2'  

export default {
  name: 'QRCode',
  data() {
    return {};
  },

  props: {
    href: {
      type: String,
    },
  },

  created() {},

  mounted() {
    this.showQRCode();
  },

  methods: {
    showQRCode(){  
      this.$nextTick(() => {
        let qrcode = new QRCode(this.$refs.qrcode, {  
          text: this.href,  
          width: 100,  
          height: 100,  
          colorDark: '#000000',  
          colorLight: '#ffffff',  
          correctLevel: QRCode.CorrectLevel.H  
        });  
      })
    } 
  }

}
</script>

<style>
.qrcode img {
  margin: 0 auto;
}
</style>