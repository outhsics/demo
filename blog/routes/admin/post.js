var express = require('express');
var router = express.Router();

//显示文章列表
router.get('/', function(req, res, next) {
  res.render('admin/article_list');
});
//显示添加文章表单
router.get("/add",function(req,res){
    res.render('admin/article_add');
});
//添加文章操作
router.post("/insert",function(req,res){
    res.send('添加文章ok');
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
