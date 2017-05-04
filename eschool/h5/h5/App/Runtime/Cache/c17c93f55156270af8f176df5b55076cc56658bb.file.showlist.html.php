<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:30:44
         compiled from "./App/Admin/View\Adminlist\showlist.html" */ ?>
<?php /*%%SmartyHeaderCode:7094565efedc659f24-58759061%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c17c93f55156270af8f176df5b55076cc56658bb' => 
    array (
      0 => './App/Admin/View\\Adminlist\\showlist.html',
      1 => 1449066641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7094565efedc659f24-58759061',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565efedc75bc6',
  'variables' => 
  array (
    'info' => 0,
    'v' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565efedc75bc6')) {function content_565efedc75bc6($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\WWW\\h5\\Core\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>管理员列表</title>

        <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{ background-color: #9F88FF }
        </style>
        <div class="div_head">
            <span>
                <span style="float: left;">当前位置是：管理员管理-》管理员列表</span>
                <span style="float: right; margin-right: 8px; font-weight: bold;">
                    <a style="text-decoration: none;" href="<?php echo @__CONTROLLER__;?>
/tianjia" target='_self'>【添加管理员】</a>
                </span>
            
            </span>
        </div>
        <div></div>
      
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <!-- <td>管理员id</td> -->
                        <td>管理员名字</td>
       
                        <td>注册时间</td>
                        <td>角色id</td>
                        <td>操作</td>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['v']->iteration=0;
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
 $_smarty_tpl->tpl_vars['v']->iteration++;
?>
                    <tr id="product1">
                        <!-- <td><?php echo $_smarty_tpl->tpl_vars['v']->value['mg_id'];?>
</td> -->
                        <td><a href="#"><?php echo preg_replace('!^!m',str_repeat('--/',$_smarty_tpl->tpl_vars['v']->value['manager_level']),$_smarty_tpl->tpl_vars['v']->value['mg_name']);?>
</a></td>
              
                            <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['mg_time'],"%Y-%m-%d %T");?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['mg_role_id'];?>
</td>
                          <td><a href="#">修改</a></td>
                        <td><a href="#">删除</a></td>
                
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </body>
</html><?php }} ?>