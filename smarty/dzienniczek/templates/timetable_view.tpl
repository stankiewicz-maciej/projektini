{extends file="main_template.tpl"}

{block name=caption} Plan zajęć - {$class}{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 

{/block}
{block name=body}
<div align="center">
<table border="2px" >
    <tr ><td>L.p</td><td>Godzina</td><td>Poniedziałek</td><td>Wtorek</td><td>Środa</td><td>Czwartek</td><td>Piątek</td></tr>
    <tr>
    <td>
		{foreach from=$number  item=item}
		 {$item} <br/>
        {/foreach}
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