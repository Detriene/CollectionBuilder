<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ViewCollection extends CI_Controller
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
        $this->template->show('viewcollection', $this->TPL);
    }
    public function index()
    {
        $this->display();
    }
    public function getCollection($id) 
    {
        // get collection name
        $query = $this->db->query("SELECT * FROM sep_Collections WHERE CollectionID=?", array($id));
        $collection = $query->result_array()[0];
        $this->TPL['collection'] = $collection;

        // get list of item id's in collection
        $query = $this->db->query("SELECT * FROM sep_CollectionItems WHERE CollectionID=?", array($id));
        $result = $query->result_array();
        $listOfItems = array();
        foreach ($result as $row)
        {
            array_push($listOfItems, $row);
        }

        // retrieve all item info for all items in collection
        $this->TPL['items'] = array();
        foreach ($listOfItems as $item)
        {
            $query = $this->db->query("SELECT * FROM sep_Items WHERE ItemID=?", array($item['ItemID']));
            $results = $query->result_array()[0];
            $results['Owned'] = $item['Owned'];
            array_push($this->TPL['items'], $results);
        }
        $this->index();
    }
}
