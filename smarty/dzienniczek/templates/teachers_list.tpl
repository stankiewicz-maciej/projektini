{extends file="main_template.tpl"}
{block name=caption}Lista nauczycieli{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}

{block name=body}

	<table  cellspacing="0" style="border-collapse: collapse;">
    <tr><td class="key_column">Imię</td><td class="key_column">Nazwisko</td><td class="key_column">Przedmiot</td><tr>
		{foreach from=$teachers_list  item=item}
		<td class="value_column">{$item}</td> {if ($item@index+1)%3==0} </tr><tr>{/if}
        {/foreach}
        </tr>
		</table>

{/block}