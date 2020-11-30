
<?php
date_default_timezone_set("America/Phoenix");

class M_entrevistados extends CI_Model{

function __construct() {
	$this->load->database(); 


 }

public function add(){
	   	$data_insertar = $this->input->post();
	   	unset($data_insertar['btn_guardar']);
	   	$this->db->insert('ENTREVISTADOS', $data_insertar);
	   	return $this -> db -> insert_id();
	
	}
	public function get_todos($data){


		$no_control = $data['no_control'];


			$query = $this->db->query("SELECT * FROM ENTREVISTADOS WHERE numero_control = '$no_control' ;");

   		return $query -> result();
	}
}
