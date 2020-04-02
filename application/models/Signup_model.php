<?php 
class Signup_model extends CI_Model {

    public function validate($username){
        $query = $this->db->query("SELECT username FROM sep_Users WHERE username = ? ", array($username));
        return $query->result_array()[0];
    }

    public function newEntry($user, $password){

        $query = $this->db->query("INSERT INTO sep_Users VALUES (null,?,?,(SELECT CURDATE()),(SELECT CURDATE()))",array($user,$password));
    }
}