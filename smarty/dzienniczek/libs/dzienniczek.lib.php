<?php
include('DB_Helper.php');
include('Model/User.php');
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
		if($row[0] !=$formvars['Login']) {
			continue;
		}
		if($row[1] ==$formvars['Password']){ 
			// form passed validation
			return $selected_user_type;
		}
	}
	
    // form fail validation
    return User::$TYPE_NULL;
  }
  
  function isLogged() {
	return isSet($_SESSION['zalogowany']) ;
  }
  
  function login($formvars, $user_type) {
	$_SESSION['zalogowany']=$formvars['Login'];
	$_SESSION['user_type']=$user_type;
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
  /* ------------------------------------------------------ END ACTIONS SECTION ------------------------------------------------------*/
  
}

?>