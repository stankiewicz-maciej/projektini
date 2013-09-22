{extends file="main_template_only_bg.tpl"}

{block name=head}
	<link rel="stylesheet" type="text/css" href="css/table.css">
{/block}

{block name=body}

	<table class="attendance_table" cellspacing="0px" style="table-layout: fixed;">
		<tr bgcolor="#4c7cb7" style="border: 2px solid #002f6a;">
		    <td class="attendance_first_row">Lp.</td>
		    <td class="attendance_first_row">Imię i Nazwisko</td>
		    <td class="attendance_first_row" colspan="8"; >Poniedzialek {$currentWeek[0]|substr:3}</td>
	        <td class="attendance_first_row" colspan="8">Wtorek {$currentWeek[1]|substr:3}</td>
	        <td class="attendance_first_row" colspan="8">Sroda {$currentWeek[2]|substr:3}</td>
	        <td class="attendance_first_row" colspan="8">Czwartek {$currentWeek[3]|substr:3}</td>
	        <td class="attendance_first_row" colspan="8">Piatek {$currentWeek[4]|substr:3}</td>
	    </tr>
	    
	    {foreach $studentAttendance as $attend}
		    <tr bgcolor={cycle values="#11498e, #002f6a"}>
		    	<td class="attendance_row">{$attend@iteration}.</td>
		    	<td class="attendance_row" style="text-align:left;">{$attend->getUserName()} {$attend->getUserSurname()}</td>
		    	{foreach $attend->getAbsences() as $absence}
		    		{if $absence->getSymbol() eq '/'}
		    			<td class="attendance_row" bgcolor="#ABC4FF"/>
		    		{else}
		    			<td class="attendance_row">{$absence->getSymbol()}</td>
		    		{/if}
		    	{/foreach}
		    </tr>
		{/foreach} 
	</table>
	
	<div style=" position: relative; float: right;  margin-bottom: 1em; padding: 10px; top: 5px; margin-right: 20px;">
	    <a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=attendance&classId={$classId}&select=previous&date={$date}', 'targetdiv', 'attendMenu')"><img src="images/previous.png" align="left" style="margin-right:10px"/> </a>
	    <a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=attendance&classId={$classId}&select=next&date={$date}', 'targetdiv', 'attendMenu')"> <img src="images/forward.png" align="left"/> </a>
	</div>
	
	<div id ="similar" style=" position: relative; float: left;  margin-bottom: 1em; padding: 10px; top: 20px; width: auto;">
	    - oznacza obecnosc ucznia <br>
	    | oznacza nieobecnosc ucznia
	</div>

{/block}