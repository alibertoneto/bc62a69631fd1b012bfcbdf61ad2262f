<?
	//configs application
	include_once('app/configs.php');

	//prepare path
	include_once('app/libs/helpers/dir.php');
	use \Libs\Helpers\Dir;

	spl_autoload_register(function($class){
		$file = Dir::prepare(ROOT . $class . '.php');
		
		if (file_exists($file))
			include_once $file;
	});

	$app = new Core\App;
	$app->run();