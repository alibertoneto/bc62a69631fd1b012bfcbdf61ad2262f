<?
	namespace Models;
	use Core\Model,
		Libs\Helpers\Sanitize,
		Libs\Helpers\Input;

	/**
	* 
	*/
	class Noticias extends Model{

		protected $table = 'tb_news';


		public function selectAll($fields = '*', $where = null, $limit = null){

			//define fields
			$fields = [
				['table' => 'tb_news', $fields],
				['table' => 'tb_user', 'name' => 'name_user'],
				['table' => 'tb_category', 'title' => 'title_category']
			];

			if (!is_null($where)) {

				return $this->db->select($fields)->
							join('tb_user', ['tb_news.user', '=', 'tb_user.id'])->
							join('tb_category', ['tb_news.category', '=','tb_category.id'])->
							where($where)->
							orderBy('tb_news.order_by', 'asc')->
							exec();
			}
			
			return $this->db->select($fields)->
							join('tb_user', ['tb_news.user', '=', 'tb_user.id'])->
							join('tb_category', ['tb_news.category', '=','tb_category.id'])->
							orderBy('tb_news.order_by', 'asc')->
							limit($limit)->
							exec();
		}


		public function edit($items){

			$allowed = Input::post('status');

			if ($allowed) {

				//def data in array
				parse_str($items, $data);

				//def id
				$id = $data['id'];
				unset($data['id']);


				//view
				if(isset($data['view']) &&  $data['view'] == 'on'){$data['view'] = 1;}else{ $data['view'] = 0; }

				//data
				$data['title'] = addslashes($data['title']);
				$data['subtitle'] = addslashes($data['subtitle']);
				$data['text'] = addslashes($data['text']);

				//update
				$this->db->update($data)->where(['id' => $id])->exec('none');

				echo json_encode(['error' => 0, 'msg' => 'Registro Editado com sucesso!']);
				return;
			}

			echo json_encode(['error' => 1,'msg' => 'Não permitido.']);
			return;
		}


		public function draft(){

			$allowed = Input::post('status');

			if ($allowed) {

				$items = input::post('data');

				//def data in array
				parse_str($items, $data);

				//def id
				$id = $data['id'];
				$data['active'] = input::post('active');
				unset($data['id']);
				
				//view
				if(isset($data['view']) &&  $data['view'] == 'on'){$data['view'] = 1;}else{ $data['view'] = 0; }
				
				//data
				$data['title'] = addslashes($data['title']);
				$data['subtitle'] = addslashes($data['subtitle']);
				$data['text'] = addslashes($data['text']);

				//update
				$a = $this->db->update($data)->where(['id' => $id])->exec('none');
				$b = $this->db->select('date')->where(['id' => $id])->exec('first');
				
				echo json_encode(['error' => 0, 'msg' => 'Seu registro foi guardado como rascunho. Obs: (Registros setados como rascunho não são visiveis.)', 'date' => $b['date']]);
				return;

			}

			echo json_encode(['error' => 1,'msg' => 'Não permitido.']);
			return;
		}



	}