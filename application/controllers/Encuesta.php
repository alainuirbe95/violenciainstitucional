<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Encuesta extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	 public function __construct() {
        parent::__construct();



        $this->load->database();


        $this->load->library("parser");
        $this->load->library("Form_validation");




        $this->load->helper("url");
        $this->load->helper('form');
        $this->load->helper('text');






        

        $this->load->model("M_entrevistados");
        $this->load->model("M_entrevista");


    }
	
	public function reglas_entrevistado()
	{				
		$this->form_validation->set_rules('numero_control','numero_control','required');
		$this->form_validation->set_rules('sexo','sexo','required');

	}

public function index()
	{
		$this->load->view('templete/View_sidebar');
		$this->load->view('View_iniciar_encuesta');
	}

public function inicio()
	{
		$this->load->view('templete/View_sidebar');
		$this->load->view('View_form_entrevistado');
			if ($this->input->post()) {
				
				$data = array(
					"no_control"=> $this->input->post('numero_control'),
					"sexo_entrevistado"=> $this->input->post('sexo')
				);
				$no_control_entrevistado = $this->input->post('numero_control');
				$sexo_entrevistado = $this->input->post('sexo');

				$this->reglas_entrevistado();
				$this->form_validation->run();
					if ($this->form_validation->run() == TRUE) {

						if ($this->M_entrevista->get_todos_from_entrevistado($data) == TRUE) {
							// echo "Ya has completado la encuesta";
							redirect('encuesta/confirm_redo/'.$no_control_entrevistado);
						}
						if ($this->M_entrevista->get_todos_from_entrevistado($data) == FALSE && $this->M_entrevistados->get_todos($data) == TRUE) {
							// echo "Aun no has completado la encuesta";

							// $id_insertado = $this->M_entrevistados->add(); //DESCOMENTA PARA PRENDER LA AGREGADA DE ENTREVISTADOS
							redirect('encuesta/preguntas/'.$no_control_entrevistado);

						}
						if ($this->M_entrevista->get_todos_from_entrevistado($data) == FALSE && $this->M_entrevistados->get_todos($data) == FALSE) {
							// echo "Aun no has completado la encuesta";

							$id_insertado = $this->M_entrevistados->add(); //DESCOMENTA PARA PRENDER LA AGREGADA DE ENTREVISTADOS
							redirect('encuesta/preguntas/'.$no_control_entrevistado);

						}
					}	
			}
	}


public function confirm_redo($no_control_entrevistado){
	$data = array(
		"no_control"=> $no_control_entrevistado,
	);

	// var_dump($data);
	$this->load->view('templete/View_sidebar');
	$this->load->view('View_confirmacion_de_redo', $data);

}



public function preguntas($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data  = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 1
		);





		if (is_null($no_control_entrevistado) ) {
				redirect('Encuesta/inicio') ;
		} else {
			// $this->load->view('templete/View_sidebar');
			$this->load->view('View_sidebar', $data);
			$this->load->view('View_form_pregunta_1', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('1_1')),
					"_2" => array_sum($this->input->post('1_2')),
					"_3" => array_sum($this->input->post('1_3'))

				);

				//AQUI SE AGREGA VALIDACION PARA VER SI HA SE CCONTESTO ESTA PREGUNTA... DE SER ASI HACE UN ¿UPDATE DE RESPUESTA?

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta2/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta2/'.$no_control_entrevistado);

				}
				


				
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta2/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta2/'.$no_control_entrevistado);

				}
				

			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta2($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 2
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			// $this->load->view('templete/View_sidebar');
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_2', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('2_1')),
					"_2" => array_sum($this->input->post('2_2')),
					"_3" => array_sum($this->input->post('2_3'))

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta3/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta3/'.$no_control_entrevistado);

				}


				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta3/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta3/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}
	
public function pregunta3($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 3
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {

			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_3', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('3_1')),
					"_2" => array_sum($this->input->post('3_2')),
					"_3" => array_sum($this->input->post('3_3'))

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta4/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta4/'.$no_control_entrevistado);

				}


				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta4/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta4/'.$no_control_entrevistado);

				}

				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

	
public function pregunta4($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 4
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_4', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('4_1')),
					"_2" => array_sum($this->input->post('4_2')),
					"_3" => array_sum($this->input->post('4_3'))

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta5/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta5/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta5/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta5/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}


