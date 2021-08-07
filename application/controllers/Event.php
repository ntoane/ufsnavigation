<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Event extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Event_model', 'event');
    }

    public function index() {
        if (_is_user_login($this)) {
            $data['events'] = $this->event->get_events();
            $data['view'] = 'event/_index.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function upcoming() {
        if (_is_user_login($this)) {
            $data['events'] = $this->event->get_upcoming_events();
            $data['view'] = 'event/_upcoming.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function past() {
        if (_is_user_login($this)) {
            $data['events'] = $this->event->get_past_events();
            $data['view'] = 'event/_past.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function get_events()
    {
        if (_is_user_login($this)) {
            // Our Start and End Dates
            $start = $this->input->get("start");
            $end = $this->input->get("end");
    
            $startdt = new DateTime('now'); // setup a local datetime
            $startdt->setTimestamp($start); // Set the date based on timestamp
            $start_format = $startdt->format('Y-m-d');
    
            $enddt = new DateTime('now'); // setup a local datetime
            $enddt->setTimestamp($end); // Set the date based on timestamp
            $end_format = $enddt->format('Y-m-d');
    
            $events = $this->event->get_events_by_dates($start_format, $end_format);
    
            $data_events = array();
    
            foreach($events as $r) {
                $data_events[] = array(
                    "id" => $r['calendar_id'],
                    "title" => $r['event_name'],
                    "start" => $r['start_time'],
                    "end" => $r['end_time'],
                    "event_date" => $r['event_date']
                );
            }

            echo json_encode(array("events" => $data_events));
            exit();
        }
    }

    public function create() {
        if (_is_user_login($this)) {
        if ($this->input->post('submit_event')) {
            $data_event = array(
                'event_name' => $this->input->post('event_name'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
                'event_date' => $this->input->post('event_date')
            );
            $id = $this->event->add_event($data_event);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Event added successfull');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Insert Event');
            }
            redirect('event');
        } else {
            $data['view'] = 'event/_create.php';
            $this->load->view('_layout.php', $data);
        }
        }
    }

    public function edit() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_event')) {
            $data_event = array(
                'event_name' => $this->input->post('event_name'),
                'start_time' => $this->input->post('start_time'),
                'end_time' => $this->input->post('end_time'),
                'event_date' => $this->input->post('event_date')
            );
            $where = array(
                'calendar_id' => $this->input->post('calendar_id')
            );
            $id = $this->event->update($data_event, $where);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Event updated Successfully');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Update Event');
            }
            redirect('event');
        } else {
            $calendar_id = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            if ($calendar_id > 0) {
                $data['event'] = $this->event->get_event($calendar_id);
                $data['view'] = 'event/_edit.php';
                $this->load->view('_layout.php', $data);
            } else {
                redirect('event');
            }
        }
        }
    }

    public function delete() {
        if (_is_user_login($this)) {
            $event_id = $this->uri->segment(3);
            if ($event_id > 0) {
                if ($this->event->delete_event($event_id)) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Event deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Cannot this Event');
                }
                redirect('event');
            }else {
                redirect('event');
            }
      }
    }

}
