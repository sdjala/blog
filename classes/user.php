<?php 
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db.php");

class User extends Db
{
	public $id;
	public $email;
    public $username;
    public $token;
    public $hashedPassword;	
    public $connect;

    public function __construct(){
        $this->connect= $this->connect();
    }


    function checkUser($email){
        $sql = $this->connect->query("SELECT id FROM users WHERE email='$email'");
        return $sql;
    }

    function addUser($username, $email, $hashedPassword, $token){
        $this->connect->query("INSERT INTO users (username,email,password,isEmailConfirmed,token)
					VALUES ('$username', '$email', '$hashedPassword', '0', '$token');
				");
    }

    function updatePwd($hashedPassword, $email){
        $this->connect->query("UPDATE users SET password='$hashedPassword' WHERE email=$email ");
    }

    function confirmUser($email, $token){
        $sql = $this->connect->query("SELECT id FROM users WHERE email='$email' AND token='$token' AND isEmailConfirmed=0");
		if ($sql->num_rows > 0) {
            $connect->query("UPDATE users SET isEmailConfirmed=1, token='' WHERE email='$email'");
        }
    }

    function login($email, $password){
        $sql = "SELECT id, username, password, isEmailConfirmed, role_id FROM users WHERE email='$email' ";
                $result = mysqli_query($this->connect, $sql);
                if($result){return $result;}
                else{echo "no data";}
    }

    function logout(){
        // Initialize the session
        session_start();
        
        // Unset all of the session variables
        $_SESSION = array();
        
        // Destroy the session.
        session_destroy();
        
        // Redirect to login page
        header("location: /blog");
        exit;
    }
}

?>