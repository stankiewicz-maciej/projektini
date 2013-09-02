{extends file="main_template.tpl"}
{block name=caption}Zostałeś wylogowany{/block}
{block name=log}  {/block}
}
{block name=head}
	<script type="text/javascript" src="js/start.js"></script> 
    <script type="text/javascript">
	
	$(document).ready(function(){
	$("#btn1").delay(0).animate({ 
        left: "-=500px",
    }, 3000 );
});
</script>
{/block}
{block name=body}
<a href="{$SCRIPT_NAME}?action=start"><div id="btn1" style="float:left"> <p align="center"> <img src="images/login.png" align="middle"  /><br/>Zaloguj ponownie</p> </div> </a>
{/block}
