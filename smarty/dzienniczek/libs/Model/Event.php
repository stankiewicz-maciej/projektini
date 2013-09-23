<?php

	class Event
	{
		private $startDate;
		private $endDate;
		private $name;
		private $description;
		
		public function __construct()
		{
			
		}
		
		public function setStartDate($date)
		{
			$this->startDate = $date;
		}
		
		public function getStartDate()
		{
			return $this->startDate;
		}
		
		public function setEndDate($date)
		{
			$this->endDate = $date;
		}
		
		public function getEndDate()
		{
			return $this->endDate;
		}
		
		public function setName($name)
		{
			$this->name = $name;
		}
		
		public function getName()
		{
			return $this->name;
		}
		
		public function setDescription($description)
		{
			$this->description = $description;
		}
		
		public function getDescription()
		{
			return $this->description;
		}
	}

?>