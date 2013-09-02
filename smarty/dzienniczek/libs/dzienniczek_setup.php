<?php

define('PARENT_TEMPLATE_DIR', './rodzic/');
define('TEACHER_TEMPLATE_DIR', './nauczyciel/');
define('STUDENT_TEMPLATE_DIR', './uczen/');

require(DZIENNICZEK_DIR . 'libs/dzienniczek.lib.php');
require(SMARTY_DIR . 'Smarty.class.php');

// smarty configuration
class Dzienniczek_Smarty extends Smarty {
    function __construct() {
      parent::__construct();
      $this->setTemplateDir(DZIENNICZEK_DIR . 'templates');
      $this->setCompileDir(DZIENNICZEK_DIR . 'templates_c');
      $this->setConfigDir(DZIENNICZEK_DIR . 'configs');
      $this->setCacheDir(DZIENNICZEK_DIR . 'cache');
    }
}
      
?>