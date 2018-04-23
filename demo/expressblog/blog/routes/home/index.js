var express = require('express');
var router = express.Router();

const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/blog4";

/* GET home page. */
router.get('/', function(req, res, next) {
    //获取所有分类
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let category = db.collection('category');
        let post = db.collection('post');
        category.find().toArray((err,cats) => {
            if (err) throw err;
            //获取最新的文章
            post.find().limit(8).sort({time : -1}).toArray((err,posts) => {
                if (err) throw err;
                res.render('home/index', { cats,posts });
            });
        });
    });
});

module.exports = router;
