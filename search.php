<?php require 'includes/header.inc.php' ?>

    <body>

        
        </Br>
        
        <div id="content2">
            
            <h2>Search</h2>
            
            <div id="search">
                <form method="post" action="search.php">
                    <input type="search" results="5" placeholder="Search" autosave="some_unique_value" name="search">
                    <input id="search-btn" type="submit" name="Search" value="search"><br>
                    <input type="radio" name="radio" value="1"> Movies
                    <input type="radio" name="radio" value="2"> People
                </form>
            </div><!-- #search -->
            
            <div id="result">
            
                <?php
                    // Includerade filer
                    include 'includes/connect.inc.php';
                    include 'includes/movieRating.inc.php';
                    include 'includes/peo_table.inc.php';
                    
                    // Search movie och person
                    
                    // Genom att använda radio-buttons
                    // kan man välja om sökningen ska
                    // göras på filer eller personer.
                    $radio=intval($_POST['radio']);
                    $search=$_POST['search']; ?>
                    
                    <!-- En if-sats används för att göra sökningen som valdes vid radioknapparna -->
                    <?php if ($radio==1): ?>
                        
                        <!-- MOVIE SEARCH -->
                        <!-- All information hämtas från de raderna där columnen mov_title matchade sökningen
                             '%$varianel%' använd för att exakt rätt titel inte ska behövas skrivas för att få resultat-->
                        <?php $sql="SELECT * FROM movie WHERE mov_title LIKE '%$search%'";
                        $result=$pdo->query($sql); ?>
                        
                        <div class="loop" width="500px">
                        
                        <!-- Resultatet sattes i en array som nu loopas igenom. Först läggs informationen från kolumnerna
                             in i variabler för att användas senare i loopen när utskift sker -->
                        <?php foreach ($result as $row):
                        $mov_title=$row['mov_title'];
                        $mov_rate=$row['mov_rate'];
                        $mov_year=$row['mov_year'];
                        $mov_synopsis=$row['mov_synopsis'];
                        $mov_pic=$row['mov_pic'];
                        $mov_id=$row['mov_id']; ?>
                        
                        <!-- Divar, rubriker skapas där innehållet från tabellen movies fylls i -->
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
                            
                            <!-- En sökning för att få med regisör skådespelare etc. till respektive film.
                                 För att rätt personer ska hamna vid rätt film används kopplingstabellen
                                 moviepeople tillsammans med tabellen people för att få kopplingen mellan
                                 personerna och filmerna. moviepeople innehåller både peo_id och mov_id
                                 som behövs för att göra kopplingen mellan personerna och filmerna -->
                            <?php $sql_peo_table="SELECT * FROM moviepeople INNER JOIN people
                            ON people.peo_id = moviepeople.peo_id
                            WHERE mov_id = '$mov_id'";
                            
                            $peo_result=$pdo->query($sql_peo_table)->fetchAll(); ?>
                            
                            <!-- Tabell för personerna -->
                            <div class="table">
                                <table>
                                    <tr>
                                        <th colspan="2">Director</th>
                                    </tr>
                                    
                                    <!-- Funktionen för att få in rätt people på rätt plats i tabellen -->
                                    <?php peo_table($peo_result,'director'); ?>
                            
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
                        
                        <?php endforeach; ?> <!-- Kanske detta som dummar sig med sökningen -->
                        
                    <?php elseif ($radio==2): ?>
                        
                        <?php $sql_peo="SELECT * FROM moviepeople INNER JOIN people
                        ON people.peo_id = moviepeople.peo_id
                        WHERE peo_firstname OR peo_lastname LIKE '%$search%'";
                            
                            $peo_result=$pdo->query($sql_peo)->fetchAll(); ?>
                            
                            <!-- Tabell för personerna -->
                            <div id="table2">
                                <table>
                                    <tr>
                                        <th colspan="2">Director</th>
                                    </tr>
                                    
                                    <!-- Funktionen för att få in rätt people på rätt plats i tabellen -->
                                    <?php peo_table($peo_result,'director'); ?>
                            
                                    <tr>
                                        <th colspan="2">Writer</th>
                                    </tr>
                                    
                                    <?php peo_table($peo_result,'writer'); ?>
                                    
                                    <tr>
                                        <th colspan="2">Actors</th>
                                    </tr>
                                    
                                    <?php peo_table($peo_result,'actor'); ?>
                                    
                                </table>
                                
                            </div><!-- .table2 -->
                            <div class="clearfix"></div><!-- .clearfix -->
                        
                    <?php endif; ?>
                
                <?php
                // Funkar
                // SELECT * FROM movie INNER JOIN moviepeople ON movie.mov_id=moviepeople.mov_id INNER JOIN people ON moviepeople.peo_id=people.peo_id WHERE mov_title = 'drive'
                
                ?>
            
            </div><!-- #result2 -->
        
        </div><!-- #content -->
        
        <footer>
            
        </footer>
    </body>
</html>
