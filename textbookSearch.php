<?php
if(!isset($_SESSION)) { 
    session_start(); 
} 
    require('connect-db.php');

   // require('textbook_db.php');
    $results = Array();
    //$favs = getFav();
    if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
   // echo "POST CALLED";
    //if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "submit")
    //{  
       // echo "Search presses";
       // header("Location: searchResults.php");
        
      // If the button is clicked and its value is "submit" then call getTextbook() function
      $results = getTextbook($_POST['search']);
     // header("Location: searchResults.php");
    //}
}
function getTextbook($search){
    global $db;
    //echo "preparing statement with ".$search." as primary key";
    $query = "SELECT * FROM `sells` NATURAL JOIN `Seller` WHERE `ISBN` = (:ISBN)";
    //echo $query;
    $statement = $db->prepare($query);
    $statement->bindValue(':ISBN', $search);
	$statement->execute();  

    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
    }
// function getFav(){
//     global $db;
//     if($_SESSION["user"] !== null){
//     $query2 = "SELECT sname FROM `favorite` WHERE `studentID` = (:ID)";
//     //echo $query;
//     $statement2 = $db->prepare($query2);
//     $statement2->bindValue(':ID', $_SESSION['user']);
// 	$statement2->execute();  
//     $favs = $statement2->fetchAll();
//     $statement2->closeCursor();
//     return $favs;
// }
// }
// function cmp($a){
//     global $favs;
//     if($a !==null and $favs !=null){
//     return strcmp($a['sname'], $favs[0]['sname']);
// }
// }
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
  <link rel="icon" type="image/png" href="https://freesvg.org/img/1372705595.png" />  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>
   
    
    <body>
    <?php include('header.html') ?>
    <?php if($_SESSION['user'] == null) {
        header("Location: login.php");
      } ?>
        <h1> Search By Textbook</h1>
        <form name="mainForm" method="post">
        <div class="row mb-3 mx-3">
        <input type="text" class="form-control" name="search" placeholder="Enter the Textbook ISBN"/>
        <input type="submit" value="Search" name="btnAction" class="btn btn-dark" 
        title="Find Textbook" />  
        </div>
        </form>  
        <h4>Results: </h4>
        <table class="w3-table w3-bordered w3-card-4" style="width:90%">
        <thead>
        <tr style="background-color:#B0B0B0">
            <th width="25%">Seller</th>
            <th width="25%">ISBN</th>
            <th width="15%">Price</th>
            <th width="15%">Type</th>
            <th width= "10%">Link</th>
        </tr>
        </thead>
        <?php
        // if($results !== null){
        //     if($favs !==null){
        //         usort($results, "cmp");
        //     }
        foreach($results as $entry){?>
         <tr>
         <td><?php echo $entry['sname']; ?></td>
        <td><?php echo $entry['ISBN']; ?></td>
        <td><?php echo $entry['price']; ?></td>
        <td><?php echo $entry['book_type']?></td>
        <td><form action = "<?php echo $entry['url']?>">
            <input type="submit" class="btn btn-light" value="LINK"/>
        </form>
        </td>
        </tr>
        <?php }; ?>

        </table>
        
        
    </body>