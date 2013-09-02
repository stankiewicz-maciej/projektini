{extends file="main_template.tpl"}
{block name=caption}Zostałeś wylogowany{/block}
{block name=log}  {/block}
}
{block name=head}
	 <script type="text/javascript">
	
	$(document).ready(function(){
	$("#btn5").delay(0).animate({ 
        left: "-=500px",
    }, 1500 );
});
</script>
{/block}
{block name=body}
<a href="{$SCRIPT_NAME}?action=start"><div class="radius" id="btn5" class="radius" style="float:left"> <p align="center" style="text-height:4px"> <img src="images/login.png" align="middle"  /><br/>Zaloguj ponownie</p> </div> </a>
{/block}
