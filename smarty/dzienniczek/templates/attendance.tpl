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

{/block}