const express = require('express');
const http = require('http');
const path = require('path');
const sio = require('socket.io');

const app = express();
app.use(express.static(path.join(__dirname,"public")));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./40.联网拖拽.html"));
});

const server = http.createServer(app);
const io = sio.listen(server);
io.on("connection",(socket) => {
        console.log("a user connected...");
        //需要响应move事件
        socket.on('move',(data) => {
            console.log(data);
            //向其他所有用户广播事件
            socket.broadcast.emit('drag',data);
        });
});

server.listen(3000,() => {
    console.log("3000 ok");
})
