<?php
include('DB_Helper.php');
include('Model/User.php');
include('Model/Education.php');
include('Model/Absence.php');
include('Model/AbsenceDetails.php');
/**
 * dzienniczek application library
 *
 */
class Dzienniczek {
	
  // database object
  var $db = null;
  // smarty template object
  var $tpl = null;
  // error messages
  var $error = null;
  // temporary password file
  var $fd = null;
  
  var $daysOfWeek = array("Poniedzialek", "Wtorek", "Sroda", "Czwartek", "Piatek");
  var $lastAttendanceDate = 'asdsa';

  /**
  * class constructor
  */
  function __construct() {

    // set up database here!
	
    // instantiate the template object
    $this->tpl = new Dzienniczek_Smarty;
	$this->db = new DB_Helper;
  }
  
	function isDatabaseActual() {
		$this->db->isDatabaseActual();
	}

  /**
  * test if form information is valid
  *
  * @param array $formvars the form variables
  */
  function isValidPass($formvars) {

    // reset error message
    $this->error = null;

    // test if "Login" is empty
    if(strlen($formvars['Login']) == 0) {
      $this->error = 'login_empty';
      return User::$TYPE_NULL; 
    }

    // test if "Password" is empty
    if(strlen($formvars['Password']) == 0) {
      $this->error = 'password_empty';
      return User::$TYPE_NULL; 
    }
	
	$selected_user_type = $_POST['usertype'];
	$rs = $this->db->getUserCredentials($selected_user_type);
	while ($row = pg_fetch_array($rs)) {
		if($row[1] !=$formvars['Login']) {
			continue;
		}
		if($row[2] ==$formvars['Password']){ 
			// form passed validation
			$this->login($formvars, $selected_user_type, $row[0]);
			return $selected_user_type;
		}
	}
	
    // form fail validation
    return User::$TYPE_NULL;
  }
  
  function isLogged() {
	return isSet($_SESSION['zalogowany']) ;
  }
  
  function login($formvars, $user_type, $user_id) {
	$_SESSION['zalogowany']=$formvars['Login'];
	$_SESSION['user_type']=$user_type;
	$_SESSION['user_id']=$user_id;
  }
  
  function getUserId() {
	if(!isSet($_SESSION['user_id'])) {
		return User::$ID_NULL;
	} else {
		return $_SESSION['user_id'];
	}
  }
  
  function getUserType() {
	if(!isSet($_SESSION['user_type'])) {
		return User::$TYPE_NULL;
	} else {
		return $_SESSION['user_type'];
	}
  }
  
  function isUserStudent() {
  	if(!isSet($_SESSION['user_type']) || $_SESSION['user_type'] != User::$TYPE_STUDENT) {
  		return false;
  	} else {
  		return true;
  	}
  }
  
  function isUserParent() {
  	if(!isSet($_SESSION['user_type']) || $_SESSION['user_type'] != User::$TYPE_PARENT) {
  		return false;
  	} else {
  		return true;
  	}
  }
  
  function isUserTeacher() {
  	if(!isSet($_SESSION['user_type']) || $_SESSION['user_type'] != User::$TYPE_TEACHER) {
  		return false;
  	} else {
  		return true;
  	}
  }
  
  function logout() {
	$message;
	if(!isSet($_SESSION['zalogowany'])) {
		$message="Nie byłeś zalogowany!";
	}
	else{
		unset($_SESSION['zalogowany']);
		unset($_SESSION['user_type']);
		$message="Zostałeś pomyślnie wylogowany!";
	}
	session_destroy();
	return $message;
  }
  
  function setUserTypeFlag() {
	$user_type = $this->getUserType();
	if($user_type == User::$TYPE_STUDENT) {
		$this->tpl->assign('isStudent', true);
	}
	else if($user_type == User::$TYPE_PARENT) {
		$this->tpl->assign('isParent', true);
	}
	else if($user_type == User::$TYPE_TEACHER) {
		$this->tpl->assign('isTeacher', true);
	}
  }
  
  function getCurrentWeek() {
  	$currentWeek = array();
  	$mon= date('y-m-d', strtotime('Monday this week'));
  	$tue= date('y-m-d', strtotime('Tuesday this week'));
  	$wed= date('y-m-d', strtotime('Wednesday this week'));
  	$thu= date('y-m-d', strtotime('Thursday this week'));
  	$fri= date('y-m-d', strtotime('Friday this week'));
  	
  	array_push($currentWeek, $mon);
  	array_push($currentWeek, $tue);
  	array_push($currentWeek, $wed);
  	array_push($currentWeek, $thu);
  	array_push($currentWeek, $fri);
  	return $currentWeek;
  }
  
