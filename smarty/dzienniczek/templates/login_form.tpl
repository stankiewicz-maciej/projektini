<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Logowanie</title>
</head>

<body>
<div align="center">
	<p style="color:#FF0000; height:5px">
		{$message}
    </p>
    <h2>Wprowadź nazwę i hasło użytkownika.</h2>
    <form name="formularz1" action="{$SCRIPT_NAME}?action=login" method="post">
    <table border="0">
    <tr><td>Użytkownik:</td> <td><input name ="Login" type="text" value="{$post.Login|escape|default:''}" /></td></tr>
    <tr><td>Hasło:</td> <td> <input name="Password" type="password" value="{$post.Password|escape|default:''}" /> </td></tr>
    <tr><td><input type="radio" name="stan" value="uczen" checked="checked" />Uczeń </td> <td><input type="radio" name="stan" value="nauczyciel" />Nauczyciel</td></tr>
    
    <tr><td colspan="2" align="center"><input type="submit" value="Zaloguj" /></td></tr>
    </table>
</div>

</body>
</html>