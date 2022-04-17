<?php
    require('connect-db.php');

   // require('textbook_db.php');
    $results = Array();
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    //echo "POST CALLED"
        //echo "Search presses";
       // header("Location: searchResults.php");
        
      // If the button is clicked and its value is "submit" then call getTextbook() function
      $results = getReqTextbook($_POST['ID'],$_POST['dept']);
     // header("Location: searchResults.php");
    //}
}
function getReqTextbook($ID, $dept){
    global $db;
    //echo "preparing statement with ".$search." as primary key";
    $query = "SELECT DISTINCT `ISBN`, `title`, `author`, `sname`, `price` FROM `has` NATURAL JOIN `Textbook` NATURAL JOIN `sells` WHERE `courseID` = (:courseID) AND `dept` = (:dept);";
    //echo $query;
    $statement = $db->prepare($query);
    $statement->bindValue(':courseID', $ID);
    $statement->bindValue(':dept', $dept);
	$statement->execute();  
    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
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
    
  <title>Required texts by class</title>
  
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
   
    
    <body>
    <?php include('header.html') ?>
    <?php session_start(); ?>
    <?php if($_SESSION['user'] == null) {
        header("Location: login.php");
      } ?>
        <h1> Search for Textbooks by class</h1>
        <form name="mainForm" method="post">
        <div class="row mb-3 mx-3">
        <input type="text" class="form-control" name="ID" placeholder="Enter the course ID (i.e 4750)"/>
    </div>
        <div class="row mb-3 mx-3">
        <input type="text" class="form-control" name="dept"placeholder="Enter the dept code (i.e CS or PHYS)"/>
        </div>
        <input type="submit" value="Search" name="btnAction" class="btn btn-dark" 
        title="Search" />  
        </form>  
        <h4>Required Textbooks for : <?php $search?> </h4>
        <table class="w3-table w3-bordered w3-card-4" style="width:90%">
        <thead>
        <tr style="background-color:#B0B0B0">
            <th width="20%">ISBN</th>
            <th width="25%">Title</th>
            <th width="15%">Author</th>
            <th width="10%">Price</th>
            <th width="15%">Seller</th>
        </tr>
        </thead>
        <?php
        if($results !== null){
        foreach($results as $entry){?>
         <tr>
         <td><?php echo $entry['ISBN']; ?></td>
        <td><?php echo $entry['title']; ?></td>
        <td><?php echo $entry['author']; ?></td>
        <td><?php echo $entry['price'];?></td>
        <td><?php echo $entry['sname']; ?></td>
        <tr>
        <?php }}; ?>
        </table>
        
        
    </body>