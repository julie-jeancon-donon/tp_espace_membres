<?php

require 'config.php';


if ( isset($_POST['name'], $_POST['mdp'], $_POST['mdp2'], $_POST['mail']) AND !empty($_POST['name']) AND !empty($_POST['mdp']) AND !empty($_POST['mail']))  {
  $name=htmlspecialchars($_POST['name']);
  $mdp=htmlspecialchars($_POST['mdp']);
  $mdp2=htmlspecialchars($_POST['mdp2']);
  $mail=htmlspecialchars($_POST['mail']);


  $req_pseudo = $bdd->prepare('SELECT pseudo FROM membres WHERE pseudo= :pseudo');
  $req_pseudo->execute(['pseudo'=>$name]);
  $recup_pseudo = $req_pseudo->fetch();

  if ($name!==$recup_pseudo['pseudo']){


    if($mdp==$mdp2){

      if(preg_match("#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $mail))
      {
        $mdp_hash = password_hash($mdp, PASSWORD_DEFAULT);

        $req_infos = $bdd->prepare('INSERT INTO membres(pseudo, mdp, email, date_inscription) VALUES(:pseudo, :mdp_hash, :mail, CURDATE())');
        $req_infos->execute(array(
          'pseudo' => $name,
          'mdp_hash' => $mdp_hash,
          'mail' => $mail));

        }
        else{
          echo 'Entrez une adresse mail correcte';
        }
    }
    else{
      echo 'les mots de passes saisis sont différents';
    }

  }
  else {
    echo 'ce pseudo est déjà pris';
  }

}


else{
  echo "merci de remplir tous les champs";
}


?>
