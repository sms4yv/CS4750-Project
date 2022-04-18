<?php



function searchTextbookByID($isbn) {
    global $db;
    $query = "select * from Textbook where ISBN = :isbn";
    $statement = $db->prepare($query);
    $statement->bindValue(':isbn', $isbn);
    $statement->execute();
    $results = $statement->fetch();   
	$statement->closeCursor();
	return $results;
}

function addTextbook($studentID,$isbn)
{
    global $db;
    $query = "insert into owns values(:studentID, :isbn)";    
    $statement = $db->prepare($query);
    $statement->bindValue(':studentID', $studentID);
    $statement->bindValue(':isbn', $isbn);
    $statement->execute();
    $statement->closeCursor();
}

function getTextbooksByUser($studentid) {
    global $db;
    $query = "select * from owns where studentID = :studentid";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentid);
    $statement->execute();
    $results = $statement->fetchAll();   
    $statement->closeCursor();
    return $results;
}

function deleteTextbook($studentID,$isbn) {
    global $db;
    $query = "delete from owns where studentID = :studentid and isbn = :isbn";    
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentID);
    $statement->bindValue(':isbn', $isbn);
    $statement->execute();
    $statement->closeCursor();
}

function getCountTextbook($studentID){
    //www.mysqltutorial.org/php-calling-mysql-stored-procedures/
    global $db;
    $query = "CALL countTextbooks((:studentid), @p1);SELECT @p1 AS num_textbooks;";
    $statement = $db->prepare($query);
    $statement->bindValue(':studentid', $studentID);
    $statement->execute();
    $statement->closeCursor();
    $row = $db->query("SELECT @p1 AS numTextbooks")->fetch();
    if ($row){
        return $row!== false ? $row['numTextbooks']:null;
    }

    return $results;

}
function verifyTextbook($isbn){
    global $db;
    $query = "select * from Textbook where ISBN = (:isbn)";
    $statement = $db->prepare($query);
    $statement->bindValue(':isbn', $isbn);
    $statement->execute();
    $results = $statement->fetchAll();   
	$statement->closeCursor();
    $numResults = 0;
    foreach ($results as $result):
        $numResults += 1;
    endforeach;

	return $numResults>0;

}

?>