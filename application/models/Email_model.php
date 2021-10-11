<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Email_model extends MY_Model {

	public function __construct()
	{
		parent::__construct();
		$this -> result_mode = 'object';
	}

	
	public function send_mail($to,$subject,$message)
	{
            
        $config = array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.gmail.com',
            'smtp_user' => '2019614417@ufs4life.ac.za',
            'smtp_pass' => 'Matebello@2147',
            'smtp_port' => 587,
            'crlf' => "\r\n",
            'newline' => "\r\n");
        
        $this->load->library('email',$config);

        $this->email->set_mailtype("html");
        $this->email->from('2019614417@ufs4life.ac.za', 'UFS Project');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();

        // echo $this->email->print_debugger();
	}
}