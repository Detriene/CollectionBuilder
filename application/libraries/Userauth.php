<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Userauth  { 
	  
    private $login_page = "";   
    private $logout_page = "";   
     
    private $username;
    private $password;
    private $access;
    private $frozen = false;

    /**
    * Turn off notices so we can have session_start run twice
    */
    function __construct() 
    {
      error_reporting(E_ALL & ~E_NOTICE);
      $this->login_page = base_url() . "index.php?/Login";
      $this->logout_page = base_url() . "index.php?/Home";
    }

    /**
    * @return string
    * @desc Login handling
    */
    public function login($username,$password) 
    {

      session_start();
        
      // User is already logged in if SESSION variables are good. 
      if ($this->validSessionExists() == true)
      {
        $this->redirect($_SESSION['basepage']);
      }

      // First time users don't get an error message.... 
      if ($_SERVER['REQUEST_METHOD'] == 'GET') return;
        
      // Check login form for well formedness.....if bad, send error message
      if ($this->formHasValidCharacters($username, $password) == false)
      {
         return "Username/password fields cannot be blank!";
      }
        
      // verify if form's data coresponds to database's data
      if ($this->userIsInDatabase() == false)
      {
        if ($this->frozen == true)
        {
          return 'Account Frozen';
        }
        return 'Invalid username/password!';
      }
      else
      { 
        // We're in!
        // Redirect authenticated users to the correct landing page
        // ex: admin goes to admin, members go to members
	$this->writeSession();
        $this->redirect($_SESSION['basepage']);
      }
    }
	
    /**
    * @return void
    * @desc Validate if user is logged in
    */
    public function loggedin($page) 
    {

      session_start();     
   
      // Users who are not logged in are redirected out
      if ($this->validSessionExists() == false)
      {
        $this->redirect($this->login_page);
      }
      $CI =& get_instance();
      //print_r( $acl[$page][$_SESSION['accesslevel']] );
      $permissions = $CI->config->item('acl');
     // print_r($permissions);
        if ( $permissions[$page][$_SESSION['accesslevel']] == false){
          switch ($_SESSION['accesslevel'])
          {
            case "member":
              $this->redirect(base_url() . "index.php?/Members/ ");
              break;
            case "editor":
              $this->redirect(base_url() . "index.php?/Editors/");
              break;
            default:
              $this->redirect(base_url() . "index.php?/Home/");
              break;
          }
        } 
      
		 
      // Access Control List checking goes here..
      // Does user have sufficient permissions to access page?
      // Ex. Can a bronze level access the Admin page?   

  
      return true;
    }
	
    /**
    * @return void
    * @desc The user will be logged out.
    */
    public function logout() 
    {
      session_start(); 
      $_SESSION = array();
      session_destroy();
      header("Location: ".$this->logout_page);
    }
    
    /**
    * @return bool
    * @desc Verify if user has got a session and if the user's IP corresonds to the IP in the session.
    */
    public function validSessionExists() 
    {
      session_start();
      if (!isset($_SESSION['username']))
      {
        return false;
      }
      else
      {
        return true;
      }
    }
    
    /**
    * @return void
    * @desc Verify if login form fields were filled out correctly
    */
    public function formHasValidCharacters($username, $password) 
    {
      // check form values for strange characters and length (3-12 characters).
      // if both values have values at this point, then basic requirements met
      if ( (empty($username) == false) && (empty($password) == false) )
      {
        $this->username = $username;
        $this->password = $password;
        return true;
      }
      else
      {
        return false;
      }
    }
	
    /**
    * @return bool
    * @desc Verify username and password with MySQL database.
    */
    public function userIsInDatabase() 
    {
      $CI =& get_instance();
      $results = $CI->db->query("SELECT username, accesslevel, password, status FROM userslab4");
      $userlist = $results->result_array();
      // Remember: you can get CodeIgniter instance from within a library with:
      // $CI =& get_instance();
      // And then you can access database query method with:
      // $CI->db->query()
      $valid = false;
      // Access database to verify username and password from database table
      foreach ($userlist as $user)
      {
        if ($user['status'] == "Y")
        {
          $this->frozen = true;
          return false;
        }
        if ($this->username == $user['username'])  
        {    
          if ($this->password == $user['password'])
          {
            $this->access = $user['accesslevel'];
            $valid = true;
            return $valid;
          }
          $valid = false;
        } 
        else 
        {
          $valid = false; 
        }
      }
      return $valid;
    }
    
    
    /**
    * @return void
    * @param string $page
    * @desc Redirect the browser to the value in $page.
    */
    public function redirect($page) 
    {
        header("Location: ".$page);
        exit();
    }
    
    /**
    * @return void
    * @desc Write username and other data into the session.
    */
    public function writeSession() 
    {
        $_SESSION['username'] = $this->username;
        $_SESSION['accesslevel'] = $this->access;

        switch ($this->access)
        {
          case "member":
            $_SESSION['basepage'] = base_url() . "index.php?/Members";
            break;
            case "editor":
              $_SESSION['basepage'] = base_url() . "index.php?/Editors";
              break;
            case "admin":
              $_SESSION['basepage'] = base_url() . "index.php?/Admin";
              break;
        }
        
    }
	
    /**
    * @return string
    * @desc Username getter, not necessary 
    */
    public function getUsername() 
    {
        return $_SESSION['username'];
    }
		 
}

