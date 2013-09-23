{extends file="main_template.tpl"}

{block name=caption}Plan zajęć{/block}

{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 

{/block}
{block name=body}


<table align="center" class="shadow_only" cellspacing="0" style="margin:1px;">
    <tr height="25px" bgcolor="#4c7cb9"><td class="row">L.p</td><td class="row">Godziny</td><td class="row">Poniedziałek</td><td class="row">Wtorek</td>
    <td class="row">Środa</td><td class="row">Czwartek</td><td class="row">Piątek</td> </tr>
    
    <tr>
    <td>
    				<table align="center" width="100%" border="0px" cellspacing="0">
    				{foreach from=$number  item=item}
    				<tr><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>
       				{/foreach}
                    </table>
    
    
    </td>
    
    
     <td>
     				<table width="100%" border="0px" cellspacing="0">
    				{foreach from=$time item=item}
    				<tr ><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>
       				{/foreach}
                    </table>
    				
    
    
    </td>
    
    
     <td>
    				<table width="100%" border="0px" cellspacing="0">
    				{foreach from=$monday  item=item}
                    {if ($item@index+1)%2==0}
    				<tr><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>{/if}
       				{/foreach}
                    </table>
    
    
    </td>
    
    <td>
    				<table width="100%" border="0px" cellspacing="0">
    				{foreach from=$tuesday  item=item}
    				
    				{if ($item@index+1)%2==0}
    				<tr><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>{/if}
       				{/foreach}
       			
                    </table>
    
    
    </td>
    
    <td>
    				<table width="100%" border="0px" cellspacing="0">
    				{foreach from=$wednesday item=item}
    				{if ($item@index+1)%2==0}
    				<tr><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>{/if}
       				{/foreach}
                    </table>
    
    </td>
    
    
    <td>
    				<table width="100%" border="0px" cellspacing="0">
    				{foreach from=$thursday  item=item}
    				{if ($item@index+1)%2==0}
    				<tr><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>{/if}
       				{/foreach}
                    </table>
    
    
    </td>
    
    <td>
    				<table width="100%" border="0px" cellspacing="0">
    				{foreach from=$friday  item=item}
    				{if ($item@index+1)%2==0}
    				<tr><td class="row1" bgcolor={cycle values=" #BCBCBC, #E9E9E9"}> {$item} </td></tr>{/if}
       				{/foreach}
                    </table>
    
    
    </td>
    
    
    
		</table>





</div>

{/block}