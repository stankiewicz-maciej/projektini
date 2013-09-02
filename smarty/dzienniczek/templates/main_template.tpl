<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
{block name=head}{/block}
</head>

<body link="#FFFFFF">

	<!--header-->
	<div style="width:100%; height:80px; overflow:hidden; margin: 0 auto; background-color:#333">

	  <div style="width:760px; height:80px; margin: 0 auto; overflow:hidden; position:relative">
			
			<div id="caption" style="height:44px; margin-top:20px;float:left; margin-left:12px; position:absolute">{block name=caption}{/block}</div>

			<div id="login" style="left:500px; height:44px; margin-top:20px;float:right; margin-left:12px; position:absolute">{block name=log} Jesteś zalogowany jako: {$login} <a id="out" href="{$SCRIPT_NAME}?action=logout"> Wylogowanie </a>{/block} </div>
	  </div>

	</div>
	
	<div style="width:760px; height:450px; overflow:hidden; margin: 0 auto; position:relative; margin-top:35px;">
		{block name=body}{/block}
	</div>

	<!--footer-->
	<div style="width:100%; height:120px; overflow:hidden; margin: 0 auto; background-color:#333; margin-top:20px;">
		<div style="width:760px; height:80px; margin: 0 auto;">
		<p style="text-align:center; color:#FFF; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:x-small">Najlepsi z najlepszych <a href="https://www.facebook.com/groups/329127673885131/?hc_location=stream">Wataha</a> &copy; 2013 All rights reserved. </p>
		<p style="text-align:center; color:#CCC; font-family:'Lucida Sans Unicode', 'Lucida Grande', sans-serif; font-size:x-small"> Jeśli chcesz kupic nasz produkt, pisz i nie krępuj się </p>
		</div>
	</div>

</body>
</html>