<?php
include('DB_Consts.php');

class DB_Helper {

	// ONLY FOR DEVELOPMENT PHASE!

	var $DB_VERSION = 17;

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
			pg_close($con);
			 return $children;
	}
	function getChildName($studentId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query=DB_Consts::$GET_STUDENT_NAME. $studentId. '\';';
		$rs=pg_query($con, $query);
		$name ='Brak Imienia';
		if($rs != FALSE) {
			$row=pg_fetch_row($rs);
			$name = $row[0];
		}
		pg_close($con);
		return $name;
		}
		
	function getTeachersList(){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_TEACHER_VIEW;
		$rs=pg_query($con, $query);
		$tmp=0;
		while($result = pg_fetch_row($rs)){
			$teachers_list[$tmp]=$result[0];
			$teachers_list[$tmp+1]=$result[1];
			$teachers_list[$tmp+2]=$result[2];
			$teachers_list[$tmp+3]=$result[3];
			$tmp+=4;
		}
			pg_close($con);
			return $teachers_list;
	}
	function getTeachingList($teacherId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_TEACHING . $teacherId . ';';
		$teaching = pg_query($con, $query ) or die("Cannot execute query:");
		pg_close($con);
		return $teaching;
	}
	
	function getSubjectName($subjectId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_SUBJECT_NAME . $subjectId . ';';
		$rs = pg_query($con, $query );
		$row = pg_fetch_array($rs);
		$subjectName = $row[0];
		pg_close($con);
		return $subjectName;
	}
	
	function getClassName($classId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_CLASS_NAME . $classId . ';';
		$rs = pg_query($con, $query );
		$row = pg_fetch_array($rs);
		$className = $row[0];
		pg_close($con);
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
		pg_close($con);
		return $rs;
	}

	function getClassId($login){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_CLASS_ID . $login . '\';';
		$rs = pg_query($con, $query );
		$row = pg_fetch_array($rs);
		$classId = $row[0];
		pg_close($con);
		return $classId;
	}
	function getNews($classId){
	$now=date("Y-m-d");
	
	$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
	$query='SELECT name, description  FROM   events WHERE  date_start <= \''.$now. '\' AND  date_end   >= \''.$now.'\' AND class_id=\''.$classId.'\';';
	
	$rs1=pg_query($con, $query);
	$index=0;
	while($result=pg_fetch_row($rs1)){
		$events[$index]=$result[0];
		$events[$index+1]=$result[1];
		$index+=2;
		}
		pg_close($con);
	return $events;
	}
	
	
	function getHomeworks($classId){
	$now=date("Y-m-d");
	
	$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
	$query='SELECT subject, description, date_end  FROM   homeworks WHERE  date_start <= \''.$now. '\' AND  date_end   >= \''.$now.'\' AND class_id=\''.$classId.'\';';
	
	$rs1=pg_query($con, $query);
	$index=0;
	while($result=pg_fetch_row($rs1)){
		$work[$index]=$result[0];
		$work[$index+1]=$result[1];
		$work[$index+2]=$result[2];
		$work[$index+3]=$this->showDay($result[2]);
		$index+=4;
		}
		pg_close($con);
	return $work;
	}
	function getStudentId($login){
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = DB_Consts::$GET_STUDENT_ID . $login.'\';';
		$rs =pg_query($query);
		$result=pg_fetch_row($rs);
		
		return $result['0'];
	}
	
	function getAbsences($id){
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT abs_date, lesson_number  FROM absence WHERE student_id=\''.$id.'\';';
		
		$rs1=pg_query($con, $query);
		$index=0;
		$absence[0]="Brak nieobecności";
		$absence[1]=" ";
		while($result=pg_fetch_row($rs1)){
			$absence[$index]=$result[0];
			$absence[$index+1]=$this->showDay($result[0]);
			$absence[$index+2]=$result[1];
			$index+=3;}
			
		pg_close($con);
		return $absence;
	}
	
	 function showDay($data){
			$day = date("l",strtotime($data)); 
	switch($day){
		case 'Monday':
			return 'Poniedziałek';
		break;
	
		case 'Tuesday':
			return 'Wtorek';
		break;
	
		case 'Wednesday':
			return 'Środa';
		break;
	
		case 'Thursday':
			return 'Czwartek';
		break;
	
		case 'Friday':
			return 'Piątek';
		break;
	
		default;
			return "---";
		break;
}}

	
	function getLessonCount($dayId, $classId)
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = sprintf(DB_Consts::$GET_LESSONS_ON_DAY_COUNT, $classId, $dayId);
		$rs = pg_query($con, $query);
		$lessonCount = 0;
		if($rs != FALSE)
		{
			$row=pg_fetch_row($rs);
			$lessonCount = $row[0];
		}
		return $lessonCount;
	}
	
	function getAbsencesByDay($studentId, $day)
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = sprintf(DB_Consts::$GET_STUDENT_ABSENCES, $studentId, $day);
		$rs = pg_query($con, $query);
		
		return $rs;
	}
	
	function getStudentsByClass($classId)
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query = sprintf(DB_Consts::$GET_STUDENTS_BY_CLASS, $classId);
		$rs = pg_query($con, $query);
		
		return $rs;

	}
	function getTimetable($classId, $day){
		
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT s.subject_name from subjects s, timetable t where class_id ='.$classId.' AND t.day_id ='.$day.' AND s.subject_id = t.subject_id order by lesson_id;';
		$rs=pg_query($con, $query);
		$index=0;
		while($result=pg_fetch_row($rs)){
			$day_plan[$index]=$result[0];
			$index++;
		}
		for($i=$index; $i<8; $i++){
			$day_plan[$i]='---';}
		pg_close($con);
		return $day_plan;
		}
  
}

?>