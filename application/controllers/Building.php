<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Building extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Building_model', 'building');
        $this->load->model('Image_model', 'image');
    }

    public function index() {
        if (_is_user_login($this)) {
            $data['buildings'] = $this->building->get_buildings();
            $data['view'] = 'building/_index.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function create() {
        if (_is_user_login($this)) {
            if ($this->input->post('submit_building')) {
                //Get form data and save new building data to the database
                $category_id = $this->input->post('category_id');
                $name = $this->input->post('name');
                $latitute = floatval($this->input->post('lat'));
                $longitude = floatval($this->input->post('lon'));
                $description = $this->input->post('description');

                if(!empty($category_id) && !empty($name) && !empty($latitute) && !empty($longitude)) {
                    $data_building = array(
                        'category_id' => $category_id,
                        'building_name' => $name,
                        'lat_coordinate' => $latitute,
                        'lon_coordinate' => $longitude,
                        'description' => $description
                    );

                    $building_id = $this->building->add_building($data_building);
                }
                if ($building_id > 0) {

                    //prepare to upload and insert new images
                    $upload_errors = [];
                    $image_names = array();
                    $array_files = $_FILES['files']['name'];
                    $count = count($_FILES['files']['name']);
                  
                    for($i=0;$i<$count;$i++){
                  
                      if(!empty($array_files)){
                        //set preferences
                        $config['upload_path'] = './uploads/buildings/'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = '5000';

                        //prefix with time to avoid clashes and replace blank with _ char
                        $image_name = time().'_'.str_replace(' ', '_', $_FILES['files']['name'][$i]);

                        $_FILES['file']['name'] = $image_name;
                        $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                        $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                        $_FILES['file']['size'] = $_FILES['files']['size'][$i]; 

                        //load upload class library
                        $this->load->library('upload',$config);
                  
                        if($this->upload->do_upload('file')){
                          $uploadData = $this->upload->data();
                          array_push($image_names, $image_name);
                          
                        } else {// failed to upload
                            $upload_errors = array('error' => $this->upload->display_errors());
                        }
                      }
                 
                    }

                    //if no upload errors and files loaded in array, save image filenames to database
                    $no_errors = true;
                    if((count($upload_errors) == 0) && (count($image_names) > 0)) {
                        for($i=0; $i<count($image_names); $i ++) {
                            $image_id = $this->image->add_image(['url' => $image_names[$i]]);
                            if($image_id < 1 ) {
                                $no_errors = false;
                            }else { 
                                $building_image_id = $this->image->add_building_image(['building_id' => $building_id, 'image_id' => $image_id]);
                                if($building_image_id < 1  ) {
                                    $no_errors = false;
                                } 
                            }
                        }

                        if($no_errors) {
                            $this->session->set_flashdata('type', 'success');
                            $this->session->set_flashdata('title', 'Success');
                            $this->session->set_flashdata('text', 'Building data successfully added'); 
                        } else {
                            $this->session->set_flashdata('type', 'error');
                            $this->session->set_flashdata('title', 'Error');
                            $this->session->set_flashdata('text', 'Buiding data NOT inserted!!');
                        }
                    } else {
                        $this->session->set_flashdata('type', 'error');
                        $this->session->set_flashdata('title', 'Error');
                        $this->session->set_flashdata('text', 'There are some errors (' . count($upload_errors). ') uploading the images');
                        //echo json_encode($upload_errors);
                    }
                 
                } else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error creating new building');
                }
                redirect('building');
            } else {
                $data['categories'] = $this->building->get_array("SELECT * FROM tbl_category");
                $data['view'] = 'building/_create.php';
                $this->load->view('_layout.php', $data);
            }
        }
    }

    public function edit() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_building')) {
            $building_id = $this->input->post('building_id');
            $data_building = array(
                'building_name' => ($this->input->post('name')),
                'lat_coordinate' => floatval($this->input->post('lat')),
                'lon_coordinate' => floatval($this->input->post('lon')),
                'description' => ($this->input->post('description'))
            );
            $where = array(
                'building_id' => $building_id
            );

            //update any changes for a building
            $building_update_id = $this->building->update($data_building, $where);
            $notify_building = false;
            if($building_update_id > 0) {
                $notify_building = true; //some changes made, will notify
            }

            //prepare to upload any new uploaded images
            $upload_errors = [];
            $image_names = array();
            $count = count($_FILES['files']['name']);
            
            for($i=0;$i<$count;$i++){
            
                if(!empty($_FILES['files']['name'][$i])){
                    //set preferences
                    $config['upload_path'] = './uploads/buildings/'; 
                    $config['allowed_types'] = 'jpg|jpeg|png|gif';
                    $config['max_size'] = '5000';
                    //prefix with time to avoid clashes and replace blank with _ char
                    $image_name = time().'_'.str_replace(' ', '_', $_FILES['files']['name'][$i]);

                    $_FILES['file']['name'] = $image_name;
                    $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                    $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                    $_FILES['file']['size'] = $_FILES['files']['size'][$i];

                    //load upload class library
                    $this->load->library('upload',$config);
                
                    if($this->upload->do_upload('file')){
                        $uploadData = $this->upload->data();
                        array_push($image_names, $image_name);
                        
                    } else {// failed to upload
                        $upload_errors = array('error' => $this->upload->display_errors());
                    }
                }
            
            }

            //if no upload errors and files loaded in array, save image filenames to database
            $no_errors = true;
            if((count($upload_errors) == 0) && (count($image_names) > 0)) {
                for($i=0; $i<count($image_names); $i ++) {
                    $image_id = $this->image->add_image(['url' => $image_names[$i]]);
                    if($image_id < 1 ) {
                        $no_errors = false;
                    }else { 
                        $building_image_id = $this->image->add_building_image(['building_id' => $building_id, 'image_id' => $image_id]);
                        if($building_image_id < 1  ) {
                            $no_errors = false;
                        } 
                    }
                }

                if($no_errors) {
                    $notify_building = false; //This notification will cater for building aswell

                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Building data updated successfully'); 
                } else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Buiding data NOT updated!!');
                }
            } else {
                $this->session->set_flashdata('type', 'error');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'There are some errors (' . count($upload_errors). ') uploading the images');
            }

            //notify if any changes made to building
            if($notify_building) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Building data updated successfully');
            }
            redirect('building');
        } else {
            $building_id = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            if ($building_id > 0) {
                $data['building'] = $this->building->get_building($building_id);
                $data['building_images'] = $this->image->get_building_images($building_id);
                $data['view'] = 'building/_edit.php';
                $this->load->view('_layout.php', $data);
            } else {
                redirect('building');
            }
        }
        }
    }

    public function delete() {
        if (_is_user_login($this)) {
            $building_id = $this->uri->segment(3);
            if ($building_id > 0) {
                $id = $this->building->delete_building($building_id);
    
                if ($id > 0) {
                    //delete associated images
                    $building_images = $this->image->get_building_images($building_id);
                    foreach($building_images as $delete_image) {
                        $this->image->delete_image($delete_image['image_id']);
                        echo ' ID: ' . $delete_image['image_id'];
                    }
                    
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Building data deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng building');
                }
                redirect('building');
            }else {
                redirect('building');
            }
      }
    }

    public function remove_image() {
        if (_is_user_login($this)) {
            $image_id = $this->uri->segment(3);
            $building_id = $this->uri->segment(4);
            if ($image_id > 0) {
                $id = $this->image->delete_image($image_id);
    
                if ($id > 0) {
                    //successfully deleted image, load building data
                    $building_images = $this->image->get_building_images($building_id);
                    foreach($building_images as $delete_image) {
                        //delete frile from database
                        if($this->image->delete_image($delete_image['image_id'])) {
                            //Also delete file from directory
                            $file_to_delete = $this->image->get_image($delete_image['image_id']);
                            $path = base_url() . 'uploads/buildings' . $file_to_delete->url;
                            // echo $path;
                            unlink($path);
                        }
                    }
                    
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Building Image deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng building');
                }
                redirect('building/edit/' . $building_id);
            }else {
                redirect('building/edit/' . $building_id);
            }
      }
    }

    
    public function create_room() {
        if (_is_user_login($this)) {
            if ($this->input->post('submit_room')) {
                $room_type = $this->input->post('room_type');
                $building_id = $this->input->post('building_id');
                $level = $this->input->post('level');
                $room_name = $this->input->post('room_name');
                $description = $this->input->post('description');

                $data_room = array(
                    'room_type' => $room_type,
                    'building_id' => $building_id,
                    'room_name' => $room_name,
                    'floor_num' => $level,
                    'description' => $description
                );

                $room_id = $this->building->add_room($data_room);
                if($room_id > 0) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Room added Successfully');
                }else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error occured when adding Room');
                }
                redirect('building');
            }else {
                $data['buildings'] = $this->building->get_buildings();
                $data['view'] = 'building/_create_room.php';
                $this->load->view('_layout.php', $data);
            }
        }
    }

    public function delete_room() {
        if (_is_user_login($this)) {
            $room_id = $this->uri->segment(3);
            if ($room_id > 0) {
                $id = $this->building->delete_room($room_id);
    
                if ($id > 0) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Room data deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng Room');
                }
                redirect('building');
            }else {
                redirect('building');
            }
      }
    }

    /************************************** Room Directions **************************************************/
    public function create_room_directions() {
        if (_is_user_login($this)) {
            if ($this->input->post('submit_room_directions')) {
                $room_id = $this->input->post('room_id');
                $entrance = $this->input->post('entrance');
                $directions = $this->input->post('directions');

                $data_room_directions = array(
                    'room_id' => $room_id,
                    'entrance' => $entrance,
                    'directions' => $directions
                );

                $direction_id = $this->building->add_room_direction($data_room_directions);
                if($direction_id > 0) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Room directions added Successfully');
                }else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error occured when adding Room directions');
                }
                redirect('building/room_directions/' . $room_id);
            }else {
                $this->session->set_flashdata('type', 'error');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Error occured when adding Room directions');
                redirect('building/room_directions/' . $room_id);
            }
        }
    }

    public function room_directions() {
        if (_is_user_login($this)) {
            $room_id = $this->uri->segment(3);
            if ($room_id > 0) {
                $data['room_id'] = $room_id;
                $data['room_name'] = $this->building->get_room($room_id)->room_name;
                $data['level_num'] = 'Level ' . $this->uri->segment(4);
                $data['building_name'] = urldecode($this->uri->segment(5));
                $data['directions'] = $this->building->get_room_directions($room_id);
                $data['view'] = 'building/_room_directions.php';
                $this->load->view('_layout.php', $data);
            }else {
                redirect('building');
            }
      }
    }

    public function delete_room_direction() {
        if (_is_user_login($this)) {
            $room_direction_id = $this->uri->segment(3);
            $room_id = $this->uri->segment(4);
            if ($room_direction_id > 0) {
                $id = $this->building->delete_room_direction($room_direction_id);
    
                if ($id > 0) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Room directions data deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'error');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng Room directions');
                }
                redirect('building/room_directions/' . $room_id);
            }else {
                $this->session->set_flashdata('type', 'error');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Undefined room directions');
                redirect('building/room_directions/' . $room_id);
            }
      }
    }
}
