<?php
defined('BASEPATH') or exit('No direct script access allowed');
/*=========================================
Clase de Visita donde se consulta al modelo 
para poder dar salida como servicio REST
y a su vez se asignan sus respectivos links
===========================================*/
class Visita extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}
	//Funcion principal de los servicios
	public function index()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'GET') {
			json_output(400, array('status' => 400, 'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if($check_auth_client == true){
				$response = $this->MyModel->auth();
				if ($response['status'] == 200) {
					$resp = $this->MyModel->visit_all_data();
					json_output($response['status'], $resp);
				}
			}
		}
	}
	//Funcion que se comunica con el modelo para ver los detalels de una visita especifica con id
	public function detail($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'GET' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
			json_output(400, array('status' => 400, 'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if ($check_auth_client == true) {
				$response = $this->MyModel->auth();
				if ($response['status'] == 200) {
					$resp = $this->MyModel->visit_detail_data($id);
					json_output($response['status'], $resp);
				}
			}
		}
	}
	//Funcion que se comunica con el modelo para crear una visita
	public function create()
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'POST') {
			json_output(400, array('status' => 400, 'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if ($check_auth_client == true) {
				$response = $this->MyModel->auth();
				$respStatus = $response['status'];
				if ($response['status'] == 200) {
					$params = json_decode(file_get_contents('php://input'), TRUE);
					if (
						$params['nombre'] == "" || 
						$params['correo'] == ""||
						$params['celular'] == ""||
						$params['comentario'] == ""||
						$params['motivo_visita'] == ""
					){
						$respStatus = 400;
						$resp = array('status' => 400, 'message' =>  'The form can\'t empty');
					} else {
						$resp = $this->MyModel->visit_create_data($params);
					}
					json_output($respStatus, $resp);
				}
			}
		}
	}
	//Funcion que se comunica con el modelo para editar una visita
	public function update($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'PUT' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
			json_output(400, array('status' => 400, 'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if ($check_auth_client == true) {
				$response = $this->MyModel->auth();
				$respStatus = $response['status'];
				if ($response['status'] == 200) {
					$params = json_decode(file_get_contents('php://input'), TRUE);
					$params['updated_at'] = date('Y-m-d H:i:s');
					if (
						$params['nombre'] == "" || 
						$params['correo'] == ""||
						$params['celular'] == ""||
						$params['comentario'] == ""||
						$params['motivo_visita'] == ""
					) {
						$respStatus = 400;
						$resp = array('status' => 400, 'message' =>  'The form can\'t empty');
					} else {
						$resp = $this->MyModel->visit_update_data($id, $params);
					}
					json_output($respStatus, $resp);
				}
			}
		}
	}
	//Funcion que se comunica con el modelo para eliminar una visita
	public function delete($id)
	{
		$method = $_SERVER['REQUEST_METHOD'];
		if ($method != 'DELETE' || $this->uri->segment(3) == '' || is_numeric($this->uri->segment(3)) == FALSE) {
			json_output(400, array('status' => 400, 'message' => 'Bad request.'));
		} else {
			$check_auth_client = $this->MyModel->check_auth_client();
			if ($check_auth_client == true) {
				$response = $this->MyModel->auth();
				if ($response['status'] == 200) {
					$resp = $this->MyModel->visit_delete_data($id);
					json_output($response['status'], $resp);
				}
			}
		}
	}
}
