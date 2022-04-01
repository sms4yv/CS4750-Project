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