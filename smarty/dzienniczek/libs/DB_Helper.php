<?php
include('DB_Consts.php');

class DB_Helper {

	// ONLY FOR DEVELOPMENT PHASE!
	var $DB_VERSION = 11;
	var $DB_CREATE_SCRIPT = 'database_create.txt';
	var $DB_DROP_SCRIPT = 'database_drop.txt';

	/* set database settings here! */
	// PDO database name
	var $dbname = "projektini";
	// PDO database host
	var $dbhost = "localhost";
	// PDO database username
	var $dbuser = "projektini_usr";
	// PDO database password
	var $dbpass = "projektini_pass";

	function __construct() {
		ini_set('auto_detect_line_endings',true);
	}
	
	function initDB($createFileName) {
		$this->loadFileScript($createFileName);
	}
	
	function isDatabaseActual() {
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$rs = pg_query($con, "SELECT relname FROM pg_stat_user_tables ORDER BY relname") or die("Cannot execute query:");
		$found = false;
		while ($row = pg_fetch_array($rs)) {
			if($row[0] == 'version') {
				$found = true;
			}
		}
		if($found)
		{
			$rs = pg_query($con, "SELECT dbversion FROM version") or die("Cannot execute query:");
			$row = pg_fetch_row($rs);
			$dbversion = $row[0];
			if($dbversion != $this->DB_VERSION) {
				$this->loadNewDatabase($this->DB_CREATE_SCRIPT, $this->DB_DROP_SCRIPT);
			}
		} else {
			$this->initDB($this->DB_CREATE_SCRIPT);
		}
		//pg_close($con);
	}
	
	function loadNewDatabase($createFileName, $dropFileName) {
		$this->loadFileScript($dropFileName);
		$this->loadFileScript($createFileName);
	}
	
	function loadFileScript($fileName) {
		if(file_exists($fileName)) {
			$this->con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
			$file = fopen($fileName,'r');
			while(!feof($file)) { 
				$query = fgets($file);
				if(trim($query) != ''){
					$rs = pg_query($this->con, $query) or die("Cannot execute query: $query\n");
				}
			}
			fclose($file);
			pg_close($this->con);
		}
	}
	
	function getUserCredentials($userType) {
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		if($userType == 'student') {
			$rs = pg_query($con, DB_Consts::$GET_STUDENT_CREDENTIALS) or die("Cannot execute query:");
		} else if($userType == 'parent') {
			$rs = pg_query($con, DB_Consts::$GET_PARENT_CREDENTIALS) or die("Cannot execute query:");
		} else if($userType == 'teacher') {
			$rs = pg_query($con, DB_Consts::$GET_TEACHER_CREDENTIALS) or die("Cannot execute query:");
		} 
		pg_close($con);
		return $rs;
	}

	function getChildrens($parentId) {
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query=DB_Consts::$GET_PARENTS_CHILDREN. $parentId. ';';
			$rs=pg_query($con, $query);
			while($tmp=pg_fetch_row($rs)){
				$children["$tmp[0]"]="$tmp[1]";}
			 return $children;
	}
	function getChildName($studentId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query=DB_Consts::$GET_STUDENT_NAME. $studentId. ';';
		$rs=pg_query($con, $query);
		$name=pg_fetch_row($rs);
		return $name;
		}
		
	function getTeachersList(){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		//$children_names=pg_query( select name from student where parentid=costam
			$teachers_list=array("Adam", "Adam", "polski", "Ewa", "Bryła", "matematyka", "Karol", "Burek", "angielski", "Bartłomiej", "Szysz", "W-F","Adam", "Adam", "polski", "Ewa", "Bryła", "matematyka", "Karol", "Burek", "angielski", "Bartłomiej", "Szysz", "W-F","Adam", "Adam", "polski", "Ewa", "Bryła", "matematyka", "Karol", "Burek", "angielski", "Bartłomiej", "Szysz", "W-F");
			return $teachers_list;
	}
	function getTeachingList($teacherId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_TEACHING . $teacherId . ';';
		$teaching = pg_query($con, $query ) or die("Cannot execute query:");
		return $teaching;
	}
	
	function getSubjectName($subjectId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_SUBJECT_NAME . $subjectId . ';';
		$rs = pg_query($con, $query );
		$row = pg_fetch_array($rs);
		$subjectName = $row[0];
		return $subjectName;
	}
	
	function getClassName($classId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_CLASS_NAME . $classId . ';';
		$rs = pg_query($con, $query );
		$row = pg_fetch_array($rs);
		$className = $row[0];
		return $className;
	}

	function getMarksForClass($classId) {

	}

	function getMarksForStudent($studentId) {

	}

	function getUserData($login, $type) {
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		if($type == User::$TYPE_STUDENT)
		{
			$query = DB_Consts::$GET_STUDENT_DATA;
		} 
		else if ($type == User::$TYPE_PARENT)
		{
			$query = DB_Consts::$GET_PARENT_DATA;
		}
		else 
		{
			$query = DB_Consts::$GET_TEACHER_DATA;
		}
		$query .= $login . '\';';

		$rs=pg_query($con, $query);
		
		return $rs;
	}
  
}

?>