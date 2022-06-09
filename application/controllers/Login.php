<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
    

	 function __construct() {
        parent::__construct();
        $this->load->model("Login_Model",'login');
        $this->load->model('Cogs_Model','cogs');
        if(!isset($_SESSION['system']))
        $sess = $this->cogs->system_session();
       
        
    }

    public function index(){
            if(isset($_SESSION['user_id']))
            redirect(base_url());
            $this->load->view('login');
    }
    function login(){
    $resp = $this->login->login();
    if($resp)
        echo $resp;

    }
    function check_email(){
        extract($_POST);
        $qry = $this->db->query('SELECT * FROM users where email = "'.$email.'" and delete_flag = 0 ')->num_rows();
        if($qry)
        echo $qry;
    }

    function create_account(){
        $resp = $this->login->create_account();
        if($resp)
        echo $resp;
    }
    function logout(){
        
        $this->session->sess_destroy();
        
        redirect(base_url('login'),'refresh');
    }
    }