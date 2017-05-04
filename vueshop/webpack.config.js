var HtmlWebpackPlugin = require('html-webpack-plugin');
var webpack=require("webpack");
module.exports =
{
    entry:
    {
       "member-index":[__dirname+'/src/jtthink/member-index.js'
           ,'webpack-dev-server/client?http://127.0.0.1:8080'],
       "web-index":[__dirname+'/src/jtthink/web-index.js'],
        "users-index":[__dirname+'/src/jtthink/users-index.js'
            ,'webpack-dev-server/client?http://127.0.0.1:8080'],  //用户登录或注册脚本
      },
    output: {
        publicPath: "http://127.0.0.1:8080/",
        path: __dirname+'/src/webapp/js',  //输出文件夹
        filename:'[name].js'   //最终打包生成的文件名(just 文件名，不带路径的哦)
    },
   resolve: {
        alias: {
            vue: 'vue/dist/vue.js'
        }
    },
    externals: {

    },
    module:{
        loaders:[
            {test:/\.js$/,loader:"babel",query:{compact:true},exclude: /node_modules/},
            {test:/\.vue$/,loader:"babel-loader!vue-loader"},
            {test:/\.(eot|woff|woff2|svg|ttf)([\?]?.*)$/,loader:"file" },
            {test:/\.json$/,loader:"json-loader" },
            {
                test: /\.css$/,
                loader: 'style-loader!css-loader'
            },
            {
                test: /\.(png|jpe?g|gif|svg)(\?\S*)?$/,
                loader: 'file-loader',
                query: {
                    name: '[name].[ext]?[hash]'
                }
            }
        ]
    },
    vue: {
        loaders: {
            scss: 'style-loader!css-loader!sass-loader'
        }
    },
    plugins:[
        new HtmlWebpackPlugin({
          //  filename: __dirname+'/src/webapp/member/index.html',//目标文件
            filename:"/member/index.html",//用户后台首页
            template: __dirname+'/src/pages/member/index.html',//模板文件
            inject:'body',
            hash:true,
            chunks:["member-index"]
        }),
        new HtmlWebpackPlugin({
            filename:"index.html",//全站首页
            template: __dirname+'/src/pages/web/index.html',//模板文件
            inject:'body',
            hash:true,
            chunks:["web-index"]
        }),
        new HtmlWebpackPlugin({
            filename:"/users/index.html",//用户登录或注册
            template: __dirname+'/src/pages/users/index.html',//模板文件
            inject:'body',
            hash:true,
            chunks:["users-index"]
        }),
    ]

}
