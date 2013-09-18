{extends file="main_template.tpl"}

{block name=caption}
{if fig_children==1} Moje dziecko
{else} Moje dzieci{/if}{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 

{/block}
{block name=body}
<div align="center">
{foreach from=$children_names item=foo}
<a href="#.html"><element><div class="radius" id="btn{$foo@index+1}" style="float:left"></element> <p align="center"> <img src="images/{$foo@index+1}.png" align="middle" /><br/>{$foo}</p> </div> </a>
{/foreach}


</div>

{/block}

