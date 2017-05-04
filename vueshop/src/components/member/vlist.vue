<template>

    <div class="video">



        <sweet-modal modal-theme="dark" overlay-theme="dark" ref="abc">
             <h3>这里回播放视频</h3>
            <video-player  ref="videoPlayer"
                           :options="playerOptions"
                           title="you can listen some event if you need"
                           >
            </video-player>

        </sweet-modal>
        <el-row class="vlist"  v-for="video in this.$store.state.video.video_list">
            <el-col :span="4">
                <img :src="video.img_url" class="vlist-vimg"/>
            </el-col>
            <el-col :span="20">
                <el-row>
                    <el-col :span="24">
                        <a  @click="playVideo" :video-src="video.v_file" class="vlist-link">{{video.v_title}}</a>
                        <span class="vlist-time">{{video.v_addtime}}</span>
                    </el-col>
                </el-row>
                <el-row  class="item">
                    <el-col :span="24"  >
                        <span class="vlist-intr">{{video.v_intr}}</span>
                    </el-col>
                </el-row>
                <el-row class="item">
                    <el-col :span="24"  >
                        <i class="el-icon-edit">编辑</i>
                        <i class="el-icon-share">分享</i>
                        <i class="el-icon-delete">删除</i>
                    </el-col>
                </el-row>

            </el-col>
    </el-row>


    </div>
</template>
<style>
    .vlist{margin-top: 30px;padding:10px;background: #eff2f7;border-radius: 5px}
    .vlist:first-child{margin-top: 0px} /* 设置第一行不要有上边距 */
    .vlist .item{line-height:28pt}
    .vlist .item i{margin-left:10px;cursor: pointer;background: #37c8f7 ;border-radius: 8px;padding:8px;color:#fff}
     .vlist-vimg{width:90%;border-radius: 5px;margin-top: 5px}
     .vlist-link{color:#000;text-decoration: none;cursor: pointer}
      .vlist-time{color:gray;margin-left:2em}
    .vlist-intr{color:gray;margin-left:2em}
</style>
<script>
    import { SweetModal, SweetModalTab } from 'sweet-modal-vue'
    import { videoPlayer } from 'vue-video-player'
    export default{
        created(){
          //加载视频列表
            this.$store.dispatch("loadVideos");
        },
        data(){
            return {
                playerOptions: {

                    // component options
                    start: 0,
                    playsinline: false,
                    // videojs options
                    muted: true,
                    language: 'en',
                    playbackRates: [0.7, 1.0, 1.5, 2.0],
                    sources: [{
                        type: "video/mp4",
                        src: ""
                    }]

                }

            }

        },
        methods:{
            playVideo(e){
                let getSrc= e.target.getAttribute("video-src")
                this.playerOptions.sources[0].src="http://ojtrrp22t.bkt.clouddn.com/"+getSrc;
                this.$refs.abc.open()
            }
        },

        components:{
            SweetModal,
            SweetModalTab,
            videoPlayer
        }
    }
</script>
