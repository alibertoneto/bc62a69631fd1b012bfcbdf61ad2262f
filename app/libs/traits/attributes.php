<?
	namespace Libs\Traits;

	/**
	* 
	*/
	trait Attributes{
		
		protected $data = array();

		public function __set($key, $value){
			$this->data[$key] = $value;
		}

		public function __get($key){
			return $this->data[$key];
		}

		public function getAttributes(){
			return dump($data);
		}

	}

