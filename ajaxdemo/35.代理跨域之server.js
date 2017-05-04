const express = require('express');
const path = require('path');
const http = require('http');

const app = express();
app.use(express.static(path.join(__dirname,"public")));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./36.代理跨域.html"));
});

//针对proxy的请求
app.get("/proxy",(req,res) => {
    //获取目标url
    let url = req.query.url;
    //需要向目标url发起get请求，将数据请求回来
    http.get(url,(response) => {
        let str = "";
        response.on('data',(chunk) => {
            str += chunk;
        });
        response.on('end',() => {
            //所有的数据，都已经接受完毕
            res.json(str);
        });
    });
});

app.listen(3000,() => {
    console.log("3000 ok");
})
