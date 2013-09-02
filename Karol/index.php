<?php
session_start();
// define our application directory
define('DZIENNICZEK_DIR', '../smarty/dzienniczek/');
// define smarty lib directory
define('SMARTY_DIR', '../smarty/libs/');
// include the setup script
include(DZIENNICZEK_DIR . 'libs/dzienniczek_setup.php');

// create guestbook object
$dzienniczek = new Dzienniczek;

// set the current action
$_action = isset($_REQUEST['action']) ? $_REQUEST['action'] : 'form';
$_logged = $dzienniczek->isLogged();
if($_action == 'form' && $_logged) {
	$_action = 'start';
}

if(!$_logged) {
	switch($_action) {
		case 'form':
			$dzienniczek->displayForm('Nie jesteś zalogowany', $_POST);
			break;
		case 'login':
			if($dzienniczek->isValidPass($_POST)) {
				$dzienniczek->login($_POST);
				$dzienniczek->displayStart();
			} else {
				$dzienniczek->displayForm('Nieprawidłowa nazwa lub hasło użytkownika', $_POST);
			}
			break;
		default:
			$dzienniczek->displayForm('Nie jesteś zalogowany', $_POST);
			break;
	}
} else {
	switch($_action) {
		case 'logout':
			$resultMessage = $dzienniczek->logout();
			$dzienniczek->displayLogout($resultMessage);
			break;
		case 'userdata':
				$dzienniczek->displayUserData();
				break;
		case 'start':
		default:
			$dzienniczek->displayStart();    
			break;
	}
}	   

?>