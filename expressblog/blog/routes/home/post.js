var express = require('express');
var router = express.Router();

const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/blog4";
const ObjectId = require('objectid');

const markdown = require('markdown').markdown;

/* GET home page. */
router.get('/', function(req, res, next) {
    //获取id
    let id = req.query.id;

    //连接数据库，完成查询
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let post = db.collection('post');
        //需要完成一个更新操作
        post.update({_id : ObjectId(id) },{$inc : {count : 1}},(err,result) => {
            if (err) throw err;
        });
        //查询操作
        post.findOne({_id : ObjectId(id)},(err,article) => {
            if (err) throw err;
            //这里的article就是博客的内容，包含content属性，保存的就是文章内容
            //将content中的内容，先转出html，再来render
            // article.content = markdown.toHTML(article.content);
            res.render('home/post',{article});
        });
    });
});



router.get('/md',(req,res) => {
    res.send(markdown.toHTML("![百度logo](https://www.baidu.com/img/bd_logo1.png)"));
});
module.exports = router;
