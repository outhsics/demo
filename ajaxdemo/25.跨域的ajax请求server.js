const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.join(__dirname,"public")));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./26.跨域的ajax请求.html"));
});

app.listen(4000,() => {
    console.log("4000 ok");
})
