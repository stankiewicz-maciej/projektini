<?php /* Smarty version Smarty-3.1.13, created on 2013-09-12 22:34:25
         compiled from "..\smarty\dzienniczek\templates\logout.tpl" */ ?>
<?php /*%%SmartyHeaderCode:83785224cc0e3c6999-88442731%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '44e8bf874737eb6165a8516d5bd3adf42a421e54' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\logout.tpl',
      1 => 1378157045,
      2 => 'file',
    ),
    '8e76363a39d719c57d603896625287a05dd121bc' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\main_template.tpl',
      1 => 1379017518,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '83785224cc0e3c6999-88442731',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5224cc0e4039c5_11554350',
  'variables' => 
  array (
    'isStudent' => 0,
    'isParent' => 0,
    'isTeacher' => 0,
    'login' => 0,
    'SCRIPT_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5224cc0e4039c5_11554350')) {function content_5224cc0e4039c5_11554350($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

	 <script type="text/javascript">
	
	$(document).ready(function(){
	$("#btn5").delay(0).animate({ 
        left: "-=500px",
    }, 1500 );
});
</script>

</head>

<?php $_smarty_tpl->tpl_vars['isStudent'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['isStudent']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['isParent'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['isParent']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>
<?php $_smarty_tpl->tpl_vars['isTeacher'] = new Smarty_variable((($tmp = @$_smarty_tpl->tpl_vars['isTeacher']->value)===null||$tmp==='' ? false : $tmp), null, 0);?>

<body link="#FFFFFF">

	<!--header-->
	<div style="width:100%; height:80px; overflow:hidden; margin: 0 auto; background-color:#333">

	  <div style="width:760px; height:80px; margin: 0 auto; overflow:hidden; position:relative">
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">Zostałeś wylogowany</div>

			<div id="login" style="left:500px; height:44px; margin-top:20px;float:right; margin-left:12px; position:absolute">   </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px;">
		
<a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=start"><div class="radius" id="btn5" class="radius" style="float:left"> <p align="center" style="text-height:4px"> <img src="images/login.png" align="middle"  /><br/>Zaloguj ponownie</p> </div> </a>

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