import Vue from 'vue'
import { titleFormat } from '@/utils/vaildata'

// 注册用于代码高亮的自定义指令
Vue.directive('highlight',function(el) {
  let blocks = el.querySelectorAll('pre code');
  blocks.forEach((block) => {
    hljs.highlightBlock(block)
  })
})

// 文章中所有 h 标签 都增加锚点
Vue.directive('directory', {
  // 2-被绑定的元素插入到DOM时
  inserted:function (el, binding, vnode) { 
    let directory = el.querySelectorAll('h1,h2,h3,h4,h5,h6');
    directory.forEach((value) => {
      value.id = "id" + titleFormat(value.innerText);
    })
  },
})

// 文章中所有的 img 标签，增加放大预览图片的css
Vue.directive('imgViewer', {
  inserted: function (el, binding, vnode) { 
    let image = el.querySelectorAll('img');
    image.forEach((value) => {
      value.onclick = function(event) {
        new Viewer(event.target, {
          inline: false,
          zoomRatio: 0.5,
          toolbar: {
            zoomIn: 10,
            zoomOut: 10,
            oneToOne: 4,
            reset: 4,
            prev: 4,
            next: 4,
            rotateLeft: 4,
            rotateRight: 4,
          },
        });
      }
    })
  }
})
