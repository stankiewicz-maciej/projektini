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

// ONLY FOR DEVELOPMENT PHASE
$dzienniczek->isDatabaseActual();

if(!$_logged) {
	switch($_action) {
		case 'form':
			$dzienniczek->displayForm('Nie jesteś zalogowany', $_POST);
			break;
		case 'login':
			$user_type = $dzienniczek->isValidPass($_POST);
			if($user_type != User::$TYPE_NULL) {
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
		case 'timetable':
			$dzienniczek->displayTimetable($_REQUEST['id']);
			break;
		case 'absence':
			$dzienniczek->displayAbsences($_REQUEST['id']);
			break;
		case 'homeworks':
			$dzienniczek->displayHomeworks($_REQUEST['id']);
			break;
		case 'news':
			$dzienniczek->displayNews($_REQUEST['id']);
			break;
		case 'mychild':
			$dzienniczek->displayPvMyChild($_REQUEST['id']);
			break;
		case 'logout':
			$resultMessage = $dzienniczek->logout();
			$dzienniczek->displayLogout($resultMessage);
			break;
		case 'userdata':
				$dzienniczek->displayUserData();
				break;
		case 'parents_children':
				$dzienniczek->displayParentsChildren();
				break;
		case 'teachers_list':
				$dzienniczek->displayTeachersList();
				break;
		case 'education':
			$dzienniczek->displayMySubjectsList();
			break;
			// ponizsze bedzie duzo bardziej rozbudowane - narazie to prottopy tych case-ów
		case 'class':
			$dzienniczek->displayClass($_REQUEST['classId'], $_REQUEST['className']);
			break;
		case 'attendance':
			if(isset($_REQUEST['select']))
				$dzienniczek->displayAttendance($_REQUEST['classId'],$_REQUEST['select'], $_REQUEST['date']);
			else 
				$dzienniczek->displayAttendance($_REQUEST['classId'], null, null);
			break;
		case 'marks':
			$dzienniczek->displayMarks();
			break;
		case 'events':
			$dzienniczek->displayEvents();
			break;
		case 'homework':
			$dzienniczek->displayHomework();
			break;
		case 'start':
		default:
			$dzienniczek->displayStart();		
			break;
	}
}	   

?>