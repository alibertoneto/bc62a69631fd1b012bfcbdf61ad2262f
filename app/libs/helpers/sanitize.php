<?
	namespace Libs\Helpers;

	Class Sanitize{

		public static function int($data){
			return (int) filter_var(trim($data), FILTER_SANITIZE_NUMBER_INT);
		}

		public static function string($data){
			return (string) filter_var(trim($data), FILTER_SANITIZE_STRING);
		}

		public static function email($data){
			return (string) filter_var(trim($data), FILTER_SANITIZE_EMAIL);
		}
		
	}