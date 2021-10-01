<?php
require APPPATH . '/libraries/TokenHandler.php';
//include Rest Controller library
require APPPATH . 'libraries/REST_Controller.php';

class Api extends REST_Controller {

  protected $token;
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
    // creating object of TokenHandler class at first
    $this->tokenHandler = new TokenHandler();
    header('Content-Type: application/json');
  }

  // Unprotected routes will be located here.
  // Fetch all the top courses
  public function top_courses_get($top_course_id = "") {
    $top_courses = array();
    $top_courses = $this->api_model->top_courses_get($top_course_id);
    $this->set_response($top_courses, REST_Controller::HTTP_OK);
  }

  // Fetch all the categories
  public function categories_get($category_id = "") {
    $categories = array();
    $categories = $this->api_model->categories_get($category_id);
    $this->set_response($categories, REST_Controller::HTTP_OK);
  }

  //Fetch all terms
  public function terms_post($section_id = "") {
    $terms = array();
    $terms = $this->api_model->terms_get($section_id);
    $this->set_response($terms, REST_Controller::HTTP_OK);
  }

  //Fetch all terms
  public function subterms_post($section_id = "") {
    $subterms = array();
    $subterms = $this->api_model->subterms_get($section_id);
    $this->set_response($subterms, REST_Controller::HTTP_OK);
  }

  // Fetch all the courses belong to a certain category
  public function category_wise_course_get() {
    $category_id = $_GET['category_id'];
    $courses = $this->api_model->category_wise_course_get($category_id);
    $this->set_response($courses, REST_Controller::HTTP_OK);
  }

  // Fetch all the courses belong to a certain category
  public function languages_get() {
    $languages = $this->api_model->languages_get();
    $this->set_response($languages, REST_Controller::HTTP_OK);
  }

  // Filter course
  public function filter_course_get() {
    $courses = $this->api_model->filter_course();
    $this->set_response($courses, REST_Controller::HTTP_OK);
  }

  // Filter course
  public function courses_by_search_string_get() {
    $search_string = $_GET['search_string'];
    $courses = $this->api_model->courses_by_search_string_get($search_string);
    $this->set_response($courses, REST_Controller::HTTP_OK);
  }
  // get system settings
  public function system_settings_get() {
    $system_settings_data = $this->api_model->system_settings_get();
    $this->set_response($system_settings_data, REST_Controller::HTTP_OK);
  }

  // Login Api
  public function login_get() {
    $userdata = $this->api_model->login_get();
    if ($userdata['validity'] == 1) {
      $userdata['token'] = $this->tokenHandler->GenerateToken($userdata);
    }
    return $this->set_response($userdata, REST_Controller::HTTP_OK);
  }

  public function signup_get() {
    $response = array(
      'success' => 'true'
    );
    $data = array(
      'first_name' => $_GET['firstName'],
      'last_name' => $_GET['lastName'],
      'email' => $_GET['email'],
      'password' => sha1($_GET['password']),
    );

    if(empty($data['first_name']) || empty($data['last_name']) || empty($data['email']) || !isset($_GET['password'])){
      $response['success'] = 'false';
      $response['message'] = 'blank_field';
      return $this->set_response($response, REST_Controller::HTTP_OK);
    }

    $verification_code =  rand(100000, 200000);
    $data['verification_code'] = $verification_code;

    if (get_settings('student_email_verification') == 'enable') {
        $data['status'] = 0;
    }else {
        $data['status'] = 1;
    }

    $data['wishlist'] = json_encode(array());
    $data['watch_history'] = json_encode(array());
    $data['date_added'] = strtotime(date("Y-m-d H:i:s"));
    $social_links = array(
        'facebook' => "",
        'twitter'  => "",
        'linkedin' => ""
    );
    $data['social_links'] = json_encode($social_links);
    $data['role_id']  = 2;

    // Add paypal keys
    $paypal_info = array();
    $paypal['production_client_id'] = "";
    array_push($paypal_info, $paypal);
    $data['paypal_keys'] = json_encode($paypal_info);
    // Add Stripe keys
    $stripe_info = array();
    $stripe_keys = array(
        'public_live_key' => "",
        'secret_live_key' => ""
    );
    array_push($stripe_info, $stripe_keys);
    $data['stripe_keys'] = json_encode($stripe_info);

    $validity = $this->user_model->check_duplication('on_create', $data['email']);

    if ($validity === 'unverified_user' || $validity == true) {
        if($validity === true){
          $this->user_model->register_user($data);
        } else {
          $this->user_model->register_user_update_code($data);
        }

        if (get_settings('student_email_verification') == 'enable') {
          $this->email_model->send_email_verification_mail($data['email'], $verification_code);

          if($validity === 'unverified_user'){
            $response['success'] = 'true';
            $response['message'] = 'already_register_verify_email';
            return $this->set_response($response, REST_Controller::HTTP_OK);
          } else {
            $response['success'] = 'true';
            $response['message'] = 'register_success_check_email';
            return $this->set_response($response, REST_Controller::HTTP_OK);
          }
          $this->session->set_userdata('register_email', $this->input->post('email'));
          redirect(site_url('home/verification_code'), 'refresh');
        } else {
          $response['success'] = 'true';
          $response['message'] = 'register_success';
          return $this->set_response($response, REST_Controller::HTTP_OK);
        }

    } else {
      $response['success'] = 'false';
      $response['message'] = 'already_registered';
      return $this->set_response($response, REST_Controller::HTTP_OK);
    }
  }

  public function verify_email_address_post() {
    $email = $this->input->post('address');
    $verification_code = $this->input->post('code');
    $user_details = $this->db->get_where('users', array('email' => $email, 'verification_code' => $verification_code));
    if($user_details->num_rows() > 0) {        
      $user_details = $user_details->row_array();
      $updater = array(
          'status' => 1
      );
      $this->db->where('id', $user_details['id']);
      $this->db->update('users', $updater);
      return $this->set_response('success', REST_Controller::HTTP_OK);
    } else {
      return $this->set_response('failed', REST_Controller::HTTP_OK);
    }
  }

  public function reset_password_post() {
    $email = $this->input->post('email');
    $new_password = substr( md5( rand(100000000,20000000000) ) , 0,7);

    // Checking credential for admin
    $query = $this->db->get_where('users' , array('email' => $email));
    if ($query->num_rows() > 0)
    {
        $this->db->where('email' , $email);
        $this->db->update('users' , array('password' => sha1($new_password)));
        // send new password to user email
        $this->email_model->password_reset_email($new_password, $email);
        return $this->set_response('success', REST_Controller::HTTP_OK);
    }
    return $this->set_response('error', REST_Controller::HTTP_OK);
  }

  public function resend_verification_code_post(){
    $email = $this->input->post('email');
    $verification_code = $this->db->get_where('users', array('email' => $email))->row('verification_code');
    $this->email_model->send_email_verification_mail($email, $verification_code);
    
    return $this->set_response('success', REST_Controller::HTTP_OK);
  }

  public function course_object_by_id_get() {
    $course = $this->api_model->course_object_by_id_get();
    $this->set_response($course, REST_Controller::HTTP_OK);
  }
  //Protected APIs. This APIs will require Authorization.
  // My Courses API
  public function my_courses_get() {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->my_courses_get($logged_in_user_details['user_id']);
    }else{

    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // My Courses API
  public function my_wishlist_get() {
    $response = array();      
    $auth_token = $_GET['auth_token'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->my_wishlist_get($logged_in_user_details['user_id']);
    }else{

    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  //get lessons from parent id
	public function lessons_from_parent_id_get()
	{
    $response = array();
    $auth_token = $_GET['auth_token'];
    $parent_id  = $_GET['parent_id'];
    $parent_type  = $_GET['parent_type'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->lessons_from_parent_id_get($parent_id, $parent_type, $logged_in_user_details['user_id']);
    }else{
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }
  
  // Get all section info
  public function sections_info_get() {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $course_id  = $_GET['course_id'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->sections_info_get($course_id, $logged_in_user_details['user_id']);
    }else{
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Get all the sections
  public function sections_get() {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $course_id  = $_GET['course_id'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);

    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->sections_get($course_id, $logged_in_user_details['user_id']);
    }else{
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  //Get all lessons, section wise.
  public function section_wise_lessons_get() {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $section_id = $_GET['section_id'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->section_wise_lessons($section_id, $logged_in_user_details['user_id']);
    }else{
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Remove from wishlist
  public function toggle_wishlist_items_get() {
    $auth_token = $_GET['auth_token'];
    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    if ($logged_in_user_details['user_id'] > 0) {
      $status = $this->api_model->toggle_wishlist_items_get($logged_in_user_details['user_id'], $logged_in_user_details['user_id']);
    }
    $response['status'] = $status;
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Lesson Details
  public function lesson_details_get() {
    $response = array();
    $auth_token = $_GET['auth_token'];
    $lesson_id = $_GET['lesson_id'];

    $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->lesson_details_get($logged_in_user_details['user_id'], $lesson_id);
    }else{

    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Course Details
  public function course_details_by_id_get() {
    $response = array();
    $course_id = $_GET['course_id'];
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
    }else{
      $logged_in_user_details['user_id'] = 0;
    }
    if ($logged_in_user_details['user_id'] > 0) {
      $response = $this->api_model->course_details_by_id_get($logged_in_user_details['user_id'], $course_id);
    }else{
      $response = $this->api_model->course_details_by_id_get(0, $course_id);
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // submit quiz view
  public function submit_quiz_post() {
    $submitted_quiz_info = array();
    $container = array();
    $quiz_id = $this->input->post('lesson_id');
    $quiz_questions = $this->crud_model->get_quiz_questions($quiz_id)->result_array();
    $total_correct_answers = 0;
    foreach ($quiz_questions as $quiz_question) {
      $submitted_answer_status = 0;
      $correct_answers = json_decode($quiz_question['correct_answers']);
      $submitted_answers = array();
      foreach ($this->input->post($quiz_question['id']) as $each_submission) {
        if (isset($each_submission)) {
          array_push($submitted_answers, $each_submission);
        }
      }
      sort($correct_answers);
      sort($submitted_answers);
      if ($correct_answers == $submitted_answers) {
        $submitted_answer_status = 1;
        $total_correct_answers++;
      }
      $container = array(
        "question_id" => $quiz_question['id'],
        'submitted_answer_status' => $submitted_answer_status,
        "submitted_answers" => json_encode($submitted_answers),
        "correct_answers"  => json_encode($correct_answers),
      );
      array_push($submitted_quiz_info, $container);
    }
    $page_data['submitted_quiz_info']   = $submitted_quiz_info;
    $page_data['total_correct_answers'] = $total_correct_answers;
    $page_data['total_questions'] = count($quiz_questions);
    $this->load->view('lessons/quiz_result', $page_data);
  }

  public function save_course_progress_get() {
    $response = array();
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $response = $this->api_model->save_course_progress_get($logged_in_user_details['user_id']);
    }else{

    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  //Upload user image
  public function upload_user_image_post() {
    $response = array();
    if (isset($_POST['auth_token']) && !empty($_POST['auth_token'])) {
      $auth_token = $_POST['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      if ($logged_in_user_details['user_id'] > 0) {
        if (isset($_FILES['file']) && $_FILES['file']['name'] != "") {
          $user_image = $this->db->get_where('users', array('id' => $logged_in_user_details['user_id']))->row('image').'.jpg';
          if(file_exists('uploads/user_image/' . $user_image)){
            unlink('uploads/user_image/' . $user_image);
          }
          $data['image'] = md5(rand(10000, 10000000));
          $this->db->where('id', $logged_in_user_details['user_id']);
          $this->db->update('users', $data);
          move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/user_image/'.$data['image'].'.jpg');
        }
        $response['status'] = 'success';
      }
    }else{
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // update user data
  public function update_userdata_post() {
    $response = array();
    if (isset($_POST['auth_token']) && !empty($_POST['auth_token'])) {
      $auth_token = $_POST['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      if ($logged_in_user_details['user_id'] > 0) {
        $response = $this->api_model->update_userdata_post($logged_in_user_details['user_id']);
      }
    }else{
      $response['status'] = 'failed';
      $response['error_reason'] = get_phrase('unauthorized_login');
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // password reset
  public function update_password_post() {
    $response = array();
    if (isset($_POST['auth_token']) && !empty($_POST['auth_token'])) {
      $auth_token = $_POST['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      if ($logged_in_user_details['user_id'] > 0) {
        $response = $this->api_model->update_password_post($logged_in_user_details['user_id']);
      }
    }else{
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // Get user data
  public function userdata_get() {
    $response = array();
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $response = $this->api_model->userdata_get($logged_in_user_details['user_id']);
      $response['status'] = 'success';
    }else{
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }

  // check whether certificate addon is installed and get certificate
  public function certificate_addon_get() {
    $response = array();
    if (isset($_GET['auth_token']) && !empty($_GET['auth_token'])) {
      $auth_token = $_GET['auth_token'];
      $logged_in_user_details = json_decode($this->token_data_get($auth_token), true);
      $user_id = $logged_in_user_details['user_id'];
      $course_id = $_GET['course_id'];

      $response = $this->api_model->certificate_addon_get($user_id, $course_id);
    }else{
      $response['status'] = 'failed';
    }
    return $this->set_response($response, REST_Controller::HTTP_OK);
  }
  /////////// Generating Token and put user data into  token ///////////

  //////// get data from token ////////////
  public function GetTokenData()
  {
    $received_Token = $this->input->request_headers('Authorization');
    if (isset($received_Token['Token'])) {
      try
      {
        $jwtData = $this->tokenHandler->DecodeToken($received_Token['Token']);
        return json_encode($jwtData);
      }
      catch (Exception $e)
      {
        http_response_code('401');
        echo json_encode(array( "status" => false, "message" => $e->getMessage()));
        exit;
      }
    }else{
      echo json_encode(array( "status" => false, "message" => "Invalid Token"));
    }
  }

  public function token_data_get($auth_token)
  {
    //$received_Token = $this->input->request_headers('Authorization');
    if (isset($auth_token)) {
      try
      {

        $jwtData = $this->tokenHandler->DecodeToken($auth_token);
        return json_encode($jwtData);
      }
      catch (Exception $e)
      {
        echo 'catch';
        http_response_code('401');
        echo json_encode(array( "status" => false, "message" => $e->getMessage()));
        exit;
      }
    }else{
      echo json_encode(array( "status" => false, "message" => "Invalid Token"));
    }
  }
}
