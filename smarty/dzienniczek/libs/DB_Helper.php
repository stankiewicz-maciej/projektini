<?php
include('DB_Consts.php');

class DB_Helper {

	// ONLY FOR DEVELOPMENT PHASE!

	var $DB_VERSION = 20;

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

	function getLogin($id, $parentId){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='select login from students where name=\''.$id.'\' and parent_id=\''.$parentId.'\';';
		$rs=pg_query($con, $query);
		$result=pg_fetch_row($rs);
		return $result;}
		
	
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

	function getTeacherPlan($id, $day){
		$con = pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query= 'SELECT t.lesson_id, c.class_descr from classes c, timetable t, teachers tr, teaching tea where tea.teacher_id ='.$id.' and t.day_id ='.$day.' and t.class_id = c.class_id and tea.class_id = c.class_id and tea.class_id= t.class_id and tea.subject_id=t.subject_id and tr.teacher_id=tea.teacher_id order by t.lesson_id;';
		$rs=pg_query($con, $query);
		$index=0;
		$list[0]='1';
		$list[1]=' ';
		$list[2]='2';
		$list[3]=' ';
		$list[4]='3';
		$list[5]=' ';
		$list[6]='4';
		$list[7]=' ';
		$list[8]='5';
		$list[9]=' ';
		$list[10]='6';
		$list[11]=' ';
		$list[12]='7';
		$list[13]=' ';
		$list[14]='8';
		$list[15]=' ';
		
		while($result=pg_fetch_row($rs)){
			if($result[0]=='1'){
				$list[1]=$result[1];}
			elseif($result[0]=='2'){
				$list[3]=$result[1];}
			elseif($result[0]=='3'){
				$list[5]=$result[1];}
			elseif($result[0]=='4'){
				$list[7]=$result[1];}
			elseif($result[0]=='5'){
				$list[9]=$result[1];}
			elseif($result[0]=='6'){
				$list[11]=$result[1];}
			elseif($result[0]=='7'){
				$list[13]=$result[1];}
			elseif($result[0]=='8'){
				$list[15]=$result[1];}
			}
		return $list;
		
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
	
	function getFullNews($classId){
		$now=date("Y-m-d");
	
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT name, description, date_start, date_end  FROM   events WHERE  date_start <= \''.$now. '\' AND  date_end   >= \''.$now.'\' AND class_id=\''.$classId.'\';';
	
		$rs=pg_query($con, $query);

		pg_close($con);
		return $rs;
	}
	
	
	function getHomeworks($classId){
	$now=date("Y-m-d");
	
	$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
	$query='SELECT subject_id, description, date_end  FROM   homeworks WHERE  date_start <= \''.$now. '\' AND  date_end   >= \''.$now.'\' AND class_id=\''.$classId.'\';';
	
	$rs1=pg_query($con, $query);
	$index=0;
	while($result=pg_fetch_row($rs1)){
		$work[$index]=$this->getSubjectName($result[0]);
		$work[$index+1]=$result[1];
		$work[$index+2]=$result[2];
		$work[$index+3]=$this->showDay($result[2]);
		$index+=4;
		}

	return $work;
	}
	
	function getHomeworksBySubject($classId, $subjectId){
		$now=date("Y-m-d");
	
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT description, date_start, date_end  FROM  homeworks WHERE  date_start <= \''.$now. '\' AND  date_end   >= \''.$now.'\' AND class_id=\''.$classId.'\' AND subject_id =\''.$subjectId .'\';';
	
		$rs=pg_query($con, $query);
	
		return $rs;
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
			$day_plan[$i]=' ';}
		pg_close($con);
		return $day_plan;
		}
	
	function getMarks($login, $subject_id, $type_id){
	
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$student_id=$this->getStudentId($login);
		$query='SELECT mark from marks where student_id='.$student_id.' and subject_id='.$subject_id.' and mark_type='.$type_id.';';
		$rs=pg_query($con, $query);
		$i=0;
		$marks[0]='-';
		 while($result=pg_fetch_row($rs)){
		 	$marks[$i]=$result[0];
			$i++;}
		 
		
		 pg_close($con);	
		return $marks;
		}
		
	function getSubjectsByClass($classId)
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT DISTINCT ON (s.subject_id, s.subject_name) s.subject_id, s.subject_name from subjects s, timetable t where class_id ='.$classId.' AND s.subject_id = t.subject_id;';
		$rs=pg_query($con, $query);
		return $rs;
	}
	
	function getMarksBySubject($studentId, $subjectId) 
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT mark_type, mark from marks where student_id ='.$studentId.' AND subject_id ='.$subjectId.' order by mark_type;';
		$rs=pg_query($con, $query);
		return $rs;
	}
	
	function getMarkName($markId)
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT mark_name from marks_types where mark_type='.$markId.';';
		$rs=pg_query($con, $query);
		return $rs;
	}
	
	function getMarksTypes()
	{
		$con= pg_connect("host=$this->dbhost dbname=$this->dbname user=$this->dbuser password=$this->dbpass");
		$query='SELECT mark_type, mark_name from marks_types;';
		$rs=pg_query($con, $query);
		return $rs;
	}
  
}

?>