<?php

function addStudent($studentid, $name, $year) {
    global $db;
    $query = "insert into Student values(:studentid, :name, :year)";

    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':year', $year);

    $statement->execute();

    $statement->closeCursor();
}

function addMajor($studentid, $major) {
    global $db;
    $query = "insert into Student_major values(:studentid, :major)";

    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->bindValue(':major', $major);

    $statement->execute();

    $statement->closeCursor();
}

function updateStudent($studentid, $name, $year) {
    global $db;
    $query = "update Student set name=:name, year=:year where studentID=:studentid";
    $statement = $db->prepare($query);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':year', $year);
    $statement->bindValue(':studentid', $studentid);
    $statement->execute();
    $statement->closeCursor();
}

function getStudent($studentid) {
    global $db;
    $query = "select * from Student where studentID = :studentid";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
	$statement->execute();
    
    // $statement = $db->query($query);
	$results = $statement->fetch();   
	$statement->closeCursor();
	return $results;
}

function getMajors($studentid) {
    global $db;
    $query = "select major from Student_major where studentID = :studentid";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
	$statement->execute();
    
    // $statement = $db->query($query);
	$results = $statement->fetchAll();   
	$statement->closeCursor();
	return $results;
}

function deleteMajors($studentid)
{
    global $db;
    $query = "delete from Student_major where studentID=:studentid";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->execute();
    $statement->closeCursor();
}