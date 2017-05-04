const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.join(__dirname,"public")));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./28.ajax跨域获取电影数据.html"));
});

app.listen(5000,() => {
    console.log("5000 ok");
})
