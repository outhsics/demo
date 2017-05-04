<?php
//命名空间
namespace Admin\Controller;
//use Think\Controller;
use Tools\AdminController;

class UserinfoController extends AdminController{
   
       function xiugai($user_id){
        $user = D('Userinfo');
        //两个逻辑：展示、收集
        if(!empty($_POST)){
            $z = $user -> save($_POST);
            if($z){
                //$this ->redirect([分组/控制器/操作方法]地址, 参数, 延迟时间, 提示信息);
                $this ->redirect('showlist', array('user_id'=>$user_id), 3, '修改信息成功');
            }else {
                $this ->redirect('xiugai', array('user_id'=>$user_id), 3, '修改信息失败');
            }
        }else{
            //根据$user_id获得被修改的信息信息，并给模板展示
            //find()方法只负责给返回一条记录结果，并且是[一维]数组返回
            $info = $user -> find($user_id);

            $this -> assign('info',$info);
            $this -> display();
        }
    }
    function showlist(){
        //实现数据分页效果
        $userinfo = M('Userinfo');
        //① 获得总记录数目
        $total = $userinfo-> count();  //sum()  max()  min()
        $per = 7;//每页显示7条数据
        
        //② 实例化分页类对象
        $page_obj = new \Tools\Page($total, $per);
        
        //③ 自定义sql语句，获得每页信息
        $sql = "select * from sw_userinfo order by user_id  ".$page_obj->limit;
        $info = $userinfo -> query($sql);
        
        //④ 获得页码列表
        $pagelist = $page_obj -> fpage(array(3,4,5,6,7,8));
        
        $this -> assign('pagelist',$pagelist);
        $this -> assign('info',$info);
        $this -> display();
    }
    function tianjia(){

        $userinfo = D('userinfo');
        //两个逻辑：展示表单、收集表单
        if(!empty($_POST)){
         
            
            //收集表单
            $shuju = $userinfo -> create();
            $z = $userinfo -> add($shuju);
            if($z){
                //$this ->redirect([分组/控制器/操作方法]地址, 参数, 延迟时间, 提示信息);
                $this ->redirect('showlist', array(), 2, '添加信息成功');
            }else {
                $this ->redirect('tianjia', array(),3, '添加信息失败');
            }
        }else{
            //展示表单
            $this -> display();
        }
    }

