var express = require('express');
var myweb = express();
myweb.use(express.static("m"));

myweb.set("views", "./views")
myweb.set("view engine", "ejs")


myweb.get("/:controller(\\w{2,5})/:action(\\w{2,5})", function (request, response) {
    // console.log(request.params.id);
    var require_path="./controller/"+request.params.controller+"Controller.js";
    var get_c=require(require_path);
    var c = new get_c.Controller(response);
    eval("c."+request.params.action+"();");
})

myweb.listen(9090)