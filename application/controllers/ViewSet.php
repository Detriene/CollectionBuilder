<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ViewSet extends CI_Controller
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

    public function display()
    {
        $this->template->show('viewset', $this->TPL);
    }
    public function index()
    {
        $this->display();
    }
    public function getSet($id) 
    {
        // get collection name
        $set = $this->Sets_model->getName($id);
        $this->TPL['sets'] = $set;

        // get list of item id's in collection
        $result = $this->Sets_model->getsetitems($id);
        $listOfItems = array();
        foreach ($result as $row)
        {
            array_push($listOfItems, $row);
        }

        // retrieve all item info for all items in collection
        $this->TPL['items'] = array();
        foreach ($listOfItems as $item)
        {
            $results = $this->Sets_model->getitemdetails($item['ItemID']);
            $results['Owned'] = $item['Owned'];
            array_push($this->TPL['items'], $results);
        }
        $this->index();
    }
}
