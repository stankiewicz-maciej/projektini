<?php /* Smarty version Smarty-3.1.13, created on 2013-09-02 18:18:25
         compiled from "..\smarty\dzienniczek\templates\login_form.tpl" */ ?>
<?php /*%%SmartyHeaderCode:159505180de8b0fdc16-47073903%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0c9f159997c27eb95679215147442672ecb48a22' => 
    array (
      0 => '..\\smarty\\dzienniczek\\templates\\login_form.tpl',
      1 => 1367339474,
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
    'message' => 0,
    'SCRIPT_NAME' => 0,
    'post' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5180de8b318d91_34985347')) {function content_5180de8b318d91_34985347($_smarty_tpl) {?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logowanie</title>
</head>

<body>
<div align="center">
	<p style="color:#FF0000; height:5px">
		<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

    </p>
    <h2>Wprowadź nazwę i hasło użytkownika.</h2>
    <form name="formularz1" action="<?php echo $_smarty_tpl->tpl_vars['SCRIPT_NAME']->value;?>
?action=login" method="post">
    <table border="0">
    <tr><td>Użytkownik:</td> <td><input name ="Login" type="text" value="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['Login'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
" /></td></tr>
    <tr><td>Hasło:</td> <td> <input name="Password" type="password" value="<?php echo (($tmp = @htmlspecialchars($_smarty_tpl->tpl_vars['post']->value['Password'], ENT_QUOTES, 'UTF-8', true))===null||$tmp==='' ? '' : $tmp);?>
" /> </td></tr>
    <tr><td><input type="radio" name="stan" value="uczen" checked="checked" />Uczeń </td> <td><input type="radio" name="stan" value="nauczyciel" />Nauczyciel</td></tr>
    
    <tr><td colspan="2" align="center"><input type="submit" value="Zaloguj" /></td></tr>
    </table>
</div>

</body>
</html><?php }} ?>