<?php /* Smarty version Smarty-3.1.13, created on 2013-09-02 21:35:11
         compiled from "..\smarty\dzienniczek\templates\start.tpl" */ ?>
<?php /*%%SmartyHeaderCode:315995180de9294aea5-97180751%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9df0f154a53a9fb6a3b3c31b1c20d37fc5bd8d06' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\start.tpl',
      1 => 1378142228,
      2 => 'file',
    ),
    '8e76363a39d719c57d603896625287a05dd121bc' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\main_template.tpl',
      1 => 1378150446,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '315995180de9294aea5-97180751',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5180de9299bfe6_46652315',
  'variables' => 
  array (
    'login' => 0,
    'SCRIPT_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5180de9299bfe6_46652315')) {function content_5180de9299bfe6_46652315($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#caption").delay(0).animate({ 
			top: "+=60px",}, 1500 );
	});
	
	
</script>
<title>Dzienniczek Ucznia</title>
<link rel="stylesheet" type="text/css" href="css/main_style.css">

	<script type="text/javascript" src="js/start.js"></script> 

</head>

<body link="#FFFFFF">

	<!--header-->
	<div style="width:100%; height:80px; overflow:hidden; margin: 0 auto; background-color:#333">

	  <div style="width:760px; height:80px; margin: 0 auto; overflow:hidden; position:relative">
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">Dzienniczek Ucznia</div>

			<div id="login" style="left:500px; height:44px; margin-top:20px;float:right; margin-left:12px; position:absolute"> Jesteś zalogowany jako: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 <a id="out" href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=logout"> Wylogowanie </a> </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px;">
		
<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=userdata"><div id="btn1" style="float:left"> <p align="center"> <img src="images/personal.png" align="middle"  /><br/>Twoje dane</p> </div> </a>
    <a href="2.html"><div id="btn2" style="float:left"> <p align="center"> <img src="images/marks.png" align="middle"  /><br/>Oceny</p> </div> </a>
    <a href="3.html"><div id="btn3" style="float:left"> <p align="center"> <img src="images/homeworks.png" align="middle"  /><br/> Prace domowe</p> </div> </a>
    <a href="4.html"><div id="btn4" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="5.html"><div id="btn5" style="float:left"> <p align="center"> <img src="images/director_issues.png" align="middle"  /><br/>Zarządzaj szkołą</p> </div> </a>
    <a href="6.html"><div id="btn6" style="float:left"> <p align="center"> <img src="images/childrens.png" align="middle"  /><br/>Dzieci</p> </div> </a>

	</div>

	<!--footer-->
	<div style="width:100%; height:120px; overflow:hidden; margin: 0 auto; background-color:#333; margin-top:20px;">
		<div style="width:760px; height:80px; margin: 0 auto;">
		<p style="text-align:center; color:#FFF; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:x-small">Najlepsi z najlepszych <a href="https://www.facebook.com/groups/329127673885131/?hc_location=stream">Wataha</a> &copy; 2013 All rights reserved. </p>
		<p style="text-align:center; color:#CCC; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:x-small"> Jeśli chcesz kupic nasz produkt, pisz i nie krępuj się </p>
		</div>
	</div>

</body>
</html><?php }} ?>