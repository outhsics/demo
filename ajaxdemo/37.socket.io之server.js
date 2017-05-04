const express = require('express');
const http = require('http');
const path = require('path');
const sio = require('socket.io'); //载入socket.io模块
const app = express();
//托管静态资源
app.use(express.static(path.join(__dirname,"public")));
//实现首页路由
app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,'./38.socket.io.html'));
});
//必须要使用server来启动http服务
const server = http.createServer(app); //这个server是http创建的，但是基于app的
//获取一个io对象，将sio应用到server上
const io = sio.listen(server);
//需要使用io对象，去建立一个socket的连接
io.on('connection',(socket) => {
    //其中socket对象就是发送请求和响应请求的对象
    console.log("a user coming...");
    //注册publish事件
    socket.on('publish',function(data){
        console.log("来自客户端的请求：" + data);
        //向客户端发射事件
        socket.broadcast.emit('reply','辛苦了');
    });
});
server.listen(4000,() => {
    console.log("http server is listening in port 4000...");
})
