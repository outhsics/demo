const express = require('express');
const path = require('path');

const app = express();

app.get("/", (req,res) => {
    res.sendFile(path.join(__dirname,"5.blog.html"))
});

//处理/blog的请求
app.get("/blog",(req,res) => {
    //获取blog数据
    let blog = require('./blog.json');
    res.json(blog);
});

app.listen(3000,() => {
    console.log('3000 ok');
});
