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