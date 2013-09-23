<?php
	class MarkType
	{
		private $id;
		private $typeName;
		
		public function __construct($id,$typeName)
		{
			$this->id = $id;
			$this->typeName = $typeName;
		}
		
		public function setId($id)
		{
			$this->id = $id;
		}
		
		public function getId()
		{
			return $this->id;
		}
		
		public function setTypeName($typeName)
		{
			$this->typeName = $typeName;
		}
		
		public function getTypeName()
		{
			return $this->typeName;
		}
	}