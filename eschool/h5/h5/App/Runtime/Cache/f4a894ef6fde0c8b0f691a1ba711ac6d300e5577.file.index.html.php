<?php /* Smarty version Smarty-3.1.6, created on 2015-12-02 22:23:18
         compiled from "./App/Admin/View\Index\index.html" */ ?>
<?php /*%%SmartyHeaderCode:3021565efed602b9d3-95325726%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f4a894ef6fde0c8b0f691a1ba711ac6d300e5577' => 
    array (
      0 => './App/Admin/View\\Index\\index.html',
      1 => 1438413487,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3021565efed602b9d3-95325726',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.6',
  'unifunc' => 'content_565efed60bc27',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_565efed60bc27')) {function content_565efed60bc27($_smarty_tpl) {?><!doctype html public "-//w3c//dtd xhtml 1.0 frameset//en" "http://www.w3.org/tr/xhtml1/dtd/xhtml1-frameset.dtd">
<html>
    <head>
        <meta http-equiv=content-type content="text/html; charset=utf-8" />
        <meta http-equiv=pragma content=no-cache />
        <meta http-equiv=cache-control content=no-cache />
        <meta http-equiv=expires content=-1000 />
        
        <title>管理中心 v1.0</title>
    </head>
    <frameset border=0 framespacing=0 rows="60, *" frameborder=0>
        <!--
        frame标签的src属性值不能设置“相对路径”
        相对地址会收到路由最后一级地址的影响而使得请求有可能失败
        最后使用绝对路径地址
        
        如下的<?php echo @__CONTROLLER__;?>
不需要php的echo输出，会直接变为具体的常量信息
        tp框架本身有“替换机制”，会把其替换为对应的常量内容
        -->
        <frame name=head src="<?php echo @__CONTROLLER__;?>
/head" frameborder=0 noresize scrolling=no>
            <frameset cols="170, *">
                <frame name=left src="<?php echo @__CONTROLLER__;?>
/left" frameborder=0 noresize />
                <frame name=right src="<?php echo @__CONTROLLER__;?>
/right" frameborder=0 noresize scrolling=yes />
            </frameset>
    </frameset>
    <noframes>
    </noframes>
</html><?php }} ?>