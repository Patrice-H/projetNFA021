<?php
	header('content-type: text/html; charset=utf-8');

	try{
		$bdd = new PDO('mysql:host=localhost;dbname=projetNFA021;charset=utf8', 'root', '');
	}
	catch(Exception $e){
		die($e->getMessage());
	}
	$donnees = $bdd->query('SELECT * FROM client ORDER BY id');
	
	echo "<head><title>Administration</title><meta charset='UTF-8'>";
    echo "<link rel='stylesheet' href='../CSS/style.css'></head><body>";
	echo "<div id='table_inscription'><table id='bleu'><tr><th>Nom de l'utilisateur</th><th>";
	echo utf8_encode("Prénom");
	echo "</th><th>Email</th><th>Date de naissance</th></tr>";
	while ($champ = $donnees->fetch()){
		echo "<tr><td>".$champ['nom']."</td>";
		echo "<td>".$champ['prenom']."</td>";
		echo "<td>".$champ['mail']."</td>";
		echo "<td>".$champ['date_enregistrement']."</td></tr>";	
	}
	echo "</table></div></body>";
?>
