<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:23:48
         compiled from "./App/Admin/View\Meet\xiugai.html" */ ?>
<?php /*%%SmartyHeaderCode:26509565efef4abeab0-44737837%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '1c1ad5f47cf86bca27b748c4022f0e37fdeda5ac' => 
    array (
      0 => './App/Admin/View\\Meet\\xiugai.html',
      1 => 1449037412,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26509565efef4abeab0-44737837',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'info' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565efef4b7646',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565efef4b7646')) {function content_565efef4b7646($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>修改会议</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：会议管理-》修改会议信息</span>
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
                    <td>会议名</td>
                    <td><input type="text" name="title" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['title'];?>
"/></td>
                </tr>
                <tr>
                    <td>会议内容</td>
                    <td><input type="text" name="content" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['content'];?>
" /></td>
                </tr>
                <tr>
                    <td>会议创建时间</td>
                    <td><input type="text" name="time" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['time'];?>
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