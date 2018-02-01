<?
	namespace Core;
	use Libs\Helpers\Dir;

	class View{
		
		public function render($view, $data = null){
			include_once Dir::prepare(DIR_VIEWS . 'header.phtml');
			include_once Dir::prepare(DIR_VIEWS . 'pages/' . $view . '.phtml');
			include_once Dir::prepare(DIR_VIEWS . 'footer.phtml');
		}

		public function setAssets(array $data){

			$cssModel = "<link rel='stylesheet' href='{{link}}' media='all'/>\n";
        	$jsModel = "<script src='{{link}}'></script>\n";
        	$code = '';

        	foreach ($data as $key => $value) {
				foreach ($data[$key] as $v) {

					$code .= str_replace('{{link}}', $v, ${$key . 'Model'});
				}
        	}

        	return $code;
		}
	}