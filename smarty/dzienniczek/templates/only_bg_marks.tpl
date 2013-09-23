{extends file="main_template_only_bg.tpl"}

{block name=head}
	<link rel="stylesheet" type="text/css" href="css/table.css">
{/block}

{block name=body}

	<table class="marks_table" cellspacing="0px" style="table-layout: fixed;">
		<tr bgcolor="#4c7cb7" style="border: 2px solid #002f6a;">
			<td class="marks_first_row">Lp.</td>
		    <td class="marks_first_row">Imię i Nazwisko</td>
		{foreach $marksTypes as $markType}

		    	<td class="marks_types_first_row" style="text-align:left;">{$markType->getTypeName()}</td>

		{/foreach} 
	    </tr>
	    {foreach $studentMarks as $studentMark}
			<tr bgcolor={cycle values="#11498e, #002f6a"}>
		    	<td class="marks_row" style="text-align:left;">{$studentMark@iteration}.</td>
		    	<td class="marks_row" style="text-align:left;">{$studentMark->getStudentName()} {$studentMark->getStudentSurname()}</td>
				{foreach $marksTypes as $markType}
					<td class="marks_row" style="text-align:left;">
						{foreach $studentMark->getMarks() as $mark}
							{if ($mark->getId() eq $markType->getId()) && ($mark->getMark() != 0)}
								{$mark->getMark()},
							{/if}
						{/foreach}
					</td>
				{/foreach}
			</tr>
		{/foreach} 
	</table>
	
	<!-- 
		<div style=" position: relative; float: right;  margin-bottom: 1em; padding: 10px; top: 5px; margin-right: 20px;">
		    <a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=event&classId={$classId}&select=previous&date={$date}', 'targetdiv', 'attendMenu')"><img src="images/previous.png" align="left" style="margin-right:10px"/> </a>
		    <a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=event&classId={$classId}&select=next&date={$date}', 'targetdiv', 'attendMenu')"> <img src="images/forward.png" align="left"/> </a>
		</div>
		
		<div id ="similar" style=" position: relative; float: left;  margin-bottom: 1em; padding: 10px; top: 20px; width: auto;">
		    - oznacza obecnosc ucznia <br>
		    | oznacza nieobecnosc ucznia
		</div>
	 -->

{/block}