      public function out(){    
        //读取库里所有的表            
        $sql="show tables";   

  $link=mysql_connect('127.0.0.1','root','root') or die("Unable to connect to the MySQL!");
  
  //选择一个需要操作的数据库
  mysql_select_db('sw_userinfo',$link);
 
  //执行MySQL语句
 $result=mysql_query("SELECT * FROM sw_userinfo");
  
//提取数据

 $row=mysql_fetch_row($result); 

   // dump($row);   //$sql="select * form es_record ";   
     //   $result=M('record')->query($sql);  
       // foreach ($row as $k=>$v) {             
            //$k++;                     
        //  $_sql="SHOW FULL COLUMNS FROM ".$v['tables_in_'.C('DB_NAME')]; 
        //     $_sql="SELECT stu_id,party,party_time,family_conditions,poverty,poverty_time, study_status,
        // partjob_begin,partjob_end,partjob_name,scholarship_name,scholarship_time,honor_name,honor_time,english_grade,english_grade_time,home_addr,home_postcode,home_tel,report_addr,report_postcode,report_people,single_parent,home_contact,home_contact_tel,studycard    FROM es_record";       
           $_sql="SELECT user_real_name,user_tel,user_scheme_name,user_remark,user_create_time FROM sw_userinfo"; 

          
            //$data[][0]=array("表 {$k}.".$v['tables_in_'.C('DB_NAME')]."表",'','','','','','');
            // $data[][0]=array("id","党员关系","入党时间","家庭条件","贫困补助","贫困补助时间","学习成绩","兼职实习开始时间","兼职实习结束时间","兼职实习名称","奖助学名称","获奖助学时间","荣誉名称","获荣誉时间","英语等级","英语等级认证时间","家庭住址","家庭邮编","家庭电话","成绩单邮寄地址","成绩单邮寄地址邮编","成绩单接收人","是否单亲家庭","家庭联系人","家庭联系人手机号","学号");
    $data[][0]=array("用户姓名","电话","案名","备注","创建时间");
            $data[]=M('Userinfo')->query($_sql);  

            $data[][]=array();                      
      //  }          
        //导入PHPExcel类库         
        import("Common.Org.PHPExcel");        
        import("Common.Org.PHPExcel.Writer.Excel5");         
        import("Common.Org.PHPExcel.IOFactory.php");         
                
        // Import('Extra.Excel.PHPExcel',APP_PATH);  
        //  Import('Extra.Excel.PHPExcel.Writer.Excel5',APP_PATH);    
        // Import('Extra.Excel.PHPExcel.IOFactory.php',APP_PATH);        
        $filename="用户信息";              
        $this->getExcel($filename,$data);    
    } 
    private function getExcel($fileName,$data){             
    //对数据进行检验            
        if(empty($data)||!is_array($data)){                 
            die("data must be a array");             
        }             
        $date=date("Y_m_d",time()); 
        $fileName.="_{$date}.xls";              
        //创建PHPExcel对象，注意，不能少了\             
        $objPHPExcel=new \PHPExcel();             
        $objProps=$objPHPExcel->getProperties();  

        $column=2;             
        $objActSheet=$objPHPExcel->getActiveSheet();   
        $objPHPExcel->getActiveSheet()->getStyle()->getFont()->setName('微软雅黑');//设置字体
        $objPHPExcel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(25);//设置默认高度

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth('15');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth('22');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth('22');//设置列宽
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth('40');//设置列宽

        //设置边框
        $sharedStyle1=new \PHPExcel_Style();
        $sharedStyle1->applyFromArray(array('borders'=>array('allborders'=>array('style'=>\PHPExcel_Style_Border::BORDER_THIN))));
        
        foreach ($data as $ke=>$row){      

            foreach($row as $key=>$rows){

                if(count($row)==1&&empty($row[0][1])&&empty($rows[1])&&!empty($rows)){

                    $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A{$column}:J{$column}");//设置边框
                    array_unshift($rows,$rows['0']);
                    $objPHPExcel->getActiveSheet()->mergeCells("A{$column}:J{$column}");//合并单元格
                    $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getFont()->setSize(12);//字体
                    $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getFont()->setBold(true);//粗体

                    //背景色填充
                    $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getFill()->getStartColor()->setARGB('FFB8CCE4');

                }else{
                    if(!empty($rows)){
                        array_unshift($rows,$key+1);
                        $objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1,"A{$column}:J{$column}");//设置边框
                    } 
                }

                if($rows['1']=='字段'){
                    // $rows[0]='ID';
                    //背景色填充
                    $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                    $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getFill()->getStartColor()->setARGB('FF4F81BD');
                }

                $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getAlignment()->setVertical(\PHPExcel_Style_Alignment::VERTICAL_CENTER);//垂直居中
                $objPHPExcel->getActiveSheet()->getStyle("A{$column}:J{$column}")->getAlignment()->setWrapText(true);//换行
                //行写入                     
                $span = ord("A");                       
                foreach($rows as $keyName=>$value){                 
                    // 列写入                       
                    $j=chr($span);                         
                    $objActSheet->setCellValue($j.$column, $value);                        
                    $span++;                     
                }                     
                $column++;                 
            }             
        } 
        $fileName = iconv("utf-8", "gb2312", $fileName);             
        //设置活动单指数到第一个表,所以Excel打开这是第一个表             
        $objPHPExcel->setActiveSheetIndex(0);             
        header('Content-Type: application/vnd.ms-excel');             
        header("Content-Disposition: attachment;filename=\"$fileName\"");             
        header('Cache-Control: max-age=0');                
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');             
        $objWriter->save('php://output'); //文件通过浏览器下载             
        exit;     
    }

}
