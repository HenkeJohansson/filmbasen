<?php include "includes/header.inc.php"; ?>

    <body>

        <?php
            
            include 'includes/connect.inc.php';
            
            $user_email=htmlspecialchars($_POST['user_email'],ENT_QUOTES);
            $user_password=htmlspecialchars($_POST['user_password'],ENT_QUOTES);
            
            require 'includes/hash_password.inc.php';
            
            // password_hash funkar bara i php 5.5.
            $passwordHash=hash_password($user_password);
            
            $sql="INSERT INTO user (user_email,user_password) VALUES (?,?)";
            
            try {
                $statement=$pdo->prepare($sql);
                $statement->execute(array($user_email,$passwordHash));
                echo "...Det lyckades :O";
            } catch (PDOExeption $e) {
                echo "User could not be inserted";
                echo "Error: $e";
            }
            // echo länk tillbaka
        ?>

        </Br>
        
        
        <footer>
            
        </footer>
    </body>
</html>
