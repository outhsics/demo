<?php

namespace Model;
use Think\Model;

//为sw_auth数据表创建一个Model模型类
//父类Model: ThinkPHP/Library/Think/Model.class.php
class AuthModel extends Model{
    //实现权限添加逻辑
    function saveData($data){
        //$data = array(4) {
        //    ["auth_name"] => string(12) "商品品牌"
        //    ["auth_pid"] => string(3) "100"
        //    ["auth_c"] => string(5) "Goods"
        //    ["auth_a"] => string(5) "brand"
        //  }
        //  当前方法的战略：根据已有信息生成一个新记录(字段内容不全面)
        //                  通过算法计算auth_path和auth_level
        //                  再通过一个update语句把path和level给更新到新记录里边
        //                  此时字段内容完整
        //1) 根据已有$data(name/pid/controller/action)数据生成一条新记录出来
        $newid = $this -> add($data);
        //2) 制作auth_path
        if($data['auth_pid']==0){
        //  ① 顶级权限 auth_path=====新记录主键id值
            $path = $newid;
        }else{
        //  ② 非顶级权限  根据pid获得父级权限信息，进而获得其“全路径”
        //     父级全路径-新记录主键id值
            $pinfo = $this -> find($data['auth_pid']);
            $path = $pinfo['auth_path']."-".$newid;
        }
        //3) 制作auth_level
        //   全路径里边"-"数量就是auth_level的值
        //   substr_count()计算一个字符串中出现的目标内容次数
        $level = substr_count($path,'-');
        
        $sql = "update sw_auth set auth_path='$path',auth_level='$level' where auth_id='$newid'";
        return $this -> execute($sql);
    }

}
