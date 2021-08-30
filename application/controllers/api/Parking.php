<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\MY_RestController;

class Parking extends MY_RestController {

    public function __construct()
    {
        parent::__construct();
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Credentials", "true");
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if ($method == "OPTIONS") {
            die();
        }

        //Load models
        $this->load->model('Parking_model', 'parking');
        $this->load->model('Image_model', 'image');
    }

    public function car_parkings_get() {
        $car_parkings = $this->parking->get_public_car_parkings();

        if($car_parkings) {
            $this->response($car_parkings, 200);
        }else {
            $this->response([
                'status' => false,
                'message' => 'No car parkings found'
            ], 404);
        }
    }

    public function wheelchair_parkings_get() {
        $wheelchair_parkings = $this->parking->get_public_wheelchair_parkings();

        if($wheelchair_parkings) {
            $this->response($wheelchair_parkings, 200);
        }else {
            $this->response([
                'status' => false,
                'message' => 'No wheelchair parkings found'
            ], 404);
        }
    }

        //Retrieve and return images of a given building id
        public function images_get() {
            $parking_id = $_REQUEST['parking_id'];
            
            if($parking_id != null) {
                $images = $this->image->get_parking_images($parking_id);
                if($images) {
                    $this->response($images, 200);
                } else {
                    $this->response([
                        'status' => false,
                        'message' => 'No such images found'
                    ], 404);
                }
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such parking found'
                ], 404);
            }
        }
}

?>