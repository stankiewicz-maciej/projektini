<?php /* Smarty version Smarty-3.1.13, created on 2013-09-05 13:00:31
         compiled from "..\smarty\dzienniczek\templates\login_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159505180de8b0fdc16-47073903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c9f159997c27eb95679215147442672ecb48a22' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\login_form.tpl',
      1 => 1378386023,
      2 => 'file',
    ),
    '8e76363a39d719c57d603896625287a05dd121bc' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\main_template.tpl',
      1 => 1378364684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '159505180de8b0fdc16-47073903',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_5180de8b318d91_34985347',
  'variables' => 
  array (
    'login' => 0,
    'SCRIPT_NAME' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5180de8b318d91_34985347')) {function content_5180de8b318d91_34985347($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

 	 $(function() {
    $( "#slider" ).slider();
  });
  </script>


</head>

<body link="#FFFFFF">

	<!--header-->
	<div style="width:100%; height:80px; overflow:hidden; margin: 0 auto; background-color:#333">

	  <div style="width:760px; height:80px; margin: 0 auto; overflow:hidden; position:relative">
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">Logowanie</div>

			<div id="login" style="left:500px; height:44px; margin-top:20px;float:right; margin-left:12px; position:absolute">   </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px;">
		

<div id="log_form">
<form class="myform"   action="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=login" method="post">
    <br/>
    <br/>
    <div align="center"><input class="fill" name ="Login" placeholder="Użytkownik" type="text" value="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['Login'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
" /></div><br/>
	<div align="center"><input align="middle" class="fill" placeholder="Hasło" name="Password" type="password" value="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['Password'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
" /></div><br/>
	<div align="center">
	
		<input type="radio" id="radio1" name="usertype" value="student_parent" checked>
		<label for="radio1">Uczeń/Rodzic</label>
	   
		<input type="radio" id="radio2" name="usertype" value="teacher">
		<label for="radio2">Nauczyciel</label></div><br/>
		
		<div align="center"><input class="logbtn" type="submit" value="Zaloguj" />
	</div>
    <br/><br/>
</form>
</div>



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