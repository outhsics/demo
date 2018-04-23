var express = require('express');
var router = express.Router();

//显示分类列表
router.get('/', function(req, res, next) {
  res.render('admin/category_list');
});
//显示添加分类表单
router.get("/add",function(req,res){
    res.render('admin/category_add');
});
//添加分类操作
router.post("/insert",function(req,res){
    res.send('添加分类ok');
});
//显示编辑分类表单
router.get('/edit',function(req,res){
    res.render('admin/category_edit');
});
//更新分类操作
router.post('/update',function(req,res){
    res.send('更新分类ok');
});
//删除分类
router.get("/delete",function(req,res){
    res.send('删除分类ok');
});
module.exports = router;
