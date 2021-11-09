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
        $this->load->model('Module_model', 'module');
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

    public function next_class_get($std_number) {
        //$std_number = $_REQUEST['std_number'];

        if(!empty($std_number)) {
            $timetable = $this->student->get_today_classes($std_number);
            if(!empty($timetable)) {
                //Sort and scan for the next class
                $sort_timetable = array();
                foreach ($timetable as $key => $row)
                {
                    $sort_timetable[$key] = $row['start_time'];
                    
                }
                //sort timetable in ascending order by start_time
                array_multisort($sort_timetable, SORT_DESC, $timetable);

                //Append other data after sorting
                foreach($timetable as $key => $val) {
                    $room = $this->building->get_room($val['room_id']);
                    $timetable[$key]['room_name'] = $room->room_name;
                    $timetable[$key]['level_num'] = 'Level ' . $room->floor_num;
                    $building = $this->building->get_building($room->building_id);
                    $timetable[$key]['building_name'] = $building->building_name;
                    $timetable[$key]['lat_coordinate'] = $building->lat_coordinate;
                    $timetable[$key]['lon_coordinate'] = $building->lon_coordinate;
                    $timetable[$key]['status'] = true;
                }

                //Now pick the exact next class
                foreach($timetable as $key => $value) {
                    //return $this->response(strtotime($timetable[$key]['start_time']), 200);
                    //check if timetable time is later than now 
                    //Add 3600(1hr) seconds to start time and 7200 (2hrs) seconds to time now to standardize
                    if((strtotime($timetable[$key]['start_time']) + 3600)  >= (time() + 7200) )
                    {
                        //return this timetable entry
                        return $this->response($timetable[$key], 200);
                    }
                    //return $this->response(strtotime($timetable[$key]['start_time']) + 3600, 200);
                    //No timetable entry for today
                    return $this->response([
                        'status' => false,
                        'message'=>'You do not have next classes today'
                    ], 200);
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

    public function delete_timetable_entry_delete($timetable_id) {

        if(!empty($timetable_id)) {
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
            return $this->response(['message' => 'Undefined timetable entry to be deleted'], 401);
        }
    }

    public function module_codes_get() {
        $modules = $this->module->get_module_codes();

        if($modules) {
            foreach($modules as $key => $val){
                $modules[$key]['status'] = true;
            }
            $this->response($modules, 200);
        }else {
            $this->response( [
                'status' => false,
                'message' => 'No Module Codes found'
            ], 404 );
        }
    }

    public function all_rooms_get() {
        $buildings_rooms = $this->building->get_buildings_rooms();

        if($buildings_rooms) {
            $this->response($buildings_rooms, 200);
        }else {
            $this->response( [
                'status' => false,
                'message' => 'No Buildings Rooms found'
            ], 404 );
        }
    }
}

?>