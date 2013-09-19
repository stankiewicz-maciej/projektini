<?php
	class Education {
		private $subjectId;
		private $classId;
		
		private $subjectName;
		private $className;
		
		public function __construct($subjectId, $classId, $subjectName, $className)
		{
			$this->subjectId = $subjectId;
			$this->classId = $classId;
			$this->subjectName = $subjectName;
			$this->className = $className;
		}
		
		public function setSubjectId($subjectId)
		{
			$this->subjecId = $subjectId;
		}
		
		public function getSubjectId()
		{
			return $this->subjectId;
		}
		
		public function setClassId($classId)
		{
			$this->classId = $classId;
		}
		
		public function getClassId()
		{
			return $this->classId;
		}
		
		public function setSubjectName($subjectName)
		{
			$this->subjectName = $subjectName;
		}
		
		public function getSubjectName()
		{
			return $this->subjectName;
		}
		
		public function setClassName($className)
		{
			$this->className = $className;
		}
		
		public function getClassName()
		{
			return $this->className;
		}
	}
?>