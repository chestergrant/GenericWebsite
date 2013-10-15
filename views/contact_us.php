<?php
   $subject ="";
   $message = "";
   $error_general = "";
   $success_sent = false;
   $site = new site($db);
   if(isset($_POST['submit'])){
       $subject= $_POST['subject'];
       $message = $_POST['message'];
       $errors = false;
       if(emptyStr($subject)){
         $errors = true;
         $error_general = "Please supply a subject.";
       }else if(emptyStr($message)){
           $errors = true;
           $error_general = "Please supply a message.";           
       }
       if(!$errors){
           $site->contact_us($subject,$message, $_SESSION['email']);
           $success_sent = true;
       }
       
   }

if(!$success_sent){
?>
<span id="user-error" class="user-error-bubble<?php if(emptyStr($error_general)){ echo " contact-error-correction";}?>"><?php if(!emptyStr($error_general)){ echo $error_general;}else{ echo "#";}?></span>           
<form id="contactFrm" name="contactFrm" method="post" action="dashboard.php">
    <table>
        <tr>            
            <td><input id="subject" type="text" placeholder="Subject" name="subject" value="<?php echo $subject;?>"></td>
        </tr>
        <tr>            
            <td><textarea id="message" placeholder="Enter your message" name="message"><?php echo $message;?></textarea></td>
        </tr>
        <tr>
            <td><center><input type="submit" name="submit" class="button" id="submit" value="Send"></center></td>
        </tr>
    </table>    
    <input type="hidden" value="contact_us" name="site">
</form>
<?php }else{ ?>
<div id="success_message">
    <center>Your message has been sent to us. We will respond in the next 24hours.</center>
</div>
 <?php } ?>

