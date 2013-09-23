{extends file="main_template.tpl"}
{block name=caption} Oceny {/block}
{block name=head}
<script type="text/javascript" src="js/start.js"></script> 
{/block}


{block name=body}

	<table class="shadow_only" cellspacing="0" style="margin:10px;">
    <tr bgcolor="#4c7cb9"><td class="row">Przedmiot</td><td class="row">Sprawdzian</td><td class="row" >Praca domowa</td><td class="row" >Aktywność</td></tr>
    
    <tr class="row" bgcolor="#BCBCBC"><td>Matematyka</td> <td style="color:red"> {foreach from=$matspr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$matpd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$matakt item=item}  {$item},  {/foreach}</td></tr>
    
    <tr class="row" bgcolor="#BCBCBC"><td>Fizyka</td> <td style="color:red"> {foreach from=$fizspr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$fizpd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$fizakt item=item} {$item},  {/foreach}</td></tr>
    
     <tr class="row" bgcolor="#BCBCBC"><td>Informatyka</td> <td style="color:red"> {foreach from=$infspr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$infpd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$infakt item=item} {$item},  {/foreach}</td></tr>
     
      <tr class="row" bgcolor="#BCBCBC"><td>Biologia</td> <td style="color:red"> {foreach from=$biospr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$biopd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$bioakt item=item} {$item},  {/foreach}</td></tr>
    
     <tr class="row" bgcolor="#BCBCBC"><td>Chemia</td> <td style="color:red"> {foreach from=$chespr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$chepd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$cheakt item=item} {$item},  {/foreach}</td></tr>
     
      <tr class="row" bgcolor="#BCBCBC"><td>Geografia</td> <td style="color:red"> {foreach from=$geospr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$geopd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$geoakt item=item} {$item},  {/foreach}</td></tr>
      
       <tr class="row" bgcolor="#BCBCBC"><td>J.Polski</td> <td style="color:red"> {foreach from=$polspr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$polpd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$polakt item=item} {$item},  {/foreach}</td></tr>
    
    	 <tr class="row" bgcolor="#BCBCBC"><td>J.Angielski</td> <td style="color:red"> {foreach from=$angspr item=item} {$item},  {/foreach}</td> <td style="color:black"> {foreach from=$angpd item=item} {$item},  {/foreach}</td> <td style="color:green"> {foreach from=$angakt item=item} {$item},  {/foreach}</td></tr>
   
   
   
    </table>


{/block}

#E9E9E9, #BCBCBC