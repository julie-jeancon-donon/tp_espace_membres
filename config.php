<?php

try
 {
     $bdd = new PDO('mysql:host=localhost;dbname=espace_membres;charset=utf8', 'root', 'jeanconweb3');

 }
 catch(Exception $e)
 {
         die('Erreur : '.$e->getMessage());
 }



 ?>
