{extends file="main_template.tpl"}
{block name=caption}Twoje dane{/block}

{block name=head} {/block}

{block name=body}

	<table  cellspacing="0" style="border-collapse: collapse;">
		{foreach from=$parent_data key=key item=item}
			<tr>
				<td class="key_column">{$key}</td>
				<td class="value_column">{$item}</td>
			</tr>
		{/foreach}
	</table>

{/block}