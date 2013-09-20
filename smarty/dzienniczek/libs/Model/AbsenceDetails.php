<?php

	class AbsenceDetails 
	{
		private $userId;
		private $userName;
		private $userSurname;
		private $absences;
		
		public function __construct()
		{
			$absences = array();
		}
		
		public function getUserId()
		{
			return $this->userId;
		}
		
		public function setUserId($userId)
		{
			$this->userId = $userId;
		}
		
		public function getUserName()
		{
			return $this->userName;
		}
		
		public function setUserName($userName)
		{
			$this->userName = $userName;
		}
		
		public function getUserSurname()
		{
			return $this->userSurname;
		}
		
		public function setUserSurname($surname)
		{
			$this->userSurname = $surname;
		}
		
		public function getAbsences()
		{
			return $this->absences;
		}
		
		public function setAbscences($absences)
		{
			$this->absences = $absences;
		}
	}

?>