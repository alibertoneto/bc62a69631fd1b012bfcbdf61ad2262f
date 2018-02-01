<?
	namespace Core;
	use Controllers,
		Libs\Helpers\Url;


	class App{
		
		private $url;
		private $controller;
		private $method;
		private $params;

		private function setUrl(){
			$this->url = isset($_GET['url']) ? $_GET['url'] : 'home';
			$this->url = rtrim(filter_var($this->url, FILTER_SANITIZE_URL), '/');
			return $this->url = explode('/', $this->url);
		}

		private function setController(){
			$ctrl = 'Controllers\\' . $this->getRouteConfigs($this->url[0]); 
			$ctrl .= isset($this->url[0]) ? Url::formatController($this->url[0]) : 'home';
			
			$this->url[] = isset($this->url[0]) ? $this->url[0] : 'home';
			class_exists($ctrl) ? $this->controller = new $ctrl($this->url[0]) : $this->error();
			array_shift($this->url);
		}

		private function setMethod(){
			$this->method = isset($this->url[0]) ? Url::formatMethod($this->url[0]) : 'index';
			method_exists($this->controller, $this->method) ? array_shift($this->url) : $this->method = 'index';
			$this->params = !is_null($this->url) ? array_values($this->url) : [];

			call_user_func_array([$this->controller, $this->method], $this->params);
		}

		private function error(){
			$this->controller = new Controllers\Error;
			$this->controller->index();
		}

		public function run(){
			$this->setUrl();
			$this->setController();
			$this->setMethod();
		}


		public function getRouteConfigs($url){

			if (array_key_exists($url, ROUTE_CONFIG)) {

				define('DIR_VIEWS', ROUTE_CONFIG[$url]['views']);
				$namespace = ROUTE_CONFIG[$url]['namespace'];
				array_shift($this->url);
				return $namespace.'\\';
			}

			define('DIR_VIEWS', ROUTE_CONFIG['site']['views']);
			return '';
		}


	}