<?
	namespace Libs\Helpers;
	use Libs\Helpers\Sanitize as Sanitize;

	Class Url{
		public static function format($data, $ext= '.html'){
		    $what = array( 'ä','ã','à','á','â','ê','ë','è','é','ï','ì','í','ö','õ','ò','ó','ô','ü','ù','ú','û','À','Á','É','Í','Ó','Ú','ñ','Ñ','ç','Ç','\'',' ','(',')',',',';',':','|','!','"','#','$','%','&','/','=','?','~','^','>','<','ª','º','¨');
		    $by   = array( 'a','a','a','a','a','e','e','e','e','i','i','i','o','o','o','o','o','u','u','u','u','A','A','E','I','O','U','n','n','c','C','','-','','','','','','','','','','','','e','/','','','','','','','','','');
		    $data = strtolower(str_replace($what, $by, $data));

		    $data = str_replace('-----', '-', $data);
		    $data = str_replace('----', '-', $data);
		    $data = str_replace('---', '-', $data);
		    $data = str_replace('--', '-', $data);
		    $data = rtrim( $data, '-');
		    $data = $data . $ext;
		    return $data;
		}

		public static function unFormat($data){
			$data =  str_replace('-', ' ', $data);
			return Sanitize::string($data);
		}

		public static function formatMethod($data){
			$data = self::unFormat($data);
			return Sanitize::string(str_replace(' ', '', lcfirst(ucwords($data))));
		}

		public static function formatController($data){
			$data = self::unFormat($data);
			return Sanitize::string(str_replace(' ', '',  ucwords($data)));
		}

		public static function getId($data, $pos = null){

			if (strripos($data, '/')) {
				$data = explode('/', $data);
				$data = explode('-', is_null($pos) ? end($data) : isset($data[$pos]) ? $data[$pos] : end($data));
				return Sanitize::int($data[0]);
			}

			$data = explode('-', $data);
			return Sanitize::int($data[0]);
		}

		public static function get(){
			return rtrim(SITE_URL, '/') . $_SERVER['REQUEST_URI'];
		}
	}