<?php
/* 
 * Razorpay Controller
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Razorpay extends CI_Controller
{
    /*
     * construct method
     */
    public function __construct()
    {
        parent::__construct();
        
        // Load models
        $this->load->model('Frontend_model', 'frontend');

        $this->load->model('Razorpay_model', 'razorpay');

        $this->load->model('StudentPanel_model', 'student_model');
    }
    
    /*
     * index page
     */
    public function index()
    {
        $data['title'] = "Checkout | IPB India";
        
        if ($this->input->get('id')) {
            redirect('checkout');
        } else {
            redirect();
        }
        $this->load->view('frontend/checkout.view.php', $data);
    }
    
    /*
     * checkout page
     */
    public function checkout()
    {
        $data['title'] = "Checkout | IPB India";
        
        $studentID = $this->session->userdata('id');
        $condition = array(
            'id' => $studentID
        );
        $data['StudentData'] = $this->frontend->student_login($condition);
        
        $URLData  = decryptID($this->uri->segment(2));
        $moduleID = $URLData['0'];
        if ($moduleID != 'CP') {
            $data['itemInfo'] = $this->frontend->getProductDetails($moduleID);
        } else {
            $data['itemInfo'] = $this->frontend->getPackageDetails($moduleID);
        }
        
        $data['return_url']    = base_url() . 'razorpay/callback';
        $data['surl']          = base_url() . 'razorpay/success';
        $data['furl']          = base_url() . 'razorpay/failed';
        $data['currency_code'] = 'INR';
        
        
        if ($this->session->userdata('frontendLogin') == 1) {
            $this->load->view('frontend/logincheckout.view.php', $data);
        } else {
            $this->load->view('frontend/checkout.view.php', $data);
        }
    }
    
    /*
     * checkout page
     */
    public function loginregistercheckout()
    {
        $data['title'] = "Checkout | IPB India";
        $redirect_id   = $this->input->post('redirect_id');
        $studentID     = $this->session->userdata('id');
        
        if (!empty($studentID)) {
            $condition           = array(
                'id' => $studentID
            );
            $data['StudentData'] = $this->frontend->student_login($condition);
        } else {
            if ($this->input->post("loginBtn")) {
                $email = $this->input->post('email');
                
                if (!empty($this->input->post('login_with_password'))) {
                    $password   = hash_password($this->input->post('login_with_password'));
                    $condition  = "(email= '" . $email . "' OR  phone= '" . $email . "' ) AND password='" . $password . "' ";
                    $userDetail = $this->frontend->student_login($condition);
                    
                    if (!empty($userDetail)) {
                        $session_data = array(
                            'id' => $userDetail['id'],
                            'email' => $userDetail['email'],
                            'phone' => $userDetail['phone'],
                            'password' => $userDetail['password'],
                            'fullname' => $userDetail['fullname'],
                            'user_type' => $userDetail['user_type'],
                            'profile_image' => $userDetail['profile_image'],
                            'frontendLogin' => '1'
                        );
                        // Add user data in session
                        $this->session->set_userdata($session_data);
                        $data['StudentData'] = $userDetail;
                    } else {
                        $this->session->set_flashdata('alertmessage', array(
                            'message' => 'Invalid Credentials...!',
                            'class' => 'danger'
                        ));
                    }
                }
                
                if (!empty($this->input->post('login_with_otp'))) {
                    $cookie_OTP = get_cookie('otp_value');
                    
                    $user_otp = $this->input->post('login_with_otp');
                    
                    if ($cookie_OTP == $user_otp) {
                        $where = "(email= '" . $email . "' OR  phone= '" . $email . "' )";
                        
                        $userDetail = $this->frontend->student_login($where);
                        
                        if (!empty($userDetail)) {
                            $session_data = array(
                                'id' => $userDetail['id'],
                                'email' => $userDetail['email'],
                                'phone' => $userDetail['phone'],
                                'password' => $userDetail['password'],
                                'fullname' => $userDetail['fullname'],
                                'user_type' => $userDetail['user_type'],
                                'profile_image' => $userDetail['profile_image'],
                                'frontendLogin' => '1'
                            );
                            // Add user data in session
                            $this->session->set_userdata($session_data);
                            $data['StudentData'] = $userDetail;
                        } else {
                            $this->session->set_flashdata('alertmessage', array(
                                'message' => 'Invalid Credentials...!',
                                'class' => 'danger'
                            ));
                        }
                    } else {
                        $this->session->set_flashdata('alertmessage', array(
                            'message' => 'You entered wrong OTP...!',
                            'class' => 'danger'
                        ));
                    }
                }
            }
            
            // for registration
            if ($this->input->post("signupBtn")) {
                $new_user_email = $this->input->post('new_user_email');
                $new_user_phone = $this->input->post('new_user_phone');
                $otp            = $this->input->post('otp');
                $reg_fullname   = $this->input->post('reg_fullname');
                $reg_phone      = $this->input->post('reg_phone');
                $reg_email      = $this->input->post('reg_email');
                $reg_password   = $this->input->post('reg_password');
                
                $useremail = (!empty($new_user_email)) ? $new_user_email : $reg_email;
                $userphone = (!empty($new_user_phone)) ? $new_user_phone : $reg_phone;
                
                $studentDetails = array(
                    'fullname' => $reg_fullname,
                    'email' => $useremail,
                    'user_type' => '2',
                    'designation' => 'Student',
                    'phone' => $userphone,
                    'password' => hash_password($reg_password),
                    'profile_image' => base_url('app-assets/images/dummy.png')
                );
                
                $NewstudentDetails = $this->frontend->create_new_student($studentDetails);
                
                if (!empty($NewstudentDetails)) {
                    $studentName  = $NewstudentDetails['fullname'];
                    $studentemail = $NewstudentDetails['email'];
                    $studentphone = $NewstudentDetails['phone'];
                    
                    // Send mail after successfull registration
                    $emailData = array(
                        "to_email" => $studentemail,
                        "subject" => "Welcome in IPB E-Learning",
                        "template_name" => "ipb_student_registration",
                        "template_content" => array(
                            array(
                                "name" => "student_name",
                                "content" => $studentName
                            ),
                            array(
                                "name" => "username",
                                "content" => $studentemail
                            ),
                            array(
                                "name" => "password",
                                "content" => $this->input->post('password')
                            )
                        )
                    );
                    mandrill_mail($emailData);
                    
                    // Send SMS on Mobile
                    $studentPhone = '91' . $studentphone;
                    $SMSmessage   = 'Dear ' . ucwords($studentName) . ', Welcome to IPB. Jumpstart your professional career with our e-learning portal. Click here ' . base_url('login') . ' and start your journey.';
                    $sendmsg      = sendSMS($studentPhone, $SMSmessage);
                    
                    // Redirect to Dashboard
                    $session_data = array(
                        'id' => $NewstudentDetails['id'],
                        'email' => $studentemail,
                        'phone' => $NewstudentDetails['phone'],
                        'password' => $NewstudentDetails['password'],
                        'fullname' => $NewstudentDetails['fullname'],
                        'user_type' => $NewstudentDetails['user_type'],
                        'profile_image' => $NewstudentDetails['profile_image'],
                        'frontendLogin' => '1'
                    );
                    // Add user data in session
                    $this->session->set_userdata($session_data);
                }
                $data['StudentData'] = $NewstudentDetails;
            }
        }
        
        $URLData  = decryptID($this->uri->segment(2));
        $moduleID = $URLData['0'];
        if ($moduleID != 'CP') {
            $data['itemInfo'] = $this->frontend->getProductDetails($moduleID);
        } else {
            $data['itemInfo'] = $this->frontend->getPackageDetails($moduleID);
        }
        
        $data['return_url']    = base_url() . 'razorpay/callback';
        $data['surl']          = base_url() . 'razorpay/success';
        $data['furl']          = base_url() . 'razorpay/failed';
        $data['currency_code'] = 'INR';
        
        $this->load->view('frontend/checkout.view.php', $data);
    }
    
    /*
     * initialized cURL Request
     */
    private function get_curl_handle($razorpay_payment_id, $amount)
    {
        $service_url = 'https://api.razorpay.com/v1/payments/' . $razorpay_payment_id . '/capture';
        $postfields  = array(
            'amount' => $amount
        );
        $serviceAuth = RAZOR_KEY_ID . ':' . RAZOR_KEY_SECRET;
        $curl        = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_USERPWD, $serviceAuth);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        return $curl;
    }
    
    /*
     * callback method
     */
    public function callback()
    {
        if ($this->input->post('razorpay_payment_id') && $this->input->post('merchant_order_id')) {
            $currency_code       = 'INR';
            $razorpay_payment_id = $this->input->post('razorpay_payment_id');
            $order_id            = $this->input->post('merchant_order_id');
            $merchant_trans_id   = $this->input->post('merchant_trans_id');
            $cardHolderName      = $this->input->post('card_holder_name_id');
            $orderTotal          = $this->input->post('merchant_amount');
            $amount              = $this->input->post('merchant_total');
            $user_id             = $this->input->post('user_id');
            $module_id           = $this->input->post('module_id');
            $complete_package    = $this->input->post('complete_package');
            $success             = false;
            $error               = '';
            
            try {
                $curl   = $this->get_curl_handle($razorpay_payment_id, $amount);
                //execute post 
                $result = curl_exec($curl);
                
                $http_status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
                
                if ($result === false) {
                    $success = false;
                    $error   = 'Curl error: ' . curl_error($curl);
                } else {
                    $response_array = json_decode($result, true);
                    if ($http_status === 200 and isset($response_array['error']) === false) {
                        $success = true;
                        
                        $transactionDetails = array(
                            'order_id' => $order_id,
                            'user_id' => $user_id,
                            'module_id' => $module_id,
                            'complete_package' => $complete_package,
                            'payment_id' => $razorpay_payment_id,
                            'order_total' => $orderTotal,
                            'currency' => $response_array['currency'],
                            'payment_status' => $response_array['status'],
                            'payment_method' => $response_array['method'],
                            'user_email' => $response_array['email'],
                            'user_contact' => $response_array['contact'],
                            'order_description' => $response_array['description']
                        );
                        $saveTransaction    = $this->frontend->saveTransactionDetails($transactionDetails);
                    } else {
                        $success = false;
                        if (!empty($response_array['error']['code'])) {
                            $error = $response_array['error']['code'] . ':' . $response_array['error']['description'];
                        } else {
                            $error = 'RAZORPAY_ERROR:Invalid Response <br/>' . $result;
                        }
                    }
                }
                //close connection
                curl_close($curl);
            }
            catch (Exception $e) {
                $success = false;
                $error   = 'OPENCART_ERROR:Request to Razorpay Failed';
            }
            if ($success === true) {
                if (!$this->session->userdata('ci_subscription_keys')) {
                    $this->session->unset_userdata('ci_subscription_keys');
                }
                redirect($this->input->post('merchant_surl_id'));
            } else {
                redirect($this->input->post('merchant_furl_id'));
            }
        } else {
            echo 'An error occured. Contact site administrator, please!';
        }
    }
    
    /*
     * Function Call - method will called when razorpay return success.
     */
    public function success()
    {
        $data['title'] = 'Razorpay Success | IPB India';
        
        $studentID = $this->session->userdata('id');
        
        $StudentDetails = $this->frontend->student_last_purchase($studentID);
        
        if ($StudentDetails) {
            $studentPhone = '91' . $StudentDetails['phone'];
            $studentName  = $StudentDetails['fullname'];
            $SMSmessage   = 'Dear ' . ucwords($studentName) . ', You\'ve successfully bought ' . ucwords($StudentDetails['course_title']) . ' course. Please click below to explore more. ' . base_url('login');
            
            $sendmsg = sendSMS($studentPhone, $SMSmessage);
        }
        
        $data['AllModules'] = $this->student_model->getAllModules($studentID);
        
        $data['BoughtModules'] = $this->student_model->get_bought_modules($studentID);
        
        $this->load->view('student/courses.view.php', $data);
    }
    
    /*
     * Function Call - if payment failed.
     */
    public function failed()
    {
        $data['title'] = 'Razorpay Failed | IPB India';
        
        $studentID = $this->session->userdata('id');
        
        $StudentDetails = $this->frontend->student_last_purchase($studentID);
        
        if ($StudentDetails) {
            $studentPhone = '91' . $StudentDetails['phone'];
            $studentName  = $StudentDetails['fullname'];
            $SMSmessage   = 'Dear ' . ucwords($studentName) . ', Your payment for ' . ucwords($StudentDetails['course_title']) . ' has been failed. Please try again. Click here to continue. ' . base_url('login');
            
            $sendmsg = sendSMS($studentPhone, $SMSmessage);
        }
        $this->load->view('razorpay/failed', $data);
    }
}
?>