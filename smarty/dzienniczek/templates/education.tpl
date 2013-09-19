{extends file="main_template.tpl"}
{block name=caption}Przedmioty których uczysz{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
{/block}

{block name=body}

	<table class="shadow_only" cellspacing="0" style="margin:10px;">
		<tr bgcolor="#4c7cb7"><td class="row">Klasa</td><td class="row">Przedmiot</td></tr>
		{foreach $education_list as $education}
			<tr>
				<td class="key_column">{$education->getClassName()}</td>
				<td class="value_column"><a href="{$SCRIPT_NAME}?action=subject&id={$education->getSubjectId()}">{$education->getSubjectName()}</a> </td> 
			</tr>
		{/foreach} 
	</table>

{/block}