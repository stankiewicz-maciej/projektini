{extends file="main_template.tpl"}
{block name=caption}Dzienniczek Ucznia{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}



{block name=body}

{assign var='isTutor' value=$isTutor|default:false}

<a href="{$SCRIPT_NAME}?action=userdata"><div class="radius" id="btn1" style="float:left"> <p align="center"> <img src="images/personal.png" align="middle"  /><br/>Twoje dane</p> </div> </a>

{if $isParent}
    <a href="{$SCRIPT_NAME}?action=teachers_list"><element><div class="radius" id="btn2" style="float:left"></element> <p align="center"> <img src="images/teacher.png" align="middle"  /><br/>Nauczyciele</p> </div> </a>
    <a href="{$SCRIPT_NAME}?action=parents_children"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/childrens.png" align="middle"  /><br/>Dzieci</p> </div> </a>
{elseif $isStudent}
    <a href="4.html"><div class="radius" id="btn2" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    <a href="6.html"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/marks.png" align="middle"  /><br/>Oceny</p> </div> </a>
	<a href="3.html"><div class="radius" id="btn4" style="float:left"> <p align="center"> <img src="images/homeworks.png" align="middle"  /><br/> Prace domowe</p> </div> </a>
    <a href="{$SCRIPT_NAME}?action=news&id={$who}"><div class="radius" id="btn5" style="float:left"> <p align="center"> <img src="images/news.png" align="middle"  /><br/> Aktualności</p> </div> </a>
    <a href="3.html"><div class="radius" id="btn6" style="float:left"> <p align="center"> <img src="images/check.png" align="middle"  /><br/> Obecności</p> </div> </a>
{elseif $isTeacher}
    <a href="{$SCRIPT_NAME}?action=education"><div class="radius" id="btn2" style="float:left"> <p align="center"> <img src="images/education.png" align="middle"  /><br/>Edukacja</p> </div> </a>
    <a href="{$SCRIPT_NAME}?action=lesson_plan"><div class="radius" id="btn3" style="float:left"> <p align="center"> <img src="images/lesson_plan.png" align="middle"  /><br/>Plan lekcji</p> </div> </a>
    {if $isTutor}
    	<a href="{$SCRIPT_NAME}?action=tutor"><div class="radius" id="btn4" style="float:left"> <p align="center"> <img src="images/tutor.png" align="middle"  /><br/>Wychowawstwo</p> </div> </a>
	{/if}
{/if}

{/block}
