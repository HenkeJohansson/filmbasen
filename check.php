<?php include "includes/header.inc.php"; ?>

    <body>

        <?php
            
            
            $typeIn_email=htmlspecialchars($_POST['typeIn_email'],ENT_QUOTES);
            $typeIn_password=htmlspecialchars($_POST['typeIn_password'],ENT_QUOTES);
            
            include 'includes/connect.inc.php';
            require 'includes/hash_password.inc.php';
            
            $sql="SELECT user_id,user_email,user_password FROM user WHERE user_email='$typeIn_email'";
            
            // Eftersom att vi behöver de olika värdena i en array så räcker inte
            // den första raden $result=pdo->query($sql) utan vi måste använda funktionen
            // fetchAll som samlar ihop allt i en array.
            $result=$pdo->query($sql);
            $resultArray=$result->fetchAll();
            $loggedin=false; // Börjar med false
            
            // Kollar om användaren finns och om lösenordet stämmer
            if (count($resultArray)==1) {
                $user_password=$resultArray[0]['user_password'];
                
                if (verify_password ($typeIn_password, $user_password)) {
                    $loggedin=true; //När det stämmer blir variabeln true
                }
            }
            
            // Sätter SESSIONs-variablerna om föregående if-sats kunde köras
            if(!$loggedin) {
                // Misslyckad inloggning ($loggedin=false)
                echo "Wrong password";
                
                $_SESSION['loggedin']=false;
                $_SESSION['user_email']='';
                $_SESSION['user_id']='';
            } else {
                // Lyckad inloggning ($loggedin=true)
                echo "You are loggedin my friend";
                echo "<br>";
                
                $user_email=$resultArray[0]['user_email'];
                $user_id=$resultArray[0]['user_id'];
                
                $_SESSION['loggedin']=true;
                $_SESSION['user_email']=$user_email;
                $_SESSION['user_id']=$user_id;
                
                echo $_SESSION['user_email'];
            }
            
        ?>

        </Br>
        
        
        <footer>
            
        </footer>
    </body>
</html>
