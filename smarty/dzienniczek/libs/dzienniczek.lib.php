<?php

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
      return false; 
    }

    // test if "Password" is empty
    if(strlen($formvars['Password']) == 0) {
      $this->error = 'password_empty';
      return false; 
    }
	// temporary we open password file
	if($fd = fopen("passwords.txt", "r"))	{
		while(!feof($fd)){
			$line = trim(fgets($fd));
			$arr = explode(":", $line);
			if(count($arr) < 2) continue;
				
			if($arr[0] !=$formvars['Login']) {
				continue;
			}
			if($arr[1] ==$formvars['Password']){ 
				// form passed validation
				return true;
			}
		}
		fclose($fd);
	}
	
    // form fail validation
    return false;
  }
  
  function isLogged() {
	return isSet($_SESSION['zalogowany']) ;
  }
  
  function login($formvars) {
	$_SESSION['zalogowany']=$formvars['Login'];
  }
  
  function logout() {
	$message;
	if(!isSet($_SESSION['zalogowany'])) {
		$message="Nie byłeś zalogowany!";
	}
	else{
		unset($_SESSION['zalogowany']);
		$message="Zostałeś pomyślnie wylogowany!";
	}
	session_destroy();
	return $message;
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
	$this->tpl->assign('login', $_SESSION['zalogowany']);
	$this->tpl->display('start.tpl'); 
  }
  
  /**
  * display the start page
  *
  */
  function displayUserData() {
	$this->tpl->assign('login', $_SESSION['zalogowany']);
	$this->tpl->assign('imie', 'karol');
	$this->tpl->assign('nazwisko', 'zurek');
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