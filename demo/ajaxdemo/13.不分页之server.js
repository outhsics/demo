const express = require('express');
const path = require('path');
const ejs = require('ejs');
const app = express();
//设置ejs
app.set('views', path.join(__dirname, './'));
app.set('view engine', 'ejs');
app.get('/',(req,res) => {
    //获取数据
    const blog = require("./blog.json");
    //ejs模板引擎渲染模板页面
    ejs.renderFile(path.join(__dirname,'./14.不分页.ejs'),{data:blog},(err,html) => {
        if (err) throw err;
        //html就是解析之后的结果
        res.send(html);
    });
});
app.listen(3000,() => {
    console.log("3000 ok");
});
