<?
	namespace Controllers;
	use Core;

	class Edition extends Core\Controller{
		
		function index(){

			// add tag header
			$assets = [
				'js' => [
					//'http://malsup.github.com/jquery.cycle2.js',
                    "https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular.min.js",
                    "public/js/service/atividades.js",
                    "public/js/app/atividades.js",
				],
                "css" => [
                    "public/css/home.css",
                    "public/css/pages.css"
                ]
			];

			$data['config']['assets'] = $this->view->setAssets($assets);

			// RENDER PAGE HTML 
			$this->view->render('edition/index', $data);
		}

	}