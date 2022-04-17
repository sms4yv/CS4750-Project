<?php
require('connect-db.php');
require('takes_db.php');

if(!isset($_SESSION)) { 
  session_start(); 
} 

if($_SESSION['user'] == null) {
  header("Location: login.php");
}

$list_of_classes = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Search")
    {
      if ($_POST['dept'] == NULL && $_POST['courseid'] == NULL) {
        echo "No textbooks needed for the entered class";
      } else if ($_POST['dept'] == NULL && $_POST['courseid'] != NULL) {
        $result = searchClassesByID($_POST['courseid']);
        if ($result != []) {
          $list_of_classes = $result;
        } else {
          echo "No classes in database - no textbooks needed";
        }
      } else if ($_POST['dept'] != NULL && $_POST['courseid'] == NULL) {
        $result = searchClassesByDept($_POST['dept']);
        if ($result != []) {
          $list_of_classes = $result;
        } else {
          echo "No classes in database - no textbooks needed";
        }
      } else {
        if ($_POST['courseid'] % 1000 == 0) {
          $result = searchClassesByLevel($_POST['dept'], $_POST['courseid']);
          if ($result != []) {
            $list_of_classes = $result;
          } else {
            echo "No classes at the specified level in the database - no textbooks needed";
          }
        } else {
          $result = searchClassesByDeptAndID($_POST['dept'], $_POST['courseid']);
          if ($result != []) {
            $list_of_classes = $result;
          } else {
            echo "Class not in database - no textbooks needed";
          }
        }
      }   
    } else if (!empty($_POST['btnAction']) && $_POST['btnAction'] == "Add") {
      addClass($_SESSION['user'], $_POST['class_to_add_dept'], $_POST['class_to_add_id'], $_POST['class_to_add_section']);
    }
}
?>

<!--1. create HTML5 doctype -->
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
  <meta name="Textbook Seller" content="Page to build a student's schedule">  
    
  <title>Schedule Builder</title>
  
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
<div class="container">
  <h1>Search for Classes</h1>  

  <form name="mainForm" action="build_schedule.php" method="post">   
  <div class="row mb-3 mx-3">
    Department Abbreviation:
    <input type="text" class="form-control" name="dept" placeholder="Enter the dept code (i.e. CS or PHYS)"
    />
  </div>
  <div class="row mb-3 mx-3">
    Course ID:
    <input type="text" class="form-control" name="courseid" min="0000" max="9999" placeholder="Enter the course ID (i.e. 4750) or a level (i.e. 2000 to search for all 2000-level courses in the department)"
    />        
  </div>  
  <input type="submit" value="Search" name="btnAction" class="btn btn-dark" 
        title="search for classes" />  
</form>    

<?php if ($list_of_classes != null): ?>
<hr/>
<h2>Search Results</h2>
<!-- <div class="row justify-content-center">   -->
<table class="w3-table w3-bordered w3-card-4" style="width:90%">
  <thead>
  <tr style="background-color:#B0B0B0">
    <th width="25%">Department</th>        
    <th width="25%">Course ID</th>        
    <th width="20%">Section</th> 
    <th width="12%">Add?</th>
  </tr>
  </thead>
  <?php foreach ($list_of_classes as $class): ?>
  <tr>
    <td><?php echo $class['dept']; ?></td>
    <td><?php echo $class['courseID']; ?></td>
    <td><?php echo $class['section']; ?></td> 
    <td>
      <form action="build_schedule.php" method="post">
        <input type="submit" value="Add" name="btnAction" class="btn btn-primary" />
        <input type="hidden" name="class_to_add_dept" value="<?php echo $class['dept'] ?>" />      
        <input type="hidden" name="class_to_add_id" value="<?php echo $class['courseID'] ?>" />      
        <input type="hidden" name="class_to_add_section" value="<?php echo $class['section'] ?>" />      
      </form>
    </td>
  </tr>
  <?php endforeach; ?>
  <?php endif ?>

  
  </table>

<!-- </div>   -->


  <!-- CDN for JS bootstrap -->
  <!-- you may also use JS bootstrap to make the page dynamic -->
  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> -->
  
  <!-- for local -->
  <!-- <script src="your-js-file.js"></script> -->  
  
</div>    
</body>
</html>