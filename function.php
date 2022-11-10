<?php
    function test($valeur) {
        if(isset($valeur) && !empty($valeur) && !is_null(($valeur))) {
            return true;
        }
        return false;
    }

    function connect() {
        $bddHost = 'mysql:host=localhost:3306;dbname=bibliotheque';
        $bdduser = 'phpuser';
        $bddpass = '1234';
        $bddBiblio = new pdo($bddHost, $bdduser, $bddpass);
    return $bddBiblio;
    }
