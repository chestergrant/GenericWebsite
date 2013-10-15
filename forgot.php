<?php
session_start();
include_once 'script/common.php';
include_once 'classes/site.php';
$site = new site($db);
$error_general = "";
$email = "";
$email_sent = false;

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $errors = false;
    if(emptyStr($email)){
        $errors = true;
        $error_general = "Please enter email.";
    }else if(!$site->alreadyUsed($email)){
        $errors = true;
        $error_general = "Email doesn't exist.";
    }
    if(!$errors){
        $site->sendRecoverEmail($email);
        $email_sent = true;
    }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Incentivize Weightloss</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" charset="utf-8" media="screen" href="css/style.css?<?php echo time();?>">        
	<link rel="stylesheet" charset="utf-8" media="screen" href="css/forgot.css?<?php echo time();?>">
              
    </head>
    <body>
        <div id="top_bar">
            <div id="logo"><a href="index.php"><img src="img/logo.png"></a></div>
            <div id="generic_button"><a href="login.php" class="button"> Login</a></div>
        </div>
        <div id="main_panel">
            <?php if(!$email_sent){ ?>
            <div id="text"><h2>Forgot your password?</h2></div>
            <div id="instructions">Please enter your email for your account below.</div>
                
            <span id="user-error" class="user-error-bubble<?php if(emptyStr($error_general)){ echo " reset-error-correction";}?>"><?php if(!emptyStr($error_general)){ echo $error_general;}else{ echo "#";}?></span>
           <form action="forgot.php" method="post">
               <input type="text" placeholder="Email" name="email" value="<?php echo $email;?>"><br> 
               <input type="submit" class="button" value="Reset" name="submit"> 
           </form>       
            <?php }else {?>
                     <div id="instructions2">Please check your email for instructions on how to recover access to your account.</div>            
            <?php } ?>
            
        </div>    
    </body>       
</html>