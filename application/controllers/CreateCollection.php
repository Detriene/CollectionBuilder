<?php
defined('BASEPATH') or exit('No direct script access allowed');

class CreateCollection extends CI_Controller
{
    var $TPL;

    public function __construct()
    {
        parent::__construct();

        $this->TPL['loggedin'] = $this->userauth->validSessionExists();
        $this->TPL['active'] = array(
            'home' => false,
            'collection' => true,
            'set' => false,
            'login' => false,
            'signup' => false
        );
        $this->getSets($_SESSION['userid']);
       // $this->load->model('CreateCollection_model');
       // $this->load->database();
    }

    //DISPLAY WEBPAGE
    public function display()
    {
        $this->template->show('createcollection', $this->TPL);
    }
    //DEFAULT HOME FUNCTION
    public function index()
    {
        $this->display();
    }
    //FUNCTION USED TO OBTAIN SETS AVAILIBLE TO THE USER
    public function getSets($id) 
    {
        //GET USER OWNED SETS
        $this->TPL['sets'] = $this->CreateCollection_model->getUserSets($id);
        //GET PUBLIC SETS
        $publicSets = $this->CreateCollection_model->getpublicsets();
        //ADD SETS TO AN ARRAY FOR OUTPUTING ONLY IF NOT IN THE EXISTING ARRAY
        foreach ($publicSets as $set){
            if (!in_array($set, $this->TPL['sets']))
            {
                array_push ($this->TPL['sets'],$set);
            }
        }
    }
    public function createCollection(){
        $success = $this->CreateCollection_model->CreateCollection($this->input->post("name"),$this->input->post("description"),$_SESSION['userid']);
        $test = $success['CollectionID'];
        echo( $test);
        if ($success['CollectionID'] != 0){
            if ($this->input->post("set") != '0'){
                $success2 = $this->CreateCollection_model->duplicateSet($this->input->post("set"),$success);
                redirect('Collections');
            }
            redirect('Collections');
        }
        $TPL['error'] = "There was an error when creating the collection.";
        $this->display();
    }

    public function validate(){
        $exists = $this->CreateCollection_model->validateName($this->input->post("name"));
        if ($exists != null){
            $TPL['error'] = "This Collection already exists in our Database. Please use a unique name or use the pre-existing set";
            $this->display();
        }
        else {

        }
    }

}
