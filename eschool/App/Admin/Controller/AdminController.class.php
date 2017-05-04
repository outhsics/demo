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
class AdminController extends AuthController {
	
	//账号管理
	public function account(){
		$admin_user = M('admin_user');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $admin_user->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $admin_user->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();

		$this->assign('list',$list);
		$this->assign('pages',$pages);
		$this->display();
	}
	
	/**
	 * 新增账号
	 */
	public function acc_add(){

		if(IS_POST){
			//表单提交
			$admin_user = D('admin_user');
			$admin_group = M('admin_group_access');
			if(	$admin_user->create()){
				if($id=$admin_user->add()){
					$admin_group->add(array('uid'=>$id,'group_id'=>I('role_id')));
					$this->success('新增成功',U('account'));
					//$this->redirect('account','' ,0,'新增成功');
				}else{
					$this->error('新增失败');
				}
			}else{
				$this->error($admin_user->getError().' [ <a href="javascript:history.back()">返 回</a> ]');
			}
		}else{
			$admin_user = M('admin_user');
			$role = M('admin_group');
			
			$role_list = $role->field('id,title')->order('id desc')->select();

			$this->assign('role_list',$role_list);

			$this->display();
		}
	}
	/**
	 * 新增账号
	 */
	public function acc_edit(){
		
		if(IS_POST){
			//表单提交
			$admin_user = D('admin_user');
			$admin_group = M('admin_group_access');
			$id=$this->_post('id');
			$data['group_id']=$this->_post('role_id');
			if(	$admin_user->create()){
				if($admin_user->save() >=0){
					$admin_group->where("uid=$id")->save($data);
					$this->success('修改成功',U('account'));
					
				}else{
					$this->error('新增失败');
				}
			}else{
				$this->error($admin_user->getError().' [ <a href="javascript:history.back()">返 回</a> ]');
			}
		}else{
			$prex = C('DB_PREFIX');
			$role = M('admin_group');
			$id = $this->_get('id');
			$Model = new Model();
			$sql = "select a.*,b.group_id from ".$prex."admin_user as a,".$prex."admin_group_access as b where a.id=$id and b.uid=$id";
			$res = $Model->query($sql);
			$role_list = $role->field('id,title')->order('id desc')->select();
			$this->assign('role_list',$role_list);
			$this->assign('val',$res[0]);
			$this->display();
		}
	}
	/**
	 * 删除账号
	 */
	public function acc_delete(){
		$id = $this->_get('id');
		$prex = C('DB_PREFIX');
		$Model = new Model();
		$sql = "delete a,b from ".$prex."admin_user as a,".$prex."admin_group_access as b where a.id=$id and b.uid=$id";
		//echo $sql;
		$res = $Model->execute($sql);
		if($res){
			//$this->success('成功删除'.$res.'条信息');
			$this->success('成功删除',U('account'));
		}else{
			$this->error('删除失败');
		}
	}

	//权限管理
	public function group(){
		$admin_user = M('admin_group');
		$id = isset($_GET['id'])?$_GET['id']:0;
		
		$count = $admin_user->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $admin_user->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();

		$this->assign('list',$list);
		$this->assign('pages',$pages);
		$this->display();
	}


	/**
	 * 新增权限组
	 */
	public function group_add(){
		if(IS_POST){
			//表单提交
			$role = M('admin_group');
			$data['rules'] = implode(',', $_POST['group']);
			$data['title'] = $this->_post('role_name');
			
			if(empty($data['rules'])){
				$this->error('请选择角色权限');
			}
			if(empty($data['title'])){
				$this->error('请填写名称');
			}
			
			if($role->create($data)){
				if($role->add($data)){
					$this->success('新增成功',U('group'));
				}else{
					$this->error('新增失败');	
				}
			}else{
				$this->error($role->getError());
			}
			
		}else{
			$admin_action = D('admin_rule');
			$list = $admin_action->getTree();
			$this->assign('list',$list);
			$this->display();
		}
	}

