<?php
include('DB_Helper.php');
include('Model/User.php');
include('Model/Education.php');
include('Model/Absence.php');
include('Model/AbsenceDetails.php');
include('Model/Event.php');
include('Model/Subject.php');
include('Model/Homework.php');
include('Model/Mark.php');
include('Model/StudentMark.php');
include('Model/MarkType.php');
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
                             array('Imie i nazwisko:' => $row[0].' '.$row[1],
                             		'Email' => $row[2],
                             		'Telefon' => $row[3],
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
	  if($number!=1){
	  $this->tpl->assign('fig_children', $number);
	  $this->tpl->assign('children_names', $result);
	  $this->tpl->display('parents_children.tpl');}
	  else{
		  $rs=implode(" ", $result);
		  $login=$this->db->getLogin($rs,$this->getUserId());
		  $login1=implode(" ", $login);
		  $this->displayPvMyChild($login1);}
		  
  }
  
   /**display teachers list
  *
  */
  function displayTeacherPlan(){
	  $this->tpl->assign('login', $_SESSION['zalogowany']);
	  $user=$_SESSION['user_id'];
	  
	  	$monday=$this->db->getTeacherPlan($user, 1);
	  	$tuesday=$this->db->getTeacherPlan($user, 2);
	  	$wednesday=$this->db->getTeacherPlan($user, 3);
	  	$thursday=$this->db->getTeacherPlan($user, 4);
  		$friday=$this->db->getTeacherPlan($user, 5);
		
		$number=array( 1,2,3,4,5,6,7,8);
		$time= array('8:00-8:45', '8:50-8:35', '9:45-10:30', '10:45-11:30', '11:40-12:25', '12:30-13:15', '13:30-14:15', '14:20-15:05');
	
		$this->tpl->assign('number', $number);
		$this->tpl->assign('time', $time);
		
		$this->tpl->assign('monday', $monday);
		$this->tpl->assign('tuesday', $tuesday);
		$this->tpl->assign('wednesday', $wednesday);
		$this->tpl->assign('thursday', $thursday);
		$this->tpl->assign('friday', $friday);
		
		$this->tpl->display('teacher_plan.tpl');
  }
  
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
  
  function displayMarksBySubject($classId, $subjectId){
  	$marksTypes = array();
  	 
  	$marksTypesRs = $this->db->getMarksTypes();
  	if($marksTypesRs != FALSE)
  	{
  		while ($markTypeRow = pg_fetch_array($marksTypesRs)) {
  			$marktype = new MarkType($markTypeRow[0], $markTypeRow[1]);
  			array_push($marksTypes, $marktype);
  		}
  	}
  	
  	$studentMarks = array();
  	
  	$students = $this->db->getStudentsByClass($classId);
  	 
  	if($students != FALSE)
  	{
  		while ($studentRow = pg_fetch_array($students)) {
  			$student = new StudentMark();
  			$student->setStudentId($studentRow[0]);
  			$student->setStudentName($studentRow[1]);
  			$student->setStudentSurname($studentRow[2]);
  			$marks = array();
  			for($i = 1; $i <= sizeof($marksTypes); $i++)
  			{
  				$mark = new Mark($i, 0, '');
  				array_push($marks, $mark);
  			}
  			$marksRs = $this->db->getMarksBySubject($studentRow[0], $subjectId);
  			if($marksRs != FALSE)
  			{
  				while ($markRow = pg_fetch_array($marksRs)) {
  					$markRs = $this->db->getMarkName($markRow[0]);
  					$markName = pg_fetch_array($markRs);
  					$mark = new Mark($markRow[0], $markRow[1], $markName);
  					array_push($marks, $mark);
  				}
  			}
  			$student->setMarks($marks);
  			array_push($studentMarks, $student);
  		}
  	}
  	  	
  	$this->tpl->assign('studentMarks', $studentMarks);
  	$this->tpl->assign('marksTypes', $marksTypes);
  	$this->tpl->display('only_bg_marks.tpl');
  }
  function displayEvents($classId){
  	$events = array();
  	$eventsRs = $this->db->getFullNews($classId);
  	
  	if($eventsRs != FALSE)
  	{
  		while ($eventRow = pg_fetch_array($eventsRs)) {
  			$event = new Event();
  			$event->setName($eventRow[0]);
  			$event->setDescription($eventRow[1]);
  			$event->setStartDate($eventRow[2]);
  			$event->setEndDate($eventRow[3]);
  			array_push($events, $event);
  		}
  	}
  	
  	$this->tpl->assign('events',$events);
  	$this->tpl->display('only_bg_news.tpl');
  }
  function displayHomework($classId, $subjectId){
  	
  	$homeworks = array();
  	$homeworksRs = $this->db->getHomeworksBySubject($classId, $subjectId);
  	 
  	if($homeworksRs != FALSE)
  	{
  		while ($homeworkRow = pg_fetch_array($homeworksRs)) {
  			$homework = new Homework();
  			$homework->setDescription($homeworkRow[0]);
  			$homework->setStartDate($homeworkRow[1]);
  			$homework->setEndDate($homeworkRow[2]);
  			array_push($homeworks, $homework);
  		}
  	}
  	$this->tpl->assign('homeworks', $homeworks);
  	$this->tpl->display('only_bg_homeworks.tpl');
  }
  function displayClass($classId, $className){
  	$subjects = array();
  	$subjectsRs = $this->db->getSubjectsByClass($classId);
  	if($subjectsRs != FALSE)
  	{
  		while ($subjectRow = pg_fetch_array($subjectsRs)) {
  			$subject = new Subject($subjectRow[0], $subjectRow[1]);

  			array_push($subjects, $subject);
  		}
  	}
  	$this->tpl->assign('login', $_SESSION['zalogowany']);
  	$this->tpl->assign('classId', $classId);
  	$this->tpl->assign('className', $className);
  	$this->tpl->assign('subjects', $subjects);
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
  /**
  *display timetable for class
  *
  */
  function displayTimetable($login){
	$this->tpl->assign('login', $_SESSION['zalogowany']);	
  	$classId=$this->db->getClassId($login);  
  	$className=$this->db->getClassName($classId);
	$monday=$this->db->getTimetable($classId, 1);
	$tuesday=$this->db->getTimetable($classId, 2);
	$wednesday=$this->db->getTimetable($classId, 3);
	$thursday=$this->db->getTimetable($classId, 4);
	$friday=$this->db->getTimetable($classId, 5);
	$number=array( 1,2,3,4,5,6,7,8);
	$time= array('8:00-8:45', '8:50-8:35', '9:45-10:30', '10:45-11:30', '11:40-12:25', '12:30-13:15', '13:30-14:15', '14:20-15:05');
	
	$this->tpl->assign('number', $number);
	$this->tpl->assign('time', $time);
	$this->tpl->assign('class', $className);
	$this->tpl->assign('monday', $monday);
	$this->tpl->assign('tuesday', $tuesday);
	$this->tpl->assign('wednesday', $wednesday);
	$this->tpl->assign('thursday', $thursday);
	$this->tpl->assign('friday', $friday);
	
	$this->tpl->display('timetable.tpl');
	}
 
 	 /**
  *display marks for student
    *
  */
  function displayMarks($login){
	$this->tpl->assign('login', $_SESSION['zalogowany']);	
	//matematyka
	$matspr=$this->db->getMarks($login, 1, 1);
	$matpd=$this->db->getMarks($login, 1, 2); 
	$matakt=$this->db->getMarks($login, 1, 3); 
	
	//fizyka
	$fizspr=$this->db->getMarks($login, 2, 1);
	$fizpd=$this->db->getMarks($login, 2, 2); 
	$fizakt=$this->db->getMarks($login, 2, 3);
	
	//informatyka
	$infspr=$this->db->getMarks($login, 3, 1);
	$infpd=$this->db->getMarks($login, 3, 2); 
	$infakt=$this->db->getMarks($login, 3, 3); 
	
	//bioogia
	$biospr=$this->db->getMarks($login, 4, 1);
	$biopd=$this->db->getMarks($login, 4, 2); 
	$bioakt=$this->db->getMarks($login, 4, 3); 
	
	//chemia
	$chespr=$this->db->getMarks($login, 5, 1);
	$chepd=$this->db->getMarks($login, 5, 2); 
	$cheakt=$this->db->getMarks($login, 5, 3); 
	
	//geografia
	$geospr=$this->db->getMarks($login, 6, 1);
	$geopd=$this->db->getMarks($login, 6, 2); 
	$geoakt=$this->db->getMarks($login, 6, 3); 
	
	//j. polski
	$polspr=$this->db->getMarks($login, 7, 1);
	$polpd=$this->db->getMarks($login, 7, 2); 
	$polakt=$this->db->getMarks($login, 7, 3); 
	
	//j. angielski
	$angspr=$this->db->getMarks($login, 8, 1);
	$angpd=$this->db->getMarks($login, 8, 2); 
	$angakt=$this->db->getMarks($login, 8, 3); 
	
	//assigment part
	
	$this->tpl->assign('matspr', $matspr);
	$this->tpl->assign('matpd', $matpd);
	$this->tpl->assign('matakt', $matakt);
	
	$this->tpl->assign('fizspr', $fizspr);
	$this->tpl->assign('fizpd', $fizpd);
	$this->tpl->assign('fizakt', $fizakt);
	
	$this->tpl->assign('infspr', $infspr);
	$this->tpl->assign('infpd', $infpd);
	$this->tpl->assign('infakt', $infakt);
	
	$this->tpl->assign('biospr', $biospr);
	$this->tpl->assign('biopd', $biopd);
	$this->tpl->assign('bioakt', $bioakt);
	
	$this->tpl->assign('chespr', $chespr);
	$this->tpl->assign('chepd', $chepd);
	$this->tpl->assign('cheakt', $cheakt);
	
	$this->tpl->assign('geospr', $geospr);
	$this->tpl->assign('geopd', $geopd);
	$this->tpl->assign('geoakt', $geoakt);
	
	$this->tpl->assign('polspr', $polspr);
	$this->tpl->assign('polpd', $polpd);
	$this->tpl->assign('polakt', $polakt);
	
	$this->tpl->assign('angspr', $angspr);
	$this->tpl->assign('angpd', $angpd);
	$this->tpl->assign('angakt', $angakt);
		
	
	$this->tpl->display('marks.tpl'); 
  }
  
  /* ------------------------------------------------------ END ACTIONS SECTION ------------------------------------------------------*/
  
}

?>