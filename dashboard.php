<?php
session_start();
include_once 'script/common.php';
include_once 'classes/site.php';

if(!isset($_SESSION['email'])){
    header('Location: login.php');
    exit();
}
$site="";
if(isset($_REQUEST['site'])){
    $site = $_REQUEST['site'];    
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Incentivize Weightloss</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" charset="utf-8" media="screen" href="css/style.css?<?php echo time();?>">        
	<link rel="stylesheet" charset="utf-8" media="screen" href="css/dashboard.css?<?php echo time();?>">
              
    </head>
    <body>
        <div id="top_bar">
            <div id="logo"><a href="index.php"><img src="img/logo.png"></a></div>
            <div id="generic_button"><a href="script/logout.php" class="button"> Log Out</a></div>
        </div>
        <div id="main_panel">
            <div id="centre_panel">
                <div id="nav_menu">
                    <ul>
                        <li><a href="dashboard.php?site=home" <?php if(($site == "")||($site == "home")){?> class="selected"<?php } ?>>Home</a></li>
                        <li><a href="dashboard.php?site=check_in" <?php if($site == "check_in"){?> class="selected"<?php } ?>>Check-in</a></li>
                        <li><a href="dashboard.php?site=invite" <?php if($site == "invite"){?> class="selected"<?php } ?>>Invite</a></li>
                        <li><a href="dashboard.php?site=work" <?php if($site == "work"){?> class="selected"<?php } ?>>How it Works</a></li>
                        <li><a href="dashboard.php?site=photo" <?php if($site == "photo"){?> class="selected"<?php } ?>>Photo</a></li>
                        <li><a href="dashboard.php?site=friends" <?php if($site == "friends"){?> class="selected"<?php } ?>>Friends</a></li>
                        <li><a href="dashboard.php?site=account" <?php if($site == "account"){?> class="selected"<?php } ?>>Account</a></li>
                        <li><a href="dashboard.php?site=contact_us" <?php if($site == "contact_us"){?> class="selected"<?php } ?>>Contact Us</a></li>
                    </ul>                    
                </div>
                <div id="copyright">
                    &copy;<?php echo date("Y");?> 
                    <a target="_blank" href="terms.php">Terms</a> 
                    <a target="_blank" href="privacy.php">Privacy</a>
                    <a href="dashboard.php?site=contact_us">Contact</a>
                    
                </div>
                <div id ="content">
                    <?php
                         if(($site == "")||($site == "home")){
                           include_once 'views/home.php';
                         }
                         
                         if($site == "check_in"){
                            include_once 'views/check_in.php';
                         }          
                         
                         if($site == "invite"){
                            include_once 'views/invite.php';
                         }   
                         
                         if($site == "work"){
                           include_once 'views/work.php';
                         }
                         
                         if($site == "photo"){
                           include_once 'views/photo.php';
                         }
                         
                         if($site == "friends"){
                           include_once 'views/friends.php';
                         }
                         
                         if($site == "account"){
                          include_once 'views/account.php';
                         }
                         
                         if($site == "contact_us"){
                           include_once 'views/contact_us.php';
                         }
                    ?>
                </div>    
            </div>   
        </div>    
    </body>       
</html>