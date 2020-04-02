<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Collections extends CI_Controller
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
    }

    public function display()
    {
        $this->TPL['collections'] = $this->selectUsersCollections();
        $this->template->show('collections', $this->TPL);
    }
    public function index()
    {
        $this->display();
    }
    private function selectUsersCollections() 
    {
        $_SESSION['userid'] = 1;
        $query = $this->db->query("SELECT CollectionID FROM sep_UserCollections WHERE UserID=?", array($_SESSION['userid']));
        $collections = $query->result_array();

        for ($i = 0; $i < count($collections); $i++) 
        {
            $query = $this->db->query("SELECT Name from sep_Collections WHERE CollectionID=?", array($collections[$i]['CollectionID']));
            $name = $query->result_array();
            $collections[$i]['Name'] = $name[0]['Name'];
        }
        return $collections;
    }
}
