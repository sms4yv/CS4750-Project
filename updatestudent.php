<?php
require('connect-db.php');
require('student_db.php');

if(!isset($_SESSION)) { 
    session_start(); 
} 

if($_SESSION['user'] == null) {
  header("Location: login.php");
}

$current_user = getStudent($_SESSION['user']);
$user_majors = getMajors($_SESSION['user']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
  if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Update")
  {
    updateStudent($_SESSION['user'], $_POST['name'], $_POST['year']);
    deleteMajors($_SESSION['user']);
    addMajor($_SESSION['user'], $_POST['major1']);
    if ($_POST['major2'] != NULL) {
      addMajor($_SESSION['user'], $_POST['major2']);
    }
    header('Location: account_info.php');
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
  <meta name="Textbook Seller" content="Page to update student profile">  
    
  <title>Update Profile</title>
  
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
<div class="container">
  <h1>Updating Profile for ID: <?php if ($_SESSION['user']!=null) echo $_SESSION['user'] ?></h1>  

  <form name="mainForm" action="updatestudent.php" method="post">   
  <div class="row mb-3 mx-3">
    Name:
    <input type="text" class="form-control" name="name" value="<?php if ($_SESSION['user']!=null) echo $current_user['name'] ?>"
    />        
  </div>  
  <div class="row mb-3 mx-3">
    Year:
    <input type="number" class="form-control" name="year" min="1" max="4" value="<?php if ($_SESSION['user']!=null) echo $current_user['year'] ?>"
    /> 
  </div>  
  <div class="row mb-3 mx-3">
    Major:
    <input type="text" class="form-control" name="major1" value="<?php if ($_SESSION['user']!=null) echo $user_majors[0]['major'] ?>"
    /> 
  </div> 
  <div class="row mb-3 mx-3">
    Second Major?:
    <input type="text" class="form-control" name="major2" value="<?php if ($_SESSION['user']!=null && count($user_majors) > 1) echo $user_majors[1]['major'] ?>"
    /> 
  </div>    
  <input type="submit" value="Update" name="btnAction" class="btn btn-dark" 
        title="update profile" />  
</form>    

<!-- </div>   -->


  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div>    
</body>
</html>