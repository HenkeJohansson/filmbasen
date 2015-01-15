<?php include "includes/header.inc.php"; ?>
        
        <a href="addstuff.php?form=1">Tillbaka</a>
        
        <?php
            
            
            include 'includes/connect.inc.php';
            include 'includes/image_uploader2.inc.php';
            include 'includes/add_person.inc.php';
            
            if (isset($_SESSION['loggedin'])===true) {
              
              // För filmformuläret. Kollar så att det är ifyllt. Om inte vill vi inte sätta in tomma rader i tabellen.
                if (isset($_POST['mov_title'])) {
                    
                    // MOVIE
                    $mov_title=htmlspecialchars($_POST['mov_title'],ENT_QUOTES);
                    $mov_synopsis=htmlspecialchars($_POST['mov_synopsis'],ENT_QUOTES);
                    $mov_year=htmlspecialchars($_POST['mov_year'],ENT_QUOTES);
                    $mov_rate=htmlspecialchars($_POST['mov_rate'],ENT_QUOTES);
                    
                    // DIRECTOR
                    $peo_firstname_dir=htmlspecialchars($_POST['peo_firstname_dir'],ENT_QUOTES);
                    $peo_lastname_dir=htmlspecialchars($_POST['peo_lastname_dir'],ENT_QUOTES);
                    $peo_birthyear_dir=htmlspecialchars($_POST['peo_birthyear_dir'],ENT_QUOTES);
                    
                    // WRITER
                    $peo_firstname_wri=htmlspecialchars($_POST['peo_firstname_wri'],ENT_QUOTES);
                    $peo_lastname_wri=htmlspecialchars($_POST['peo_lastname_wri'],ENT_QUOTES);
                    $peo_birthyear_wri=htmlspecialchars($_POST['peo_birthyear_wri'],ENT_QUOTES);
                    
                    // ACTOR 1
                    $peo_firstname1=htmlspecialchars($_POST['peo_firstname1'],ENT_QUOTES);
                    $peo_lastname1=htmlspecialchars($_POST['peo_lastname1'],ENT_QUOTES);
                    $peo_birthyear1=htmlspecialchars($_POST['peo_birthyear1'],ENT_QUOTES);
                    
                    // ACTOR 2
                    $peo_firstname2=htmlspecialchars($_POST['peo_firstname2'],ENT_QUOTES);
                    $peo_lastname2=htmlspecialchars($_POST['peo_lastname2'],ENT_QUOTES);
                    $peo_birthyear2=htmlspecialchars($_POST['peo_birthyear2'],ENT_QUOTES);
                    
                    // ACTOR 3
                    $peo_firstname3=htmlspecialchars($_POST['peo_firstname3'],ENT_QUOTES);
                    $peo_lastname3=htmlspecialchars($_POST['peo_lastname3'],ENT_QUOTES);
                    $peo_birthyear3=htmlspecialchars($_POST['peo_birthyear3'],ENT_QUOTES);
                    // HTML SPECIAL CHAR att försvara sig mot elaka tecken
                    
                    
                    // Funktionen för bilduppladdning.
                    $mov_pic=image_uploader2();
                    
                    // Lägger in i databasen.
                    // Förbereder INSERT
                    $sql_mov_check="SELECT COUNT(*) FROM movie WHERE mov_title = ?";
                    $statement_mov=$pdo->prepare($sql_mov_check);
                    $statement_mov->execute(array($mov_title));
                    
                    
                    //if ($statement_mov->fetchColumn()===0) {
                        //  Utför insert om $statement_mov är tom
                    
                        // Förbereder insättningen i tabellen movie.
                        $sql_mov="INSERT INTO movie (mov_title,mov_synopsis,mov_year,mov_rate,mov_pic)
                        VALUES (?,?,?,?,?)";
                        
                        
                    
                        // Utför insättningarna i movie, sedan genom en funktion sätts även datan från person-formulären
                        // in i people.
                        try {
                            $statement_mov=$pdo->prepare($sql_mov);
                            $statement_mov->execute(array($mov_title,$mov_synopsis,$mov_year,$mov_rate,$mov_pic));
                            $mov_id=$pdo->lastInsertId();
                            
                            // Funktionen add_person som lägger till personerna. Används eftersom det blev så krångligt med alla personer.
                            $peo_id_dir=add_person($peo_firstname_dir,$peo_lastname_dir,$peo_birthyear_dir,''); // Tomma platser iom att bild för personerna är skippade tillsvidare.
                            $peo_id_wri=add_person($peo_firstname_wri,$peo_lastname_wri,$peo_birthyear_wri,'');
                            
                            $peo_id1=add_person($peo_firstname1,$peo_lastname1,$peo_birthyear1,'');
                            $peo_id2=add_person($peo_firstname2,$peo_lastname2,$peo_birthyear2,'');
                            $peo_id3=add_person($peo_firstname3,$peo_lastname3,$peo_birthyear3,'');
                            
                        } catch (PDOExeption $e) {
                            
                            echo "No data could be inserted";
                            echo "Error: $e";
                            
                        }
                       
                        // Sen måste filmen och personerna sammankopplas. Det görs med kopplingstabellen moviepeople.
                        $sql_moviepeople="INSERT INTO moviepeople (mov_id,peo_id,profession)
                        VALUES (?,?,?)";
                        
                        // Många personer kräver många insättningar.
                        // Även här kollas det så att fälten inte är tomma innan insättning.
                        // Är fälten tomma görs ingen insättning och man slipper En namnlös person
                        // som är med i skitmånga filmer. Det skulle blivit många onödiga rader i tabellen
                        try {
                            $statement_moviepeople=$pdo->prepare($sql_moviepeople);
                            
                            if ($peo_id_dir !== FALSE) {
                                $statement_moviepeople->execute(array($mov_id,$peo_id_dir,'director'));
                            }
                            
                            if ($peo_id_wri !== FALSE) {
                                $statement_moviepeople->execute(array($mov_id,$peo_id_wri,'writer'));
                            }
                            
                            if ($peo_id1 !== FALSE) {
                                $statement_moviepeople->execute(array($mov_id,$peo_id1,'actor'));
                            }
                            
                            if ($peo_id2 !== FALSE) {
                                $statement_moviepeople->execute(array($mov_id,$peo_id2,'actor'));
                            }
                            
                            if ($peo_id3 !== FALSE) {
                                $statement_moviepeople->execute(array($mov_id,$peo_id3,'actor'));
                            }
                            
                            
                        } catch (PDOException $e) {
                            echo "No data could be inserted";
                            echo "Error: $e";
                        }
                        
                        echo "Hopefully the movie and people you have submited have found their place in the database";
                        
                    } else {
                        // Meddela att filmen redan finns
                        echo "<br>Filmen finns redan i filmbasen!<br>";
                    }
                
                }
            //} else {
                exit();
            //}

            
            
            
            
            // ALTER TABLE table_name AUTO_INCREMENT=51 
        ?>  
        
        </Br>
        
    </body>
</html>