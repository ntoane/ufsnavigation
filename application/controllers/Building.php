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
                $name = $this->input->post('name');
                $latitute = floatval($this->input->post('lat'));
                $longitude = floatval($this->input->post('lon'));
                $description = $this->input->post('description');

                $data_building = array(
                    'building_name' => $name,
                    'lat_coordinate' => $latitute,
                    'lon_coordinate' => $longitude,
                    'description' => $description
                );

                $building_id = $this->building->add_building($data_building);
                if ($building_id > 0) {

                    //prepare to upload and insert new images
                    $upload_errors = [];
                    $image_names = array();
                    $count = count($_FILES['files']['name']);
                  
                    for($i=0;$i<$count;$i++){
                  
                      if(!empty($_FILES['files']['name'][$i])){
                        //set preferences
                        $config['upload_path'] = './uploads/buildings/'; 
                        $config['allowed_types'] = 'jpg|jpeg|png|gif';
                        $config['max_size'] = '5000';
                        $image_name = time().$_FILES['files']['name'][$i];//prefix with time to avoid clashes
                        $config['file_name'] = $image_name;
                  
                        $_FILES['file']['name'] = $_FILES['files']['name'][$i];
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
                            $this->session->set_flashdata('type', 'danger');
                            $this->session->set_flashdata('title', 'Error');
                            $this->session->set_flashdata('text', 'Buiding data NOT inserted!!');
                        }
                    } else {
                        $this->session->set_flashdata('type', 'danger');
                        $this->session->set_flashdata('title', 'Error');
                        $this->session->set_flashdata('text', 'There are some errors (' . count($upload_errors). ') uploading the images');
                    }
                 
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error creating new building');
                }
                redirect('building');
            } else {
                $data['view'] = 'building/_create.php';
                $this->load->view('_layout.php', $data);
            }
        }
    }

    public function delete() {
        if (_is_user_login($this)) {
            $building_id = $this->uri->segment(3);
            if ($building_id > 0) {
                $id = $this->building->delete_building($building_id);
    
                if ($id > 0) {
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Building data deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng building');
                }
                redirect('building');
            }else {
                redirect('building');
            }
      }
    }
}
