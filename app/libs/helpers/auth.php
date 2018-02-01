<?
	namespace Libs\Helpers;
	use Libs\Helpers\Database\Database as Db,
		Libs\Helpers\Hash as Hash,
		Libs\Helpers\Session as Session;

	/**
	* 
	*/
	class Auth{
		
		public static function auth($where, $pass, $table = 'tb_user'){

			$auth = self::setDb($table)->select()->where($where)->exec();
			if (!empty($auth) && Hash::check($pass, $auth[0]['password'])) {
				Session::init();
				Session::set('user', $auth[0]);
				
				return true;
			}

			return false;
		}

		public static function isAuth($key){
			Session::init();

			if (isset($_SESSION[$key])) {
				return true;
			}

			return false;
		}

		public static function logout($key){
			Session::init();
			return Session::delete($key);
		}

		private static function setDb($table){
			return new Db($table);
		}
	}

