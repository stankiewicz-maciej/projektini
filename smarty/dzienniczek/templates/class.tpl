{extends file="main_template.tpl"}
{block name=caption}Klasa {$className}{/block}

{block name=head} 
	<link rel="stylesheet" type="text/css" href="css/menu_style.css">
{/block}

{block name=body}
<nav id="navigationMenu" style="z-index: 1000; position: fixed; ">
	<ul>
		<li id="attendMenu" class='active'> <a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=attendance', 'targetdiv', 'attendMenu')" ><span>Frekwencja</span></a></li>
		<li id="marksMenu"><a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=marks', 'targetdiv', 'marksMenu')" ><span>Oceny</span></a>
			<ul>
				<li><a href="#">Matematyka</a></li>
				<li><a href="#">Jezyk polski</a></li>
				<li><a href="#">Wf</a></li>
			</ul>
		</li>
		<li id="eventsMenu"><a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=events', 'targetdiv', 'eventsMenu')" ><span>Wydarzenia</span></a></li>
		<li id="homeworkMenu"><a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=homework', 'targetdiv', 'homeworkMenu')" ><span>Zadania domowe</span></a>
			<ul>
				<li><a href="#">Matematyka</a></li>
				<li><a href="#">Jezyk polski</a></li>
				<li><a href="#">Wf</a></li>
			</ul>
		</li>
	</ul>
</nav>

<div id="targetdiv" style="position:relative; border:1px solid #11498e; margin-bottom: 1em; padding: 0px; top: 100px; overflow: auto;">
	<p>This is some default tab content, embedded directly inside this space and not via Ajax. It can be shown when no tabs are automatically selected, or associated with a certain tab, in this case, the first tab.</p>
</div>

<div id ="similar" style=" position: relative; float: left;  margin-bottom: 1em; padding: 10px; top: 100px; width: auto;">
    - oznacza obecnosc ucznia <br>
    | oznacza nieobecnosc ucznia</div>


<script type="text/javascript">
	var target;
	var page_request;
	var loader_content = "<img src='images/ajax-loader.gif' style='margin-left:300px; margin-top:50px; ' /> Trwa pobieranie danych...Proszę czekać...";

	$(document).ready(function(){
		sendRequest('{$SCRIPT_NAME}?action=attendance&classId={$classId}', 'targetdiv', 'attendMenu')
	});
	
	function sendRequest(scriptFile, targetElement, activeMenu)
	{	
		target = targetElement;
		resetActiveMenu();
		document.getElementById(activeMenu).className = "active"
		document.getElementById(target).innerHTML = loader_content;
		setTimeout(function(){
			page_request = false;
			
			if (window.ActiveXObject){ //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
				try {
					page_request = new ActiveXObject("Msxml2.XMLHTTP")
				} 
				catch (e){
					try{
						page_request = new ActiveXObject("Microsoft.XMLHTTP")
					}
					catch (e){}
				}
			}
			else if (window.XMLHttpRequest) // if Mozilla, Safari etc
				page_request = new XMLHttpRequest()
			else
				return false
			page_request.onreadystatechange=handleResponse
			var ajaxfriendlyurl=scriptFile.replace(/^http:\/\/[^\/]+\//i, "http://"+window.location.hostname+"/") 
			page_request.open('GET', ajaxfriendlyurl, true)
			page_request.send(null)

		}, 2000);
	}
	
	function handleResponse()
	{	
		if(page_request.readyState == 4) {		
		try{
	
			var strResponse = page_request.responseText;
				document.getElementById(target).innerHTML = strResponse;
			} catch (e){
				document.getElementById(target).innerHTML = e;
			}	
		} 
	}

	function resetActiveMenu()
	{
		var tabs=document.getElementById("navigationMenu").getElementsByTagName("li");

		for(var i=0; i < tabs.length; i++)
		{
			tabs[i].className = ""
		}
		
	}
</script>

{/block}