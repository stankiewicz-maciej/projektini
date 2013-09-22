{extends file="main_template.tpl"}
{block name=caption}Nieobecności - {$name}{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}

{block name=body}

	<table class="shadow_only" cellspacing="0" style="margin:10px;">
    <tr bgcolor="#4c7cb9"><td class="row">Termin</td><td class="row">Dzień</td><td class="row">Lekcja</td><tr bgcolor="#BCBCBC">
		{foreach from=$absences  item=item}
		<td  class="row">{$item}</td> {if ($item@index+1)%3==0}</tr><tr  bgcolor={cycle values="#E9E9E9, #BCBCBC"}>{/if}
        {/foreach}
        </tr>
		</table>


{/block}