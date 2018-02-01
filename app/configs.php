<?
	define('DS', DIRECTORY_SEPARATOR);
	define('ROOT', __DIR__ . DS);
	
	define('SITE_TITLE', "Campuseiro's Mirror");
	define('SITE_URL', 'http://'.$_SERVER['SERVER_NAME'] . '/CampuseirosMirror/');

	#definição de namespaces e diretorios
	define('DIR_PUBLIC', '../public/');
	
	const ROUTE_CONFIG = [
		'site'=> ['views' => ROOT . 'views/template'.DS, 'namespace' => ''],
		'cms' => ['views' => ROOT . 'views/cms'.DS, 'namespace' => 'cms'],
		'painel' => ['views' => ROOT . 'views/cms'.DS, 'namespace' => 'cms'],
		'api' => ['views' => '', 'namespace' => 'api']
	];

	#definições do banco de dados
	const DB_CONFIG = [
		'DB_TYPE' => 'mysql',
		'DB_HOST' => 'localhost',
		'DB_NAME' => 'db_name',
		'DB_USER' => 'root',
		'DB_PASS' => '',
	];
	
	#configurações de localização
	date_default_timezone_set("America/Sao_Paulo");

	#definições de erro do sistema
	ini_set('display_errors', 1);
	ini_set('error_reporting', E_ALL);
	ini_set('log_errors', 1);
	ini_set('error_log', ROOT . 'errors.log');
