<?php
    
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $fonction = $_POST['fonction'];
    $mail = $_POST['mail'];
    $naissance = $_POST['naissance'];
    $pass = $_POST['pass'];
    $repass = $_POST['repass'];
    
    echo $nom . " " . $prenom . " " . $fonction;
    try{
        $bdd = new PDO('mysql:host=localhost;dbname=projetNFA021;charset=utf8', 'root', '');
    }
    catch(Exception $e){
        die($e->getMessage());
    }
    
?>