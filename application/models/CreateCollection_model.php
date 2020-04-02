<?php 
class CreateCollection_model extends CI_Model {

    public function getpublicsets(){
        $query = $this->db->query("SELECT SetID, Name FROM sep_Sets WHERE public = 1");
        return $query->result_array();
    }
    // Returns all of the sets that the user is the owner of or has access to view it
    // @PARAM $name : the name of the set being tested
    public function getUserSets($id){
        //Get User sets
        $query = $this->db->query("SELECT SetID FROM sep_UserSets WHERE UserID=? AND ( Priviliges = 'Owner' OR priviliges = 'Read')", array($id));
        $setidlist = $query->result_array();
        $sets = array();
        foreach ($setidlist as $setid){
            $getSetInfo = $this->db->query("SELECT SetID, Name FROM sep_Sets WHERE SetID = ?", array($setid['SetID']));
            array_push($sets, $getSetInfo->result_array()[0]);
        }
        return $sets;
    }
    // CHECKS IF THE SET NAME ALREADY EXISTS WITHIN THE DATABASE
    // @PARAM $name : the name of the set being tested
    public function validateName($name){
        $query = $this->db->query("SELECT Name from sep_Collections WHERE Name = ?", array($name));
        return $query->result_array()[0];
    }

    public function createCollection($name,$description,$userid){
        $query = $this->db->query("INSERT INTO sep_Collections values (null,?,?,(SELECT CURDATE()),(SELECT CURDATE()))", array($name,$description));

        if ($this->db->affected_rows() > 0){
            $id = $this->db->query("SELECT CollectionID FROM sep_Collections ORDER BY CollectionID Desc");
            $id = $id->result_array()[0];

            $usercollectionquery = $this->db->query("INSERT INTO sep_UserCollections values (?,?,'Owner')", array($userid,$id));
            if ($this->db->affected_rows() > 0){
                return $id;
            }
            return 0;
        }
        return 0;

    }

    public function duplicateSet($setID, $collectionID){
        $query = $this->db->query("SELECT ItemID FROM sep_SetItems WHERE SetID = ?", array($setID));
        $query = $query->result_array();

        foreach ($query as $row){
            $insert = $this->db->query("INSERT INTO sep_CollectionItems values (?,?,0,(SELECT CURDATE()))",array($collectionID,$row['ItemID']));
        }
    }
}