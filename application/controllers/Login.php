<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();
    // Your own constructor code

    $this->TPL['loggedin'] = false;
    $this->TPL['active'] = array(
      'home' => false,
      'collection' => false,
      'set' => false,
      'login' => true,
      'signup' => false
    );
  }

  public function index()
  {
    $this->template->show('login', $this->TPL);
  }

  public function loginuser()
  {
    $this->TPL['msg'] =
      $this->userauth->login(
        $this->input->post("username"),
        $this->input->post("password")
      );
    echo $this->TPL['msg'];
    $this->template->show('login', $this->TPL);
  }

  public function logout()
  {
    $this->userauth->logout();
  }
}
