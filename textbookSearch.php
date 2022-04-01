<?php
    require('connect-db.php');
    require('textbook_db.php');
    $results = Array();
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "submit")
    {  
      // If the button is clicked and its value is "submit" then call getTextbook() function
      $results = getTextbook($_POST['search']);
    }
}
?>
<!DOCTYPE html>
<html>
    <head>
    <!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">  
  
  <!-- 2. include meta tag to ensure proper rendering and touch zooming -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- 
  Bootstrap is designed to be responsive to mobile.
  Mobile-first styles are part of the core framework.
   
  width=device-width sets the width of the page to follow the screen-width
  initial-scale=1 sets the initial zoom level when the page is first loaded   
  -->
  
  <meta name="eal8hs, sms4yv, btg6zn" content="CS 4750 Project">
  <meta name="Textbook Seller" content="Page to create student profile">  
    
  <title>Find a Textbook by ISBN</title>
  
  <!-- 3. link bootstrap -->
  <!-- if you choose to use CDN for CSS bootstrap -->  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  
  <!-- you may also use W3's formats -->
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link href="style/textbook-css.css" rel="stylesheet" type="text/css"/>
  
  <!-- 
  Use a link tag to link an external resource.
  A rel (relationship) specifies relationship between the current document and the linked resource. 
  -->
  
  <!-- If you choose to use a favicon, specify the destination of the resource in href -->
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>
    </head>
    
    <body>
    <?php include('header.html') ?>
    <?php session_start(); ?>
        <h1> Search By Textbook</h1>
        <form name="mainForm" action="TextbookSearch.php" method="post">
        <input type="text" class="form-control" name="search" placeholder="Enter the Textbook ISBN">
        <input type="submit" value="search" name="btnAction" class="btn btn-dark" 
        title="Find Textbook" />  
        </form>  
        <h4>Results: </h4>
        <p><?php
        if($results !== null){
        foreach($results as $entry){
            echo $entry;
        }
        }
        ?>
    </body>