<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:23:53
         compiled from "./App/Admin/View\Userinfo\xiugai.html" */ ?>
<?php /*%%SmartyHeaderCode:15682565efef9b6d379-07007164%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '87e80a164daf43a1afb462ddae9afd49df6ec7e2' => 
    array (
      0 => './App/Admin/View\\Userinfo\\xiugai.html',
      1 => 1449035611,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15682565efef9b6d379-07007164',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565efef9c1532',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565efef9c1532')) {function content_565efef9c1532($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改商品</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：商品管理-》修改商品信息</span>
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
                <input type="hidden" name="goods_id" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['goods_id'];?>
" />
              <table border="1" width="100%" class="table_a">
                <tr>
                    <td>姓名</td>
                    <td><input type="text" name="user_real_name" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_real_name'];?>
"/></td>
                </tr>
                <tr>
                    <td>电话</td>
                    <td><input type="text" name="user_tel" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_tel'];?>
" /></td>
                </tr>
                <tr>
                    <td>昵称</td>
                    <td><input type="text" name="user_name" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_name'];?>
" /></td>
                </tr>
           
             
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="修改" />
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html><?php }} ?>