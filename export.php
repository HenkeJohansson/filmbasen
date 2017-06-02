<?php include "includes/header.inc.php"; ?>

    <body>
    
	<?php
        
	    include "includes/connect.inc.php";
	    
	    // Hämta datan från tabellen
	    $sql="SELECT * FROM movie";
	    $result=$pdo->query($sql); // Skickar sql-frågan till databasen
	    
	    $export="mov_title\tmov_rate\tmov_year\tmov_synopsis\t@picture\n";
	    
	    foreach ($result as $row) {
		$prod_id=$row['prod_id'];
		$mov_title=$row['mov_title'];
		$mov_rate=$row['mov_rate'];
		$mov_year=$row['mov_year'];
		$mov_synopsis=$row['mov_synopsis'];
		$pic=$row['mov_pic'];
		
		//$pic="/img/mov/$mov_pic.jpg";
		
		// Spara i en variabel
		$export.="$mov_title\t$mov_rate\t$mov_year\t$mov_synopsis\t/$pic\n";
	    }
	    
	    //Skapar och fyller filen
	    $filename="export.txt";
	    file_put_contents($filename,$export);
	    
	    echo "The exported file is <a href='$filename'>here</a>";
        
        ?>
        
    </body>

    <footer>
        
    </footer>
    
</html>
