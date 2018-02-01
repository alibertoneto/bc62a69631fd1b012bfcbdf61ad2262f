<?
	namespace Controllers;
	use Core;

	class Home extends Core\Controller{
		
		function index(){

			// add tag header
			$assets = [
				'js' => [
					'http://malsup.github.com/jquery.cycle2.js'
				],
                "css" => [
                    "public/css/home.css"
                ]
			];

			$data['config']['assets'] = $this->view->setAssets($assets);

			// RENDER PAGE HTML 
			$this->view->render('home/index', $data);
		}

	}