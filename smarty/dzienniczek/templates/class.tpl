{extends file="main_template.tpl"}
{block name=caption}Klasa {$className}{/block}

{block name=head} 
	<link rel="stylesheet" type="text/css" href="css/menu_style.css">
{/block}

{block name=body}
<nav id="navigationMenu" style="z-index: 1000; position: fixed; ">
	<ul>
		<li id="attendMenu" class='active'> <a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=attendance&classId={$classId}', 'targetdiv', 'attendMenu','0')" ><span>Frekwencja</span></a></li>
		<li id="marksMenu"><a href="javascript:void()"><span>Oceny</span></a>
			<ul>
				{foreach $subjects as $subject}
					<li><a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=marks_by_sub&classId={$classId}&subjectId={$subject->getId()}', 'targetdiv', 'marksMenu','{$subject->getId()}')">{$subject->getName()}</a></li>
				 {/foreach}
			</ul>
		</li>
		<li id="eventsMenu"><a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=events&classId={$classId}', 'targetdiv', 'eventsMenu','0')" ><span>Wydarzenia</span></a></li>
		<li id="homeworkMenu"><a href="javascript:void()"><span>Zadania domowe</span></a>
			<ul>
				 {foreach $subjects as $subject}
					<li><a href="javascript:void()" onclick="javascript:sendRequest('{$SCRIPT_NAME}?action=homework&classId={$classId}&subjectId={$subject->getId()}', 'targetdiv', 'homeworkMenu', '{$subject->getId()}')">{$subject->getName()}</a></li>
				 {/foreach}
			</ul>
		</li>
	</ul>
</nav>

<div id="targetdiv" style="position:relative; border:1px solid #11498e; margin-bottom: 1em; padding: 0px; top: 100px; overflow: auto;">
	
</div>

<script type="text/javascript">
	var target;
	var page_request;
	var loader_content = "<img src='images/ajax-loader.gif' style='margin-left:300px; margin-top:50px; ' /> Trwa pobieranie danych...Proszę czekać...";
	var active;
	var last_subject_id;
	
	$(document).ready(function(){
		sendRequest('{$SCRIPT_NAME}?action=attendance&classId={$classId}', 'targetdiv', 'attendMenu')
	});
	
	function sendRequest(scriptFile, targetElement, activeMenu, subjectId)
	{	
		target = targetElement;
		active = activeMenu;
		if(subjectId != '0' && subjectId != 'undefined')
		{
			last_subject_id = subjectId;
		}
		document.getElementById(target).innerHTML = loader_content;
		if(active != 'addHomeworks' && active != 'addNews') 
		{
			resetActiveMenu();
			document.getElementById(activeMenu).className = "active"
		}
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

		}, 1200);
	}
	
	function handleResponse()
	{	
		if(page_request.readyState == 4) {		
		try{
	
			var strResponse = page_request.responseText;
			
				document.getElementById(target).innerHTML = strResponse;

				if(active == 'homeworkMenu' || active == 'addHomeworks')
				{
					$("#startDate").datepicker({ dateFormat: 'yy-mm-dd' });
				    $("#endDate").datepicker({ dateFormat: 'yy-mm-dd' });

				    
				    $("#add_homework").click(function() {
				    	var homework_description = $('#homeworkDescription').val();
					    sendRequest('{$SCRIPT_NAME}?action=add_homework&classId={$classId}&subjectId=' + last_subject_id + '&homework_descr=' + homework_description + '&startDate=' 
							    + $("#startDate").val() + '&endDate=' + $("#endDate").val(), 'targetdiv', 'addHomeworks', last_subject_id);
					});
				}
				else if(active == 'eventsMenu')
				{
					$("#startDate").datepicker({ dateFormat: 'yy-mm-dd' });
				    $("#endDate").datepicker({ dateFormat: 'yy-mm-dd' });
				}
			    
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