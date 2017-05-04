const express = require('express');
const path = require('path');

const app = express();
app.use(express.static(path.join(__dirname,"public")));

app.get("/",(req,res) => {
    res.sendFile(path.join(__dirname,"./34.jsonp原理.html"));
});

app.listen(3000,() => {
    console.log("3000 ok");
})
