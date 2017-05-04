import  Vue from "vue";
export  default{
    state:{
        CurrentUser:{
            get UserName()
            {
                let getUName=localStorage.getItem("CurrentUser_Name");
                if(getUName==null || getUName==undefined)
                    return "guest";
                return getUName;
            },
            get UserToken()
            {
                let getToken=localStorage.getItem("CurrentUser_Token")
                if(getToken==null || getToken==undefined)
                    return "";
                return localStorage.getItem("CurrentUser_Token");
            }
        }

    },
    mutations:{
        setUser(state,{user_name,user_token,success})
        {
            localStorage.setItem("CurrentUser_Name",user_name);
            localStorage.setItem("CurrentUser_Token",user_token);
            success();//执行回调
        }
    }
    ,
    actions:{
        userLogin(context,{user_name,user_pass,success})
        {
            Vue.http.get("http://localhost:9090/web/token?client_appid="+user_name
                +"&client_appkey="+user_pass).then((rs)=>{
                if(rs!=null && rs.body!=undefined && "access_token" in rs.body)
                {
                    if(rs.body.access_token!="")
                    {
                            //代表后端API验证通过
                        context.commit("setUser",{user_name,"user_token":rs.body.access_token,success});

                    }
                    else
                    {
                        alert("用户名密码错误");
                    }
                }
                else
                {
                    alert("用户名密码错误");
                }
            },(rs)=>{})
        },
        userUnlog(context,callback)
        {
            var getToken=context.state.CurrentUser.UserToken;
            if(getToken!="")
            {
                Vue.http.get("http://localhost:9090/web/user/unlog?access-token="+getToken)
                    .then(function(r){
                        if(r.body.status=="success"){
                            localStorage.removeItem("CurrentUser_Name")
                            localStorage.removeItem("CurrentUser_Token");
                            callback();
                        }
                    },function(r){

                    })
            }

        }
    }
}