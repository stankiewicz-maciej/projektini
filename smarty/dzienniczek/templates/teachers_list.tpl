{extends file="main_template.tpl"}
{block name=caption}Lista nauczycieli{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}

{block name=body}

	<table class="shadow_only" cellspacing="0" style="margin:10px;">
    <tr bgcolor="#4c7cb7"><td class="row">Imię</td><td class="row">Nazwisko</td><td class="row" >Przedmiot</td><tr bgcolor="#BCBCBC">
		{foreach from=$teachers_list  item=item}
		<td  class="row">{$item}</td> {if ($item@index+1)%3==0} </tr><tr  bgcolor={cycle values="#E9E9E9, #BCBCBC"}>{/if}
        {/foreach}
        </tr>
		</table>


{/block}