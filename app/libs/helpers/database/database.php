<?
	namespace Libs\Helpers\Database;
	use PDO,
		Libs\Helpers\Database\Query,
		Libs\Helpers\Database\CRUD;


	class Database{
		use Query;
		protected $pdo;

		function __construct($table = null){
			$this->table = $table;
			
			try {
				$this->pdo = new PDO(DB_CONFIG['DB_TYPE'] . ':dbhost=' . DB_CONFIG['DB_HOST'] . ';dbname=' . DB_CONFIG['DB_NAME'], DB_CONFIG['DB_USER'], DB_CONFIG['DB_PASS']);
				$this->pdo->exec("SET NAMES 'utf-8';");
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
			} catch(PDOException $e) {
				error_log($e->getMessage());
				$error = new Error;
				$error->index();
				die();
			}
		}

	}