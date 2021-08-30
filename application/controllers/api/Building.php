<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\MY_RestController;

class Building extends MY_RestController {

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
        $this->load->model('Building_model', 'building');
        $this->load->model('Image_model', 'image');
    }

    //Retrieve all buidings from DB
    public function buildings_get() {
        $buildings = $this->building->get_buildings();//load all building from DB

        $building_id = $this->get( 'id' ); //Get one building from the list

        if($building_id == null) { //building id param not requested
            if($buildings) {
                $this->response($buildings, 200);
            }else {
                $this->response( [
                    'status' => false,
                    'message' => 'No buildings were found'
                ], 404 );
            }
        } else { // get building based on id param
            if ( array_key_exists( $building_id, $buildings ) )
            {
                $this->response( $buildings[$building_id], 200 );
            }
            else
            {
                $this->response( [
                    'status' => false,
                    'message' => 'No such building found'
                ], 404 );
            }
        }
    }

    //Retrieve and return a building data based on building id
    public function building_get() {
        $building_id = $_REQUEST['building_id'];//Get building id from query param

        if($building_id != null) {
            $building = $this->building->get_building($building_id);
            if($building) {
                $this->response($building, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such building found'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'No such building found'
            ], 404);
        }
    }

    //Retrieve and return images of a given building id
    public function images_get() {
        $building_id = $_REQUEST['building_id'];
        
        if($building_id != null) {
            $images = $this->image->get_building_images($building_id);
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
                'message' => 'No such building found'
            ], 404);
        }
    }
}

?>