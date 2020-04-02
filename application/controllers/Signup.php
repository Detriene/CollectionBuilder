<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Signup extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code
    $this->TPL['active'] = array(
      'home' => false,
      'collection' => false,
      'set' => false,
      'login' => false,
      'signup' => true
    );

    $this->load->model('signup_model');
    $this->load->database();
  }

  public function index()
  {
    $this->template->show('signup', $this->TPL);
  }

  public function CheckUser()
  {
    $results = $this->signup_model->validate($this->input->post("username"));
    if ($results != null)
    {
      $this->TPL['error'] = true;
      echo $date = date("Y-m-d");
      $this->index(); 
    }
    else{
    $this->signup_model->newEntry($this->input->post("username"),$this->input->post("password"));
    $this->TPL['success'] = true;
    $this->index();
    }
  }

  public function logout()
  {
    $this->userauth->logout();
  }
}
