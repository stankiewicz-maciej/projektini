<?php

	class DB_Consts
	{
		static $TABLE_STUDENTS = "students";
		static $TABLE_PARENTS = "parents";
		static $TABLE_TEACHERS = "teachers";
		
		static $COLUMN_LOGIN = "login";
		
		static $GET_STUDENT_CREDENTIALS = "SELECT stud_id, login, password FROM students";
		static $GET_PARENT_CREDENTIALS = "SELECT parent_id, login, password FROM parents";
		static $GET_TEACHER_CREDENTIALS = "SELECT teacher_id, login, password FROM teachers";
		
		static $GET_STUDENT_DATA = 'SELECT * from students where login=\'';
		static $GET_PARENT_DATA = 'SELECT * from parents where login=\'';
		static $GET_TEACHER_DATA = 'SELECT * from teachers where login=\'';
		
		static $GET_TEACHING = 'SELECT subject_id, class_id FROM teaching WHERE teacher_id=';
		static $GET_SUBJECT_NAME = 'SELECT subject_name FROM subjects WHERE subject_id=';
		static $GET_CLASS_NAME = 'SELECT class_descr FROM classes WHERE class_id=';
		static $GET_PARENTS_CHILDREN = 'SELECT login, name FROM students WHERE parent_id=';
		static $GET_STUDENT_NAME = 'select name FROM students WHERE login=\'';

		static $GET_TEACHER_VIEW = 'SELECT surname, name, email, tel FROM teachers ORDER BY surname;';
		static $GET_CLASS_ID = 'SELECT class_id FROM students WHERE login=\'';
		static $GET_STUDENT_ID = 'SELECT stud_id FROM students WHERE login=\'';

		static $GET_LESSONS_ON_DAY_COUNT = 'SELECT count(*) FROM timetable WHERE class_id=%u AND day_id=%u;';
		static $GET_STUDENT_ABSENCES = 'SELECT lesson_number FROM absence WHERE student_id=%u AND abs_date=\'%s\'::timestamp without time zone;';
		static $GET_STUDENTS_BY_CLASS = 'SELECT stud_id, name, surname FROM students WHERE class_id=%u;';
		static $GET_DAYS_LESSONS= 'SELECT ';

		
		static $SELECT_ALL = "SELECT * FROM ";
		
	}

?>