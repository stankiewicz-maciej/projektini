<?php /* Smarty version Smarty-3.1.13, created on 2013-09-18 18:26:04
         compiled from "..\smarty\dzienniczek\templates\parents_children.tpl" */ ?>
<?php /*%%SmartyHeaderCode:43395239f03caca3c8-77108565%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'c285b0002fbe19497046e9d1e1f2264b0a3215f9' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\parents_children.tpl',
      1 => 1379528070,
      2 => 'file',
    ),
    '8e76363a39d719c57d603896625287a05dd121bc' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\main_template.tpl',
      1 => 1379368230,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '43395239f03caca3c8-77108565',
  'function' => 
  array (
  ),
  'variables' => 
  array (
    'isStudent' => 0,
    'isParent' => 0,
    'isTeacher' => 0,
    'login' => 0,
    'SCRIPT_NAME' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5239f03cc15635_92049433',
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5239f03cc15635_92049433')) {function content_5239f03cc15635_92049433($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

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

<?php $_smarty_tpl->tpl_vars['isStudent'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['isStudent']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['isParent'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['isParent']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['isTeacher'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['isTeacher']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>

<body link="#FFFFFF">

	<!--header-->
	<div style="width:100%; height:100px; overflow:hidden; margin: 0 auto; background-color:#333">

	  <div style="width:760px; height:100px; margin: 0 auto; overflow:hidden; position:relative">
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">Moje dziecko</div>

			<div id="login" style="left:500px; height:60px; margin-top:20px;float:right; margin-left:12px; position:absolute"> <p style="font-size: medium; color:#CCC;">Jesteś zalogowany jako: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 </p><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=logout"> Wylogowanie </a> </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px; overflow-y: auto;">
		


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