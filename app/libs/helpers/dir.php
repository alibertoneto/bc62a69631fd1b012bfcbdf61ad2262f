<?
	namespace Libs\Helpers;

	class Dir{

		//return path files formated
		public static function prepare($path){
			return str_replace('\\', '/', strtolower($path));
		}
		
	}