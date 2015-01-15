<?php include "includes/header.inc.php"; ?>
    
    <body>
	
	<div id="content2">
	    
	    <h1>All movies</h1>
	    
	    <?php
	    
		include 'includes/connect.inc.php';
                include 'includes/movieRating.inc.php';
		include 'includes/peo_table.inc.php';
		
		// Hämtar allt från movie eftersom att alla kolumner ska användas
		$sql="SELECT * FROM movie";
		$result=$pdo->query($sql);
		
	    ?>
		
	    <br>
		
	    <div class="loop" width="500px">
	     
		<?php foreach ($result as $row): 
		    $mov_title=$row['mov_title'];
		    $mov_rate=$row['mov_rate'];
		    $mov_year=$row['mov_year'];
		    $mov_synopsis=$row['mov_synopsis'];
		    $mov_pic=$row['mov_pic'];
		    $mov_id=$row['mov_id'];
		?>
		
		
		<a href="#"><h3 class="title"><?php echo $mov_title ?></h3></a>
		<div class="row">
		    <div class="floater">
			<img src="<?php echo $mov_pic ?>" class="poster" />
			
			    <div class="rating">
			    <?php movieRating($mov_rate) ?>
			</div><!-- .rating -->
			    <p class="year"><?php echo $mov_year ?></p>
			    <br>
				
			    <?php $sql_tri="SELECT * FROM trivia INNER JOIN movie
			    ON trivia.mov_id=movie.mov_id WHERE mov_title='$mov_title'";
			    $tri_result=$pdo->query($sql_tri); ?>
			    <?php foreach ($tri_result as $row):
				$tri_facts=$row['tri_facts'];
				$tri_quotes=$row['tri_quotes']; ?>
				<div class="trivia">
				    <p><span><?php echo $tri_facts ?></span></p>
				    <p style="margin: 10px 0"><span>"<?php echo $tri_quotes ?>"</span></p>
				</div>
			    <?php endforeach; ?>
			    
			    <br>
			    <p class="synopsis"><?php echo $mov_synopsis ?></p>
		    </div><!-- .floater -->
		    
		    <!-- För att koppla ihop rätt personer till rätt film behövs tabellerna
			 people och moviepeople kopplas samman. mov_id är kopplingen.
			 Det funkar ypperligt att här använda variabeln $mov_id då värdet i den
			 byts ut varje varv i loopen. Så nästa varv i loopen när tabellen under
			 skapas igen innehåller $mov_id värdet av nästa film och rätt personen sätts på plats -->
		    <?php $sql_peo_table="SELECT * FROM moviepeople INNER JOIN people
		    ON people.peo_id = moviepeople.peo_id
		    WHERE mov_id = $mov_id"; 
		    
		    // Sparar alla personer i en variabel som senare ska
		    // sättas på rätt plats i funktionen peo_table.
		    $peo_result=$pdo->query($sql_peo_table)->fetchAll(); ?>
		    
		    
		    <div class="table">
			<table>
			    <tr>
				<th colspan="2">Director</th>
			    </tr>
			    
			    <?php peo_table($peo_result,'director'); ?> <!-- funktion för insättning av rätt personer -->
			    
			    <tr>
				<th colspan="2">Writer</th>
			    </tr>
			    
			    <?php peo_table($peo_result,'writer'); ?>
			    
			    <tr>
				<th colspan="2">Actors</th>
			    </tr>
			    
			    <?php peo_table($peo_result,'actor'); ?>
			    
			</table>
			
		    </div><!-- .table -->
		    <div class="clearfix"></div><!-- .clearfix -->
		</div><!-- .loop -->
		    
		<?php endforeach; ?>	
		</div><!-- .row -->
	    </div><!-- #content -->
        
    </body>

    <footer>
        
    </footer>
    
</html>