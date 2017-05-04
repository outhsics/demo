const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');

const app = express();
const users = ['admin','test','root'];

//使用static托管静态资源
app.use(express.static(path.join(__dirname,"public")));

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./7.$.get和$.post实现用户名检测.html"));
});

//处理/check的get请求
app.get("/check",(req,res) => {
    //获取传递的用户名
    let username = req.query.username;
    let index = users.findIndex( n => n == username );
    if (index === -1) {
        //不存在，ok
        // res.send('恭喜您，该用户名可用');
        res.json({code : 1, msg : '恭喜您，该用户名可用'});
    } else {
        //存在，不能使用
        // res.send('对不起，该用户名已被占用');
        res.json({code : 0, msg : '对不起，该用户名已被占用'});
    }
});

//处理check的post请求
app.post('/check',(req,res) => {
    //获取用户传递的用户名
    let username = req.body.username;
    let index = users.findIndex( n => n === username);
    if (index === -1) {
        //没有找到，可用
        res.send('恭喜您，该用户名可用');
        // res.json({code : 1, msg : '恭喜您，该用户名可用'});
    } else {
        //不可用
        res.send('对不起，该用户名已被占用');
        // res.json({code : 0, msg : '对不起，该用户名已被占用'})
    }
});

app.listen(4000,() => {
    console.log("4000 ok");
});
