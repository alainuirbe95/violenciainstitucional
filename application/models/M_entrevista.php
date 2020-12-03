
<?php
date_default_timezone_set("America/Phoenix");

class M_entrevista extends CI_Model{

function __construct() {
	$this->load->database(); 


 }

public function add($data){
	   	print_r($data);

		$respuestas = array_pop($data);
		unset($data['sexo_entrevistado']);
		// print_r($data);
		// print_r($respuestas);
		// print_r($respuestas['1_1']);
		
		$x = $respuestas['1'];
		$_1 = $respuestas['_1'];
		$_2 = $respuestas['_2'];
		$_3 = $respuestas['_3'];

		$no_control = $data['no_control'];
		$id_pregunta = $data['id_pregunta'];


	   $query = $this->db->query("INSERT INTO PREGUNTAS_RESPONDIDAS (id_pregunta, numero_control, _0, _1, _2, _3) VALUES ('$id_pregunta', '$no_control', '$x', '$_1', '$_2', '$_3');");
   		return;
	}

public function get_todos_from_entrevistado($data){


		$no_control = $data['no_control'];


			$query = $this->db->query("SELECT * FROM PREGUNTAS_RESPONDIDAS WHERE numero_control = '$no_control' ;");

   		return $query -> result();
	}

public function validate($data){


		$no_control = $data['no_control'];
		$id_pregunta = $data['id_pregunta'];


			$query = $this->db->query("SELECT * FROM PREGUNTAS_RESPONDIDAS WHERE numero_control = '$no_control' AND id_pregunta = '$id_pregunta';");

   		return $query -> result();
	}

public function remove_user_response($data){


		$no_control = $data['no_control'];
		$id_pregunta = $data['id_pregunta'];


			$query = $this->db->query("DELETE FROM PREGUNTAS_RESPONDIDAS WHERE numero_control = '$no_control' AND id_pregunta = '$id_pregunta';");

   		// return $query -> result();
	}
	
public function get_pregunta_from_entrevistado($data){

	// $no_control = 12121212;
	$no_control = $data;
	// $id_pregunta = $data['id_pregunta'];

	$query = $this->db->query("SELECT * FROM PREGUNTAS_RESPONDIDAS WHERE numero_control = '$no_control' ORDER BY id_pregunta ASC ;");
	$resultado = $query -> result();
	// $cuenta_resultado = count($resultado);
	// print_r($resultado[0]);

	if ($resultado == TRUE){
		return $resultado;

	}
	if ($resultado == False){
		return FALSE;
	}

	// foreach ($resultado as $pregunta) {
	// 	$json_p = json_encode ($pregunta);
	// 	// echo $json_p;
	// }

	// for ($i=0; $i < $cuenta_resultado; $i++) { 
	// 	var_dump ($resultado);
		
	// }

	// var_dump ();



	// var_dump( $resultado);


}

public function get_results($data){

	$no_control = $data['no_control'];
	$query = $this->db->query("SELECT * FROM RESPUESTAS WHERE numero_control = '$no_control';");
	$h = $query -> row_array();

	// var_dump($h['numero_control']);
	return $h;
}


}