	/**
	 * 编辑权限组
	 */
	public function group_edit(){
		if(IS_POST){
			//表单提交
			$role = M('admin_group');
			$data['rules'] = implode(',', $_POST['group']);
			$data['title'] = $this->_post('role_name');
			$data['id'] = $this->_post('role_id');
			if(empty($data['rules'])){
				$this->error('请选择角色权限');
			}
			if(empty($data['title'])){
				$this->error('请填写名称');
			}
			if($role->create($data)){
				if($role->save($data)>=0){
					$this->success('更新成功',U('group'));
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error($role->getError());
			}
		}else{
			$role = M('admin_group');
			$admin_action = D('admin_rule');
			$list = $admin_action->getTree();
			$id = $this->_get('id');
			$res = $role->where('id='.$id)->find();
			$this->assign('list',$list);
			$this->assign('val',$res);
			$this->display();
		}
	}
	/**
	 * 删除权限组
	 */
	public function group_delete(){
		$id = $this->_get('id');
		$role = M('admin_group');
		$res = $role->where('id='.$id)->delete();
		if($res){
			$this->success('成功删除',U('group'));
		}else{
			$this->error('删除失败');
		}
	}
	//节点管理页

	public function node(){
		$admin_rule = M('admin_rule');
		$id = isset($_GET['id'])?$_GET['id']:0;
		$this->assign("id", $id);
		if($id){
			$this->assign('child_close','1');
		}else{
			$this->assign('child_close','0');
		}
		$count = $admin_rule->where('pid=' . $id)->count();
		$cur_page = isset($_GET['page'])?$_GET['page']:1;
		
		$Page = new \Think\Page($count,C('DEFAULT_NUMS')); //实例化page对象
		$pages = $Page->show();
		
		$list = $admin_rule->where('pid=' . $id)->order('id desc')->page($cur_page.','.C('DEFAULT_NUMS'))->select();

		$this->assign('list',$list);
		$this->assign('pages',$pages);
		$this->display();
	}

	/**
	 * 编辑节点信息
	 */
	public function node_edit(){
		if(IS_POST){
			//表单提交
			$admin_action = D('admin_rule');
			if($admin_action->create()){
				if($admin_action->save()>=0){
					$this->success('更新成功',U('node'));
				}else{
					$this->error('更新失败');
				}
			}else{
				$this->error($admin_action->getError());
			}
		}else{
			$admin_action = M('admin_rule');
			$id = $_GET['id'];
			$list = $admin_action->field('id,title')->where('pid=0')->select();
			$res = $admin_action->where('id='.$id)->find();
			$this->assign('list',$list);
			$this->assign('val',$res);
			$this->display();
		}
	}

	/**
	 * 新增节点
	 */
	public function node_add(){
		if(IS_POST){
			//表单提交
			$admin_action = D('admin_rule');
			if($admin_action->create()){
				if($admin_action->add()){
					$this->success('新增成功',U('node'));
				}else{
					//echo $admin_action->getLastSql();
					$this->error('新增失败');
				}
			}else{
				$this->error($admin_action->getError());
			}
		}else{
            $pid = isset($_GET['pid'])?$_GET['pid']:0;
            $this->assign("pid", $pid);
			$admin_action = M('admin_rule');
			$list = $admin_action->field('id,title')->where('pid=0')->select();
			$this->assign('list',$list);
			$this->display();
		}
	}
	/**
	 * 删除节点
	 */
	public function node_delete(){
		$id = $this->_get('id');
		$admin_action = M('admin_rule');

		$count = $admin_action->where('pid='.$id)->count();
		if($count)$this->error('请先删除子数据。');

		$res = $admin_action->where('id='.$id)->delete();
		if($res){
			$this->success('成功删除',U('node'));
		}else{
			$this->error('删除失败');
		}
	}
	
}