const express = require('express');
const path = require('path');
const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/test";

const app = express();

app.use(express.static(path.join(__dirname,"public")));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./11.仿google suggest页面.html"));
});

//处理/suggest请求
app.get('/suggest',(req,res) => {
    let keyword = req.query.keyword.trim();
    if (keyword) {
        MongoClient.connect(url,(err,db) => {
            if (err) throw err;
            let search = db.collection('search');
            //定义一个正则
            let reg = new RegExp('^' + keyword,"i");
            search.find({keyword : reg},{_id:0}).toArray( (err,result) => {
                if (err) throw err;
                res.json(result);
            });
        });
    } else {
        res.json([]);
    }

});

app.listen(3000,() => {
    console.log("3000 ok");
});
