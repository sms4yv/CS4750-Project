<?php
function getTextbook($search){
    global $db;
    echo "preparing statement with ".$search." as primary key";
    $query = "select * from sells where ISBN = :ISBN";
    echo $query;
    $statement = $db->prepare($query);
    $statement->bindValue(':ISBN', $search);
	$statement->execute();  

    $results = $statement->fetchAll();
    $statement->closeCursor();
    return $results;
    }
