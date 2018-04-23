const express = require('express');
const path = require('path');

const app = express();

//对/blog请求的路由
app.get("/blog",(req,res) => {
    // let cb = req.query.callback; //获取回调函数的名称
    const blogs = require('./blog.json');
    // res.json(blogs);
    //返回函数调用语句的字符串,不是在服务端执行，返回到浏览器端，然后在浏览器端执行
    // res.send( cb + "(" + JSON.stringify(blogs) + ")" );
    res.jsonp(blogs);
});

app.listen(4000,() => {
    console.log("4000 ok");
})
