var express = require('express');
var router = express.Router();

//引入mongodb
const MongoClient = require("mongodb").MongoClient;
const url = "mongodb://localhost:27017/blog4";

//引入OjbectId对象
const ObjectId =  require('objectid');
//显示分类列表
router.get('/', function(req, res, next) {
    //连接数据库，获取所有的分类
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let category = db.collection('category');
        category.find().toArray((err,result) => {
            if (err) {
                res.render("admin/message",{msg : err});
            } else {
                res.render('admin/category_list',{data : result});
            }
        });
    });
});
//显示添加分类表单
router.get("/add",function(req,res){
    res.render('admin/category_add');
});
//添加分类操作
router.post("/insert",function(req,res){
    //获取表单添加的数据
    let title = req.body.title;
    let sort = req.body.sort;
    //对数据进行验证，确保数据的完整性和有效性
    if (!title.trim()) {
        res.render('admin/message',{msg : '分类名称不能为空'});
        return;
    }
    //连接数据库，完成插入操作,同时给出提示信息
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        //获取集合
        let category = db.collection('category');
        category.insert({title,sort},(err,result) => {
            if (err) {
                // res.send('添加分类失败');
                res.render('admin/message',{msg : '添加分类失败'});
            } else {
                // res.send('添加分类成功');
                res.render('admin/message',{msg : '添加分类成功'});
            }
        });
    });
    // res.send('添加分类ok');
});
//显示编辑分类表单
router.get('/edit',function(req,res){
    //获取id
    let id = req.query.id;
    console.log(id);
    console.log(typeof id);
    console.log(ObjectId(id));
    //根据id来获取对应的分类信息，是查询操作
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let category = db.collection('category');
        category.findOne({_id : ObjectId(id)},(err, result) => {
            if (err) {
                res.render('admin/message',{msg : '获取分类出错'});
            } else {
                console.log(result);
                res.render('admin/category_edit',{data : result});
            }
        });
    });
});
//更新分类操作
router.post('/update',function(req,res){
    //获取用户提交的数据
    let title = req.body.title;
    let sort = req.body.sort;
    let id = req.body.id;
    // console.log(typeof sort);
    //验证
    if (!title.trim()) {
        res.render('admin/message',{msg : '分类名称不能为空'});
        return;
    }
    if (!sort.trim()) {
        res.render('admin/message',{msg : '排序依据不能为空'});
        return;
    }
    //验证必须是数字
    if (!(sort.trim() == Number(sort.trim()))) {
        res.render('admin/message',{msg : '排序依据必须是数字'});
        return;
    }
    //连接数据库，完成更新操作，并提示
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let category = db.collection('category');
        category.update({_id : ObjectId(id)},{title,sort},(err,result) => {
            if (err) {
                res.render('admin/message',{msg : '更新分类失败'});
            } else {
                res.render('admin/message',{msg : '更新分类成功'});
            }
        });
    });
    // res.send('更新分类ok');
});
//删除分类
router.get("/delete",function(req,res){
    //获取id
    let id = req.query.id;
    //删除对应分类
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let category = db.collection('category');
        category.remove({_id : ObjectId(id)},(err,result) => {
            if (err) {
                res.render('admin/message',{msg : '删除分类失败'});
            } else {
                res.render('admin/message',{msg : '删除分类成功'});
            }
        });
    });
    // res.send('删除分类ok');
});
module.exports = router;
