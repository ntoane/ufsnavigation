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
                foreach($buildings as $key => $val) {
                    //Append ebedded images to the array
                    $buildings[$key]['images'] = $this->image->get_building_image_urls($buildings[$key]['building_id']);
                }
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

    public function health_services_get() {
        $health = $this->building->get_Health_Services();

        if($health) {
            foreach($health as $key => $val) {
                //Append ebedded images to the array
                $health[$key]['images'] = $this->image->get_building_image_urls($health[$key]['building_id']);
            }
            $this->response($health, 200);
        }else {
            $this->response( [
                'status' => false,
                'message' => 'No Health Services found'
            ], 404 );
        }
    }

    public function eating_places_get() {
        $eating = $this->building->get_eating_places();

        if($eating) {
            foreach($eating as $key => $val) {
                //Append ebedded images to the array
                $eating[$key]['images'] = $this->image->get_building_image_urls($eating[$key]['building_id']);
            }
            $this->response($eating, 200);
        }else {
            $this->response( [
                'status' => false,
                'message' => 'No Eating Places found'
            ], 404 );
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

    //Retrieve and return images of a given building id using Path Param
    public function images_get($building_id) {
        //$building_id = $_REQUEST['building_id']; for query param
        
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

    public function building_levels_get($building_id) {
        if($building_id != null) {
            $levels = $this->building->get_building_levels($building_id);
            if($levels) {
                $this->response($levels, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such building levels found'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'No such building levels found'
            ], 404);
        }
    }

    public function building_levels_rooms_get($building_id, $floor_num) {
        if($building_id != null) {
            $rooms = $this->building->get_building_level_rooms($building_id, $floor_num);
            if($rooms) {
                foreach($rooms as $key => $val) {
                    $rooms[$key]['building_name'] = $this->building->get_building($val['building_id'])->building_name;
                }
                $this->response($rooms, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such rooms found'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'No such building level rooms found'
            ], 404);
        }
    }

    public function building_levels_toilets_get($building_id, $floor_num) {
        if($building_id != null) {
            $toilets = $this->building->get_building_level_toilets($building_id, $floor_num);
            if($toilets) {
                foreach($toilets as $key => $val) {
                    $toilets[$key]['building_name'] = $this->building->get_building($val['building_id'])->building_name;
                }
                $this->response($toilets, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such toilets found'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'No such building level toilets found'
            ], 404);
        }
    }

    public function room_directions_get($room_id) {
        if($room_id != null) {
            $directions = $this->building->get_room_directions($room_id);
            if($directions) {
                $this->response($directions, 200);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'No such room directions found'
                ], 404);
            }
        } else {
            $this->response([
                'status' => false,
                'message' => 'No such room directions found'
            ], 404);
        }
    }
}

?>