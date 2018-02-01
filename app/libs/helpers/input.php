<?
	namespace Libs\Helpers;

	/**
	* 
	*/
	class Input{

		public static function get($get){
			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET[$get])) {
				return $_GET[$get];
			}
		}

		public static function post($post){
			if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
				return $_POST[$post];
			}
		}
	}