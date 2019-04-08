<?php
	//session_start();
	require("membre.php");

	$quidam = new Membre(array(
			"id" => "",
			"nom" => "",
			"prenom" => "",
			"mail" => $_POST['mail'],
			"date_enregistrement" => new DateTime(),
			"pass" => "",
			"repass" => ""
	));
	
	//	traitement client ajax
	if($_POST['origine'] == "reqajax"){
		if($quidam->email()){
			echo  "false";
		}
		else {
			echo  "true";
		}
	}
	
	//	traitement serveur
	else{
		$validation = true;
		
		$quidam->setNom($_POST['nom']);
		$quidam->setPrenom($_POST['prenom']);
		$quidam->setNaissance($_POST['enregistrement']);
		$quidam->setMotPasse($_POST['pass']);
		$quidam->setRePasse($_POST['repass']);
		
		$doc = new DOMDocument();
		$doc-> loadHTMLFile('HTML/inscription.html');
		
		if($quidam->email()){
			$doc->getElementById('erreur_mail')->nodeValue = utf8_encode("Votre e-mail est déjà enregistré");
			$validation = false;
		}
		else{
			$doc->getElementById('erreur_mail')->nodeValue = "";
		}
		if($quidam->getMotPasse() != $quidam->getRePasse()){
			$doc->getElementById('erreur_repass')->nodeValue = "Les mots de passe ne sont pas identiques";
			$validation = false;
		}
		else{
			$doc->getElementById('erreur_repass')->nodeValue = "";
		}
		if(strlen($quidam->getMotPasse()) < 8){
			$doc->getElementById('erreur_pass')->nodeValue = utf8_encode("votre mot de passe doit contenir 8 caratères au moins");
			$validation = false;
		}
		else{
			$doc->getElementById('erreur_pass')->nodeValue = "";
		}
		
		echo $doc->saveHTML();
		
		if($validation){
			//$quidam->ecrire();
			try{
			$bdd = new PDO('mysql:host=localhost;dbname=projetNFA021;charset=utf8', 'root', '');
			}
			catch(Exception $e){
				die($e->getMessage());
			}
			$req = $bdd->prepare('INSERT INTO client(nom, prenom, fonction, mail, date_enregistrement, pass) VALUES(:nom, :prenom, :fonction, :mail, :date_enregistrement, :pass)');
			$req->execute(array(
					'nom' => $quidam->getNom(),
					'prenom' => $quidam->getPrenom(),
					'mail' => $quidam->getMail(),
					'fonction' => '',
					'date_enregistrement' => $quidam->getNaissance(),
					'pass' => $quidam->getMotPasse()
			));
			header("Location: HTML/validation.html");
		}
	}
?>
