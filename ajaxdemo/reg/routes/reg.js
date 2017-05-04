var express = require('express');
var router = express.Router();

/* 处理注册. */

const users = ['admin','root','test'];

//对表单提交的post处理
router.post('/', function(req, res, next) {

    for(let i = 0; i < 10000000; i++);
  // res.render('index', { title: 'Express' });
  // res.render('reg');
  //获取表单提交的数据
  let username = req.body.username;
  let password = req.body.password;
  //需要连接数据库，判断username是否已经存在了
  //模拟数据库中的数据
  let index = users.findIndex(n => n==username);
  if (index === -1) {
      //说明没有找到，不存在
      //完成注册功能
    //    res.send('<em>恭喜您，该用户可用使用----' + username+"</em>");
    res.json({code : 1, msg : "恭喜您，该用户可用使用"});
  } else {
      //说明找到了，已存在
    //    res.send('<em>对不起，该用户名已占用，请重新输入用户名---' + username+"</em>");
    res.json({code : 0, msg : "对不起，该用户名已占用"});
  }
});

//针对ajax的get请求处理
router.get('/', function(req, res, next) {
  //获取表单提交的数据
  let username = req.query.username;
  //需要连接数据库，判断username是否已经存在了
  //模拟数据库中的数据
  let index = users.findIndex(n => n==username);
  if (index === -1) {
      //说明没有找到，不存在
      //完成注册功能
       res.send('恭喜您，该用户可用使用---'+username);
  } else {
      //说明找到了，已存在
       res.send('对不起，该用户名已占用，请重新输入用户名---'+username);
  }
});

module.exports = router;
