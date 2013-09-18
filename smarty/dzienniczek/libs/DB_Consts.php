<?php

	class DB_Consts
	{
		static $TABLE_STUDENTS = "students";
		static $TABLE_PARENTS = "parents";
		static $TABLE_TEACHERS = "teachers";
		
		static $COLUMN_LOGIN = "login";
		
		static $GET_STUDENT_CREDENTIALS = "SELECT tid, login, password FROM students";
		static $GET_PARENT_CREDENTIALS = "SELECT tid, login, password FROM parents";
		static $GET_TEACHER_CREDENTIALS = "SELECT tid, login, password FROM teachers";
		
		static $GET_STUDENT_DATA = 'SELECT * from students where login=\'';
		static $GET_PARENT_DATA = 'SELECT * from parents where login=\'';
		static $GET_TEACHER_DATA = 'SELECT * from teachers where login=\'';
		
		static $SELECT_ALL = "SELECT * FROM ";
		
	}

?>