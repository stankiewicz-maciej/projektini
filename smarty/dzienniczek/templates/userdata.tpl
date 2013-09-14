{extends file="main_template.tpl"}
{block name=caption}Twoje dane{/block}

{block name=head} {/block}

{block name=body}
{foreach from=$userData key=key item=item}
{$key}: {$item} <br/>
  
{/foreach}
{/block}