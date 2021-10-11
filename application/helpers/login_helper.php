<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('_is_user_login')) {

    function _is_user_login($thi) {
        $user_id = _get_current_user_id($thi);
        $user_type = _get_current_user_type($thi);

        if (isset($user_id) && $user_id != "" && isset($user_type) && $user_type != "") {
            return true;
        } else {
            $thi->load->view('_no_access');
            return false;
        }
    }

}
if (!function_exists('_is_frontend_user_login')) {

    function _is_frontend_user_login($thi) {
        $userid = _get_current_user_id($thi);
        $usertype = _get_current_user_type($thi);

        if (isset($userid) && $userid != "" && isset($usertype) && $usertype != "") {
            return true;
        } else {

            return false;
        }
    }

}
if (!function_exists('_get_current_user_id')) {

    function _get_current_user_id($thi) {
        return $thi->session->userdata("user_id");
    }

}

if (!function_exists('_get_current_user_type')) {

    function _get_current_user_type($thi) {
        return $thi->session->userdata("user_type");
    }

}

if (!function_exists('_get_current_fullname')) {

    function _get_current_fullname($thi) {
        $query = $thi->db->query("SELECT fname, lname FROM tbl_admin WHERE admin_id = " . $thi->session->userdata("user_id"));
        return $query->row('fname') . ' ' . $query->row('lname');
    }

}

if (!function_exists('_get_user_redirect')) {

    function _get_user_redirect($thi) {
        return "dashboard";
    }

}

if (!function_exists('_generate_code')) {

    function _generate_code()
    {
        // $permitted_chars = "0123456789";
        // $length = strlen($permitted_chars);
        // $key = '';
        // for ($i = 0; $i < 5; $i++) {
        //     $random_char = $permitted_chars[mt_rand(0, $length - 1)];
        //     $key .= $random_char;
        // }
        $key = '12345';
        return $key;
    }

}
