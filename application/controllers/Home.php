<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  var $TPL;

  public function __construct()
  {
    parent::__construct();

    $this->TPL['loggedin'] = $this->userauth->validSessionExists();
    $this->getpublicsets();
    $this->TPL['active'] = array(
      'home' => true,
      'collection' => false,
      'set' => false,
      'login' => false,
      'signup' => false
    );
  }
  public function getpublicsets(){
    $sets = $this->Sets_model->getpublicsets();
    $this->TPL['sets'] = $sets;
  }

  public function display()
  {
    $this->template->show('home', $this->TPL);
  }
  public function index()
  {
    $this->display();
  }
}
