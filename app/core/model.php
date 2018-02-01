<?
	namespace Core;
	use Libs\Helpers\Database\Database,
		Libs\Helpers\Database\Query,
		Libs\Helpers\Input,
		Libs\Helpers\Session;

	class Model extends Database{

		function __construct(){
			$this->db = new Database($this->table);
			return $this->db;
		}

		public function add($data = array('')){
			$allowed = Input::post('status');

			if ($allowed) {
				echo json_encode(['error' => 0, 'id' => $this->db->insert($data)]);
				return;
			}

			echo json_encode(['error' => 1,'msg' => 'Não permitido.']);
			return;
		}

		public function deleteModel($data){
			$allowed = Input::post('status');

			if ($allowed) {
				$this->db->delete()->where($data)->exec('none');
				echo json_encode(['error' => 0, 'msg' => 'Registro Deletado com Sucesso!']);
				return;
			}

			echo json_encode(['error' => 1,'msg' => 'Não permitido.']);
			return;

		}


	}