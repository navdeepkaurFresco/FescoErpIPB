<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load database
        $this->load->model('Login_model', 'login');
        
        $this->output->set_header('X-FRAME-OPTIONS: SAMEORIGIN');
        
        // load php mailer
        $this->load->library('Phpmailer');
        
        if (isset($this->session->adminLogin)) {
            redirect('/admin/home');
        }
        if (isset($this->session->instructorLogin)) {
            redirect('/instructor/home');
        } elseif (isset($this->session->frontendLogin)) {
            echo '<script> window.history.back();</script>';
        }
    }
    
    /*
     * Redirect to another page according to session data
     */
    public function index()
    {
        if (!isset($this->session->id)) {
            $this->load->view('admin/login.view.php');
        }else{
            echo '<script> window.history.back();</script>';
        }
    }
    
    /*
     * Check for user login process
     * Required params - @email,@password
     */
    public function checkAdminLogin()
    {
        if ($this->input->post('loginbtn')) {
            $username = $this->input->post('username');
            
            $password = $this->input->post('password');
           
            $remember_me = $this->input->post('remember_me');
            
            $condition = "(email = '" . $username . "' OR  phone = '" . $username . "' ) AND password='" . hash_password($password) . "' ";
            
            $result = $this->login->login($condition);
            
            if (!empty($result)) {
                if ($remember_me == Null) {
                    delete_cookie('username');
                    delete_cookie('password');
                } else {
                    setcookie('username', $username, time() + 60 * 60 * 30);
                    setcookie('password', $password, time() + 60 * 60 * 30);
                }
                
                $userType = $result['user_type'];
                
                if ($userType == '0') {
                    $session_data = array(
                        'id' => $result['id'],
                        'email' => $result['email'],
                        'phone' => $result['phone'],
                        'fullname' => $result['fullname'],
                        'password' => $result['password'],
                        'user_type' => $result['user_type'],
                        'profile_image' => $result['profile_image'],
                        'designation' => $result['designation'],
                        'adminLogin' => '1'
                    );
                    
                    // Add user data in session
                    $this->session->set_userdata($session_data);
                    
                    $this->session->set_flashdata('item', array(
                        'message' => 'Login for Super Admin is successfull...!',
                        'class' => 'success'
                    ));
                    
                    redirect('admin/home');
                    
                } elseif ($userType == '1') {
                    $session_data = array(
                        'id' => $result['id'],
                        'email' => $result['email'],
                        'phone' => $result['phone'],
                        'fullname' => $result['fullname'],
                        'password' => $result['password'],
                        'user_type' => $result['user_type'],
                        'designation' => $result['designation'],
                        'profile_image' => $result['profile_image'],
                        'instructorLogin' => '1'
                    );
                    
                    // Add user data in session
                    $this->session->set_userdata($session_data);
                    
                    $this->session->set_flashdata('item', array(
                        'message' => 'Login for Instructor Panel is successfull...!',
                        'class' => 'success'
                    ));
                    
                    redirect('/instructor/home');
                    
                } elseif ($userType == '2') {
                    $isActive = $result['is_deactive'];
                    
                    if ($isActive == '1') {
                        $this->session->set_flashdata('item', array(
                            'message' => 'Dear ' . $result['fullname'] . ', Your account has been De-activated due to some reasons. Please Contact Support to activate your account.',
                            'class' => 'warning'
                        ));
                    } else {
                        $session_data = array(
                            'id' => $result['id'],
                            'email' => $result['email'],
                            'phone' => $result['phone'],
                            'password' => $result['password'],
                            'fullname' => $result['fullname'],
                            'user_type' => $result['user_type'],
                            'profile_image' => $result['profile_image'],
                            'frontendLogin' => '1'
                        );
                        
                        // Add user data in session
                        $this->session->set_userdata($session_data);
                        
                        $this->session->set_flashdata('item', array(
                            'message' => 'Login for Student Panel is successfull...!',
                            'class' => 'success'
                        ));
                       
                        redirect('student/home');
                        //echo '<script> window.history.back();</script>';
                    }
                } else {
                    $this->session->set_flashdata('item', array(
                        'message' => 'You are not authorised to Login here...!',
                        'class' => 'danger'
                    ));
                }
                
            } else {
                $this->session->set_flashdata('item', array(
                    'message' => 'Invalid Email/Phone or Password...!',
                    'class' => 'danger'
                ));
            }
        }
        $this->load->view('admin/login.view.php');
    }
    
    /*
     * Function Call - To reset password
     * Required params - @email
     */
    
    public function RecoverPassword()
    {
        $this->load->view('admin/recover_password.view.php');
    }
    
    public function sentMail()
    {
        if ($this->input->post('send_mail')) {
            $email = $this->input->post('email');
            
            $emailCondition = array(
                "email" => $email
            );
            
            $checkEmail = $this->login->checkEmail($emailCondition);
            
            if (!empty($checkEmail)) {
                $passwordResetString = randomString();
                
                //send reset code on phone via SMS
                $userPhone   = '91' . $checkEmail['phone'];
                $studentName = $checkEmail['fullname'];
                $to = $checkEmail['email'];
                $subject  = "Forgot Password";
                $message  = 'Dear ' . ucwords($studentName) . ', <br>Please use this code ' . $passwordResetString . ' to recover your password.<br><br>Thanks';
                
                //$sendmsg = sendSMS($userPhone, $SMSmessage);
                
                //send reset code via email
                $pwd_reset_code = array(
                    'pwd_reset_code' => $passwordResetString
                );
                $this->login->update_data('users_details',$pwd_reset_code,$emailCondition);
                if(test_email($to,$subject,$message,$attach = ''))
                {
                     echo $passwordResetString;
                 }
            } else {
                echo false;
            }
        }
    }
    
    public function changePassword()
    {
        if ($this->input->post('recoverPwd')) {
            $newPassword = array(
                'password' => hash_password($this->input->post('newPassword'))
            );
            
            $resetcode = $this->input->post('resetcode');
            
            $result = $this->login->changePassword($resetcode, $newPassword);
            
            $checkUserDetails = $this->login->checkEmail($dataCondition = array(
                'pwd_reset_code' => $resetcode
            ));
            
            if ($result) {
                //send success message to user after recover password successfully.
                $subject = "Password Reset Notification";
                $userPhone  = '91' . $checkUserDetails['phone'];
                $userName   = $checkUserDetails['fullname'];
                $email = $checkUserDetails['email'];
                $message = 'Dear ' . ucwords($userName) . ', Your password has been changed successfully.';
                
                //$sendmsg = sendSMS($userPhone, $SMSmessage);
                if(test_email($email,$subject,$message,$attach = '')){
                    echo json_encode(array(
                        "response" => 1
                    ));
                }
                
                
            } else {
                //send failure message if recover password failed.
                $userPhone  = '91' . $checkUserDetails['phone'];
                $userName   = $checkUserDetails['fullname'];
                $SMSmessage = 'Dear ' . ucwords($userName) . ', We are sorry. Password recovery failed. Please try again.';
                
                $sendmsg = sendSMS($userPhone, $SMSmessage);
                
                echo json_encode(array(
                    "response" => 0
                ));
            }
        }
    }
    
}