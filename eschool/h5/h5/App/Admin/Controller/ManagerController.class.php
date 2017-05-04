<?php
//命名空间
namespace Admin\Controller;
//use Think\Controller;
use Tools\AdminController;
//use Think\Verify;  //① 空间类元素引入
class ManagerController extends AdminController{
    //管理员登录系统
    // function login(){
        //两个逻辑：展示、收集
//         if(!empty($_POST)){
//             $vry = new \Think\Verify();
//             if($vry -> check($_POST['captcha'])){
//                 //用户名和密码校验
//                 $manager = new \Model\ManagerModel();  
//                 //在ManagerModel里边丰富一个checkNamePwd方法,用户校验用户名和密码
//                 //校验成功后把当前管理员的一条记录信息都返回，
//                 //校验失败返回null
//                 $info = $manager-> checkNamePwd($_POST['admin_user'],$_POST['admin_psd']);
//                 if($info){
//                     //session持久化用户信息(id/name)，页面跳转到后台
//                     session('admin_id',$info['mg_id']);
//                     session('admin_name',$info['mg_name']);
//                     $this -> redirect('Index/index');
//                 }else{
//                         $a="用户名或密码错误";
//                         $this->assign('a',$a);
//             }else{
//                     $b="验证码错误";
//                         $this->assign('a',$a);
//         }
//         $this -> display();
//     }
// }
    

function login(){
        //两个逻辑：展示、收集
        if(!empty($_POST)){
            $vry = new \Think\Verify();
            if($vry -> check($_POST['captcha'])){
                //用户名和密码校验
                $manager = new \Model\ManagerModel();  
                //在ManagerModel里边丰富一个checkNamePwd方法,用户校验用户名和密码
                //校验成功后把当前管理员的一条记录信息都返回，
                //校验失败返回null
                $info = $manager-> checkNamePwd($_POST['admin_user'],md5($_POST['admin_psd']));
                if($info){
                    //session持久化用户信息(id/name)，页面跳转到后台
                    session('admin_id',$info['mg_id']);
                    session('admin_name',$info['mg_name']);
                    $this -> redirect('Index/index');
                }else
                $a="用户名或密码错误";
                $this->assign('a',$a);
            }else
                $b="验证码错误";
            $this->assign('b',$b);
        }
        $this -> display();
    }

    //退出系统
    function logout(){
        //清除session,同时跳转到登录页面
        session(null);
        $this -> redirect('login');
    }
    
    //输出验证码
    function verifyImg(){
        //给验证做配置
        $cfg = array(
            'imageH'    =>  45,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'fontSize'  =>  15,              // 验证码字体大小(px)
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  '4.ttf',              // 验证码字体，不设置随机获取
        );
        //实例化Verify类
        $very = new \Think\Verify($cfg);//② 完全限定名称 方式
        $very -> entry(); //输出验证码
    }
    //输出验证码
    function verifyZHImg(){
        //给验证做配置
        $cfg = array(
            'imageH'    =>  45,               // 验证码图片高度
            'imageW'    =>  100,               // 验证码图片宽度
            'fontSize'  =>  15,              // 验证码字体大小(px)
            'length'    =>  4,               // 验证码位数
            'fontttf'   =>  'simsun.ttc',              // 验证码字体，不设置随机获取
            'useZh'     =>  true,           // 使用中文验证码 
        );
        //实例化Verify类
        $very = new \Think\Verify($cfg);//② 完全限定名称 方式
        $very -> entry(); //输出验证码
    }
}
