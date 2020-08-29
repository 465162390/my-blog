// 和风天气的key和username
const weather = {
  key: "7dab4c170a674f07bbb2605dfd4c8aaa",
  username: "HE1910111558331584",
}

// 微博App的key、Secret、回调地址，请求地址
const weibo = {
  key: "167444771",
  secret: "a1921ee14cabf9a75ca34e645757ad43",
  redirect_uri: "https://www.ngkakui.cn/loginCallBack/weibo",
  request_uri: "https://api.weibo.com/oauth2/authorize?client_id=167444771&response_type=code&redirect_uri=https://www.ngkakui.cn/loginCallBack/weibo",
}

// QQ的App的key、ID、回调地址，请求地址
const qq = {
  id: "101876230",
  key: "37e0de0eb1f3906b88020b2b0b037313",
  redirect_uri: "https://www.ngkakui.cn/loginCallBack/qq",
  request_uri: "https://graph.qq.com/oauth2.0/authorize?response_type=token&client_id=101876230&redirect_uri=https://www.ngkakui.cn/loginCallBack/qq&scope=get_user_info",
}

const github = {
  id: "5a16d2b557c027310af2",
  secret: "c2f685091d181e715769b2d3f5ea34857a23e651",
  redirect_uri: "https://www.ngkakui.cn/loginCallBack/github",
  request_uri: "https://github.com/login/oauth/authorize?client_id=5a16d2b557c027310af2&scope=user",
}

export { 
  weather,
  weibo,
  qq,
  github,
}