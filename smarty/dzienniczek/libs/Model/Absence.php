<?php

	class Absence 
	{
		private $date;
		private $lessonNumber;
		
		public function __construct($date, $lessonNumber)
		{
			$this->date = $date;
			$this->lessonNumber = $lessonNumber;
		}
		
		public function setDate($date)
		{
			$this->date = $date;
		}
		
		public function getDate()
		{
			return $this->date;
		}
		
		public function setLessonNumber($lessonNumber)
		{
			$this->lessonNumber = $lessonNumber;
		}
		
		public function getLessonNumber()
		{
			return $this->lessonNumber;
		}
	}

?>