<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use chriskacerguis\RestServer\MY_RestController;

class Event extends MY_RestController {

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
        $this->load->model('Event_model', 'event');
    }

    public function upcoming_get() {
        $events = $this->event->get_upcoming_events();

        if($events) {
            $this->response($events, 200);
        }else {
            $this->response( [
                'status' => false,
                'message' => 'No events were found'
            ], 404 );
        }
    }
}

?>