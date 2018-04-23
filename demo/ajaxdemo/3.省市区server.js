const express = require('express');
const path = require('path');
const app = express();

//直接引入json文件
const data = require("./cityData.min.json");

app.get("/",(req,res) => {
    //获取省份，通过render方法渲染到页面中，在页面中使用ejs模板语法输出
    res.sendFile(path.join(__dirname,"4.省市区三级联动.html"));
})

//获取所有的省份
app.get("/province",(req,res) => {
    let provinces = [];
    data.forEach( (item) => {
        provinces.push(item.n);
    });
    //返回
    res.json(provinces);
});

//获取指定省份的所有市区
app.get("/city",(req,res) => {
    //获取省份
    let province = req.query.province;
    let citys = [];
    data.forEach( (item) => {
        if (item.n == province) {
            //找到对应的省份了，需要对该省份的s属性，进行遍历
            item.s.forEach((item1) => {
                citys.push(item1.n);
            });
        }
    });
    //返回
    res.json(citys);
});

//获取指定市区下的所有区县
app.get("/country",(req,res) => {
    //获取市区
    let city = req.query.city;
    let countries = [];
    data.forEach( (item) => {
        //item就是省份，需要对省份的市区，进行遍历，就是对item.s进行遍历
        item.s.forEach((item1) => {
            //item1就是二级市区，需要对item1.n判断，如果相等，就是我选中的市区
            if (item1.n == city) {
                //需要对item1.s进行遍历，获取所有区县，要注意直辖市是没有item1.s
                if (item1.s){
                    item1.s.forEach((item2) => {
                        countries.push(item2.n);
                    });
                }
            }
        });
    });
    //返回
    res.json(countries);
});

app.listen(5000, () => {
    console.log("5000 ok");
});
