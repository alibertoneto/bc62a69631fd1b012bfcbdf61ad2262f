<?
	namespace Libs\Helpers;
	class Session{

		public static function init(){
			if(empty(session_id())){
				session_start();
				session_regenerate_id();
			}
		}

		public static function set($key, $value){
			$_SESSION[$key] = $value;
		}

		public static function get($key){
			self::init();
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			}
			return false;
		}

		public static function delete($key){

			if (isset($_SESSION[$key])) {
			
				unset($_SESSION[$key]);
				session_destroy();
				return true;
			}

			return false;
		}
	}