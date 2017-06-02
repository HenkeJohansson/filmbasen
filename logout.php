<?php session_start() ?>

<!doctype html>
<html lang="sv">
    <head>
	<meta charset="UTF-8" />
        <meta name="author" content="Henrik Johansson" />
        <meta name="description" content="" />
        <meta name="keywords" content="" />
        <link rel="stylesheet" href="css/style.css" media="screen" type="text/css" />
	<title>Henke</title>
    </head>

    <body>
	
	<a href="index.php">Tillbaka till index</a>
	
	<?php
        
        
	    $_SESSION=array(); // Sessionen lever fortfarande, men alla sessionsvariabler tas bort.
	    session_destroy(); // Avslutar sessionen.
        
        
        ?>
        
    </body>

    <footer>
        
    </footer>
    
</html>
