<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreateSet extends CI_Controller
{
    var $TPL;

    public function __construct()
    {
        parent::__construct();

        $this->TPL['loggedin'] = $this->userauth->validSessionExists();
        $this->TPL['active'] = array(
            'home' => false,
            'collection' => false,
            'set' => true,
            'login' => false,
            'signup' => false
        );
    }

    //DISPLAY WEBPAGE
    public function display()
    {
        $this->template->show('createset', $this->TPL);
    }
    //DEFAULT HOME FUNCTION
    public function index()
    {
        $this->display();
    }

    //CREATE A SET METHOD CALLED FROM MODEL
    public function createSets(){
        $success = $this->Sets_model->createSets($this->input->post("name"),$this->input->post("description"),$this->input->post("private"),$_SESSION['userid']);
        $test = $success['CollectionID'];
        echo( $test);
        if ($success['CollectionID'] != 0){
           // redirect('Sets');
        }
        $TPL['error'] = "There was an error when creating the Set.";
        $this->display();
    }
}
