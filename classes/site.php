<?php
class site{
   private $conn;
   private $login_err;
   private $signup_err;
  function __construct($db) {
      $this->conn = $db;
      $this->login_err= "";
      $this->signup_err= "";
   }
  
   
   function signup($firstname,$lastname,$email,$password){
       //hash password
         $salt = $this->generateSalt($email);
         $g_password = $this->generateHash($salt,$password);
         //store signup data
         $sql = "INSERT INTO users (firstname, lastname, email, password, signup_time) VALUES(?,?,?,?,?)";
         $user = false;
         if($stmt = $this->conn->prepare($sql)){
                $stmt->bind_param("ssssi", ucwords(strtolower($firstname)), ucwords(strtolower($lastname)),$email,$g_password,time());
                $stmt->execute();
                $user = true;
         }
         //add user to a group
         if($user){            
             $this->login($email, $password);
         }
         
       
   }
   
  function contact_us($subject, $message, $email){     
        $subject = "My Site: ".$subject;
        $this->sendEmail("chester.grant@yahoo.co.uk", $message, $subject, $email);     
   }
   
   function alreadyUsed($email){
       $output = false;
       $sql = "SELECT * FROM users WHERE email = ?";
       if($stmt = $this->conn->prepare($sql)){
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $output = true;
                }
               
       }
       return $output;
   }
   
     
   function login($email, $password){
         $this->login_err= "";
         $salt = $this->generateSalt($email);
         $g_password = $this->generateHash($salt,$password);
         
         if($stmt = $this->conn -> prepare("SELECT * FROM users WHERE email=? AND password=?")) {
                $stmt -> bind_param("ss", $email, $g_password);

	      /* Execute it */
      		$stmt -> execute();
                
                $stmt->store_result();
                if($stmt->num_rows == 0){
                    $this->login_err .= "&bull; Couldn't login. Please try again.";
                }else{
                      $this->login_err = "";
                      $this->setupSessions($email);
                }
	      
      		$stmt -> close(); 
         }else{
             $this->login_err .= "Couldn't connect to the Database";
	 }

   }
   
   function setupSessions($email){
         $_SESSION['email'] = $email;    
   }
   
   function loginErrors(){
       return $this->login_err;
   }
   
   
   
   function generateHash($salt, $password) {
	$hash = crypt($password, $salt);
	$hash = substr($hash, 29);
	return $hash;
   }
   
   function generateSalt($email) {
	$salt = '$2a$13$';
	$salt = $salt . md5(strtolower($email));
	return $salt;
   } 


function sendRecoverEmail($email){      
           $resetStr = $this->setRecoveryStr($email);
           $msg = $this->getRecoveryEmailMsg($resetStr);
           $subject = "Reset Password";
           $this->sendEmail($email,$msg, $subject,"no-reply@incentivizeweightloss.com");
      
}

function setRecoveryStr($email){
       $output = $email.time();
       $output = md5($output);
       $sql = "INSERT INTO recovery (email, hash, time) VALUES(?,?,?)";
         
        if($stmt = $this->conn->prepare($sql)){
                $stmt->bind_param("ssi", $email,$output,time());
                $stmt->execute();
                $user = true;
         }
       return $output;
   }
   
function getRecoveryEmailMsg($resetStr){
       $output =  "<table cellspacing=0 cellpadding=0 style='border: 1px solid #AAA' border=0 align='center'>";
       $output .= "<tr colspan=3 height='36px'></tr>";
       $output .= '<tr>';
       $output .= '<td width="36px">&nbsp;';
       $output .= '</td>';
       $output .= '<td width="454px">';
       $output .= 'Hi,<br><br>';
       $output .= 'It was recently requested that you want to change your password.<br><br>';
       $output .= 'If this was indeed you, please click on the link below else ignore this email.<br><br>';
       $output .= '<center><a style="border:1px solid #2270AB; padding:14px 7px 14px 7px; margin: 0px auto 0px auto; font-size:16px; background:#33A0E8; width:210px;" href="http://www.incentivizeweightloss.com/reset.php?hash='.$resetStr.'">Reset</a><br><br></center>';
       $output .= 'Thanks,<br>';
       $output .= 'Incentivize Weightloss Team';
       $output .= '</td>';
       $output .= '<td width="36px">&nbsp;';
       $output .= '</td>';
       $output .= '</tr>';
       $output .= "<tr colspan=3 height='36px'></tr>";
       $output .= "</table>";
       return $output;
}   

function sendEmail($email, $msg, $subject,$from){
       $headers = 'From: '.$from . "\r\n" .
                  'Reply-To: '.$from . "\r\n" ;
       $headers .= "MIME-Version: 1.0\r\n";
       $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        mail($email, $subject, $msg, $headers);
 }


function validHash($hash){
       $day_ago = time() - 86400;
       $sql =  "SELECT * FROM recovery WHERE hash=? AND time >= ".$day_ago;
       $output = false;
       if($stmt = $this->conn->prepare($sql)){
                $stmt->bind_param("s", $hash);
                $stmt->execute();
                $stmt->store_result();
                if($stmt->num_rows > 0){
                    $output = true;
                }
                
       }
       
       return $output;
   }


 function getEmailFromHash($hash){
       $output = "";
       $sql = "SELECT email FROM recovery WHERE hash = ?";
       if($stmt = $this->conn->prepare($sql)){
                $stmt->bind_param("s", $hash);
                $stmt->execute();
                $stmt->store_result();
                $stmt->bind_result($email);
                if($stmt->num_rows > 0){
                    $stmt->fetch();                    
                    $output = $email;
                }
                /*$res = $stmt -> get_result();
                $arr = niceArray($res);
                if(count($arr) > 0){
                   $output = $arr[0]['email'];
                }*/
       }
       return $output;
 }
   
   function resetPassword($password,$retypepassword,$hash){               
              $email = $this->getEmailFromHash($hash);
              $salt = $this->generateSalt($email);
              $g_password = $this->generateHash($salt,$password);              
              $sql = "UPDATE users SET password='".$g_password."' WHERE email='".$email."'";
              $this->conn->query($sql);
              $this->login($email, $password);   
   }
 }
?>