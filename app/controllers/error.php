<?
	namespace Controllers;
	use Core;

	class Error extends Core\Controller{
		
		function index(){

			/*DEF TITLES AND CSS STYLE */
			$data['config']['title'] = 'Colégio SOLAR - #404, Página não encontrada ou não existe.';
			$data['config']['assets'] = $this->view->setAssets(['css'=>['public/css/pages.css']]);
			
			/* RENDER PAGE HTML */
			$this->view->render('error/index', $data);
		}
	}