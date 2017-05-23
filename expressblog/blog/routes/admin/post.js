var express = require('express');
var router = express.Router();

const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/blog4";
const fs = require('fs');
const path = require('path');
//引入multiparty对象
const multiparty = require('multiparty');

//显示文章列表
router.get('/', function(req, res, next) {
    //每一页显示的文章数
    const pagesize = 4;
    //获取当前页
    let current = req.query.page || 1;
    let offset = ( current - 1 ) * pagesize;
    //需要获取所有的文章
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let post = db.collection('post');
        //获取总的记录数
        post.find().limit(pagesize).skip(offset).toArray((err,result) => {
            if (err) throw err;
            post.find().count().then((sum) => {
                let total = Math.ceil(sum / pagesize);
                res.render('admin/article_list',{data : result, total,current});
            });

        });
    });
});
//显示添加文章表单
router.get("/add",function(req,res){
    //获取所有的分类数据
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let category = db.collection('category');
        category.find().toArray( (err,result) => {
            if (err) throw err;
            res.render('admin/article_add',{data : result});
        });
    });
});
//添加文章操作
router.post("/insert",function(req,res){
    //设置临时目录
    let tmp = path.join(__dirname,"../../public/tmp");
    //实例化一个form对象
    const form = new multiparty.Form({uploadDir: tmp});
    //调用form对象的parse方法来解析表单
    form.parse(req,(err,fields,files) => {
        console.log('---------------');
        console.log(fields);
        console.log(files);
        console.log('---------------');

        let category = fields.category[0];
        let subject = fields.subject[0];
        let summary = fields.summary[0];
        let content = fields.content[0];
        let time = new Date();
        //验证
        if (!subject.trim()) {
            res.render('admin/message',{msg : '标题不能为空'});
            return ;
        }
        //需要转移文件
        if (files.cover[0].size == 0) {
            //没有上传，保存数据到数据库
            MongoClient.connect(url,(err,db) => {
                if (err) throw err;
                let post = db.collection('post');
                post.insert({category,subject,summary,content,time},(err,result) => {
                    if (err) {
                        res.render('admin/message',{msg : '添加文章失败'});
                    } else {
                        res.render('admin/message',{msg : '添加文章成功'});
                    }
                });
            });
        } else {
            //有上传
            let oldPath = files.cover[0].path;
            let filename = files.cover[0].originalFilename;
            let newPath = path.join(__dirname,"../../public/uploads",filename);
            console.log(newPath);
            fs.rename(oldPath,newPath,(err) => {
                if (err) throw err;
                //说明上传成功，保存数据到数据库
                let cover = path.join('uploads',filename);
                MongoClient.connect(url,(err,db) => {
                    if (err) throw err;
                    let post = db.collection('post');
                    post.insert({category,subject,summary,content,cover,time},(err,result) => {
                        if (err) {
                            res.render('admin/message',{msg : '添加文章失败'});
                        } else {
                            res.render('admin/message',{msg : '添加文章成功'});
                        }
                    });
                });
            });
        }


    });
    //获取表单提交的数据
    /*
        console.log(req.body);
        let category = req.body.category;
        let subject = req.body.subject;
        let summary = req.body.summary;
        let content = req.body.content;
        let time = new Date();
        //验证
        if (!subject.trim()) {
            res.render('admin/message',{msg : '标题不能为空'});
            return ;
        }
        MongoClient.connect(url,(err,db) => {
            if (err) throw err;
            let post = db.collection('post');
            post.insert({category,subject,summary,content,time},(err,result) => {
                if (err) {
                    res.render('admin/message',{msg : '添加文章失败'});
                } else {
                    res.render('admin/message',{msg : '添加文章成功'});
                }
            });
        });
        //连接数据库，完成插入操作
        // res.send('添加文章ok');
    */
});
//显示编辑文章表单
router.get('/edit',function(req,res){
    res.render('admin/article_edit');
});
//更新文章操作
router.post('/update',function(req,res){
    res.send('更新文章ok');
});
//删除文章
router.get("/delete",function(req,res){
    res.send('删除文章ok');
});
module.exports = router;
