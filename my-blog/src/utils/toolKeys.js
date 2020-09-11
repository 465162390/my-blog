// 和风天气的key和username
const weather = {
  key: "xxx",
  username: "xxx",
}

// 微博App的key、Secret、回调地址，请求地址
const weibo = {
  key: "xxx",
  secret: "xxx",
  redirect_uri: "https://www.ngkakui.cn/loginCallBack/weibo",
  request_uri: "https://api.weibo.com/oauth2/authorize?client_id=167444771&response_type=code&redirect_uri=https://www.ngkakui.cn/loginCallBack/weibo",
}

// QQ的App的key、ID、回调地址，请求地址
const qq = {
  id: "xxx",
  key: "xxx",
  redirect_uri: "https://www.ngkakui.cn/loginCallBack/qq",
  request_uri: "https://graph.qq.com/oauth2.0/authorize?response_type=token&client_id=101876230&redirect_uri=https://www.ngkakui.cn/loginCallBack/qq&scope=get_user_info",
}

const github = {
  id: "xxx",
  secret: "xxx",
  redirect_uri: "https://www.ngkakui.cn/loginCallBack/github",
  request_uri: "https://github.com/login/oauth/authorize?client_id=5a16d2b557c027310af2&scope=user",
}

export { 
  weather,
  weibo,
  qq,
  github,
}