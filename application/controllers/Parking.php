<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Parking extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Parking_model', 'parking');
        $this->load->model('Image_model', 'image');
    }
/***********************Parking Category starts***************************/
    public function index() {
        if (_is_user_login($this)) {
            $data['parking_categories'] = $this->parking->get_parking_categories();
            $data['view'] = 'parking/_index.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function create_cat() {
        if (_is_user_login($this)) {
        if ($this->input->post('submit_category')) {

            $cat_name = $this->input->post('cat_name');
            $id = $this->parking->add_parking_cat(['cat_name' => $cat_name]);

            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Parking category name successfully added');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Error inserting parking category');
            }
            redirect('parking');
        } else {
            $data['view'] = 'parking/_create_cat.php';
            $this->load->view('_layout.php', $data);
        }
        }
    }

    public function edit_cat() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_category')) {
            $data_cat = array(
                'cat_name' => $this->input->post('cat_name')
            );
            $where = array(
                'cat_id' => $this->input->post('cat_id')
            );
            $id = $this->parking->update_parking_cat($data_cat, $where);
            if ($id > 0) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Parking category updated Successfully');
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'Cannot Update Parking category');
            }
            redirect('parking');
        } else {
            $cat_id = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            if ($cat_id > 0) {
                $data['category'] = $this->parking->get_parking_cat($cat_id);

                $data['view'] = 'parking/_edit_cat.php';
                $this->load->view('_layout.php', $data);
            } else {
                redirect('parking');
            }
        }
        }
    }

    public function delete_cat() {
        if (_is_user_login($this)) {
            $cat_id = $this->uri->segment(3);
            if ($cat_id > 0) {
                $id = $this->parking->delete_parking_cat($cat_id);
    
                if ($id > 0) {  
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Parking category deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng parking category');
                }
                redirect('parking');
            }else {
                redirect('parking');
            }
      }
    }

    /***********************Parking Category ends***************************/

    /***********************Parking Starts***************************/
    public function load_car_parkings() {
        if (_is_user_login($this)) {
            $data['car_parkings'] = $this->parking->get_car_parkings();
            $data['view'] = 'parking/_car_parkings.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function load_wheelchair_parkings() {
        if (_is_user_login($this)) {
            $data['wheelchair_parkings'] = $this->parking->get_wheelchair_parkings();
            $data['view'] = 'parking/_wheelchair_parkings.php';
            $this->load->view('_layout.php', $data);
        }
    }

    public function create_parking() {
        if (_is_user_login($this)) {
            if ($this->input->post('submit_parking')) {
                $cat_id = $this->input->post('cat_id');
                $parking_type = $this->input->post('parking_type');
                $parking_name = $this->input->post('parking_name');
                $latitute = floatval($this->input->post('lat'));
                $longitude = floatval($this->input->post('lon'));
                $description = $this->input->post('description');

                $data_parking = array(
                    'cat_id' => $cat_id,
                    'parking_name' => $parking_name,
                    'parking_type' => $parking_type,
                    'lat_coordinate' => $latitute,
                    'lon_coordinate' => $longitude,
                    'description' => $description
                );

                $parking_id = $this->parking->add_parking($data_parking);
                if ($parking_id > 0) {

                    //prepare to upload and insert new images
                    $upload_errors = [];
                    $image_names = array();
                    $array_files = $_FILES['files']['name'];
                    $count = count($_FILES['files']['name']);
                  
                    for($i=0;$i<$count;$i++){
                  
                      if(!empty($array_files)){
                        //set preferences
                        $config['upload_path'] = './uploads/parkings/'; 
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
                                $parking_image_id = $this->image->add_parking_image(['parking_id' => $parking_id, 'image_id' => $image_id]);
                                if($parking_image_id < 1  ) {
                                    $no_errors = false;
                                } 
                            }
                        }

                        if($no_errors) {
                            $this->session->set_flashdata('type', 'success');
                            $this->session->set_flashdata('title', 'Success');
                            $this->session->set_flashdata('text', 'Parking data successfully added'); 
                        } else {
                            $this->session->set_flashdata('type', 'danger');
                            $this->session->set_flashdata('title', 'Error');
                            $this->session->set_flashdata('text', 'Parking data NOT inserted!!');
                        }
                    } else {
                        $this->session->set_flashdata('type', 'danger');
                        $this->session->set_flashdata('title', 'Error');
                        $this->session->set_flashdata('text', 'There are some errors (' . count($upload_errors). ') uploading the images');
                    }
                 
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error creating new parking');
                }
                if($parking_type == 'car') {
                    redirect('parking/load_car_parkings');
                } else {
                    redirect('parking/load_wheelchair_parkings');
                }
            } else {
                $data['parking_categories'] = $this->parking->get_parking_categories();
                $data['view'] = 'parking/_create_parking.php';
                $this->load->view('_layout.php', $data);
            }
        }
    }

    public function edit_parking() {
        if (_is_user_login($this)) {
        if ($this->input->post('update_building')) {
            $parking_id = $this->input->post('parking_id');
            $cat_id = $this->input->post('cat_id');
            $parking_type = $this->input->post('parking_type');
            $parking_name = $this->input->post('parking_name');
            $latitute = floatval($this->input->post('lat'));
            $longitude = floatval($this->input->post('lon'));
            $description = $this->input->post('description');
            $data_parking = array(
                'cat_id' => $cat_id,
                'parking_name' => $parking_name,
                'parking_type' => $parking_type,
                'lat_coordinate' => $latitute,
                'lon_coordinate' => $longitude,
                'description' => $description
            );
            $where = array(
                'parking_id' => $parking_id
            );

            //update any changes for a building
            $parking_update_id = $this->parking->update_parking($data_parking, $where);
            $notify_parking = false;
            if($parking_update_id > 0) {
                $notify_parking = true; //some changes made, will notify
            }

            //prepare to upload any new uploaded images
            $upload_errors = [];
            $image_names = array();
            $count = count($_FILES['files']['name']);
            
            for($i=0;$i<$count;$i++){
            
                if(!empty($_FILES['files']['name'][$i])){
                    //set preferences
                    $config['upload_path'] = './uploads/parkings/'; 
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
                        $parking_image_id = $this->image->add_parking_image(['parking_id' => $parking_id, 'image_id' => $image_id]);
                        if($parking_image_id < 1  ) {
                            $no_errors = false;
                        } 
                    }
                }

                if($no_errors) {
                    $notify_parking = false; //This notification will cater for building aswell

                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Parking data updated successfully'); 
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Parking data NOT updated!!');
                }
            } else {
                $this->session->set_flashdata('type', 'danger');
                $this->session->set_flashdata('title', 'Error');
                $this->session->set_flashdata('text', 'There are some errors (' . count($upload_errors). ') uploading the images');
            }

            //notify if any changes made to building
            if($notify_parking) {
                $this->session->set_flashdata('type', 'success');
                $this->session->set_flashdata('title', 'Success');
                $this->session->set_flashdata('text', 'Parking data updated successfully');
            }
            if($parking_type == 'car') {
                redirect('parking/load_car_parkings');
            } else {
                redirect('parking/load_wheelchair_parkings');
            }
        } else {
            $parking_id = ($this->uri->segment(3) > 0) ? $this->uri->segment(3) : 0;
            if ($parking_id > 0) {
                $data['parking'] = $this->parking->get_parking($parking_id);
                $data['parking_images'] = $this->image->get_parking_images($parking_id);
                $data['parking_categories'] = $this->parking->get_parking_categories();
                $data['view'] = 'parking/_edit_parking.php';
                $this->load->view('_layout.php', $data);
            } else {
                redirect('parking/load_car_parkings');
            }
        }
        }
    }

    public function delete_parking() {
        if (_is_user_login($this)) {
            $parking_id = $this->uri->segment(3);
            if ($parking_id > 0) {
                $parking_images = $this->image->get_parking_images($parking_id);
    
                if ($this->parking->delete_parking($parking_id)) {
                    //delete associated images
                    foreach($parking_images as $delete_image) {
                        $this->image->delete_image($delete_image['image_id']);
                    }
                    
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Parking data deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng Parking');
                }
                redirect('parking/load_car_parkings');
            }else {
                redirect('parking/load_car_parkings');
            }
      }
    }

    public function remove_image() {
        if (_is_user_login($this)) {
            $image_id = $this->uri->segment(3);
            $parking_id = $this->uri->segment(4);
            if ($image_id > 0) {
                $parking_image = $this->image->get_image($image_id);
    
                if ($this->image->delete_image($image_id)) {
                    //successfully deleted image from DB, now delete from file directory
                    $path = base_url() . 'uploads/parkings' . $parking_image->url;
                    // echo $path;
                    unlink($path);
                    
                    $this->session->set_flashdata('type', 'success');
                    $this->session->set_flashdata('title', 'Success');
                    $this->session->set_flashdata('text', 'Parking Image deleted Successfully');
                } else {
                    $this->session->set_flashdata('type', 'danger');
                    $this->session->set_flashdata('title', 'Error');
                    $this->session->set_flashdata('text', 'Error deleteng Parking');
                }
                redirect('parking/edit_parking/' . $parking_id);
            }else {
                redirect('parking/edit_parking/' . $parking_id);
            }
      }
    }

    /***********************Parking ends***************************/
}
