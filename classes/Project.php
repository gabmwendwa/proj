<?php

class Project{
	private $_db,
			$_data;
	
	public function __construct($project = null, $project_table = null){
		$this->_db = DB::getInstance();
		if($project){
			$this->find($project_table, $project);
		}
		
	}
	
	public function update($table = null, $fields = array(), $id = null){
		if(!$this->_db->update($table, $id, $fields)){
			throw new Exception('<div class="alert alert-danger"><p><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;There was a problem updating. Please try again.</p></div>');
		}
	}
	
	public function create($table = null, $fields = array()){
		if(!$this->_db->insert($table, $fields)){
			throw new Exception('<div class="alert alert-danger"><p><span class="glyphicon glyphicon-exclamation-sign"></span>&nbsp;There was a problem inserting in '.$table.'. Please try again.</p></div>');
		}
	}
	
	public function find($table = null,$project = null, $field = null){
		if($project){
			if(!$field)
				$field = (is_numeric($project)) ? 'id' : 'project_ref';
			$data = $this->_db->get($table, array($field, '=', $project));
			
			if($data->count()){
				$this->_data = $data->first();
				return true;
			}
		}
		return false;
	}

	public function find_all($table = null, $field = null, $value = null){
		$res = [];
		if($value)
			$data = $this->_db->get_all($table, array($field, '=', $value));
		else
			$data = $this->_db->get_all($table, $field);
		
		if($data->count()){
			$this->_data = $data->results();
			
			foreach($this->_data as $row)
			{
				$res[] = $row;
			}
			
			$res  = array_unique($res, SORT_REGULAR);
			return $res;
		}
		return false;
	}

	public function exists(){
		return (!empty($this->_data)) ? true : false;
	}
	
	public function data(){
		return $this->_data;
	}
}

?>