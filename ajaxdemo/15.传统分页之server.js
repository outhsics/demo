const express = require('express');
const path = require('path');
const ejs = require('ejs');
const app = express();
//设置ejs
app.set('views', path.join(__dirname, './'));
app.set('view engine', 'ejs');
app.get('/',(req,res) => {
    //获取数据
    const blogs = require("./blog.json");
    //设置pagesize
    const pagesize = 4; //每页显示4条
    //获取page值
    const page = req.query.page || 1; //当前的页数
    let start = (page - 1) * pagesize;
    let end = start + pagesize;
    //计算总的条数
    let total = blogs.length;
    //总共有多少页
    let pagenum = Math.ceil(total / pagesize);
    //获取当前页的数据
    let blog = blogs.slice(start,end);
    //ejs模板引擎渲染模板页面
    ejs.renderFile(path.join(__dirname,'./16.传统分页.ejs'),{
            data : blog, //当前页的内容
            total, //总的记录数
            page, //当前页
            pagenum, //总的页数
            pagesize //没有显示的条数
        },(err,html) => {
        if (err) throw err;
        //html就是解析之后的结果
        res.send(html);
    });
});
app.listen(3000,() => {
    console.log("3000 ok");
});