  function getWeek($select, $date) {
  	$currentWeek = array();
  	
  	$currentDate;
  	if($select == 'next')
  	{
  		$mon= date('y-m-d', strtotime($date . 'next week'));
  		$tue= date('y-m-d', strtotime($date .' next week + 1 day'));
  		$wed= date('y-m-d', strtotime($date .' next week + 2 day'));
  		$thu= date('y-m-d', strtotime($date .' next week + 3 day'));
  		$fri= date('y-m-d', strtotime($date .' next week + 4 day'));
  	}
  	else 
  	{
  		$mon= date('y-m-d', strtotime($date . 'last week'));
  		$tue= date('y-m-d', strtotime($date . 'last week + 1 day'));
  		$wed= date('y-m-d', strtotime($date . 'last week + 2 day'));
  		$thu= date('y-m-d', strtotime($date . 'last week + 3 day'));
  		$fri= date('y-m-d', strtotime($date . 'last week + 4 day'));
  	}
  	 
  	array_push($currentWeek, $mon);
  	array_push($currentWeek, $tue);
  	array_push($currentWeek, $wed);
  	array_push($currentWeek, $thu);
  	array_push($currentWeek, $fri);
  	return $currentWeek;
  }
  
  function prepareAbsenceList($userId, $classId, $currentWeek)
  {
  	$absenceList = array();
  	for($i = 0 ; $i < sizeof( $this->daysOfWeek, 0); $i++)
  	{
  		$lessonOnDay = $this->db->getLessonCount($i+1, $classId);
  		if((time()) >= strtotime($currentWeek[$i]))
  		{
	  		for($j = 0; $j < $lessonOnDay; $j++)
	  		{
	  			array_push($absenceList, new Absence($currentWeek[$i], $j, '-'));
	  		}
  		}
  		else 
  		{
  			for($j = 0; $j < $lessonOnDay; $j++)
  			{
  				array_push($absenceList, new Absence($currentWeek[$i], $j, ''));
  			}
  		}
  		
  		for($j = 0; $j < 8 - $lessonOnDay; $j++)
  		{
  			array_push($absenceList, new Absence($currentWeek[$i], $lessonOnDay+$j, '/'));
  		}
  		
  		$absences = $this->db->getAbsencesByDay($userId, $currentWeek[$i]);
  		if($absences != FALSE) {
	  		while ($row = pg_fetch_array($absences)) {
	  			$absenceList[($i * 8) + $row[0]-1]->setSymbol('|');
	  		}
  		}
  	}

  	return $absenceList;
  }
  
  /* ------------------------------------------------------ BEGIN ACTIONS SECTION ------------------------------------------------------ */
  /**
  * display the login form
  *
  * @param array $formvars the form variables
  */
  function displayForm($message, $formvars = array()) {
    // assign the form vars
    $this->tpl->assign('post',$formvars);
    // assign error message
    $this->tpl->assign('error', $this->error);
	$this->tpl->assign('message', $message);
    $this->tpl->display('login_form.tpl');
  }

  /**
  * display the start page
  *
  */
  function displayStart() {
	$this->setUserTypeFlag();
	$this->tpl->assign('login', $_SESSION['zalogowany']);
	$this->tpl->display('start.tpl'); 
  }
  
  /**
  * display the start page
  *
  */
  function displayUserData() {
	$this->setUserTypeFlag();
	$this->tpl->assign('login', $_SESSION['zalogowany']);
	
	$user_data = $this->db->getUserData($_SESSION['zalogowany'], $this->getUserType());
	$row = pg_fetch_array($user_data);
	
	$this->tpl->assign('personal_data',
                             array('Imie i nazwisko:' => $row[1].' '.$row[2],
                             		'Email' => $row[3],
                             		'Telefon' => $row[4],
									));
	$this->tpl->display('userdata.tpl'); 
  }
  
  /**
  * display the logout page
  *
  */
  function displayLogout() {
	$this->tpl->assign('login', ' ');
	$this->tpl->assign('message', 'Zostałeś wylogowany!');
	$this->tpl->display('logout.tpl'); 
  }
  /**display parent's children
  *
  */
  function displayParentsChildren(){
      $this->tpl->assign('login', $_SESSION['zalogowany']);
	  $result=$this->db->getChildrens($this->getUserId());
	  $number=count($result);
	  $this->tpl->assign('fig_children', $number);
	  $this->tpl->assign('children_names', $result);
	  $this->tpl->display('parents_children.tpl');
		  
  }
  
