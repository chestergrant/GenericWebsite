<?php
session_start();
include_once 'script/common.php';
include_once 'classes/site.php';
$site = new site($db);
$error_general = "";
$email = "";
$valid_link = false;
$hash ="";
if(isset($_REQUEST['hash'])){
    $hash = $_REQUEST['hash'];
}
if(!emptyStr($hash)){
   $valid_link = $site->validHash($hash);
}
if(isset($_POST['submit'])){
    $password = $_POST['password'];
    $retypepassword = $_POST['retypepassword'];
    $errors = false;
    if($password != $retypepassword){
        $errors = true;
        $error_general = "Password don't match.";
    }else if(strlen($password)<8){
        $errors = true;
        $error_general = "Password must be atleast 8 characters";        
    }
   if(!$errors){
       $site->resetPassword($password, $retypepassword, $hash);
       header( 'Location: dashboard.php' ) ;
       exit();
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
	<link rel="stylesheet" charset="utf-8" media="screen" href="css/reset.css?<?php echo time();?>">
              
    </head>
    <body>
        <div id="top_bar">
            <div id="logo"><a href="index.php"><img src="img/logo.png"></a></div>
            <div id="generic_button"><a href="login.php" class="button"> Login</a></div>
        </div>
        <div id="main_panel">
            <?php if($valid_link){?>
                <div id="text"><h2>Reset Password?</h2></div>
                <div id="instructions">Please enter your new password.</div>
                
                    <span id="user-error" class="user-error-bubble<?php if(emptyStr($error_general)){ echo " reset-error-correction";}?>"><?php if(!emptyStr($error_general)){ echo $error_general;}else{ echo "#";}?></span>
                    <form id="recoverFrm" name="recoverFrm" method="post" action="#" onsubmit="return resetPassword()">
                        <input type="hidden" name="hash" id="hash" value="<?php echo $hash;?>">
                        <table width="100%">
                            <tr>                                
                                <td width="80%"><input type="password" id="password" name="password" placeholder="Password" ><br></td>
                            </tr>
                            <tr>                                
                                <td width="100%"><input type="password" id="retypepassword" name="retypepassword" placeholder="Retype Password"><br></td>    
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" value="submit" name="submit" class="button" ></td>
                            </tr>
                        </table>
                        
                            
                    </form>
           <?php }else{?>
                     <div id="instructions2">Sorry the link is invalid. A link to reset your password is only valid for 24 hours. To request a new link click <a href="forgot.php">here</a>.</div>                
           <?php } ?>         
            
        </div>    
    </body>       
</html>