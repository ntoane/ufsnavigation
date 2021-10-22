<?php

defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\MY_RestController;


class Login extends MY_RestController{

    public function __construct() {
        parent::__construct();
        
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }

        $this->load->model('student_model', 'student');
        $this->load->model('jwttoken_model', 'jwt');
    }

    public function authenticate_post() {
        $data = json_decode(file_get_contents("php://input"));

        $student = $this->student->get_student($data->std_number);
        if (empty($student) || !password_verify($data->password, $student->password)) {
            return $this->response(['message' => 'Wrong credentials'], 401);
        } else {
            return $this->response([
                'message' => 'You are loggen in successfully', 
                'token' => $this->jwt->login_token($student),
                'std_number' => $data->std_number
            ], 200);
        }
	}

    public function auth_user_post() {
        $data = json_decode(file_get_contents("php://input"));

        $validation = $this->jwt->validate_token($data);

        if($validation['message'] == "Access granted") {
            return $this->response([
                'auth' => true,
                'username' => $validation['data']->firstname . ' ' . $validation['data']->lastname
            ], 200);
        }else {
            return $this->response(['auth' => false], 401);
        }
    }

}