{extends file="main_template.tpl"}
{if $fig_children == 1}
{block name=caption}Moje dziecko{/block}
{else}
{block name=caption}Moje dzieci{/block}
{/if}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 

{/block}

<div align="center">
{foreach from=$children_names item=item}
<a href="#.html"><element><div class="radius" id="child{$smarty.foreach.foo.index +1}" style="float:left"></element> <p align="center"> <img src="images/{$smarty.foreach.foo.index +1}.png" align="middle"  /><br/>{$item}</p> </div> </a>
{/foreach}

</div>

{block name=body}

{/block}

