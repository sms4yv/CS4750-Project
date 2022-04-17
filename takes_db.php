<?php

function searchClassesByDeptIDAndSection($dept, $courseid, $section) {
    global $db;
    $query = "select * from Course where dept = :dept and courseID = :courseid and section = :section";
    $statement = $db->prepare($query);
    $statement->bindValue(':dept', $dept);
    $statement->bindValue(':courseid', $courseid);
    $statement->bindValue(':section', $section);
	$statement->execute();
	$results = $statement->fetch();   
	$statement->closeCursor();
	return $results;
}

function searchClassesByDeptAndID($dept, $courseid) {
    global $db;
    $query = "select * from Course where dept = :dept and courseID = :courseid";
    $statement = $db->prepare($query);
    $statement->bindValue(':dept', $dept);
    $statement->bindValue(':courseid', $courseid);
	$statement->execute();
	$results = $statement->fetchAll();   
	$statement->closeCursor();
	return $results;
}

function searchClassesByDept($dept) {
    global $db;
    $query = "select * from Course where dept = :dept";
    $statement = $db->prepare($query);
    $statement->bindValue(':dept', $dept);
    $statement->execute();
    $results = $statement->fetchAll();   
	$statement->closeCursor();
	return $results;
}

function searchClassesByID($courseid) {
    global $db;
    $query = "select * from Course where courseID = :courseid";
    $statement = $db->prepare($query);
    $statement->bindValue(':courseid', $courseid);
    $statement->execute();
    $results = $statement->fetchAll();   
	$statement->closeCursor();
	return $results;
}

function searchClassesByLevel($dept, $courseid) {
    global $db;
    $query = "select * from Course where dept = :dept and courseID >= :courseid and courseID < :courseid + 1000";
    $statement = $db->prepare($query);
    $statement->bindValue(':dept', $dept);
    $statement->bindValue(':courseid', $courseid);
	$statement->execute();
	$results = $statement->fetchAll();   
	$statement->closeCursor();
	return $results;
}

function addClass($studentid, $dept, $courseid, $section)
{
    global $db;
    $query = "insert into takes values(:studentid, '2022EUVA', :courseid, :section, :dept)";    
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->bindValue(':dept', $dept);
    $statement->bindValue(':courseid', $courseid);
    $statement->bindValue(':section', $section);
    $statement->execute();
    $statement->closeCursor();
}

function getClassesByUser($studentid) {
    global $db;
    $query = "select * from takes where studentID = :studentid";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->execute();
    $results = $statement->fetchAll();   
    $statement->closeCursor();
    return $results;
}

function deleteClass($studentid, $dept, $courseid, $section) {
    global $db;
    $query = "delete from takes where studentID = :studentid and dept = :dept and courseID = :courseid and section = :section";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->bindValue(':dept', $dept);
    $statement->bindValue(':courseid', $courseid);
    $statement->bindValue(':section', $section);
    $statement->execute();
    $statement->closeCursor();
}

?>