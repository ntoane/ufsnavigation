<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/CreatorJwt.php';

class JwtToken_model extends MY_Model 
{
    public function __construct()
    {
        parent::__construct();
        
        $this->objOfJwt = new CreatorJwt();
        header('Content-Type: application/json');
    }

    /*************Ganerate token this function use**************/

    public function login_token($data)
    {

        $tokenData['uniqueId'] = '11';
        $tokenData['exp'] = time() + (60*600);//valid for 6hr
        $tokenData['role'] = 'Ntoane';
        $tokenData['timeStamp'] = Date('Y-m-d h:i:s');
        $tokenData['data'] = [
            'std_number' => $data->std_number,
            'firstname' => $data->std_fname,
            'lastname' => $data->std_lname,
        ];
        $jwtToken = $this->objOfJwt->GenerateToken($tokenData);
        return $jwtToken;
    }
     
   /*************Use for token then fetch the data**************/
         
    public function token_data()
    {
        $received_Token = $this->input->request_headers('Authorization');
        try
        {
            $jwtData = $this->objOfJwt->DecodeToken($received_Token['Token']);
            //echo json_encode($jwtData);
            return $jwtData;
        }
        catch (Exception $e)
            {
            http_response_code('401');
            return array( "status" => false, "message" => $e->getMessage());
            exit;
        }
    }

    public function validate_token($data) {
        // get jwt
        $jwt = isset($data->token) ? $data->token : "";
        
        // if token is not empty
        if($jwt){
        
            // if decode succeed, show user details
            try {
                // decode jwt
                $decoded = $this->objOfJwt->DecodeToken($jwt);
        
                // set response code
                http_response_code(200);
        
                // show user details
                return (array(
                    "message" => "Access granted",
                    "data" => $decoded['data']
                ));
        
            }
            // if decode fails, it means jwt is invalid
            catch (Exception $e){
            
                // set response code
                http_response_code(401);
            
                // tell the user access denied  & show error message
                return (array(
                    "message" => "Access denied",
                    "error" => $e->getMessage()
                ));
            }
        }
        
        // show error message if jwt is empty
        else{
        
            // set response code
            http_response_code(401);
        
            // tell the user access denied
            return (array("message" => "Access denied"));
        }
    }
}
        