<?php
require('connect-db.php');
require('owns_db.php');
require('student_db.php');

if(!isset($_SESSION)) { 
    session_start(); 
} 

if($_SESSION['user'] == null) {
  header("Location: login.php");
}

$current_user = getStudent($_SESSION['user']);
$user_textbooks = getTextbooksByUser($_SESSION['user']);


if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete")
  {
    deleteTextbook($_SESSION['user'], $_POST["textbook_to_delete"]);
    $user_classes = getTextbooksByUser($_SESSION['user']);
    header("Location: owns.php");
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnActionAdd']))
  {
    if (verifyTextbook($_POST["isbn"])){
    addTextbook($_SESSION['user'], $_POST["isbn"]);
    $user_classes = getTextbooksByUser($_SESSION['user']);
    header("Location: owns.php");
  }else{
      echo "invalid isbn";
  }
  }
}
?>
<!-- 1. create HTML5 doctype -->
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
  <meta name="Textbook Seller" content="Page to show student profile">  
    
  <title>Your Profile</title>
  
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


    <h2>Your Have <?php echo getCountTextbook($_SESSION['user']);
    
    ?>
    Textbooks</h2>
    <!-- <div class="row justify-content-center">   -->
    <?php if ($user_textbooks != null): ?>
      <table class="w3-table w3-bordered w3-card-4" style="width:90%">
      <thead>
      <tr style="background-color:#B0B0B0">
        <th width="25%">ISBN</th>        
        <th width="25%">Title</th>        
        <th width="25%">Author</th> 
        <th width="25%">Delete?</th>
      </tr>
      </thead>
      <?php foreach ($user_textbooks as $textbook_isbn): ?>
      <tr>
        <?php $textbook= searchTextbookByID($textbook_isbn['ISBN']);?>
        <td><?php echo $textbook['ISBN']; ?></td>
        <td><?php echo $textbook['title']; ?></td>
        <td><?php echo $textbook['author']; ?></td> 
        <td>
          <form action="owns.php" method="post">
            <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" />
            <input type="hidden" name="textbook_to_delete" value="<?php echo $textbook['ISBN'] ?>" />      
          </form>
        </td>
        <td>
        </td>
      </tr>
        </hr>
      
      <?php endforeach; ?>
      <?php else: ?>
          <p> You have not added any classes to your schedule yet </p>
      <?php endif ?>
      <form name="mainForm" action="owns.php" method="post">   
        <div class="row mb-3 mx-3">
            Textbook ISBN:
            <input type="text" class="form-control" name="isbn" placeholder="Enter the ISBN of a Textbook that you own"
            />
        </div>   
                <input type="submit" value="Add" name="btnActionAdd" class="btn btn-dark" />
        </form>  

      </table>