var express = require('express');
var router = express.Router();
const MongoClient = require('mongodb').MongoClient;
const url = "mongodb://localhost:27017/blog4";

//显示登录页面
router.get('/login', function(req, res, next) {
    if (req.session.isLogin) {
        //已经登录了
        res.redirect('/admin');
    } else {
        res.render('admin/login');
    }
});

//登录操作
router.post('/signin',(req,res) => {
    //获取用户名和密码
    let username = req.body.username;
    let password = req.body.password;
    //验证
    if (username.trim() == '' || password.trim() == '') {
        res.redirect('/user/login');
        return;
    }
    //连接数据库，验证用户名和密码是否正确
    MongoClient.connect(url,(err,db) => {
        if (err) throw err;
        let user = db.collection('user');
        user.findOne({username,password},(err,result) => {
            if (result) {
                //说明用户名和密码正确
                //设置登录成功标志 isLogin
                req.session.isLogin = true;
                //需要跳转到后台首页
                res.redirect('/admin');
            } else {
                //用户名和密码错误
                res.redirect('/user/login');
            }
        });
    });
});

//注销操作
router.get('/logout',(req,res) => {
    //销毁session
    req.session.destroy();
    //然后跳转
    res.redirect('/admin');
})

module.exports = router;
