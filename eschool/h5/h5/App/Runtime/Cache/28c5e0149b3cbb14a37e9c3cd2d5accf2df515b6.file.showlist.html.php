<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:23:21
         compiled from "./App/Admin/View\Meet\showlist.html" */ ?>
<?php /*%%SmartyHeaderCode:1144565efed9220502-75794394%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '28c5e0149b3cbb14a37e9c3cd2d5accf2df515b6' => 
    array (
      0 => './App/Admin/View\\Meet\\showlist.html',
      1 => 1449045961,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1144565efed9220502-75794394',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
    'v' => 0,
    'pagelist' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565efed931a53',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565efed931a53')) {function content_565efed931a53($_smarty_tpl) {?><?php if (!is_callable('smarty_modifier_date_format')) include 'D:\\WWW\\h5\\Core\\Library\\Vendor\\Smarty\\plugins\\modifier.date_format.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

        <title>会员列表</title>

        <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet" />
    </head>
    <body>
        <style>
            .tr_color{ background-color: #9F88FF }
        </style>
        <div class="div_head">
            <span>
              
                  <!--   <a style="text-decoration: none;" href="<?php echo @__CONTROLLER__;?>
/tianjia" target='_self'>【添加】</a> -->

          <!--           <a style="text-decoration: none;" href="<?php echo @__CONTROLLER__;?>
/out" target='_self'>【导出信息】</a> -->
                </span>
            </span>
        </div>
        <div></div>
       
    
        <div style="font-size: 13px; margin: 10px 5px;">
            <table class="table_a" border="1" width="100%">
                <tbody><tr style="font-weight: bold;">
                        <td>序号</td>
                        <td>会议名字</td>
                        <td>内容</td>
                        <td>创建时间</td>                  
                        <!-- <td>创建时间</td> -->
                        <td align="center">操作</td>
                    </tr>
                    <?php  $_smarty_tpl->tpl_vars['v'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['v']->_loop = false;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['info']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
foreach ($_from as $_smarty_tpl->tpl_vars['v']->key => $_smarty_tpl->tpl_vars['v']->value){
$_smarty_tpl->tpl_vars['v']->_loop = true;
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['v']->key;
?>
                    <tr id="product1">
                    <td><?php echo $_smarty_tpl->tpl_vars['v']->value['meet_id'];?>
</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['v']->value['title'];?>
</td>
                        <td><a href="#"><?php echo $_smarty_tpl->tpl_vars['v']->value['content'];?>
</a></td>
                        <td><?php echo smarty_modifier_date_format($_smarty_tpl->tpl_vars['v']->value['time'],"%Y-%m-%d %T");?>
</td>
                        <td><a href="<?php echo @__CONTROLLER__;?>
/xiugai/goods_id/<?php echo $_smarty_tpl->tpl_vars['v']->value['goods_id'];?>
">修改</a></td>
                        <!-- <td><a href="javascript:;" onclick="delete_product(1)">删除</a></td> -->
                    </tr>
                    <?php } ?>
                    <tr>
                        <td colspan="20" style="text-align: center;">
                            <?php echo $_smarty_tpl->tpl_vars['pagelist']->value;?>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html><?php }} ?>