{extends file="main_template.tpl"}

{block name=caption} Plan zajęć - {$class}{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 

{/block}
{block name=body}
<div align="center">
<table class="shadow_only" cellspacing="0" style="margin:10px;" border="2px" >
    <tr ><td class="small_row">L.p</td><td class="small_row">Godzina</td><td class="small_row">Poniedziałek</td><td class="small_row">Wtorek</td><td class="small_row">Środa</td><td class="small_row">Czwartek</td><td class="small_row">Piątek</td></tr> 
    <tr>
    <td>
    	<table><tr><td class="small_row" bgcolor="#BCBCBC">
		{foreach from=$number  item=item}
		 {$item} </td></tr><tr><td class="small_row"  bgcolor={cycle values="#E9E9E9, #BCBCBC"}>
        {/foreach}
     </td></tr>
     </td>
     <td>
		{foreach from=$time  item=item}
		 {$item} <br/>
        {/foreach}
     </td>
    <td>
		{foreach from=$monday  item=item}
		 {$item} <br/>
        {/foreach}
     </td>

	<td>
		{foreach from=$tuesday item=item}
		 {$item} <br/>
        {/foreach}
     </td>
     <td>
		{foreach from=$wednesday item=item}
		 {$item} <br/>
        {/foreach}
     </td>
     <td>
		{foreach from=$thursday item=item}
		 {$item} <br/>
        {/foreach}
     </td>
     <td>
		{foreach from=$friday item=item}
		 {$item} <br/>
        {/foreach}
     </td></tr></table>
    
 </div>
{/block}