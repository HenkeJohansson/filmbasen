<?php

    function add_person ($peo_firstname,$peo_lastname,$peo_birthyear,$peo_pic) {
	
	// Include behövs här eftersom funktioner inte kan hämta nått utanför funktionen.
	include 'connect.inc.php';
	
	// Kollar så att variablerna inte är tomma.
	// Är de tomma körs inte funktionen längre.
	if (empty($peo_firstname) && empty($peo_lastname)) {
	    return FALSE;
	}
	
	// Kollar ifall personen redan finns i databasen.
	$sql_peo_check="SELECT peo_id FROM people WHERE peo_firstname=? AND peo_lastname=?";
	
	// Använder prepare execute här eftersom datan används i sql-koden kommer från användaren.
	$statement_peo=$pdo->prepare($sql_peo_check);
	$statement_peo->execute(array($peo_firstname,$peo_lastname));
	
	// Hämtar datan från people-tabellen som matchade det användaren försöker
	// lägga till. Datan hämtas till variabeln $peo_id.
	$peo_id=$statement_peo->fetchColumn();
	
	// Var där inget som matchade lades inget till i variabeln $peo_id och en insättning kan göras.
	if ($peo_id === FALSE) {
	    
	    // Add pople
	    $sql_peo="INSERT INTO people (peo_firstname,peo_lastname,peo_birthyear,peo_pic)
	    VALUES (?,?,?,?)";
	    
	    // Utför INSERT
	    try {	    
		$statement_peo=$pdo->prepare($sql_peo);
		$statement_peo->execute(array($peo_firstname,$peo_lastname,$peo_birthyear,$peo_pic));
		$peo_id=$pdo->lastInsertId();
		
	    } catch (PDOExeption $e) {		
		echo "No data could be inserted";
		echo "Error: $e";
		
	    }
	
	}
	
	// Annars görs ingen insättning.
	return $peo_id;
    }

?>
