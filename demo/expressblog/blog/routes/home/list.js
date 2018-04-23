var express = require('express');
var router = express.Router();
const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/blog4";

/* GET list page. */
router.get('/', function(req, res, next) {
    //获取cat参数
    let cat = req.query.cat;
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let post = db.collection('post');
        post.find({category : cat}).limit(5).toArray((err,article) => {
            if (err) throw err;
            res.render('home/list',{article});
        });
    });
});

module.exports = router;
