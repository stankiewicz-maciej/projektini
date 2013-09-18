<?php /* Smarty version Smarty-3.1.13, created on 2013-09-19 00:11:48
         compiled from "..\smarty\dzienniczek\templates\teachers_list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:6650523a12a8e1b0e7-84138801%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fc33dff0c0a5a92f09a9255ef43d72689ea69135' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\teachers_list.tpl',
      1 => 1379542305,
      2 => 'file',
    ),
    '8e76363a39d719c57d603896625287a05dd121bc' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\main_template.tpl',
      1 => 1379443498,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '6650523a12a8e1b0e7-84138801',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.13',
  'unifunc' => 'content_523a12a8f017e2_77122138',
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
<?php if ($_valid && !is_callable('content_523a12a8f017e2_77122138')) {function content_523a12a8f017e2_77122138($_smarty_tpl) {?><?php if (!is_callable('smarty_function_cycle')) include '../smarty/libs/plugins\\function.cycle.php';
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">Lista nauczycieli</div>

			<div id="login" style="left:500px; height:60px; margin-top:20px;float:right; margin-left:12px; position:absolute"> <p style="font-size: medium; color:#CCC;">Jesteś zalogowany jako: <?php echo $_smarty_tpl->tpl_vars['login']->value;?>
 </p><a href="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=logout"> Wylogowanie </a> </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px; overflow-y: auto;">
		

	<table class="shadow_only" cellspacing="0" style="margin:10px;">
    <tr bgcolor="#4c7cb7"><td class="row">Imię</td><td class="row">Nazwisko</td><td class="row" >Przedmiot</td><tr bgcolor="#BCBCBC">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable; $_smarty_tpl->tpl_vars['item']->_loop = false;
 $_from = $_smarty_tpl->tpl_vars['teachers_list']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['item']->index=-1;
foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
$_smarty_tpl->tpl_vars['item']->_loop = true;
 $_smarty_tpl->tpl_vars['item']->index++;
?>
		<td  class="row"><?php echo $_smarty_tpl->tpl_vars['item']->value;?>
</td> <?php if (($_smarty_tpl->tpl_vars['item']->index+1)%3==0){?> </tr><tr  bgcolor=<?php echo smarty_function_cycle(array('values'=>"#E9E9E9, #BCBCBC"),$_smarty_tpl);?>
><?php }?>
        <?php } ?>
        </tr>
		</table>



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