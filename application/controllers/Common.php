<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Common extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        ob_start();
        
        // Load database
        $this->load->model('Common_model', 'common');
        
        if (!isset($this->session->id)) {
            
            redirect('login');
        }
    }
    
    public function index()
    {
    }
    
    
    /*
     * Function Call - To check instructor username is unique or not.
     */
    public function check_username()
    {
        
        if ($this->input->is_ajax_request()) {
            
            $where  = array(
                "username" => $this->input->post('username'),
                "id!=" => $this->session->userdata('id')
            );
            $result = $this->common->username_exists($where);
            echo $result;
        }
    }
    
    /*
     * Function Call - to show 404 page if page not found.
     */
    public function PageNotFound()
    {
        $data['title'] = "404 Not Found";

        $this->load->view('404.view.php', $data);
    }
    
    
    /*
     * Function Call - To destroy the Session and logout User
     */
    public function Logout()
    {
        $this->load->driver('cache');

        delete_cookie('username');

        delete_cookie('password');

        // Removing session data
        $session_data = $this->session->userdata();

        $this->session->unset_userdata($session_data);

        $this->session->sess_destroy();

        $this->cache->clean();

        ob_clean();

        $this->session->set_flashdata('item', array(
            'message' => 'Logout Successfully...!',
            'class' => 'success'
        ));

        echo '<script> window.history.back();</script>';
    }
}