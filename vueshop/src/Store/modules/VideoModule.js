
import  Vue from "vue";
import axios from "axios";
export  default{
    state:{
        video_list:[]
    },
    mutations: {
      setVideoList(state,params)
      {
          state.video_list=params;//设置视频列表
      }
    },
    actions:{
        loadVideos(context,params) //加载视频列表
        {
            if(context.rootState.users.CurrentUser.UserName=="guest")
            {
                Vue.prototype.functions.needLogin()
            }
            else
            {
                axios.get("http://localhost:9090/web/video/load-video?access-token="
                    +context.rootState.users.CurrentUser.UserToken)
                    .then(function(r){
                        context.commit("setVideoList", r.data);
                    })
            }

        },
        submitVideo(context,params)
        {
            //params 就是publish组件中的 video对象
           Vue.http.post("http://localhost:9090/web/video/submitvideo",
               params).then(function(res){
               if(res.body.status=="success")
               {
                   alert("上传成功，未来我们需要跳转到列表页中");
               }

            },function(res){
               alert(res.body.message)
           })
        }

    }
}