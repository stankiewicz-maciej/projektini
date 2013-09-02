<?php /* Smarty version Smarty-3.1.13, created on 2013-09-02 21:06:35
         compiled from "..\smarty\dzienniczek\templates\userdata.tpl" */ ?>
<?php /*%%SmartyHeaderCode:134995224ca323d73b8-42672068%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '62f57c59b2e0ef75c8747986eeccc5a13c53ddc5' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\userdata.tpl',
      1 => 1378142854,
      2 => 'file',
    ),
    '8e76363a39d719c57d603896625287a05dd121bc' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\main_template.tpl',
      1 => 1378148681,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '134995224ca323d73b8-42672068',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5224ca3245da43_24708670',
  'variables' => 
  array (
    'login' => 0,
    'SCRIPT_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5224ca3245da43_24708670')) {function content_5224ca3245da43_24708670($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$("#caption").delay(0).animate({ 
			top: "+=60px",}, 1500 );
	});
	$("a").click(function () {
  $("a").fadeOut("slow");
  });
</script>
<title>Dzienniczek Ucznia</title>
<link rel="stylesheet" type="text/css" href="css/main_style.css">
 
</head>

<body link="#FFFFFF">

	<!--header-->
	<div style="width:100%; height:80px; overflow:hidden; margin: 0 auto; background-color:#333">

	  <div style="width:760px; height:80px; margin: 0 auto; overflow:hidden; position:relative">
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">Twoje dane</div>
			
			<div id="login" style="left:500px; height:44px; margin-top:20px;float:right; margin-left:12px; position:absolute"> Jesteś zalogowany jako: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 <a id="out" href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=logout"> Wylogowanie </a> </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px;">
		
<p align="center">Imie: <?php echo $_smarty_tpl->tpl_vars['imie']->value;?>
 </p> <br/><br/>

<p align="center">Nazwisko: <?php echo $_smarty_tpl->tpl_vars['nazwisko']->value;?>
 </p>


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