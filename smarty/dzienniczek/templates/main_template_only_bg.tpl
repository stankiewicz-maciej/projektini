<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script type="text/javascript" src="js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="js/jquery-ui-1.10.3.custom.min.js"></script>

<title>Dzienniczek Ucznia</title>
<link rel="stylesheet" type="text/css" href="css/main_style.css">
{block name=head}{/block}
</head>

{assign var='isStudent' value=$isStudent|default:false}
{assign var='isParent' value=$isParent|default:false}
{assign var='isTeacher' value=$isTeacher|default:false}

<body link="#FFFFFF">

	<div style="width:auto ; overflow-x:auto; margin: 0 0; position:relative; margin:5px; overflow-y: auto;">
		{block name=body}{/block}
	</div>

</body>
</html>