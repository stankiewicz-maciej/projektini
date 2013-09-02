{extends file="main_template.tpl"}
{block name=caption}Dzienniczek Ucznia{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}

{block name=body}
<a href="{$SCRIPT_NAME}?action=userdata"><div id="btn1" style="float:left"> <p align="center"> <img src="images/personal.png" align="middle"  /><br/>Twoje dane</p> </div> </a>
    <a href="2.html"><div id="btn2" style="float:left"> <p align="center"> <img src="images/marks.png" align="middle"  /><br/>Oceny</p> </div> </a>
    <a href="3.html"><div id="btn3" style="float:left"> <p align="center"> <img src="images/homeworks.png" align="middle"  /><br/> Prace domowe</p> </div> </a>
    <a href="4.html"><div id="btn4" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="5.html"><div id="btn5" style="float:left"> <p align="center"> <img src="images/director_issues.png" align="middle"  /><br/>Zarządzaj szkołą</p> </div> </a>
    <a href="6.html"><div id="btn6" style="float:left"> <p align="center"> <img src="images/childrens.png" align="middle"  /><br/>Dzieci</p> </div> </a>
{/block}



<!-- <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<link rel="stylesheet" type="text/css" href="css/reset.css" />
 	<link rel="stylesheet" type="text/css" href="css/text.css" />
 	<link rel="stylesheet" type="text/css" href="css/960.css" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
<title>Strona głowna</title>
</head>

<body>

<div class="container_12">
	<div class="grid_12" id="log">Jesteś zalogowany jako: {$login} <a id="out" href="{$SCRIPT_NAME}?action=logout">Wylogowanie</a>
    </div>
    <div class="grid_12">
    <br/>
    <br/>
    <br/>
    </div>
	<div class="grid_4 win">
   <p align="center"><br/><img src="pictures/personal.png" align="middle"  /><br/>Dane ogólne</p>
	</div>
    <div class="grid_4 win">
    <p align="center"><br/><img src="pictures/lesson_plan.png" align="middle" /><br/>Podział godzin</p>
	</div>
    
    <div class="grid_4 win">
    <p align="center"><br/><img src="pictures/marks.png" align="middle"  /><br/>Oceny</p>
	</div>
    
    <div class="grid_12">
    <br/>
    <br/>
    <br/>
    </div>
	<div class="grid_4 win">
   <p align="center"><br/><img src="pictures/childrens.png" align="middle"  /><br/>Ustawienia</p>
	</div>
    <div class="grid_4 win">
    <p align="center"><br/><img src="pictures/homeworks.png" align="middle" /><br/>Wiadomości</p>
	</div>
    
    <div class="grid_4 win">
    <p align="center"><br/><img src="pictures/director_issues.png" align="middle"  /><br/>Forum</p>
	</div>
     
    <div class="grid_12">
    <br/>
    <br/>
    <br/>
    </div>
    <div class="grid_12 win2" >Copyrights by 3S</div>
</div>

</body>
</html>-->