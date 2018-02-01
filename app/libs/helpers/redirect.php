<?
	namespace Libs\Helpers;

	/**
	* re
	*/
	class Redirect{
		
		public static function to($path = null){
			$redirect = (!is_null($path)) ? $path : 'home';
			return header('location: '. SITE_URL .$redirect);
		}

	}