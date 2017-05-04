<?php
//命名空间
namespace Admin\Controller;
//use Think\Controller;
use Tools\AdminController;

//管理员控制器
class AdminlistController extends AdminController{

    //列表展示
    function showlist(){
        //获得全部管理员信息并给模板展示
        //按照"auth_path"排序获得数据，以便信息按照“上下级”关系输出
        $info = D('manager')->order('mg_id')->select();
        
        $this -> assign('info',$info);
        $this -> display();
    }
    
    //管理员添加
    function tianjia(){

        if(!empty($_POST)){
    $data['mg_name']=I('mg_name');
    $data['mg_pwd']=md5(I('mg_pwd'));
    $data['mg_role_id']=I('mg_role_id');
    $data['mg_time']=time();
$manager=M('manager')->add($data);


        if($manager){
            //dump($_POST);//只有4个信息(name,pid,controller,action)
            // $z = $auth -> saveData($_POST);//通过算法制作auth_path和auth_level，并实现整条记录的填充'
            // if($z){
                $this -> redirect('showlist',array(),2,'添加管理员成功!');
            }else {
                $this -> redirect('tianjia',array(),2,'添加管理员失败!');
            }
        
           } //获得上级(顶级)管理员信息
            // $auth_infoA = $auth->where('auth_level=0')->select();
            
            // $this -> assign('auth_infoA',$auth_infoA);
            $this -> display();
        
    
}
}
