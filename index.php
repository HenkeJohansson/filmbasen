<?php include "includes/header.inc.php"; ?>

    <body>
        <div id="content">
	    <h1>Filmbasen</h1>
	    
	    <?php include 'includes/connect.inc.php'; ?>
	    
	    <div id="buttons">
                <a href="addstuff.php" class="flat_btn"><span>Add stuff</span></a>
                <a href="movies.php" class="flat_btn"><span>Full list</span></a>
                <a href="search.php" class="flat_btn"><span>Search</span></a>
	    </div><!-- #buttons -->
            </Br>
            
        </div><!-- #content -->
        
	<a href="logout.php">Logga ut</a>
	<br>
	<?php echo $_SESSION['user_email']; ?>
	
	<!--<div id="bg_bild"></div><!-- #bg_bild -->
	<!-- <a href="http://www.youtube.com/watch?v=KUnNHAg91Yo">Datorsäkerhet</a> -->
	
        <footer>
            
        </footer>
    </body>
</html>
