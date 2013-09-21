<?php

	class Absence 
	{
		private $date;
		private $lessonNumber;
		private $symbol;
		
		public function __construct($date, $lessonNumber, $symbol)
		{
			$this->date = $date;
			$this->lessonNumber = $lessonNumber;
			$this->symbol = $symbol;
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
		
		public function setSymbol($symbol)
		{
			$this->symbol = $symbol;
		}
		
		public function getSymbol()
		{
			return $this->symbol;
		}
	}

?>