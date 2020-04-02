<?php 
class Sets_model extends CI_Model {
    //Gets set name
    public function getName($id){
        $query = $this->db->query("SELECT * FROM sep_Sets WHERE SetID=?", array($id));
        return $query->result_array()[0];
    }

    //Return all public sets
    public function getpublicsets(){
        $query = $this->db->query("SELECT SetID, Name FROM sep_Sets WHERE public = 1");
        return $query->result_array();
    }

    public function getsetitems($id){
        $query = $this->db->query("SELECT * FROM sep_SetItems WHERE SetID=?", array($id));
        return $query->result_array();
    }

    public function getitemdetails($id){
        $query = $this->db->query("SELECT * FROM sep_Items WHERE ItemID=?", array($id));
        return $query->result_array()[0];
    }

    public function createSets($name,$description,$public,$userid){
        $query = $this->db->query("INSERT INTO sep_Sets values (null,?,?,?,(SELECT CURDATE()),(SELECT CURDATE()))", array($name,$description,$public));

        if ($this->db->affected_rows() > 0){
            $id = $this->db->query("SELECT SetID FROM sep_Sets ORDER BY SetID Desc");
            $id = $id->result_array()[0];

            $usercollectionquery = $this->db->query("INSERT INTO sep_UserSets values (?,?,'Owner')", array($userid,$id));
            if ($this->db->affected_rows() > 0){
                return $id;
            }
            return 0;
        }
        return 0;

    }
}