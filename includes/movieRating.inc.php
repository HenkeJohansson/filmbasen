<?php
    // Loopar fram "stjärnorna" som är png-filer beroende på betyg
    function movieRating($mov_rate) {
    
        if ($mov_rate == 1) {
            echo '<img src="img/death_star.png"/>';
        } elseif ($mov_rate == 2) {
            echo '<img src="img/death_star.png"/>';
            echo '<img src="img/death_star.png"/>';
        } elseif ($mov_rate == 3) {
            for ($i=0; $i<3; $i++) {
                echo '<img src="img/death_star.png"/>';
            }
        } elseif ($mov_rate == 4) {
            for ($i=0; $i<4; $i++) {
                echo '<img src="img/death_star.png"/>';
            }
        } elseif ($mov_rate == 5) {
            for ($i=0; $i<5; $i++) {
                echo '<img src="img/death_star.png"/>';
            }
        }
    }

?>