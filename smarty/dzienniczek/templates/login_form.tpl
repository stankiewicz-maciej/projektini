{extends file="main_template.tpl"}
{block name=caption}Logowanie{/block}
{block name=log}  {/block}
}
{block name=head} {/block}
{block name=body}
<div id="div1" align="center">
<h2>Wprowadź nazwę i hasło użytkownika.</h2>
    <form class="form1" name="formularz1"  action="{$SCRIPT_NAME}?action=login" method="post">
    <table border="0">
    <tr><td>Użytkownik:</td> <td><input name ="Login" type="text" value="{$post.Login|escape|default:''}" /></td></tr>
    <tr><td>Hasło:</td> <td> <input name="Password" type="password" value="{$post.Password|escape|default:''}" /> </td></tr>
    <tr><td><input type="radio" name="stan" value="uczen" checked="checked" />Uczeń </td> <td><input type="radio" name="stan" value="nauczyciel" />Nauczyciel</td></tr>
    
    <tr><td colspan="2" align="center"><input type="submit" value="Zaloguj" /></td></tr>
    </table>
</div>
{/block}
