{extends file="main_template.tpl"}

{block name=caption}
Moje dziecko -{$name} {/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 

{/block}
{block name=body}
<a href="4.html"><div class="radius" id="btn1" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="6.html"><div class="radius" id="btn2" style="float:left"> <p align="center"> <img src="images/marks.png" align="middle"  /><br/>Oceny</p> </div> </a>
	<a href="3.html"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/homeworks.png" align="middle"  /><br/> Prace domowe</p> </div> </a>
{/block}