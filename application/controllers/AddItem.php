<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AddItem extends CI_Controller
{
    var $TPL;

    public function __construct()
    {
        parent::__construct();

        $this->TPL['loggedin'] = $this->userauth->validSessionExists();
        $this->TPL['active'] = array(
            'home' => false,
            'collection' => false,
            'set' => false,
            'login' => false,
            'signup' => false
        );
		
		// get post variables from collections page
		$this->TPL['collectionid'] = $this->input->post("collectionid");
		$this->TPL['itemname'] = $this->input->post("itemname");
    }
	
	
	
	public function index()
	{
		$this->template->show('additem', $this->TPL);
	}
  
  
  
	public function add(){
		//set timezone
		date_default_timezone_set("America/New_York");
		
		//get values for collectionitems
		$collectionid = $this->TPL['collectionid'];
		$owned = 0;
		if($this->input->post("owned")){
			$owned = 1;
		}
		$dateadded = NULL;
		if($owned == 1){
			$dateadded = date("Y/m/d");
		}
		
		//get values for items
		$name = $this->input->post("name");
		$description = $this->input->post("description");
		$year = $this->input->post("year");
		$condition = $this->input->post("condition");
		$createdate = date("Y/m/d");
		$updatedate = $createdate;
		

		//upload photo to directory 
		$newfilename = NULL;
		if($_FILES["photo"]["name"]){
			//split file name
			$temp = explode(".", $_FILES["photo"]["name"]);
			//save extension
			$extension = end($temp);
			//rename file to current microtime
			$newfilename = round(microtime(true)) . '.' . $extension;	
			//upload file to uploads directory
			$config['upload_path']='./assets/uploads/';
			$config['allowed_types']='gif|jpg|png|pdf';
			$this->upload->initialize($config);
			$this->upload->do_upload('photo');
			rename('./assets/uploads/'.$_FILES["photo"]["name"], './assets/uploads/'.$newfilename);		
		}
		
		// add item to sep_Items
		$data = array( 
					'ItemID' => NULL,
					'Name' => $name, 
					'Description' => $description,
					'Year' => $year,
					'ItemCondition'	=> $condition,
					'Photo'	=> $newfilename,
					'CreateDate' => $createdate,
					'UpdateDate' => $updatedate
					);
		$this->db->insert('sep_Items', $data);
		
		//retrieve primary key of insert
		$insertid = $this->db->insert_id();
		
		// add item to sep_CollectionItems
		$data = array( 
					'CollectionID' => $collectionid,
					'ItemID' => $insertid, 
					'Owned' => $owned,
					'DateAdded' => $dateadded
					);
		$this->db->insert('sep_CollectionItems', $data);
		
		//send back to collection page
		redirect('/ViewCollection/getCollection/'.$collectionid);
	}
}
