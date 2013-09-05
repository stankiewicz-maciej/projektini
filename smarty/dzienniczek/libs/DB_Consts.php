<?php

class DB_Consts
{
	static $GET_STUDENT_CREDENTIALS = "SELECT login, password FROM students";
	static $GET_PARENT_CREDENTIALS = "SELECT login, password FROM parents";
	static $GET_TEACHER_CREDENTIALS = "SELECT login, password FROM teachers";
}

?>