   /**display teachers list
  *
  */
  function displayTeachersList(){
      $this->tpl->assign('login', $_SESSION['zalogowany']);
	  $result=$this->db->getTeachersList();
	  $this->tpl->assign('teachers_list', $result);
	  $this->tpl->display('teachers_list.tpl');
		  
  }
  
  function displayMySubjectsList(){
  	$this->tpl->assign('login', $_SESSION['zalogowany']);
  	$teaching=$this->db->getTeachingList($this->getUserId());
  	
  	$education_list = array();
  	
  	while ($row = pg_fetch_array($teaching)) {
  		$subject_name = $this->db->getSubjectName($row[0]);
  		$class_name = $this->db->getClassName($row[1]);
  		$education = new Education($row[0], $row[1], $subject_name, $class_name);
  		array_push($education_list, $education);
  	}
  	
  	$this->tpl->assign('education_list', $education_list);
  	$this->tpl->display('education.tpl');
  
  }
  
  // te funkcje beda duzo duzo bardziej rozbudowane
  function displayAttendance($classId, $select, $date){
  	$currentWeek = array();
  	
  	if($date == null)
  	{
  		$currentWeek = $this->getCurrentWeek();
  	} 
  	else
  	{
  		$currentWeek = $this->getWeek($select, $date);
  	}
  	$weekDate = '20'.$currentWeek[0];
  	// fake data
  	$studentAttendance = array();

  	$students = $this->db->getStudentsByClass($classId);
  	
  	if($students != FALSE) 
  	{
  		while ($studentRow = pg_fetch_array($students)) {
  			$absenceDetails = new AbsenceDetails();
  			$absenceDetails->setUserId($studentRow[0]);
  			$absenceDetails->setUserName($studentRow[1]);
  			$absenceDetails->setUserSurname($studentRow[2]);
  			$absenceDetails->setAbscences($this->prepareAbsenceList($studentRow[0], $classId, $currentWeek));
  			array_push($studentAttendance, $absenceDetails);
  		}
  	}
  	
  	$this->tpl->assign('currentWeek', $currentWeek);
  	$this->tpl->assign('classId', $classId);
  	$this->tpl->assign('date', $weekDate);
  	$this->tpl->assign('studentAttendance', $studentAttendance);
  	$this->tpl->display('attendance.tpl');
  }
  function displayMarks(){
  	$this->tpl->display('marks.tpl');
  }
  function displayEvents(){
  	$this->tpl->display('events.tpl');
  }
  function displayHomework(){
  	$this->tpl->display('homework.tpl');
  }
  function displayClass($classId, $className){
  	$this->tpl->assign('login', $_SESSION['zalogowany']);
  	$this->tpl->assign('classId', $classId);
  	$this->tpl->assign('className', $className);
  	$this->tpl->display('class.tpl');
  }
  /**
  * display PV with data of one child
  *
  */
  function displayPvMyChild($id){
	$this->tpl->assign('login', $_SESSION['zalogowany']);
	$name=$this->db->getChildName($id); 
	$this->tpl->assign('who' ,$id);
	$this->tpl->assign('name', $name);
	$this->tpl->display('pv_child_view.tpl');
  }
  /**
  * display news acoording data
  *
  */
  function displayNews($id){
  $this->tpl->assign('login', $_SESSION['zalogowany']);	
  $classId=$this->db->getClassId($id);
  $events=$this->db->getNews($classId); 
  $className=$this->db->getClassName($classId);
  $this->tpl->assign('className', $className);
  $this->tpl->assign('news', $events);
	$this->tpl->display('news.tpl');
  }
  
  /**
  * display homeworks acorrding to date
  *
  */
  function displayHomeworks($id){
  $this->tpl->assign('login', $_SESSION['zalogowany']);	
  $classId=$this->db->getClassId($id);
  $homeworks=$this->db->getHomeworks($classId); 
  $className=$this->db->getClassName($classId);
  $this->tpl->assign('className', $className);
  $this->tpl->assign('homeworks', $homeworks);
	$this->tpl->display('homeworks.tpl');
  }
  /**
  * display homeworks acorrding to date
  *
  */
  function displayAbsences($login){
  $this->tpl->assign('login', $_SESSION['zalogowany']);	
  $name=$this->db->getChildName($login);
  $sid=$this->db->getStudentId($login);
  $absences=$this->db->getAbsences($sid);
  $this->tpl->assign('sid', $sid);
  $this->tpl->assign('name', $name);
  $this->tpl->assign('absences', $absences);
	$this->tpl->display('absence.tpl');
  }
  /* ------------------------------------------------------ END ACTIONS SECTION ------------------------------------------------------*/
  
}

?>