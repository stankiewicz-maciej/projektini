<?php
	class StudentMark
	{
		private $userId;
		private $userName;
		private $userSurname;
		private $marks;
		
		public function __construct()
		{
			$marks = array();
		}
		
		public function getStudentId()
		{
			return $this->userId;
		}
		
		public function setStudentId($userId)
		{
			$this->userId = $userId;
		}
		
		public function getStudentName()
		{
			return $this->userName;
		}
		
		public function setStudentName($userName)
		{
			$this->userName = $userName;
		}
		
		public function getStudentSurname()
		{
			return $this->userSurname;
		}
		
		public function setStudentSurname($surname)
		{
			$this->userSurname = $surname;
		}
		
		public function getMarks()
		{
			return $this->marks;
		}
		
		public function setMarks($marks)
		{
			$this->marks = $marks;
		}
	}