<?php
	class Mark
	{
		private $id;
		private $mark;
		private $name;
		
		public function __construct($id,$mark, $name)
		{
			$this->id = $id;
			$this->name = $name;
			$this->mark = $mark;
		}
		
		public function setId($id)
		{
			$this->id = $id;
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function setMark($mark)
		{
			$this->mark = $mark;
		}
		
		public function getMark()
		{
			return $this->mark;
		}
		
		public function setName($name)
		{
			$this->name = $name;
		}
		
		public function getName()
		{
			return $this->name;
		}
	}
?>