<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:29:36
         compiled from "./App/Admin/View\Role\distribute.html" */ ?>
<?php /*%%SmartyHeaderCode:7297565f005097f428-07749319%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dde457b0451b95f8320e9a39772384cb52343291' => 
    array (
      0 => './App/Admin/View\\Role\\distribute.html',
      1 => 1449039435,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7297565f005097f428-07749319',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'role_info' => 0,
    'auth_infoA' => 0,
    'v' => 0,
    'have_authids' => 0,
    'auth_infoB' => 0,
    'vv' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565f0050a88e6',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565f0050a88e6')) {function content_565f0050a88e6($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>分配权限</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：角色管理-》分配权限【<?php echo $_smarty_tpl->tpl_vars['role_info']->value['role_name'];?>
】</span>
                <span style="float:right;margin-right: 8px;font-weight: bold">
                    <a style="text-decoration: none" href="<?php echo @__CONTROLLER__;?>
/showlist">【返回】</a>
                </span>
            </span>
        </div>
        <div></div>

        <div style="font-size: 13px;margin: 10px 5px">
            <form action="<?php echo @__SELF__;?>
" method="post" enctype="multipart/form-data">
<style type="text/css">
td { border:1px solid gray; }
</style>
<input type="hidden" name="role_id" value="<?php echo $_smarty_tpl->tpl_vars['role_info']->value['role_id'];?>
" />
<table width="100%" class="table_a">
    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['auth_infoA']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
    <tr>
        <td width="18%">
            <input type="checkbox" name="auth_id[]" value="<?php echo $_smarty_tpl->tpl_vars['v']->value['auth_id'];?>
" 
                   <?php if (in_array($_smarty_tpl->tpl_vars['v']->value['auth_id'],$_smarty_tpl->tpl_vars['have_authids']->value)){?>checked='checked'<?php }?>
                   /><?php echo $_smarty_tpl->tpl_vars['v']->value['auth_name'];?>
</td>
        <td>
            <?php  $_smarty_tpl->tpl_vars['vv'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['vv']->_loop = false;
 $_smarty_tpl->tpl_vars['kk'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['auth_infoB']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['vv']->key => $_smarty_tpl->tpl_vars['vv']->value){
$_smarty_tpl->tpl_vars['vv']->_loop = true;
 $_smarty_tpl->tpl_vars['kk']->value = $_smarty_tpl->tpl_vars['vv']->key;
?>
            <?php if ($_smarty_tpl->tpl_vars['vv']->value['auth_pid']===$_smarty_tpl->tpl_vars['v']->value['auth_id']){?>
            <div style="width:200px;float:left;">
                <input type="checkbox" name="auth_id[]" value="<?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_id'];?>
" 
                       <?php if (in_array($_smarty_tpl->tpl_vars['vv']->value['auth_id'],$_smarty_tpl->tpl_vars['have_authids']->value)){?>checked='checked'<?php }?>
                       /><?php echo $_smarty_tpl->tpl_vars['vv']->value['auth_name'];?>
</div>
            <?php }?>
            <?php } ?>
        </td>
    </tr>
    <?php } ?>
</table>
                <input type="submit" value="分配权限" />
            </form>
        </div>
    </body>
</html><?php }} ?>