<?php 
$page_title = "Email";
require_once("blocks/header.php");?>
<?php require_once("blocks/content.php");?>
  <div class="col-md-12">
        <h2>Email Your Instructor</h2>
      
      <form action='send_email.php' method='post'>
        <label><b>Your Name: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='name' size='40' ></label><br>
        <label><b>Your Email: </b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='text' name='email' size='40' ></label><br>
        <label><b>Enter message: </b><textarea name='message' rows='5' cols='40 ' ></textarea></label><br>
        <input type='submit' value='Send'>
      </form>
  </div>
  <?php require_once("blocks/footer.php");?>