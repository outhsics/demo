<?php
/*
 * @thinkphp3.2.3  auth认证
 * @wamp2.1a  php5.3.3  mysql5.5.8
 * @Created on 2015/10/12
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Think\Controller;

//不验证的控制器
class LoginController extends Controller {
   
    //ajxa检查验证码
    public function check_code(){
    	$code = $_GET['code'];	//验证码
    	$verify = new \Think\Verify();
    	if($verify->check($code)){
    		$this->ajaxReturn(1);	//成功
    	}else{
    		$this->ajaxReturn(0);	//失败
    	}
    }
    
    //登录验证
    public function index(){
    	if(!empty($_POST)){
    		$map['account'] = I('account');   //用户名
    		$map['password'] = md5(I('password'));	//密码
    		$m = M('admin_user');
    		$result = $m->field('id,account,login_count,status')->where($map)->find();
    		if($result){
    			if($result['status'] == 0){
    				$this->error('登录失败，账号被禁用',U('Login/index'));
    			}
    			session('aid',$result['id']);	//管理员ID
    			session('account',$result['account']);	//管理员密码  				
    			//保存登录信息
    			$data['id'] = $result['id'];	//用户ID
    			$data['login_ip'] = get_client_ip();	//最后登录IP
    			$data['login_time'] = time();		//最后登录时间
    			$data['login_count'] = $result['login_count'] + 1;
    			$m->save($data);    				
    			$this->success('验证成功，正在跳转到首页',U('Index/index'));			
    		}else{
    			$this->error('账户或密码错误',U('Login/index'));
    		}
    	}else{
    		if(session('aid')){
    			//$this->error('已登录，正在跳转到管理页',U('Index/index'));
				$this->redirect('Index/index','','0','跳转中...');
    		}
    		$this->display();
    	}
    }
    
    //验证码
    public function verify(){   	
    	ob_clean();		//清除缓存
    	$Verify = new \Think\Verify();
    	$Verify->fontSize = 30;	//验证码字体大小
    	$Verify->length = 4;	//验证码位数
    	$Verify->entry();
    }

}
