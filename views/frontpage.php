
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>Incentivize Weightloss</title>
        <script type="text/javascript" src="js/jquery.js"></script>
        <link rel="stylesheet" charset="utf-8" media="screen" href="css/style.css?<?php echo time();?>">        
	<link rel="stylesheet" charset="utf-8" media="screen" href="css/frontpage.css?<?php echo time();?>">
              
    </head>
    <body>
        <div id="top_bar">
            <div id="logo"><a href="index.php"><img src="img/logo.png"></a></div>
            <div id="generic_button"><a href="login.php" class="button"> Sign In</a></div>
        </div>
        <div id="main_panel">
            <div id="left_panel">
                <h1 class="heading">Increase your weight loss potential</h1>
                <h2 class="subheading">By combining daily weigh-in, a food diary, accountability buddies and monetary incentives</h2>
            </div>   
            <div id="right_panel">
                <form action="signup.php" method="post">
                    <input type="text" placeholder="Your First Name" name="firstname"><br>
                    <input type="text" placeholder="Your Last Name" name="lastname"><br> 
                    <input type="text" placeholder="Your Email" name="email"><br> 
                    <input type="password" placeholder="Create Password" name="password"><br>
                    <input type="submit" class="button" value="Create Account" name="submit"><br>
                   <div style="width:250px;font-size:13px"> By clicking on "Create account" above, you are agreeing to the <a target="_blank" href="terms.php">Terms of Service</a> and the <a target="_blank" href="privacy.php">Privacy Policy</a>.</div>        
                </form>    
            </div>
        </div>    
    </body>       
</html>