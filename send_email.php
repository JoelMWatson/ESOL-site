<?php 
$page_title = "Email";
require_once("blocks/header.php");?>
<?php require_once("blocks/content.php");?>
<?php
  //print "<pre>";
  //print_r($_POST);
  //print "</pre>";
  
  if(isset($_POST)){
    //get form data
    $name = $_POST['name'];
    $message = $_POST['message'];
    $email = $_POST['email'];
    
    //Send email
    $to= "ogorkovets@mail.greenriver.edu";
    $subject = "Message from my website";
    $headers = "From: " .$name . "<" . $email . ">";
    $succes = mail($to, $subject, $message, $headers);
    
    //Display confirmation
    echo "<p><b>Thank you for contacting us, $name!</b></p>";
    if($succes) {
      echo "<b>Your email has been sent succesfully!</b>";
      
    }
    else{
      echo "<b>Sorry, your message was not sent!</b>";
    }
  }  
?>
 <?php require_once("blocks/footer.php");?>