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
            $results['DateAdded'] = $item['DateAdded'];
            array_push($this->TPL['items'], $results);
        }
        $this->index();
    }
    public function changeOwned()
    {
        $owned = $this->input->post("owned");
        $ownedBool = 0;
        if ($owned == "true") {
            $ownedBool = 1;
        }
        $collectionID = $this->input->post("collectionID");
        $itemID = $this->input->post("itemID");
        date_default_timezone_set("America/New_York");
        $dateAdded = NULL;
        if ($owned == "true") {
            $dateAdded = date("Y-m-d");
        }

        $query = $this->db->query("UPDATE sep_CollectionItems SET Owned=?, DateAdded=? WHERE CollectionID=? AND ItemID=?", array($ownedBool, $dateAdded, $collectionID, $itemID));
        echo json_encode($dateAdded);
    }
    public function getFullItemInfo()
    {
        $collectionID = $this->input->post("collectionID");
        $itemID = $this->input->post("itemID");
        $query = $this->db->query("SELECT * FROM sep_Items WHERE ItemID=?", array($itemID));
        $item = $query->result_array()[0];

        $query2 = $this->db->query("SELECT * FROM sep_CollectionItems WHERE CollectionID=? and ItemID=?", array($collectionID, $itemID));
        $colItem = $query2->result_array()[0];

        $item['Owned'] = $colItem['Owned'];
        $item['DateAdded'] = $colItem['DateAdded'];

        echo json_encode($item);
    }
}
