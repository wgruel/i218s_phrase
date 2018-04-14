<?php 
  include('config.php');
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
            <h1 class="display-3">I say YES! to ...</h1>
            <table class="table-striped table">
              <th>ID</th>
              <th>Phrase</th>
              <?php
                $link = mysqli_connect("localhost", "root", "", "i218_phrases");
                $stmt = "SELECT * FROM `phrases`";
                $result = $link->query($stmt);

                if ($result->num_rows > 0){
                  while ($row = mysqli_fetch_row($result)){
                    echo "<tr>\n";
                    echo "<td>" . $row[0] . "</td>\n";
                    echo "<td>" . $row[1] . "</td>\n";
                    echo "</tr>";
                  }
                }
                else {
                    echo "<tr><td colspan='2'>No data found</td></tr>";
                }
              ?>
            </table>
          </div>

        </div>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>    </body>
  </body>
</html>
