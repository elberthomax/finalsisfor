<?php
class sisfor_model extends CI_Model{
	public function read(){
		$this->db->select("*");
		$this->db->from("company");
		$query = $this->db->get()->result_array();
		return $query;
	}

	public function add($data){
		$this->db->insert("company", $data);
	}
	
	public function update($data, $id){
		$where = array("id" => $id);
		$this->db->update("company", $data, $where);
	}
	public function delete($id){
		$where = array("id" => $id);
		$this->db->delete("company",$where);
	}
}
?>