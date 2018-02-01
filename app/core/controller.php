<?
	namespace Core;
	use Models,
		\Libs\Helpers\Session;

	/**
	* 
	*/
	
	class Controller{
		
		protected $data;

		public function __construct($name = null){
			$this->view = new View;

			$model = 'models\\'.$name;
			if (class_exists($model)) {
				$this->model = new $model;
			}

			$this->setHeaderCMS();
			$this->setHeader();
		}

		public function setHeaderCMS(){
			$this->data['config']['user'] = Session::get('user');
		}

		//set data header and footers template.
		public function setHeader(){
			return $this->data['config']['header'] = 'tudo do header do site vem aqui';
		}

		public function setFooter(){}
	}