{extends file="main_template_only_bg.tpl"}

{block name=head}
	<link rel="stylesheet" type="text/css" href="css/table.css">
{/block}

{block name=body}

	<table class="event_table" cellspacing="0px" style="table-layout: fixed;">
		<tr bgcolor="#4c7cb7" style="border: 2px solid #002f6a;">
		    <td class="event_first_row">Wydarzenie</td>
	        <td class="event_first_row">Opis</td>
	        <td class="event_first_row">Data rozpoczęcia</td>
	        <td class="event_first_row">Data zakończenia</td>
	    </tr>
	    
	    {foreach $events as $event}
		    <tr bgcolor={cycle values="#11498e, #002f6a"}>
		    	<td class="event_row" style="text-align:left;">{$event->getName()}</td>
		    	<td class="event_row" style="text-align:left;">{$event->getDescription()}</td>
		    	<td class="event_row" style="text-align:left;">{$event->getStartDate()}</td>
		    	<td class="event_row" style="text-align:left;">{$event->getEndDate()}</td>
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