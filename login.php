<html lang="en">
<!doctype html>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">  <!-- required to handle IE -->
    <meta name="viewport" content="width=device-width, initial-scale=2"> <!-- got style sheet from example from class -->
    <meta name="eal8hs, sms4yv, btg6zn" content="CS 4750 Project">
    <meta name="Textbook Seller" content="Page to login to site"> 
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link href="style/textbook-css.css" rel="stylesheet" type="text/css"/>
  </head>

<head>
  <meta charset="utf-8">

  <title>Textbook Seller</title>
  <meta name="description" content="textbook mainpage">
  <meta name="author" content="Elena Lensink">


</head>
<body>

  <?php include('header.html') ?>
  <?php session_start(); ?>



<div class="container">
    <form id="myform"  method="post">

      <label>Username: </label>
        <input type="text" name="username" id="username" class="form-control" autofocus required />
        <div id="user-msg" class="feedback"></div>  <br/>
        <label>Password: </label>
        <input type="password" name="pwd" id="pwd" class="form-control" required />
        <div id="pwd-msg" class="feedback"></div>  <br/>
      <input type="submit" value="Submit" class="btn btn-secondary" value="Sign in"
        />
    </form>


<?php
require('connect-db.php');

// require: if a required file is not found, require() produces a fatal error, the rest of the script won't run
// include: if a required file is not found, include() throws a warning, the rest of the script will run
?>

<?php


function authenticate()
{
   global $mainpage;
   global $db;


   if ($_SERVER['REQUEST_METHOD'] == 'POST')
   {
      // htmlspecialchars() stops script tags from being able to be executed and renders them as plaintext
      $pwd = htmlspecialchars($_POST['pwd']);
      $username = htmlspecialchars($_POST['username']);
      $hashed_password = password_hash($pwd, PASSWORD_DEFAULT);


      $query = "SELECT `studentID`,`pwd` FROM `login_info` WHERE studentID = (:studentID)";

      $statement = $db->prepare($query);
      $statement->bindValue(':studentID', $username);
      $statement->execute();
      $results = $statement->fetchAll();
      $statement->closeCursor();
      $numresults = 0;
      $query2 = "SELECT * FROM `Student` WHERE studentID = (:studentID)";

      $statement2 = $db->prepare($query2);
      $statement2->bindValue(':studentID', $username);
      $statement2->execute();
      $results2 = $statement2->fetchAll();
      $statement2->closeCursor();
      $numresults = 0;
      $numStudentResults = 0;
      foreach($results as $result){
        $db_username = $result['studentID'];
        $db_pwd = $result['pwd'];
        $numresults = $numresults +1;
      }
      foreach($results2 as $result2){
        $numStudentResults = $numStudentResults +1;
      }
    
    
      if($numresults > 0)
      {
        if (password_verify($pwd, $db_pwd))
        {
            $_SESSION['user']= $username;
            header("Location: account.php");
        }
        else
        {
            echo 'Password Incorrect';
        }


      }
      else
      {
        $query2 = "INSERT INTO login_info (studentID,pwd) values (:studentID,:pwd)";

        $statement = $db->prepare($query2);
        $statement->bindValue(':studentID', $username);
        $statement->bindValue(':pwd', $hashed_password);
        $statement->execute();
        $results = $statement->fetchAll();
        $statement->closeCursor();
        $numresults = 0;
        if ($numStudentResults > 0)
        {
          header("Location: account.php");
        }
        else{
          header("Location: addstudentform.php");
        }
         
      }
   }
}
authenticate();
?>

</div>
</div>


</body>
</html>