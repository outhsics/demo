var express = require('express');
var path = require('path');
var favicon = require('serve-favicon');
var logger = require('morgan');
var cookieParser = require('cookie-parser');
var bodyParser = require('body-parser');
var session = require('express-session');

// var users = require('./routes/users');

var app = express();

app.use(session({
    secret: 'blog',
    resave: false,
    saveUninitialized: true,
    cookie: { }
}));
// view engine setup
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'ejs');

// uncomment after placing your favicon in /public
//app.use(favicon(path.join(__dirname, 'public', 'favicon.ico')));
app.use(logger('dev'));
app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
app.use(cookieParser());
app.use(express.static(path.join(__dirname, 'public')));

//判断用户是否已经登录
app.use("/admin",(req,res,next) => {
    if (req.session.isLogin) {
        //已经登录
        next();
    } else {
        //没有登录
        res.redirect('/user/login');
    }
});

//针对/user的路由
var user = require('./routes/admin/user');
app.use("/user",user);


var index = require('./routes/home/index');
app.use('/', index);
// app.use('/users', users);

//针对/list的路由
var list = require('./routes/home/list');
app.use('/list',list);
//针对/post的路由
var post = require('./routes/home/post');
app.use("/post",post);

//针对 /admin的路由
var admin = require('./routes/admin/index');
app.use("/admin",admin);

//针对 /admin/cats的路由
var cats = require('./routes/admin/cats');
app.use("/admin/cats",cats);

//针对 /admin/post的路由
var post = require('./routes/admin/post');
app.use("/admin/post",post);


// catch 404 and forward to error handler
app.use(function(req, res, next) {
  var err = new Error('Not Found');
  err.status = 404;
  next(err);
});

// error handler
app.use(function(err, req, res, next) {
  // set locals, only providing error in development
  res.locals.message = err.message;
  res.locals.error = req.app.get('env') === 'development' ? err : {};

  // render the error page
  res.status(err.status || 500);
  res.render('error');
});

module.exports = app;
