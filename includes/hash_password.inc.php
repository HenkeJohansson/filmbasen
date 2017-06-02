<?php

    function hash_password($password) {
        $salt_raw = mcrypt_create_iv(16, MCRYPT_DEV_URANDOM);       // Skapar en sträng med 16 slumpmässiga tecken
        $salt_b64 = base64_encode($salt_raw);                       // Gör om strängen så att den innehåller "rätt tecken" och så blir den längre lol (typ ASCII-koder för tecken)
        $salt = substr(str_replace('+', '.', $salt_b64), 0, 22);    // Byter ut tecken och plockar ut de 22 första tecknena.
    
        $options_salt = '$2y$10$' . $salt . '$';                    // Lägger till information om hur det ska komprimeras på saltet.
    
        // Hashar lösenordet och lägger på saltet
        $hash = crypt($password, $options_salt);
        return $hash;
    }
   
    function verify_password($password, $hash) {
        $new_hash = crypt($password, $hash); // Plockar ut saltet från början av strängen och skiter i resten
    
        // Kollar om strängen är längre än 13 tecken och om tecknena stämmer.
        if (strlen($new_hash) <= 13 || $new_hash != $hash) {
            return FALSE;
        } else {
            return TRUE;
        }
    }

?>
