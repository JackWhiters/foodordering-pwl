<?php


if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login_Model extends CI_Model {

 function __construct() {
        parent::__construct();
    }


    function create_account(){
        extract($_POST);
        $data['firstname'] = $firstname;
        $data['lastname'] = $lastname;
        $data['email'] = $email2;
        $data['password'] = md5($password);
        $data['phone_number'] = $phone_number;
       
        if(!isset($type))
        $data['type'] = 5;
        else
        $data['type'] = $type;

        $insert = $this->db->insert('users',$data);
        if($insert){
            $user_id= $this->db->insert_id();
            $data['user_id'] = $user_id;
            foreach($data as $key => $val){
                if($key != 'password')
                $this->session->set_userdata($key,$val);
            }

            $resp['status'] = 'success';
            $resp['type']=$data['type'];
            return json_encode($resp);
        }

    }
    function login(){
        extract($_POST);
        $chk_email = $this->db->get_where('users',array('email'=>$email))->num_rows();
        if($chk_email <= 0 ){
            $resp['status'] = 'email_unknown';
        }else{
            $qry = $this->db->get_where('users',array('email'=>$email,'password'=>md5($password)));
            if($qry->num_rows() <= 0){
            $resp['status'] = 'login_failed';
            }else{
                if($qry->row()->status ==2 ){
                 $resp['status'] = 'blocked';
                    
                }else{
                    foreach($qry->row() as $key => $val){
                    if($key != 'password'){
                        $key = $key == 'id' ? 'user_id' : $key;
                        $this->session->set_userdata($key,$val);
                    }
                }

                $resp['status'] = 'success';
                $resp['type'] = $this->session->userdata('type');
                }
                
            }
        }
        return json_encode($resp);
    }

}