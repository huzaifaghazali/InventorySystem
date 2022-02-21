<?php

// User Account for account creation and login purpose

class User
{

    private $con;

    function __construct()
    {
        include_once("../database/db.php");
        $db = new Database();
        $this->con  = $db->connect();  // this will return the connection object

    }

    // User is already register or not

    private function emailExists($email)
    {
        $pre_stmt = $this->con->prepare("SELECT `id` FROM `user` WHERE `email` = ?");
        $pre_stmt->bind_param("s", $email);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        // $result > 0 mean user is already register
        if ($result->num_rows > 0) {
            return 1;
        } else {
            return 0; // user is not register;
        }
    }

    public function createUserAccount($username, $email, $password, $usertype)
    {
        // To protect your application from the sql attack(sql injection) you can can use prepared statement

        if ($this->emailExists($email)) {
            return "EMAIL_ALREADY_EXISTS";
        } else {

            // for the protection of the password convert it into the random characters
            $pass_hash = password_hash($password, PASSWORD_BCRYPT, ["cost" => 8]);
            $date = date('Y-m-d');
            $notes = "";
            $pre_stmt = $this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) 
                                            VALUES (?, ?, ?, ?, ?,?, ?)");
            $pre_stmt->bind_param("sssssss", $username, $email, $pass_hash, $usertype, $date, $date, $notes);
            $result = $pre_stmt->execute() or die($this->con->error);
            if ($result) {
                return $this->con->insert_id;
            } else {
                return "SOME_ERROR"; // user is not register;
            }
        }
    }

    public function userLogin($email, $password){
        $pre_stmt = $this->con->prepare("SELECT `id`, `username`, `password`, `last_login` FROM `user` WHERE `email` = ?");
        $pre_stmt->bind_param("s", $email);
        $pre_stmt->execute() or die($this->con->error);
        $result = $pre_stmt->get_result();
        // if email not exists 
        if ($result->num_rows < 1) {
            return "NOT_REGISTERD";
        } else {
           $row = $result->fetch_assoc();
           if(password_verify($password, $row["password"])) {
               // assigning the values to the session varialbes
               $_SESSION["userid"] = $row["id"];
               $_SESSION["username"] = $row["username"];
               $_SESSION["last_login"] = $row["last_login"];

               // Here we are updating user last login time when he is performing login
               $last_login = date("Y-m-d h:m:s");
               $pre_stmt = $this->con->prepare("UPDATE `user` SET `last_login` = ? WHERE `email` = ?");
               $pre_stmt->bind_param("ss", $last_login, $email);
               $result = $pre_stmt->execute() or die($this->con->error);

               if($result) {
                    return 1; // if the login is successful
               } else {
                   return 0;
               }
 
           } else {
               return "PASSWORD_NOT_MATCHED";
           }
        }
    }
}

// $user = new User();

// echo $user->userLogin("huzaifa@email.com", "123456");

// echo $_SESSION['username'];

?>