public function pregunta5($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 5
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_5', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('5_1')),
					"_2" => array_sum($this->input->post('5_2')),
					"_3" => array_sum($this->input->post('5_3'))

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta6/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta6/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta6/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta6/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}
public function pregunta6($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 6
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_6', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('6_1')),
					"_2" => array_sum($this->input->post('6_2')),
					"_3" => array_sum($this->input->post('6_3'))

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta7/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta7/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta7/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta7/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta7($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 7
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_7', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('7_1')),
					"_2" => array_sum($this->input->post('7_2')),
					"_3" => array_sum($this->input->post('7_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta8/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta8/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta8/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta8/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta8($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 8
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_8', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('8_1')),
					"_2" => array_sum($this->input->post('8_2')),
					"_3" => array_sum($this->input->post('8_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta9/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta9/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta9/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta9/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta9($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 9
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_9', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('9_1')),
					"_2" => array_sum($this->input->post('9_2')),
					"_3" => array_sum($this->input->post('9_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta10/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta10/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta10/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta10/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta10($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 10
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_10', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('10_1')),
					"_2" => array_sum($this->input->post('10_2')),
					"_3" => array_sum($this->input->post('10_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta11/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta11/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta11/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta11/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta11($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 11
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_11', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('11_1')),
					"_2" => array_sum($this->input->post('11_2')),
					"_3" => array_sum($this->input->post('11_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta12/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta12/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta12/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta12/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta12($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 12
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_12', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('12_1')),
					"_2" => array_sum($this->input->post('12_2')),
					"_3" => array_sum($this->input->post('12_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta13/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta13/'.$no_control_entrevistado);

				}
			// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta13/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta13/'.$no_control_entrevistado);

				}
			// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta13($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 13
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_13', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('13_1')),
					"_2" => array_sum($this->input->post('13_2')),
					"_3" => array_sum($this->input->post('13_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta14/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta14/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta14/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta14/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta14($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 14
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_14', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('14_1')),
					"_2" => array_sum($this->input->post('14_2')),
					"_3" => array_sum($this->input->post('14_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta15/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta15/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta15/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta15/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta15($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 15
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_15', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('15_1')),
					"_2" => array_sum($this->input->post('15_2')),
					"_3" => array_sum($this->input->post('15_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta16/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta16/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);

				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta16/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta16/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta16($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 16
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_16', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('16_1')),
					"_2" => array_sum($this->input->post('16_2')),
					"_3" => array_sum($this->input->post('16_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta17/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta17/'.$no_control_entrevistado);

				}
				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta17/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/pregunta17/'.$no_control_entrevistado);

				}
				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}

public function pregunta17($no_control_entrevistado)
	{	

		$respuesta_principal = 0;
		$respuesta_secundaria_1 = 0;
		$respuesta_secundaria_2 = 0;
		$respuesta_secundaria_3 = 0;

		$data = array(
    		"no_control"=> $no_control_entrevistado,
    		"id_pregunta"=> 17
		);


		if (is_null($no_control_entrevistado))  {
				redirect('Encuesta/inicio') ;
		} else {
			$this->load->view('View_sidebar', $data);

			$this->load->view('View_form_pregunta_17', $data);


		}

		if ($this->input->post()) {
			$respuesta_principal =  $this->input->post('1');
			
			if ($respuesta_principal == TRUE ) {

				$data['respuestas'] = array(

					"1" =>   $respuesta_principal,
					"_1" => array_sum($this->input->post('17_1')),
					"_2" => array_sum($this->input->post('17_2')),
					"_3" => array_sum($this->input->post('17_3'))

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/fin_encuesta/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/fin_encuesta/'.$no_control_entrevistado);

				}

				// print_r($data);
			
			} 


			if ($respuesta_principal == 0) {
				
				$data['respuestas_secundarias'] = array(

					"1" => 0,
					"_1" => 0,
					"_2" => 0,
					"_3" => 0

				);


				if ($this->M_entrevista->validate($data) == TRUE) { // DESCOMENTAR PARA VALIDACION DE RESPUESTA YA RESPONDIDA
					// echo "llegaste";
					$this->M_entrevista->remove_user_response($data); // DESCOMENTAR PARA QUE SE BORREN LOS VALORES 
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/fin_encuesta/'.$no_control_entrevistado);


				}

				if ($this->M_entrevista->validate($data) == FALSE) {
					// echo "no llegaste";
					$this->M_entrevista->add($data); // DESCOMENTAR PARA QUE SE EMPIECEN A GUARDAR LOS VALORES
					redirect('encuesta/fin_encuesta/'.$no_control_entrevistado);

				}

				// print_r($data);

				
			}

			
			// print_r( $this->input->post());
		}

	}
	
public function fin_encuesta($no_control_entrevistado)
	{	
		// $url = '/Users/alainalejandro/Desktop/json.json';
		// $ponderaciones = "";

		$data = array(
    		"no_control"=> $no_control_entrevistado
		);

		$respuestas = $this->M_entrevista->get_todos_from_entrevistado($data);

		$respuestas_entrevistado = json_encode( $respuestas);

		$salida = " ";
		$output = exec("/usr/bin/python3  /Users/alainalejandro/Downloads/model_test.py ' $respuestas_entrevistado' 2>&1", $salida);
		// $result = shell_exec('/usr/bin/python3 /Users/alainalejandro/Downloads/model_test.py ' . $respuestas_entrevistado);


		// $decoded_output = json_decode($salida);
		// print_r($_GET['numero_control']);
		$numero_control = htmlspecialchars($_GET['numero_control']);

		var_dump($numero_control);
		// var_dump($decoded_output);




	}
	
	public function get_results()
	{	

		// $data = json_decode(file_get_contents('/Applications/MAMP/htdocs/riesgoinstitucional/application/json.json'), true);
		$data = json_decode(file_get_contents('php://input'));
		print_r($data);

		
		// print_r($_GET['numero_control']);
		// $numero_control = htmlspecialchars($_GET['numero_control']);
		// echo $numero_control;
		// $data_to_view = array(
		// 	'numero_control' => $_POST['numero_control'], 
		// 	'Vf' => $_POST['Vf'], 
		// 	'Vs' => $_POST['Vs'], 
		// 	'Vp' => $_POST['Vp'], 
		// 	'RVf' => $_POST['RVf'], 
		// 	'RVs' => $_POST['RVs'], 
		// 	'RVp' => $_POST['RVp'], 
		// 	'EVf' => $_POST['EVf'], 
		// 	'EVs' => $_POST['EVs'], 
		// 	'EVp' => $_POST['EVp'], 
		// );
		// $this->load->view('templete/View_sidebar', $data_to_view);

		// if ($data['EVf'] == "Muy alto") {
		// 	echo "1";
		// }
		// echo $data['Vs'];


		// print_r($data_to_view);


		// $this->load->view('templete/View_sidebar');

		// $this->load->view('View_end', $data_to_view);


		// print_r( $data_to_view);



	}

}









