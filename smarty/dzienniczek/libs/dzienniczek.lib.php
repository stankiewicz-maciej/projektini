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
  
  function getWeek($date) {
  	$currentWeek = array();
  	 
  	$mon= date('y-m-d', strtotime('$date Monday'));
  	$tue= date('y-m-d', strtotime('$date Tuesday'));
  	$wed= date('y-m-d', strtotime('$date Wednesday'));
  	$thu= date('y-m-d', strtotime('$date Thursday'));
  	$fri= date('y-m-d', strtotime('$date Friday'));
  	 
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
  		if((time()) >= strtotime($currentWeek[$i]))
  		{
	  		for($j = 0; $j < 8; $j++)
	  		{
	  			array_push($absenceList, new Absence($currentWeek[$i], $j, '-'));
	  		}
  		}
  		else 
  		{
  			for($j = 0; $j < 8; $j++)
  			{
  				array_push($absenceList, new Absence($currentWeek[$i], $j, ''));
  			}
  		}
  		
  		$absences = $this->db->getAbsences($userId, $currentWeek[$i]);
  		
  		while ($row = pg_fetch_array($absences)) {
  			$absenceList[$row[0]] = '|';
  		}
  		
  	}
  	$absenceList1 = array(new Absence('09/19', 1, '-'), new Absence('09/19', 2, '-'), new Absence('09/19', 3, '-'),
  			new Absence('09/19', 4, '-'), new Absence('09/19', 5, '|'),new Absence('09/19', 6, '|'), new Absence('09/19', 7, '-'),
  			new Absence('09/19', 8, '/')
  	);
  	return $absenceList1;
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
  function displayAttendance($classId, $date){
  	$currentWeek = array();
  	if($date == null)
  	{
  		$currentWeek = $this->getCurrentWeek();
  	} 
  	else
  	{
  		$currentWeek = $this->getWeek($date);
  	}
  	// fake data
  	
  	$absenceList1 = $this->prepareAbsenceList(1, $classId);
  	//$absenceList2 = array(new Absence('09/18', 5));
  	/*$absence1 = new Absence('09/19', 1);
  	$absence2 = new Absence('09/19', 4);
  	$absence3 = new Absence('09/20', 1);
  	$absence4 = new Absence('09/18', 5);*/
  	
  	$absenceDetails1 = new AbsenceDetails();
  	$absenceDetails1->setUserId(1);
  	$absenceDetails1->setUserName('Karol');
  	$absenceDetails1->setUserSurname('Zurek');
  	$absenceDetails1->setAbscences($absenceList1);
  	
  	$absenceDetails2 = new AbsenceDetails();
  	$absenceDetails2->setUserId(2);
  	$absenceDetails2->setUserName('Maciej');
  	$absenceDetails2->setUserSurname('Stankiewicz');
  	//$absenceDetails2->setAbscences($absenceList2);
  	
  	$absenceDetails3 = new AbsenceDetails();
  	$absenceDetails3->setUserId(3);
  	$absenceDetails3->setUserName('Bartlomiej');
  	$absenceDetails3->setUserSurname('Szysz');
  	
  	//$studentAttendance = array("Karol Zurek", "Maciej Stankiewicz", "Monika Zieba");
  	$studentAttendance = array($absenceDetails1, $absenceDetails2, $absenceDetails3);
  	$this->tpl->assign('currentWeek', $currentWeek);
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
  function displayClass(){
  	$this->tpl->assign('login', $_SESSION['zalogowany']);
  	$this->tpl->display('class.tpl');
  }
  /**
  * display PV with data of one child
  *
  */
  function displayPvMyChild($id){
	$this->tpl->assign('login', $_SESSION['zalogowany']);
	$name=$this->db->getChildName($id); 
	$this->tpl->assign('name', $name);
	$this->tpl->display('pv_child_view.tpl');
	  
  }
  
  /* ------------------------------------------------------ END ACTIONS SECTION ------------------------------------------------------*/
  
}

?>