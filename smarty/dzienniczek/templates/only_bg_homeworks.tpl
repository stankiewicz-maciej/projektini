{extends file="main_template_only_bg.tpl"}

{block name=head}
	<link rel="stylesheet" type="text/css" href="css/table.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
{/block}

{block name=body}

	<table class="homework_table" cellspacing="0px" style="table-layout: fixed;">
		<tr bgcolor="#4c7cb7" style="border: 2px solid #002f6a;">
		    <td class="homework_first_row">Opis</td>
	        <td class="homework_first_row">Data rozpoczęcia</td>
	        <td class="homework_first_row">Data zakończenia</td>
	    </tr>
	    
	    {foreach $homeworks as $homework}
		    <tr bgcolor={cycle values="#11498e, #002f6a"}>
		    	<td class="homework_row" style="text-align:left;">{$homework->getDescription()}</td>
		    	<td class="homework_row" style="text-align:left;">{$homework->getStartDate()}</td>
		    	<td class="homework_row" style="text-align:left;">{$homework->getEndDate()}</td>
		    </tr>
		{/foreach} 
	</table>
		
	<div style="position: relative; float: left; width:450px;  margin-bottom: 1em; padding: 10px; top: 5px; margin-right: 20px;">
		Treść zadania:<br> <textarea id="homeworkDescription" rows="5" cols="45"> </textarea><br><br>
  		Data rozpoczęcia:<br> <input id="startDate" /><a href="#" id="add_homework" style="float: right"><img src="images/list_add.png" align="left" style="margin-right:10px"/></a><br><br>
  		Data Zakończenia:<br> <input id="endDate" /><br><br>
	</div>
{/block}