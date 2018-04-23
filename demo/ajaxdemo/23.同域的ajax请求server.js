const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.join(__dirname,"public")));

//针对所有的请求，都调用这个回调
app.use("*",(req,res,next) => {
    res.setHeader('Access-Control-Allow-Origin', "*"); //针对哪个域名可以访问，*表示所有
    res.setHeader('Access-Control-Allow-Credentials', true); //是否可以携带cookie
    res.setHeader('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');
    next();
});

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./24.同域的ajax请求.html"));
});

//blog路由
app.get('/blog',(req,res) => {
    //设置允许ajax跨域请求
    // res.setHeader('Access-Control-Allow-Origin', "*"); //针对哪个域名可以访问，*表示所有
    // res.setHeader('Access-Control-Allow-Credentials', true); //是否可以携带cookie
    // res.setHeader('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, OPTIONS');
    let blogs = require('./blog.json');
    res.json(blogs);
});

app.listen(3000,() => {
    console.log("3000 ok");
})
