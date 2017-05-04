const express = require('express');
const path = require('path');
const bodyParser = require('body-parser');

const users = ['admin','root','test'];
const app = express();

app.use(express.static(path.join(__dirname,'public')));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({extended: false}));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./9.使用$.ajax方法实现用户名检测.html"));
});


app.get('/check',(req,res) => {
    let username = req.query.username;
    let index = users.findIndex(n => n === username);
    if (index === -1) {
        //没有，ok
        res.json({code : 1, msg : "恭喜您，可用"});
    } else {
        res.json({code : 0, msg : "对不起，不可用"});
    }
});

app.listen(5000,() => {
    console.log("5000 ok");
});
