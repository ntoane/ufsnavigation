<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\MY_RestController;

class Timetable extends MY_RestController {

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
        $this->load->model('jwttoken_model', 'jwt');
        $this->load->model('student_model', 'student');
        $this->load->model('Building_model', 'building');
    }

    public function create_timetable_post() {
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        //Check if the token supplied is valid
        $validation = $this->jwt->validate_token($data);
        if($validation['message'] == "Access granted") {
            $data_timetable = array(
                'std_number' => $data->std_number,
                'room_id' => $data->room_id,
                'module_code' => $data->module_code,
                'start_time' => $data->start_time,
                'end_time' => $data->end_time,
                'day' => $data->day
            );
            $insert_id = $this->student->add_timetable($data_timetable);
            if($insert_id > 0) {
                return $this->response([
                    'message' => 'Timetable entry added successfully',
                    'data' => $data_timetable,
                        ], 201);
            }else {
                return $this->response(['message' => 'Error inserting timetable']);
            }
        }else {
            return $this->response(['message' => 'You have no access'], 401);
        }
        //echo json_encode($this->jwt->validate_token());
    }

    public function student_timetable_get($std_number) {
        //Get student number
        //$std_number = $_REQUEST['std_number'];

        if(!empty($std_number)) {
            $timetable = $this->student->get_student_timetable($std_number);
            if(!empty($timetable)) {
                foreach($timetable as $key => $val) {
                    $room = $this->building->get_room($val['room_id']);
                    $timetable[$key]['room_name'] = $room->room_name;
                    $timetable[$key]['level_num'] = 'Level ' . $room->floor_num;
                    $building = $this->building->get_building($room->building_id);
                    $timetable[$key]['building_name'] = $building->building_name;
                    $timetable[$key]['lat_coordinate'] = $building->lat_coordinate;
                    $timetable[$key]['lon_coordinate'] = $building->lon_coordinate;
                }
                $this->response($timetable, 200);
            }else {
                $this->response( [
                    'status' => false,
                    'message' => 'No timetable data found'
                ], 404 );
            }
        }else {
            return $this->response(['message' => 'You have no access'], 401);
        }
    }

    public function delete_timetable_entry_delete() {
        //Get timetable id from query param
        $timetable_id = $_REQUEST['timetable_id'];
        // get posted data
        $data = json_decode(file_get_contents("php://input"));

        //Check if the token supplied is valid
        $validation = $this->jwt->validate_token($data);

        if(($validation['message'] == "Access granted") && ($timetable_id != null)) {
            $delete_id = $this->student->delete_timetable($timetable_id);
            if($delete_id > 0) {
                $this->response(['message' => 'Timetable entry deleted successfully'], 200);
            }else {
                $this->response( [
                    'status' => false,
                    'message' => 'Failed to delete timetable entry'
                ], 404 );
            }
        }else {
            return $this->response(['message' => 'You have no access'], 401);
        }
    }
}

?>