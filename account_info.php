<?php
require('connect-db.php');
require('student_db.php');
require('takes_db.php');

if(!isset($_SESSION)) { 
    session_start(); 
} 

if($_SESSION['user'] == null) {
  header("Location: login.php");
}

$current_user = getStudent($_SESSION['user']);
$user_majors = getMajors($_SESSION['user']);
$user_classes = getClassesByUser($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Delete")
  {
    deleteClass($_SESSION['user'], $_POST["class_to_delete_dept"], $_POST["class_to_delete_id"], $_POST["class_to_delete_section"]);
    $user_classes = getClassesByUser($_SESSION['user']);
  }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "search")
  {
    header("reqTextbook.php");
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
  <link rel="icon" type="image/png" href="http://www.cs.virginia.edu/~up3f/cs4750/images/db-icon.png" />
  
  <!-- if you choose to download bootstrap and host it locally -->
  <!-- <link rel="stylesheet" href="path-to-your-file/bootstrap.min.css" /> --> 
  
  <!-- include your CSS -->
  <!-- <link rel="stylesheet" href="custom.css" />  -->
       
</head>

<body>
<?php include('header.html') ?>

  <h1>Profile Information</h1>  

    <p> ID: <?php if ($_SESSION['user']!=null) echo $_SESSION['user'] ?> </p>
    <p> Name: <?php if ($_SESSION['user']!=null) echo $current_user['name'] ?> </p>
    <p> Year: <?php if ($_SESSION['user']!=null) echo $current_user['year'] ?> </p>
    <p> Major(s): <?php if ($_SESSION['user']!=null && count($user_majors) > 1) {echo $user_majors[0]['major'].", ".$user_majors[1]['major'];} else { echo $user_majors[0]['major'];} ?> </p>

    <form action="updatestudent.php">
        <input type="submit" class="btn btn-dark" value="Edit?" />
    </form>
    <hr/>
    <h2>Your Schedule</h2>
    <!-- <div class="row justify-content-center">   -->
    <?php if ($user_classes != null): ?>
      <table class="w3-table w3-bordered w3-card-4" style="width:90%">
      <thead>
      <tr style="background-color:#B0B0B0">
        <th width="25%">Department</th>        
        <th width="25%">Course ID</th>        
        <th width="20%">Section</th> 
        <th width="12%">Delete?</th>
        <th width="12%">Find Textbooks</th>
      </tr>
      </thead>
      <?php foreach ($user_classes as $class): ?>
      <tr>
        <td><?php echo $class['dept']; ?></td>
        <td><?php echo $class['courseID']; ?></td>
        <td><?php echo $class['section']; ?></td> 
        <td>
          <form action="account_info.php" method="post">
            <input type="submit" value="Delete" name="btnAction" class="btn btn-danger" />
            <input type="hidden" name="class_to_delete_dept" value="<?php echo $class['dept'] ?>" />      
            <input type="hidden" name="class_to_delete_id" value="<?php echo $class['courseID'] ?>" />      
            <input type="hidden" name="class_to_delete_section" value="<?php echo $class['section'] ?>" />      
          </form>
        </td>
        <td>
          <form method="post">
            <input type="submit" value="search" name="btnAction" class="btn btn-info" />
            <input type="hidden" name="class_dept" value="<?php echo $class['dept'] ?>" />      
            <input type="hidden" name="class_id" value="<?php echo $class['courseID'] ?>" />           
          </form>
        </td>
      </tr>
      <?php endforeach; ?>
      <?php else: ?>
          <p> You have not added any classes to your schedule yet </p>
      <?php endif ?>

      </table>

      <hr/>
      <form action="build_schedule.php">
        <input type="submit" class="btn btn-dark" value="Add Courses?" />
      </form>

      <hr/>
      <form action="account.php">
        <input type="submit" class="btn btn-dark" value="Back to Home" />
      </form>
<!-- </div>   -->


  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
   
</body>
</html>