<?
	namespace Libs\Helpers;
	use Libs\Helpers\Sanitize;
	/**
	* 
	*/

	class Hash{
		public static function create($str){
			return password_hash(Sanitize::string($str), PASSWORD_BCRYPT, ['cost' => 10]);
		}

		public static function check($str, $hash){
			return password_verify(Sanitize::string($str), $hash);
		}

		public static function randMd5(){
			return md5(uniqid(rand(), true));
		}

		public static function rand($size = 10, $number = true, $letter = true){

			$letters = array("A","B","C","D","E","F","G","H","I","J","K","L","M","N","O","P","Q","R","S","U","V","W","X","Y","Z");
			$numbers = array(1,2,3,4,5,6,7,8,9,0);

			if ($number == true && $letter == true) {
				$character = array_merge($letters, $numbers);
			}else if($number == true && $letter == false){
				$character = $numbers;
			}else if($number == false && $letter == true){
				$character = $letters;
			}

	        $data = '';
	        
	        for($i=0; $i<$size; $i++){
	            $rand = rand(0, count($character) - 1 );
	            $data .= $character[$rand];
	        }

	        return $data;
		}
	}