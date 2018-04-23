const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.join(__dirname,"public")));


//对/blog请求的路由
app.get("/blog",(req,res) => {
    //获取查询字符串传递的callback
    let cb = req.query.callback;
    const blogs = require('./blog.json');
    // res.json(blogs);
    //返回一段js代码
    // res.send("alert(1)");
    res.send( cb+"(" + JSON.stringify( blogs) + ")" );
});

app.listen(4000,() => {
    console.log("4000 ok");
})
