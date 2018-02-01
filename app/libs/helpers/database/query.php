<?
	namespace Libs\Helpers\Database;

	/**
	* 
	*/
	trait Query{

		protected $sql = null;

		#insert into table
		public function insert($data = null){
			if(isset($data) && !is_null($data)){

		        $keys 	= implode(", ", array_keys($data));
				$values = ':' . implode(', :', array_keys($data));

				$sql = 'INSERT INTO ' . $this->table . " ($keys) VALUES ($values)" ;
				$pdo = $this->pdo->prepare($sql);

				foreach ($data as $key => $value) {
					$pdo->bindValue(':'.$key, $value);
				}

			}else{
				$sql = 'INSERT INTO ' . $this->table . ' (id) VALUES (:id)';
				$pdo = $this->pdo->prepare($sql);
				$pdo->bindValue(':id', null);
			}

			try {
				$pdo->execute();
				return $this->pdo->lastInsertId();
			} catch (PDOException $e) {
				error_log($e->getMessage());
			}
		}

		#select in table
		public function select($fields = '*'){
			$args = func_get_args();

			$fields = is_array($fields) ? $this->setFields($fields) : $fields;
			$this->sql = 'SELECT ' . $fields . ' FROM ' . $this->table;
			return $this;
		}

		#updat data in table
		public function update($data = array()){
			$this->sql = 'UPDATE ' . $this->table . $this->setDetails($data);
			return $this;
		}

		#delete in table
		public function delete(){
			$this->sql = 'DELETE FROM ' . $this->table;
			return $this;
		}

		#set fields;
		function setFields($fields){
			$str = null;
			for($i=0; $i<count($fields); $i++){

				if(isset($fields[$i]['table'])){
					#get table of array
					$table[] = $fields[$i]['table'];

					#remove table of array
					array_shift($fields[$i]);
				}else{
					$table[] = $this->table;
				}

				#received keys and add alias
				foreach ($fields[$i] as $key => $value) {
					$str .= !is_int($key) ? "$table[$i].$key AS $value, " : "$table[$i].$value, ";
				}
			}

			$str = rtrim( $str, ', ');
			return $str;
		}

		#set details update in sql;
		public function setDetails($data){
			$set = ' SET ';
			foreach ($data as $key => $value) {
				$set .= $key . ' = ' .':'.$key . ', ';
				$this->data[':'.$key] = is_array($value) ? $value[1] : $value;
			}

			$set = rtrim($set, ', ');
			return $set;
		}

		#add orderby in sql
		public function orderBy($field = 'id', $order = 'desc'){
			$this->sql .= ' ORDER BY ' . $field . ' ' . $order;
			return $this;
		}

		#add limit in sql
		public function limit($limit = null){
			$this->sql .= !is_null($limit) ? ' LIMIT ' . $limit : '' ;
			return $this;
		}

		#add inner joi in table
		public function join($table, $data = array()){
			$this->sql .= ' INNER JOIN ' . $table . ' ON ' . implode(" ", $data);
			return $this;
		}

		#add table in sql
		public function table($table){
			$this->table = $table;
			return $this;
		}

		public function writeSQL(){
			return $this->sql;
		}

		#add where in sql;
		public function where($details = ['']){

			$where = ' WHERE ';
			$i = 0;

			foreach ($details as $key => $value) {
				$i++;
				$k = ':v'.$i;

				$this->data[$k] = is_array($value) ? $value[1] : $value;
				$where .= is_array($value) ?  $key .' '. $value[0] .' '.  $k  .' AND ' : $key .' = '. $k . ' AND ' ;
			}

			$where = rtrim($where, ' AND ');
			$this->sql .= $where;
			
			return $this;
		}

		#execute sql;
		public function exec($mode = 'all'){
			try {

				$pdo = $this->pdo->prepare($this->sql);
				if(isset($this->data) && is_array($this->data) && !is_null($this->data)){
					foreach ($this->data as $key => $value) {
						$pdo->bindValue($key,$value);
					}
				}

				$pdo->execute();

				$this->sql = null;
				$this->data = null;

				switch ($mode) {
					case 'all':
						return $pdo->fetchAll();
						break;
					case 'first':
						return $pdo->fetch();
						break;
					case 'count':
						return $pdo->rowCount();
						break;
					case 'none':
						return;
						break;
				}

			} catch (PDOException $e) {
				echo $e->getMessage();
			}
		}
	}