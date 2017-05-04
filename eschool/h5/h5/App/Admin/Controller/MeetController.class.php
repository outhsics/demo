<?php
//命名空间
namespace Admin\Controller;
//use Think\Controller;
use Tools\AdminController;

class MeetController extends AdminController{
   
    
    function showlist(){
        //实现数据分页效果
        $goods = M('Meet');
        //① 获得总记录数目
        $total = $goods-> count();  //sum()  max()  min()
        $per = 7;//每页显示7条数据
        
        //② 实例化分页类对象
        $page_obj = new \Tools\Page($total, $per);
        
        //③ 自定义sql语句，获得每页信息
        $sql = "select * from sw_meet order by meet_id  ".$page_obj->limit;
        $info = $goods -> query($sql);
        
        //④ 获得页码列表
        $pagelist = $page_obj -> fpage(array(3,4,5,6,7,8));
        
        $this -> assign('pagelist',$pagelist);
        $this -> assign('info',$info);
        $this -> display();
    }
    
}
