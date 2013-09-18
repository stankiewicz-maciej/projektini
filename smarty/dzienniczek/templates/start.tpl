{extends file="main_template.tpl"}
{block name=caption}Dzienniczek Ucznia{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}

{block name=body}

<a href="{$SCRIPT_NAME}?action=userdata"><div class="radius" id="btn1" style="float:left"> <p align="center"> <img src="images/personal.png" align="middle"  /><br/>Twoje dane</p> </div> </a>

{if $isParent}
    <a href="4.html"><element><div class="radius" id="btn2" style="float:left"></element> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="{$SCRIPT_NAME}?action=parents_children"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/childrens.png" align="middle"  /><br/>Dzieci</p> </div> </a>
{elseif $isStudent}
    <a href="4.html"><div class="radius" id="btn2" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="6.html"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/marks.png" align="middle"  /><br/>Oceny</p> </div> </a>
	<a href="3.html"><div class="radius" id="btn4" style="float:left"> <p align="center"> <img src="images/homeworks.png" align="middle"  /><br/> Prace domowe</p> </div> </a>
{elseif $isTeacher}
    <a href="2.html"><div class="radius" id="btn2" style="float:left"> <p align="center"> <img src="images/marks.png" align="middle"  /><br/>Oceny</p> </div> </a>
    <a href="3.html"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/homeworks.png" align="middle"  /><br/> Prace domowe</p> </div> </a>
    <a href="4.html"><div class="radius" id="btn4" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="5.html"><div class="radius" id="btn5" style="float:left"> <p align="center"> <img src="images/director_issues.png" align="middle"  /><br/>Zarządzaj szkołą</p> </div> </a>
    <a href="6.html"><div class="radius" id="btn6" style="float:left"> <p align="center"> <img src="images/childrens.png" align="middle"  /><br/>Dzieci</p> </div> </a>
{/if}

{/block}
