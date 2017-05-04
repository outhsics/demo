<?php
/*
 * @thinkphp3.2.3 
 * @wamp2.1a  php5.3.3  mysql5.5.8
 * @Created on 2015/10/12
 * @Author  fengxp
 *
 */
namespace Admin\Controller;
use Common\Controller\AuthController;
use Think\Model;
//权限控制类
class TempletController extends AuthController {
	
	//账号管理
	public function lists(){
		$admin_user = M('admin_audit');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $admin_user->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		//$list = $admin_user->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();
		$prex = C('DB_PREFIX');
		$Model = new Model();
		$sql = "select a.*,b.tel,c.real_name from ".$prex."admin_audit as a,".$prex."stu_user as b, ".$prex."stu_info as c where a.id=b.id and a.id=c.stu_id";
		$res = $Model->query($sql);
		
		//exit;
		$this->assign('lists',$res);
		$this->assign('pages',$pages);
		$this->display();
	}

	//模板发送选择人员
	public function send(){
		
		$this->display();
	}
	/*
	**
	*/
	public function adduser(){
		$admin_user = M('followusers','wx_');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $admin_user->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $admin_user->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();
		
		
		//exit;
		$this->assign('lists',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	/**
	 * 删除
	 */
	public function delete(){
		$id = $this->_get('id');
		$role = M('admin_audit');
		$res = $role->where('id='.$id)->delete();
		if($res){
			$this->success('成功删除',U('lists'));
		}else{
			$this->error('删除失败');
		}
	}

	/**
	 * 审核
	 */
	public function edit(){
		if(IS_POST){
			//表单提交
			$res = M('admin_audit');
			$data['audit'] = $this->_post('status');
			$data['audit_reason'] = $this->_post('reason');
			$data['id'] = $this->_post('id');
			$data['audit_time'] =time();
			if(empty($data['audit'])){
				$this->error('请选择审核操作');
			}
			elseif($data['audit'] ==2 && empty($data['reason'])){
				$this->error('请输入拒绝理由');
			}
			
			if($res->create($data)){
				if($res->save($data)>=0){
					$this->success('审核成功',U('lists'));
				}else{
					$this->error('审核失败');
				}
			}else{
				$this->error($res->getError());
			}
		}else{
			$id = $this->_get('id');
			$prex = C('DB_PREFIX');
			$Model = new Model();
			$sql = "select a.*,b.tel,c.real_name from ".$prex."admin_audit as a,".$prex."stu_user as b, ".$prex."stu_info as c where a.id=b.id and a.id=c.stu_id and a.id=$id";
			$res = $Model->query($sql);
			
			$this->assign('val',$res[0]);
			$this->display();
			}
	}
}