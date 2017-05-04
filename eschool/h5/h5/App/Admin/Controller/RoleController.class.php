<?php
//命名空间
namespace Admin\Controller;
//use Think\Controller;
use Tools\AdminController;

//角色控制器
class RoleController extends AdminController{
    //列表展示
    function showlist(){
        //获得角色数据
        $info = D('Role')->select();
        
        $this -> assign('info',$info);
        $this -> display();
    }
    
    //分配权限
    function distribute($role_id){
        $role = new \Model\RoleModel();
        //两个逻辑：展示、收集
        if(!empty($_POST)){
            //dump($_POST);//role_id  auth_id(array)
            //收集好设置的权限，并"制作"为数据表要求格式 并"存储"
            $z = $role->saveAuth($_POST['role_id'],$_POST['auth_id']); 
            if($z){
                $this -> redirect('showlist',array(),2,'分配权限成功！');
            }else{
                $this -> redirect('distribute',array('role_id'=>$role_id),2,'分配权限失败！');
            }
        }else{
            //查询被分配权限的角色信息
            $role_info = $role->find($role_id);

            //查询当前角色已经拥有的权限
            $have_authids = $role_info['role_auth_ids'];//例如 ： 101,103,104,107,109
            $have_authids = explode(',',$have_authids);//字符串 --》数组，使得判断更严谨

            
            //获得可供选取分配的权限信息
            $auth_infoA = D('Auth')->where('auth_level=0')->select();//父级
            $auth_infoB = D('Auth')->where('auth_level=1')->select();//子级

            $this -> assign('have_authids',$have_authids);
            $this -> assign('auth_infoA',$auth_infoA);
            $this -> assign('auth_infoB',$auth_infoB);
            $this -> assign('role_info',$role_info);
            $this -> display();
        }
    }
}
