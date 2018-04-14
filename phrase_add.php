<?php 
  include('config.php');  
  
  $message = ""; 

  if(isset($_GET['btn-save'])){
    // save 
    $text = $_GET['phrase_01'] . " " . $_GET['phrase_02']  . "\n"; 
    $text = urldecode($text);

    $email = ""; 
    if (isset($_GET['email'])){
      $email = $_GET['email'];
    }
     
    // create SQL statement
    $sql_query = "INSERT INTO `phrases`(`id`, `phrase`, `recipient`) ";
    $sql_query .= "VALUES('','" . $text . "','" . $email . "')";

    // run query
    mysqli_query($link, $sql_query);
    $errorText = mysqli_error($link);

    if (!empty($errorText)){
      $message = $errorText;
    }
    else {
      $message = "Added phrase: " . $text . "\n";
    }    


    if ($mailfun == true){
      // email related stuff... 
      if (isset($_GET['email'])){
        $to      = urldecode($_GET['email']);
        $subject = 'I say YES! to...';
        $message = $text;
        $headers = 'From: internet2@hdmy.de' . "\r\n" .
            'Reply-To: internet2@hdmy.de' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        $mailSuccess = mail($to, $subject, $message, $headers);      
  
        if (!$mailSuccess){
          $message .= "mail not sent";
        }
        else {
          $message .= "mail sent to: " . $to;
        }
      }  
    }

  }


?>
<html>

  <head>
    <title>Index</title>
    <meta charset="UTF-8"></meta>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <style type="text/css">
      .container div {
        margin-top: 20px;
      }
    </style>
  </head>
  <body>
          <div class="jumbotron jumbotron-fluid">
          <div class="container">
            <?php
              if ($message != ""){
                echo "<div class='alert alert-info'>";
                echo $message;
                echo "</div>";
              }
            ?>          
            <h1 class="display-3">I say YES! to ...</h1>
            <form method="get">
              <div class="select-div">
                <select class="custom-select" name="phrase_01">
                  <option selected>Open this select menu</option>
                  <option value="learning">learning</option>
                  <option value="exploring">exploring</option>
                  <option value="finding">finding</option>
                  <option value="enjoying">enjoying</option>
                </select>
              </div>
              <div>
                <select class="custom-select" name="phrase_02">
                  <option selected>Open this select menu</option>
                  <option value="to%20make%20myself%20understood">to make myself understood</option>
                  <option value="something%20new%20about%20my%20world">something new about my world</option>
                  <option value="to%20be%20brave%20from%20time%20to%20time">to be brave from time to time</option>
                </select>
              </div>
              <?php 
                if ($mailfun == true){
              ?>
                <div class="form-group">
                  <label for="email">Send this message to:</label>
                  <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com">
                </div>    
              <?php    
                }
              ?>
          
              <div>
                <button type="submit" class="btn btn-default" name="btn-save" value="1">Say YES!</button>
              </div>      
            </form>
          </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>    </body>
  </body>
</html>
