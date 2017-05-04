<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:27:26
         compiled from "./App/Admin/View\Adminlist\tianjia.html" */ ?>
<?php /*%%SmartyHeaderCode:27280565effced9f655-41835975%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7cd1e021dc7e619a52251179657585aeb34ab632' => 
    array (
      0 => './App/Admin/View\\Adminlist\\tianjia.html',
      1 => 1449040881,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27280565effced9f655-41835975',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565effcee37bf',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565effcee37bf')) {function content_565effcee37bf($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
    <head>
        <title>添加管理员</title>
        <meta http-equiv="content-type" content="text/html;charset=utf-8">
        <link href="<?php echo @ADMIN_CSS_URL;?>
mine.css" type="text/css" rel="stylesheet">
    </head>

    <body>

        <div class="div_head">
            <span>
                <span style="float:left">当前位置是：管理员管理-》添加管理员信息</span>
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
            <table border="1" width="100%" class="table_a">
                <tr>
                    <td>管理员名称</td>
                    <td><input type="text" name="mg_name" /></td>
                </tr>
                <tr>
                    <td>管理员密码</td>
                    <td><input type="text" name="mg_pwd" /></td>
                </tr>
                <tr>
                    <td>管理员角色id</td>
                    <td><input type="text" name="mg_role_id" /></td>
                </tr>
                <tr>
                    <td colspan="2" align="center">
                        <input type="submit" value="添加">
                    </td>
                </tr>  
            </table>
            </form>
        </div>
    </body>
</html><?php }} ?>