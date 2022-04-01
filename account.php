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
<h2> Welcome! <?php if ($_SESSION['user']!=null) echo $_SESSION['user']?> </h2>
</div>


</body>
</html>