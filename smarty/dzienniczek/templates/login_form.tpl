{extends file="main_template.tpl"}
{block name=caption}Logowanie{/block}
{block name=log}  {/block}

{block name=head}
<script type="text/javascript">

 	 $(function() {
    $( "#slider" ).slider();
  });
  </script>

{/block}
{block name=body}

<div id="log_form">
<form class="myform"   action="{$SCRIPT_NAME}?action=login" method="post">
    <br/>
    <br/>
    <div align="center"><input class="fill" name ="Login" placeholder="Użytkownik" type="text" value="{$post.Login|escape|default:''}" /></div><br/>
	<div align="center"><input align="middle" class="fill" placeholder="Hasło" name="Password" type="password" value="{$post.Password|escape|default:''}" /></div><br/>
	<div align="center">
	
		<input type="radio" id="radio1" name="usertype" value="student" checked>
		<label for="radio1">Uczeń</label>
	
		<input type="radio" id="radio2" name="usertype" value="parent" checked>
		<label for="radio2">Rodzic</label>
	   
		<input type="radio" id="radio3" name="usertype" value="teacher">
		<label for="radio3">Nauczyciel</label></div><br/>
		
		<div align="center"><input class="logbtn" type="submit" value="Zaloguj" />
	</div>
    <br/><br/>
</form>
</div>


{/block}
